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


class CargaDeProductosCommand extends ContainerAwareCommand
{
	private $row = 0;
    

    protected function configure()
    {
        $this
            ->setName('app:importacion:productos')
            ->setDescription('Importación de productos del excel del drive')
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
                
				if ($this->row > 1)
	           	    $this->cargarProducto($data);
	           	$this->row++;
                
	      }
      	}
        
      $this->getContainer()->get('doctrine')->getManager()->flush();
      fclose($handle);
    }

    protected function cargarProducto($data) {
    	$data = $this->limipiarArray($data);
    	
      if ($data[1] == null || empty($data[1]))
        return 0;

    	$producto = new Producto();
    	$producto->setMarca($data[1]);
        $producto->setModelo($data[2]);

    	if ($data[0] == null)
        	$producto->setCodigo($producto->getMarca()."_".$producto->getModelo());
        else
        	$producto->setCodigo($data[0]);

        $producto->setCategoriaInterna($data[3]);
        $producto->setCategoriaMatchMl($data[4]);
        $producto->setDescripcion($data[5]);
        $producto->setNombre($producto->getMarca()."_".$producto->getModelo());
       	$producto->setPeso($data[6]);
       	$producto->setPesoCaja($data[7]);
       	$producto->setAncho($data[10]);
       	$producto->setLargo($data[11]);
       	$producto->setProfundidad($data[12]);
       	if (is_numeric( $data[14]))
       		$producto->setPrecioMinimo($data[14]);
       	else
       		$producto->setPrecioMinimo(0);

       	if (is_numeric( $data[14]))
       		$producto->setPrecioMaximo($data[15]);
       	else
       		$producto->setPrecioMaximo(99999);


       	$producto->setRotacion($data[17]);
       	$producto->setModelo2($data[18]);
       	$producto->setModelo3($data[19]);
       	$producto->setContenidoPaquete($data[24]);
       	$producto->setWebOficial($data[34]);
       	$producto->setManualUrl($data[35]);
       	$producto->setOrigen($data[36]);
       	$producto->setCantidad(0);

        $this->getContainer()->get('doctrine')->getManager()->persist($producto);
        
    }

    protected function limipiarArray($array) {
    	foreach ($array as $key => $value) {
    		if (trim($value) == '')
    			$array[$key] = null;
    	}

    	return $array;
    }

}