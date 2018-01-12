<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use AppBundle\Entity\PublicacionML;
use AppBundle\Entity\Producto;
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

    public function productosPorMinimoYVendidos($minimo, $vendidos) {
        $sql = "select p.id as id, p.marca as marca, p.modelo as modelo , sum(pm.cantidadVendidos) as ventas , min(pm.precio_compra) as precioMinimo from producto p join publicacion_ml pm on pm.producto_id = p.id group by p.id having ventas > ".$vendidos." and precioMinimo > ".$minimo." order by ventas desc;";

        $stmp = $this->em->getConnection()->prepare($sql);
        $stmp->execute();
        $productos = $stmp->fetchAll();
        $resultado = "IDENTIFICADOR_PRODUCTO , MARCA, MODELO";

        foreach ($productos as $key => $prod) {
            $resultado .= $prod["id"].",".$prod["marca"].",".$prod["modelo"];
        }

        return $resultado;
    }
}