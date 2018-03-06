<?php
namespace AppBundle\Command\MercadoLibre;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Utils\Meli\Meli;
use AppBundle\Entity\PublicacionEbay;
use AppBundle\Entity\Cuenta;

class PublicarEbayEnMlCommand extends ContainerAwareCommand
{
    protected function configure()
	{
	    $this
	        ->setName('ml:publicar:ebay')
	        ->setDescription('Replica producto publicado en ebay en ml')
	        ->addOption('id_ebay', null,         InputOption::VALUE_REQUIRED,    'Id de la categoria de MercadoLibre')
	        ->addOption('id_cuenta', null,         InputOption::VALUE_REQUIRED,    'Id de la cuenta');
	    ;
	}

	/*
		php app/console ml:publicar:ebay --id_ebay=10455 --id_cuenta=2
	*/

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$publi_ebay = $busqueda = $this->getContainer()->get('doctrine')->getManager()->getRepository(PublicacionEbay::ORM_ENTITY)->findOneById($input->getOption('id_ebay'));
    	$cuenta = $busqueda = $this->getContainer()->get('doctrine')->getManager()->getRepository(Cuenta::ORM_ENTITY)->findOneById($input->getOption('id_cuenta'));
    	
		$token = "";
    	$rentabilidad = 2;
    	$shipping = 10;

    	$this->getContainer()->get('meli_service')->replicarPublicacionEbayEnMl($publi_ebay, $cuenta, $token, $rentabilidad, $shipping);
    }
}

?>