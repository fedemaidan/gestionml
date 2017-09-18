<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TipoDeEntrega;

class TipoDeEntregaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
    	$oca = new TipoDeEntrega();
    	$oca->setNombre("Envios OCA");
        $oca->setCodigo("ENVIOS_OCA");

    	$oca2 = new TipoDeEntrega();
    	$oca2->setNombre("Etiqueta OCA");
        $oca2->setCodigo("ETIQUETA_OCA");

    	$remis_con_cargo = new TipoDeEntrega();
    	$remis_con_cargo->setNombre("Remis con cargo");
        $remis_con_cargo->setCodigo("REMIS_CON_CARGO");

        $remis_sin_cargo = new TipoDeEntrega();
        $remis_sin_cargo->setNombre("Remis sin cargo");
        $remis_sin_cargo->setCodigo("REMIS_SIN_CARGO");

        $retiro = new TipoDeEntrega();
        $retiro->setNombre("Retiro");
        $retiro->setCodigo("RETIRO");

    	$manager->persist($oca);
    	$manager->persist($oca2);
    	$manager->persist($remis_sin_cargo);
        $manager->persist($remis_con_cargo);
        $manager->persist($retiro);

        $manager->flush();
    }
}