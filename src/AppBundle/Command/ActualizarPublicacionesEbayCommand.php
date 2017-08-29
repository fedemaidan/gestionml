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
                $this->getContainer()->get('ebay_service')->actualizarPublicaciones($busqueda);
            }
        }
        catch(OutOfMemoryException $e) {

                $this->cambiarEstadoBusqueda($busqueda, $busqueda->getEstadoActual() . " - Error por falla en memoria 1");
                $keyConflicto = $key;
                $busquedaConflicto = $busqueda;

                foreach ($busquedas as $key => $bus) {
                    if ($key > $keyConflicto)
                        $this->getContainer()->get('ebay_service')->actualizarPublicaciones($bus);
                }

                $this->getContainer()->get('ebay_service')->actualizarPublicaciones($busquedaConflicto);

        }
        catch(Symfony\Component\Debug\Exception\OutOfMemoryException $e) {

                $this->cambiarEstadoBusqueda($busqueda, $busqueda->getEstadoActual() . " - Error por falla en memoria 2");
                $keyConflicto = $key;
                $busquedaConflicto = $busqueda;

                foreach ($busquedas as $key => $bus) {
                    if ($key > $keyConflicto)
                        $this->getContainer()->get('ebay_service')->actualizarPublicaciones($bus);
                }

                $this->getContainer()->get('ebay_service')->actualizarPublicaciones($busquedaConflicto);

        }
        catch(\Symfony\Component\Debug\Exception\OutOfMemoryException $e) {

                $this->cambiarEstadoBusqueda($busqueda, $busqueda->getEstadoActual() . " - Error por falla en memoria 3");
                $keyConflicto = $key;
                $busquedaConflicto = $busqueda;

                foreach ($busquedas as $key => $bus) {
                    if ($key > $keyConflicto)
                        $this->getContainer()->get('ebay_service')->actualizarPublicaciones($bus);
                }

                $this->getContainer()->get('ebay_service')->actualizarPublicaciones($busquedaConflicto);

        }
        catch(\Exception $e) {

                $this->cambiarEstadoBusqueda($busqueda, $busqueda->getEstadoActual() . " - Error por falla en memoria 4");
                $keyConflicto = $key;
                $busquedaConflicto = $busqueda;

                foreach ($busquedas as $key => $bus) {
                    if ($key > $keyConflicto)
                        $this->getContainer()->get('ebay_service')->actualizarPublicaciones($bus);
                }

                $this->getContainer()->get('ebay_service')->actualizarPublicaciones($busquedaConflicto);

        }
        catch(FatalErrorException $e) {
                $this->cambiarEstadoBusqueda($busqueda, $this->getEstadoActual() . " - Error por FatalError - ". $e->message);
        }

        
    }

    private function cambiarEstadoBusqueda($busqueda, $texto) {
        $busqueda->setEstadoActual(date('Y-m-d h:i:s')." - ".$texto);
        $this->em->flush();
    }
}