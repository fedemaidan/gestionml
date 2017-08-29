<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Entity\BusquedaEbay;
use Symfony\Component\Debug\Exception\OutOfMemoryException;
use Symfony\Component\Debug\Exception\FatalErrorException;


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
        try {

            
            $busquedas = $this->getContainer()->get('doctrine')->getManager()->getRepository(BusquedaEbay::ORM_ENTITY)->findAll();
            foreach ($busquedas as $key => $busqueda) {
                $this->imprimo("Memory init: " . ( (memory_get_usage() /1024) /1024));
                $this->getContainer()->get('ebay_service')->actualizarPublicaciones($busqueda);
            
                $this->imprimo("Memory next: " . ( (memory_get_usage() /1024) /1024));
            }
        }
        catch(\Exception $e) {

                $this->cambiarEstadoBusqueda($busqueda, $busqueda->getEstadoActual() . " - Exception");
                $keyConflicto = $key;
                $busquedaConflicto = $busqueda;

                foreach ($busquedas as $key => $bus) {
                    if ($key > $keyConflicto)
                        $this->getContainer()->get('ebay_service')->actualizarPublicaciones($bus);
                }

                $this->getContainer()->get('ebay_service')->actualizarPublicaciones($busquedaConflicto);

        }
        
        
    }

    private function cambiarEstadoBusqueda($busqueda, $texto) {
        $busqueda->setEstadoActual(date('Y-m-d h:i:s')." - ".$texto);
        $this->getContainer()->get('doctrine')->getEntityManager()->persist($busqueda);
        $this->getContainer()->get('doctrine')->getEntityManager()->flush();
    }

    private function imprimo($texto) {
        echo "\n".date("Y-m-d H:i:s"). " ****** ".$texto;
    }
}