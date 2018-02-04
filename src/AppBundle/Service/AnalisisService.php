<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use AppBundle\Entity\PublicacionML;
use AppBundle\Entity\Producto;
use AppBundle\Entity\Reserva;
use AppBundle\Entity\TipoDePago;
/**
 * Include the SDK by using the autoloader from Composer.
 */

class AnalisisService
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
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
    }

    public function comisiones() {

        $mesActual = date('Y-m-01');
        $mesPasado = date('Y-m-01',strtotime("-1 month"));;

        $comisionPasada = 0;
        $comisionActual = 0;
        $tipos = $this->em->getRepository(TipoDePago::class)->findAll();
        
        foreach ($tipos as $key => $tipo) {
            $ventasMesPasado = $this->comisionesPorFechaYTipo($tipo,$mesPasado , $mesActual  );
            $ventasMesActual = $this->comisionesPorFechaYTipo($tipo, $mesActual );

            $comisionPasada += $ventasMesPasado * $tipo->getComision();
            $comisionActual += $ventasMesActual * $tipo->getComision();
        }
        
        $comisionActual += $this->comisionesExtra($comisionActual);
        $comisionPasada += $this->comisionesExtra($comisionPasada);

        return "Mes pasado: $".$comisionPasada."------- Actual: $".$comisionActual;
    }

    public function productosPorMinimoYVendidos($minimo, $vendidos) {
        $sql = "select p.id as id, p.marca as marca, p.modelo as modelo , sum(pm.cantidadVendidos) as ventas , min(pm.precio_compra) as precioMinimo from producto p join publicacion_ml pm on pm.producto_id = p.id group by p.id having ventas > ".$vendidos." and precioMinimo > ".$minimo." order by ventas desc;";

        $stmp = $this->em->getConnection()->prepare($sql);
        $stmp->execute();
        $productos = $stmp->fetchAll();
        $resultado = "IDENTIFICADOR_PRODUCTO , MARCA, MODELO,PRECIO_MINIMO,VENTAS\n";

        foreach ($productos as $key => $prod) {
            $resultado .= $prod["id"].",".$prod["marca"].",".$prod["modelo"].",".$prod["precioMinimo"].",".$prod["ventas"]."\n";
        }

        return $resultado;
    }

    private function comisionesPorFechaYTipo($tipo, $desde, $hasta = null) {
        if ($hasta != null) {
            $sql = "select count(*) as cantidad from reserva where fechaAlta between '$desde' and '$hasta' and tipo_de_pago_1_id = ".$tipo->getId();
        }
        else {
            $sql = "select count(*) as cantidad from reserva where fechaAlta > '$desde' and tipo_de_pago_1_id = ".$tipo->getId();
        }


        $stmp = $this->em->getConnection()->prepare($sql);
        $stmp->execute();
        $res = $stmp->fetchAll();
        return  $res[0]["cantidad"];

    }

    private function comisionesExtra($comision) {
        $extra =  intdiv($comision, 5000);
        return $extra * 1000;
    }
}