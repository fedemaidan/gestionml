<?php

namespace AppBundle\Service;

use AppBundle\Entity\OrdenDeCompra;
use AppBundle\Entity\Reserva;
use AppBundle\Entity\Estado;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class CargasImportacionService
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

    public function csvContent_pendiente_carga() {
    	$estado = $this->em->getRepository(Estado::class)->findOneByCodigo(Estado::COMPRADO);
    	$reservasCompradas = $this->em->getRepository(Reserva::class)->findByEstado($estado);;

    	$csv = "Tracking,Warehouse,Producto,Precio compra,qty,qty * precio compra, Instrucciones:,idNuestroDeReserva\n";
    	foreach ($reservasCompradas as $key => $reserva) {
            $productoNombre = $reserva->getProducto()->getNombre()."_".$reserva->getProductoNoCargado();
    		$csv .= $reserva->getTracking.",".$reserva->getOrdenDeCompra()->getWarehouse().",".$productoNombre.",".$reserva->getCostoCompraProducto().",1,".$reserva->getCostoCompraProducto().",Quitar fuente,".$reserva->getId()."\n";
    	}
    	
    	return $csv;
    }

}
