<?php
namespace AppBundle\Command\MercadoLibre;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Utils\Meli\Meli;
use AppBundle\Entity\BusquedaEbay;

class CargarPublicacionesMercadolibreCommand extends ContainerAwareCommand
{
    protected function configure()
	{
	    $this
	        ->setName('ml:actualizar:publicaciones')
	        ->setDescription('Actualizar publicacion ml.')
	        ->addOption('categoria_ml', null,         InputOption::VALUE_REQUIRED,    'Id de la categoria de MercadoLibre');
	    ;
	}
	/*
		php app/console ml:actualizar:publicaciones
	*/

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$categoria = $input->getOption('categoria_ml');
    	$this->getContainer()->get('meli_service')->buscarPublicacionesPorCategoria($categoria);
    }
}
?>