<?php
namespace AppBundle\Command\MercadoLibre;

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
use AppBundle\Entity\PublicacionEbay;
use AppBundle\Entity\Cuenta;


class PublicacionMasivaEbayMLCommand extends ContainerAwareCommand
{
	private $row = 0;
    

    protected function configure()
    {
        $this
            ->setName('ml:publicar:masiva:ebay')
            ->setDescription('Publicacion masiva de productos en ml')
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
	           	    $this->cargarPublicacion($data);
	           	$this->row++;
	      }
      	}
        
      $this->getContainer()->get('doctrine')->getManager()->flush();
      fclose($handle);
    }

    protected function cargarPublicacion($data) {

    	
    	$id_cuenta = 1;
    	
    	$cuenta = $this->getContainer()->get('doctrine')->getManager()->getRepository(Cuenta::class)->findOneById($id_cuenta);

		$token = "APP_USR-3659532861516182-030809-752ba060bd120fcc2c4c1bf35687444c__B_J__-73818038";
		$id_ebay  = $data[0];
    	$rentabilidad = $data[1];
    	$shipping = $data[2];

        

    	$publi_ebay = $busqueda = $this->getContainer()->get('doctrine')->getManager()->getRepository(PublicacionEbay::class)->findOneById($id_ebay);

        if ($publi_ebay == null) {
            //var_dump("no tengo id ebay ".$id_ebay);
            return;
        }

    	$this->getContainer()->get('meli_service')->replicarPublicacionEbayEnMl($publi_ebay, $cuenta, $token, $rentabilidad, $shipping);
    	
    }

    

}