<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TipoDeVenta;

class TipoDeVentaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
    	$pedidoConSena = new TipoDeVenta();
    	$pedidoConSena->setNombre("Pedido con seña");
        $pedidoConSena->setCodigo("PEDIDO_CON_SENA");

    	$pedidoSinSena = new TipoDeVenta();
    	$pedidoSinSena->setNombre("Pedido sin seña");
        $pedidoSinSena->setCodigo("PEDIDO_SIN_SENA");

    	$stock = new TipoDeVenta();
    	$stock->setNombre("Stock");
        $stock->setCodigo("STOCK");

    	$manager->persist($stock);
    	$manager->persist($pedidoSinSena);
    	$manager->persist($pedidoConSena);

        $manager->flush();
    }
}