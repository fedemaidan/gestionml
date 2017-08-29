<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Utils\Meli\Meli;
use AppBundle\Entity\BusquedaEbay;

class ActualizarPublicacionesEbayCommand extends ContainerAwareCommand
{
    protected function configure()
{
    $this
        ->setName('ebay:actualizar:publicaciones')
        ->setDescription('Actualizar publicaciones ebay.');
}
	/*
		php app/console ebay:actualizar:publicaciones 
	*/

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $busquedas = $this->getContainer()->get('doctrine')->getManager()->getRepository(BusquedaEbay::ORM_ENTITY)->findAll();
        foreach ($busquedas as $key => $busqueda) {
            $this->getContainer()->get('ebay_service')->actualizarPublicaciones($busqueda);
        }
        
    }
}