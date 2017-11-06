<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Entity\Reserva;
use AppBundle\Entity\Producto;
use AppBundle\Entity\TipoDeVenta;
use AppBundle\Entity\TipoDeEntrega;
use AppBundle\Entity\TipoDePago;
use AppBundle\Entity\Estado;


class CargaDeProductosExtrasCommand extends ContainerAwareCommand
{
	private $row = 0;
    

    protected function configure()
    {
        $this
            ->setName('app:importacion:productos:extras')
            ->setDescription('Importación de productos extras del excel del drive')
            ->addOption('archivo', null,         InputOption::VALUE_REQUIRED,    'Archivo de csv');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $archivo = $input->getOption('archivo');
        
        if(!file_exists($archivo))
        {
            throw new InvalidArgumentException("No existe el archivo $archivo");
        }
 		
 		
 		    $array = [];
        if (($handle = fopen($archivo, "r")) !== FALSE) {
	        while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                
				if ($this->row > 0)
	           	    $this->cargarProducto($data);
	           	$this->row++;
                
	      }
      	}
        
      $this->getContainer()->get('doctrine')->getManager()->flush();
      fclose($handle);
    }

    protected function cargarProducto($data) {
    	$data = $this->limipiarArray($data);
    	
      $producto = $this->getContainer()->get('doctrine')->getManager()->getRepository(Producto::ORM_ENTITY)->findOneByCodigo($data[0]);
      if (!$producto && $data[0] != null) {
        $producto = new Producto();
        $producto->setCodigo($data[0]);
        $producto->setNombre($data[1]);  
        $producto->setCantidad(0);
        $this->getContainer()->get('doctrine')->getManager()->persist($producto);  
      }
    	
    }

    protected function limipiarArray($array) {
    	foreach ($array as $key => $value) {
    		if (trim($value) == '')
    			$array[$key] = null;
    	}

    	return $array;
    }

}