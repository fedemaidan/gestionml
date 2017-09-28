<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Estado;

class EstadosFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
    	$PRIMER_CONTACTO = new Estado();
    	$PRIMER_CONTACTO->setNombre("Primer contacto");
        $PRIMER_CONTACTO->setCodigo("PRIMER_CONTACTO");
        $PRIMER_CONTACTO->setDescripcion("El cliente consulta sobre el producto");
        
        $RESERVADO = new Estado();
        $RESERVADO->setNombre("Reservado");
        $RESERVADO->setCodigo("RESERVADO");
        $RESERVADO->setDescripcion("El cliente reserva el producto");

        $PROCESO_DE_COMPRA = new Estado();
        $PROCESO_DE_COMPRA->setNombre("Proceso de compra");
        $PROCESO_DE_COMPRA->setCodigo("PROCESO_DE_COMPRA");
        $PROCESO_DE_COMPRA->setDescripcion("El producto está en proceso de ser comprado");

        $COMPRADO = new Estado();
        $COMPRADO->setNombre("Compra");
        $COMPRADO->setCodigo("COMPRADO");
        $COMPRADO->setDescripcion("Se seleccionó al proveedor y se pago el producto");

        $DEPOSITO_EEUU = new Estado();
        $DEPOSITO_EEUU->setNombre("Deposito EEUU");
        $DEPOSITO_EEUU->setCodigo("DEPOSITO_EEUU");
        $DEPOSITO_EEUU->setDescripcion("El producto llegó a nuestro depósito en EEUU");
        
        $IMPORTANDO = new Estado();
        $IMPORTANDO->setNombre("Importando");
        $IMPORTANDO->setCodigo("IMPORTANDO");
        $IMPORTANDO->setDescripcion("Se notificó a la empresa de importación que traiga el producto y está en proceso de venir a ARG");

        $DEPOSITO_ARG = new Estado();
        $DEPOSITO_ARG->setNombre("Deposito de Argentina");
        $DEPOSITO_ARG->setCodigo("DEPOSITO_ARG");
        $DEPOSITO_ARG->setDescripcion("El producto esta en el deposito de argentina de la empresa de importación");

        $ENTREGADO = new Estado();
        $ENTREGADO->setNombre("Entregado");
        $ENTREGADO->setCodigo("ENTREGADO");
        $ENTREGADO->setDescripcion("El producto fue entregado al cliente");

        $CANCELADO_CLIENTE = new Estado();
        $CANCELADO_CLIENTE->setNombre("Cancelado por cliente");
        $CANCELADO_CLIENTE->setCodigo("CANCELADO_CLIENTE");
        $CANCELADO_CLIENTE->setDescripcion("Se canceló la reserva por razones del cliente");

        $DEPOSITO_INNOVA = new Estado();
        $DEPOSITO_INNOVA->setNombre("Deposito de INNOVA");
        $DEPOSITO_INNOVA->setCodigo("DEPOSITO_INNOVA");
        $DEPOSITO_INNOVA->setDescripcion("El producto llegó a alguno de los depósitos de INNOVA");

        $CANCELADO_INNOVA = new Estado();
        $CANCELADO_INNOVA->setNombre("Cancelado por INNOVA");
        $CANCELADO_INNOVA->setCodigo("CANCELADO_INNOVA");
        $CANCELADO_INNOVA->setDescripcion("Se canceló la reserva por razones de INNOVA");

        $DEVUELTO_GARANTIA = new Estado();
        $DEVUELTO_GARANTIA->setNombre("Devuelto por garantía");
        $DEVUELTO_GARANTIA->setCodigo("DEVUELTO_GARANTIA");
        $DEVUELTO_GARANTIA->setDescripcion(" Se devolvió por ejecución de la garantía");


    	$manager->persist($PRIMER_CONTACTO);
        $manager->persist($RESERVADO);
    	$manager->persist($PROCESO_DE_COMPRA);
    	$manager->persist($COMPRADO);
        $manager->persist($DEPOSITO_EEUU);
        $manager->persist($IMPORTANDO);
        $manager->persist($DEPOSITO_ARG);
        $manager->persist($DEPOSITO_INNOVA);
        $manager->persist($ENTREGADO);
        $manager->persist($CANCELADO_INNOVA);
        $manager->persist($CANCELADO_CLIENTE);
        $manager->persist($DEVUELTO_GARANTIA);
        $manager->flush();
        
    }
}
