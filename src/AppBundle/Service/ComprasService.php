<?php

namespace AppBundle\Service;

use AppBundle\Entity\OrdenDeCompra;
use AppBundle\Entity\Reserva;
use AppBundle\Entity\Estado;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

/**
 * Include the SDK by using the autoloader from Composer.
 */

class ComprasService
{
    const FECHA_PAGO_1_KEY          = 0;
    const CUENTA_PAYPAL_KEY         = 1;
    const NOMBRE_PRODUCTO_PUBLI_KEY = 2;
    const NUMERO_TEMPORAL_ORDEN     = 3;
    const PROVEEDOR_KEY             = 4;
    const CUENTA_EBAY_COMPRA_KEY    = 5;
    const RESERVA_KEY               = 6;
    const COSTO_PRODUCTO_KEY        = 7;
    const SHIPPING_KEY              = 8;
    const TRACKING_KEY              = 9;
    const WAREHOUSE_KEY             = 10;
    const TARJETA1_KEY              = 11;
    const PAGO1_KEY                 = 12;
    const TARJETA2_KEY              = 13;
    const PAGO2_KEY                 = 14;
    const TARJETA3_KEY              = 15;
    const PAGO3_KEY                 = 16;
    const TARJETA4_KEY              = 17;
    const PAGO4_KEY                 = 18;
    const TARJETA5_KEY              = 19;
    const PAGO5_KEY                 = 20;

    const ARRAY_COLUMNAS = [
                                self::FECHA_PAGO_1_KEY        => "Fecha pago 1" ,
                                self::CUENTA_PAYPAL_KEY       => "Cuenta Paypal",
                                self::NOMBRE_PRODUCTO_PUBLI_KEY => "Producto",
                                self::NUMERO_TEMPORAL_ORDEN   => "Número temporal de orden",
                                self::PROVEEDOR_KEY           => "Proveedor",
                                self::CUENTA_EBAY_COMPRA_KEY  => "Cuenta de Ebay usada",
                                self::RESERVA_KEY             => "Número de reserva",
                                self::COSTO_PRODUCTO_KEY      => "Costo de producto",
                                self::SHIPPING_KEY            => "Shipping",
                                self::TRACKING_KEY            => "Tracking",
                                self::WAREHOUSE_KEY           => "Warehouse",
                                self::TARJETA1_KEY            => "Tarjeta 1",
                                self::PAGO1_KEY               => "Pago 1",
                                self::TARJETA2_KEY            => "Tarjeta 2",
                                self::PAGO2_KEY               => "Pago 2",
                                self::TARJETA3_KEY            => "Tarjeta 3",
                                self::PAGO3_KEY               => "Pago 3",
                                self::TARJETA4_KEY            => "Tarjeta 4",
                                self::PAGO4_KEY               => "Pago 4",
                                self::TARJETA5_KEY            => "Tarjeta 5",
                                self::PAGO5_KEY               => "Pago 5"
                            ];

	private $container;
    
    /**
    *
    * @var EntityManager
    */
    private $em;


    public function __construct( Container $container, EntityManager $entityManager )
    {
        $this->container = $container;
        $this->em = $entityManager;
    }

    /*
        Recibe un archivo
            Genera un array con ordenes de compra
                Por cada orden actualiza las reservas
            Guarda todo en la DB
        Devuelve vacio
    */

