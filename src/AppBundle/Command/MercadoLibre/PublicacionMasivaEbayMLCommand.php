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

    protected function cargarProducto($data) {
    	var_dump($data);die;
    	$token = "APP_USR-3659532861516182-030605-ba83eef67e7539b017338ac213aeb16f__N_A__-73818038";
    	$id_cuenta = "";
    	$id_ebay  = "";


         $publi_ebay = $busqueda = $this->getContainer()->get('doctrine')->getManager()->getRepository(PublicacionEbay::class)->findOneById($input->getOption('id_ebay'));
    	$cuenta = $this->getContainer()->get('doctrine')->getManager()->getRepository(Cuenta::class)->findOneById($input->getOption('id_cuenta'));

		$token = "APP_USR-3659532861516182-030605-ba83eef67e7539b017338ac213aeb16f__N_A__-73818038";
    	$rentabilidad = 2;
    	$shipping = 10;

    	$this->getContainer()->get('meli_service')->replicarPublicacionEbayEnMl($publi_ebay, $cuenta, $token, $rentabilidad, $shipping);
    	
    }

    

}