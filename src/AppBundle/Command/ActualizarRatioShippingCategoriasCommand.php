<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Entity\CategoriaEbay;
use Symfony\Component\Debug\Exception\OutOfMemoryException;
use Symfony\Component\Debug\Exception\FatalErrorException;


class ActualizarRatioShippingCategoriasCommand extends ContainerAwareCommand
{
    protected function configure()
{
    $this
        ->setName('ebay:actualizar:categorias')
        ->setDescription('Actualizar categorias ebay.')
        ->addOption('archivo', null,         InputOption::VALUE_OPTIONAL,    'archivo');
}
	/*
		php app/console ebay:actualizar:categorias 
	*/

    protected function execute(InputInterface $input, OutputInterface $output)
    {   
    	$archivo = $input->getOption('archivo');
        
        if(!file_exists($archivo))
        {
            throw new InvalidArgumentException("No existe el archivo $archivo");
        }
        try {
        	$row = 0;
	        if (($handle = fopen($archivo, "r")) !== FALSE) {
		        while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
		        	$name = $data[0];
		        	$valida = !($data[1] == "");
                	$ratio = str_replace(",", ".", $data[2]);
                	$shipping = $data[3];
	                if ($row > 1 && is_numeric($ratio)) {
	                	$categoria = $this->getContainer()->get('doctrine')->getManager()->getRepository(CategoriaEbay::ORM_ENTITY)->findOneByName($name);
	                	if ($categoria) {
	                		$categoria->setRatio($ratio);
	                		$categoria->setShipping($shipping);
	                	}
	                	else {
	                		$this->imprimo("No se encontro la categoria ".$name);
	                	}                	
	                }
		           	    
		           	$row++;
		      }
		      
		      $this->getContainer()->get('doctrine')->getManager()->flush();
			  $this->getContainer()->get('doctrine')->getManager()->clear();
	      	}
	        
	      
	      fclose($handle);
        }
        catch(\Exception $e) {
        	$this->imprimo($e->getMessage());
        }
    }

    private function imprimo($texto) {
        echo "\n".date("Y-m-d H:i:s"). " ****** ".$texto;
    }
}