    public function cargaMasivaOrdenDeCompra($archivo) {
        $row = 0;
        $masivaOC = [];
        if (($handle = fopen($archivo, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                    $row++;
                    if ($row == 1 ) continue;

                    $masivaOC = $this->cargarOrdenDeCompra($data, $masivaOC);
              }
            }
        
        $this->em->flush();
    }

    public function cargarOrdenDeCompra($data, $masivaOC){
        
        foreach ($data as $key => $value) {
            $data[$key] = $value == "" ? null : $data[$key];
        }

        $ordenDeCompra = new OrdenDeCompra();
        $ordenDeCompra->setFechaPrimerPago($data[self::FECHA_PAGO_1_KEY]);
        $ordenDeCompra->setCuentaPaypal($data[self::CUENTA_PAYPAL_KEY]);
        $ordenDeCompra->setProveedor($data[self::PROVEEDOR_KEY]);
        $ordenDeCompra->setCuentaEbayCompra($data[self::CUENTA_EBAY_COMPRA_KEY]);
        $ordenDeCompra->setShipping($data[self::SHIPPING_KEY]);
        $ordenDeCompra->setWarehouse($data[self::WAREHOUSE_KEY]);
        $ordenDeCompra->setTarjeta1($data[self::TARJETA1_KEY]);
        $ordenDeCompra->setPago1($data[self::PAGO1_KEY]);
        $ordenDeCompra->setTarjeta2($data[self::TARJETA2_KEY]);
        $ordenDeCompra->setPago2($data[self::PAGO2_KEY]);
        $ordenDeCompra->setTarjeta3($data[self::TARJETA3_KEY]);
        $ordenDeCompra->setPago3($data[self::PAGO3_KEY]);
        $ordenDeCompra->setTarjeta4($data[self::TARJETA4_KEY]);
        $ordenDeCompra->setPago4($data[self::PAGO4_KEY]);
        $ordenDeCompra->setTarjeta5($data[self::TARJETA5_KEY]);
        $ordenDeCompra->setPago5($data[self::PAGO5_KEY]);

        if (!array_key_exists($data[0], $masivaOC)) {
            $masivaOC[$data[0]] = $ordenDeCompra;

        } else {
            /* Validar que los datos sean iguales a los de la OC */
            $oc = $masivaOC[$data[0]];
            $mensaje = $oc->tieneDatosDistintosA($ordenDeCompra);
            if ( $mensaje != false) {
                throw new \Exception("La columna ".$mensaje." de una misma OC debe ser igual en todas las filas", 1);
            }
        }

        $ordenDeCompra = $masivaOC[$data[0]];
        $reserva = $this->em->getRepository(Reserva::class)->findOneById($data[3]);
        if ($reserva == null) 
            throw new \Exception("Reserva no encontrada ".$data[self::RESERVA_KEY], 1);
        if ($reserva->getEstado() != Estado::PROCESO_DE_COMPRA) 
            throw new \Exception("Reserva con estado invalido ".$reserva->getEstado(), 1);
            
        $reserva->setCostoCompraProducto($data[self::COSTO_PRODUCTO_KEY]);
        $reserva->setTracking($data[self::TRACKING_KEY]);
        $reserva->setOrdenDeCompra($ordenDeCompra);
        $estado = $this->em->getRepository(Estado::class)->findOneByCodigo(Estado::COMPRADO);
        $reserva->setEstado($estado);
        
        $this->em->persist($ordenDeCompra);
        $this->em->persist($reserva);
        
        return $masivaOC;
    }

    public function csvContent_seleccion_compra() {
        $estado = $this->em->getRepository(Estado::class)->findOneByCodigo(Estado::PROCESO_DE_COMPRA);
        $reservasSeleccionadas = $this->em->getRepository(Reserva::class)->findByEstado($estado);;

        $csv = "";
        foreach (self::ARRAY_COLUMNAS as $key => $columnaNombre) {
            $csv .= $columnaNombre.",";
        }
        $csv .= substr($csv, 0, -1)."\n";

        foreach ($reservasSeleccionadas as $key => $reserva) {
            foreach (self::ARRAY_COLUMNAS as $key => $columnaNombre) {
                if ($key == self::RESERVA_KEY)
                    $csv .= $reserva->getId();
                else if ($key == self::NOMBRE_PRODUCTO_PUBLI_KEY) 
                    $csv .= $reserva->getProducto()->getNombre()." - ".$reserva->getProductoNoCargado();
                else
                    $csv .= ",";
            }
            $csv .= "\n";
        }
        
        return $csv;
    }    
}
?>