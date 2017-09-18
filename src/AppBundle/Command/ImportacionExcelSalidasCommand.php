<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Entity\Reserva;
use AppBundle\Entity\Producto;


class ImportacionExcelSalidasCommand extends ContainerAwareCommand
{
	private $contador = 0;
	private $row = 0;
	private $ultimaFechaValida =  null;
    protected function configure()
{
    $this
        ->setName('app:importacion:reservas')
        ->setDescription('Importación de reservas del excel del drive')
        ->addOption('archivo', null,         InputOption::VALUE_REQUIRED,    'Archivo de csv');
    ;
}

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$this->ultimaFechaValida =\DateTime::createFromFormat('j/m/Y', '01/01/1980');
        $archivo = $input->getOption('archivo');
        
        if(!file_exists($archivo))
        {
            throw new InvalidArgumentException("No existe el archivo $archivo");
        }
 		
 		
 		
        if (($handle = fopen($archivo, "r")) !== FALSE) {
	        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        	
	        	if ($this->row > 1)
	           	    $this->cargarReserva($data);
	           	$this->row++;
	      }
      	}
      
      echo $this->contador." sobre ".$this->row;
      fclose($handle);
    }

    private function cargarReserva($data) {
    	$reserva = new Reserva();
    	$fechaAlta = $this->dameFechaValida($data[0]);
    	$producto = $this->dameProducto($data[1], $data[17]);
    	
    	if ($producto->getNombre() == "Otros") {
    		$reserva->setProductoNoCargado($data[1]);
    	}

    	$tipoDeVenta = $this->dameTipoDeVenta($data[3]);
    	$tipoDePago = $this->dameTipoDePago($data[4]);
    	$precio = $data[6];
    	$tipoDeEntrega = $this->dameTipoDeEntrega($data[7]);
    	$info = $data[9];
    	$sena = $data[10];
    	$cliente = $data[12];
    	$cuenta = $this->dameCuenta($data[13]);
    	$cuentaUsados = $this->dameCuentaUsados($data[14]);
    	$linkUsados = $this->dameLinkUsados($data[14], $data[15]);
    	$codigoReserva = $data[19];

    	$reserva->setFechaAlta($fechaAlta);
    	$reserva->setProducto($producto);
    	$reserva->setTipoDeVenta($tipoDeVenta);
    	$reserva->setTipoDePago($tipoDePago);
    	$reserva->setPrecio($precio);
    	$reserva->setInformacion($info);
    	$reserva->setSena($sena);
    	$reserva->setCliente($cliente);
    	$reserva->setCuenta($cuenta);
    	$reserva->setCuentaUsados($cuentaUsados);
    	$reserva->setLinkUsados($linkUsados);
    	$reserva->setCodigReserva($codigoReserva):

    	dump($reserva);die;
    }

    private function dameFechaValida($fecha) {
    	$fechaAlta = \DateTime::createFromFormat('j/m/Y', $fecha);
    	$fechaValida = $fechaAlta ? $fechaAlta : $this->ultimaFechaValida;

    	if ($fechaValida < $this->ultimaFechaValida) {
    		$fechaValida = $this->ultimaFechaValida;
    	}

    	$this->ultimaFechaValida = $fechaValida;
    	return $fechaValida;

    }

    private function dameProducto($productoTexto) {
    	
    }

    private function dameTipoDeVenta($tipoDeVentaTexto) {

    }

    private function dameTipoDePago($tipoDePagoTexto) {

    }

    private function dameTipoDeEntrega($tipoDeEntregaTexto) {

    }
    
    private function dameCuenta($cuentaTexto) {

    }

    private function dameCuentaUsados($cuentaTexto) {

    }

    private function dameLinkUsados($cuentaUsadosTexto, $link) {

    }
}