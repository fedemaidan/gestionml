<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use AppBundle\Entity\PublicacionML;
use AppBundle\Entity\Producto;
/**
 * Include the SDK by using the autoloader from Composer.
 */

class ProductosService
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

    /* Por cada publicación de ML busco producto en YouTec*/
            /* Si existe, cargo datos faltantes */
            /* Si no existe, cargo el producto*/
            /* Relaciono producto con la publicación ML */

    public function cargaProductosDesdeML() {
        $publicacionesML = $this->em->getRepository(PublicacionML::class)->damePublicacionesProducto(null);

        $count = 0;
        foreach ($publicacionesML as $key => $publiML) {
            $producto = $this->dameProducto($publiML);
            $publiML->setProducto($producto);
            $count++;
            if ($count == 200) {
                $count = 0;
                $this->em->flush(); 
            }
        }
    }

    public function relacionProductoPublicacionEbay() {
        /* Por cada producto encuentro que publicación de ebay compatibiliza y lo relaciono */
    }

    private function dameProducto($publiML) {
        $upc = $publiML->getUpc();
        $mpn = $publiML->getMpn();
        $brand = $this->comprimirTexto($publiML->getBrand());
        $model = $this->comprimirTexto($publiML->getModel());
        $ean = $publiML->getEan();

        //$productos = $this->em->getRepository(Producto::class)->dameProductos($upc, $mpn, $brand, $model, $ean);
        $productos = $this->em->getRepository(Producto::class)->dameProductos(null,null, $brand, $model, null);
        /* Comparo productos */
        if (count($productos) == 0) {
            $producto = new Producto();
            $producto->setUpc($publiML->getUpc());
            $producto->setMpn($publiML->getMpn());
            $producto->setEan($publiML->getEan());
            $producto->setBrand($publiML->getBrand());
            $producto->setModel($publiML->getModel());
            $this->em->persist($producto);
        }
        else if (count($productos) == 1) {
            $producto = $productos[0];
            $producto->setUpc($publiML->getUpc());
            $producto->setMpn($publiML->getMpn());
            $producto->setEan($publiML->getEan());
            $producto->setBrand($publiML->getBrand());
            $producto->setModel($publiML->getModel());
            $this->em->persist($producto);   
        }
        else {
            $this->fusionarProductos($productos);
        }
    }

    private function fusionarProductos($productos) {
        throw new \|Exception($productos, 1);
    }

    private function comprimirTexto($text) {
        $text = strtoupper($text);
        $text = str_replace(' ', '', $text);
        $text = str_replace('-', '', $text);
        $text = str_replace('_', '', $text);
        return $text;
    }
}