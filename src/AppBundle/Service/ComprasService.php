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
        if (!array_key_exists($data[0], $masivaOC)) {
            $ordenDeCompra = new OrdenDeCompra();
            $ordenDeCompra->setProveedor($data[1]);
            $ordenDeCompra->setCuentaEbayCompra($data[2]);
            $ordenDeCompra->setShipping($data[5]);
            $ordenDeCompra->setWarehouse($data[7]);
            $ordenDeCompra->setTarjeta1($data[8]);
            $ordenDeCompra->setPago1($data[9]);
            $ordenDeCompra->setTarjeta2($data[10]);
            $ordenDeCompra->setPago2($data[11]);
            $ordenDeCompra->setTarjeta3($data[12]);
            $ordenDeCompra->setPago3($data[13]);
            $ordenDeCompra->setTarjeta4($data[14]);
            $ordenDeCompra->setPago4($data[15]);
            $ordenDeCompra->setTarjeta5($data[16]);
            $ordenDeCompra->setPago5($data[17]);
            $masivaOC[$data[0]] = $ordenDeCompra;

        }

        $ordenDeCompra = $masivaOC[$data[0]];
        $reserva = $this->em->getRepository(Reserva::class)->findOneById($data[3]);
        if ($reserva == null) 
            throw new \Exception("Reserva no encontrada ".$data[3], 1);
        if ($reserva->getEstado() != Estado::PROCESO_DE_COMPRA) 
            throw new \Exception("Reserva con estado invalido ".$reserva->getEstado(), 1);
            
        $reserva->setCostoCompraProducto($data[4]);
        $reserva->setTracking($data[6]);
        $reserva->setOrdenDeCompra($ordenDeCompra);
        $estado = $this->em->getRepository(Estado::class)->findOneByCodigo(Estado::COMPRADO);
        $reserva->setEstado($estado);
        
        $this->em->persist($ordenDeCompra);
        $this->em->persist($reserva);
        
        return $masivaOC;
    }

}
