<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TipoDePago;

class TipoDePagoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
    	$efectivo = new TipoDePago();
    	$efectivo->setNombre("Efectivo");
        $efectivo->setCodigo("EFECTIVO");

    	$mp_usados = new TipoDePago();
    	$mp_usados->setNombre("MP-Usados");
        $mp_usados->setCodigo("MP_USADOS");

    	$mp_nuevo = new TipoDePago();
    	$mp_nuevo->setNombre("MP-Nuevos");
        $mp_nuevo->setCodigo("MP_NUEVOS");

    	$manager->persist($efectivo);
    	$manager->persist($mp_usados);
    	$manager->persist($mp_nuevo);

        $manager->flush();
    }
}