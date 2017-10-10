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


class ImportacionExcelSalidasCommand extends ContainerAwareCommand
{
	private $row = 0;
	private $ultimaFechaValida =  null;
    

    protected function configure()
    {
        $this
            ->setName('app:importacion:reservas')
            ->setDescription('Importación de reservas del excel del drive')
            ->addOption('archivo', null,         InputOption::VALUE_REQUIRED,    'Archivo de csv');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$this->ultimaFechaValida =\DateTime::createFromFormat('j/m/Y', '01/01/1980');
        $archivo = $input->getOption('archivo');
        
        if(!file_exists($archivo))
        {
            throw new InvalidArgumentException("No existe el archivo $archivo");
        }
 		
 		
 		$array = [];
        if (($handle = fopen($archivo, "r")) !== FALSE) {
	        while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                /*
                $t = $this->dameTipoDeEntrega($data[7]);

                //$array[$data[7]] = 1;
                
                if (array_key_exists($data[7], $array)) {
                
                    if ($t)
                        $array[$t->getId()]++;
                    else
                        $array[0]++;
                }
                else {
                
                    if ($t)
                        $array[$t->getId()] = 1;
                    else
                        $array[0] = 1;
                }
	        	*/

	        	
                if ($this->row > 1)
	           	    $this->cargarReserva($data);
	           	$this->row++;
                
	      }
      	}
        
      
      fclose($handle);
    }

    private function cargarReserva($data) {
        
        if (trim($data[1]) == "")
            return;

    	$reserva = new Reserva();
    	$fechaAlta = $this->dameFechaValida($data[0]);
    	$producto = $this->dameProducto($data[1], $data[22]);
    	
    	if ($producto->getNombre() == "Otros") {
    		$reserva->setProductoNoCargado($data[1]);
    	}

    	$tipoDeVenta = $this->dameTipoDeVenta($data[3]);
    	$tipoDePago = $this->dameTipoDePago($data[4]);
    	$precio = $this->damePrecio($data[6]);
        $moneda = $this->dameMoneda($data[6]);
    	$tipoDeEntrega = $this->dameTipoDeEntrega($data[7]);
    	$info = $data[9];
    	$sena = is_numeric($data[10]) ? $data[10]: null;
    	$datosCliente = $data[12];

        $mailCliente = $this->dameMailCliente($datosCliente);

    	$cuenta = $this->dameCuenta($data[13]);

    	$cuentaPago = $this->dameCuentaPago($data[14]);
    	$linkUsados = $this->dameLinkUsados($data[14], $data[15]);

    	$codigoReserva = intval($data[24]);
        $estado = $this->dameEstado($data);


    	$reserva->setFechaAlta($fechaAlta);
    	$reserva->setProducto($producto);
    	$reserva->setTipoDeVenta($tipoDeVenta);
    	$reserva->setTipoDePago1($tipoDePago);
        $reserva->setTipoDeEntrega($tipoDeEntrega);
        $reserva->setMoneda($moneda);
    	$reserva->setPrecio($precio);
    	$reserva->setInformacion($info);
        $reserva->setMailCliente($mailCliente);
    	$reserva->setSena($sena == '' ? 0 : $sena);
    	$reserva->setDatosCliente($datosCliente);
    	$reserva->setCuentaPrincipal($cuenta);
        $reserva->setCuentaPago($cuentaPago);
    	$reserva->setLinkUsados($linkUsados);
    	$reserva->setCodigoReserva($codigoReserva);
        $reserva->setEstado($estado);
        
        if ($estado->getCodigo() == Estado::ENTREGADO) {
            $reserva->setValorPago1($precio);
        }

        $this->getContainer()->get('doctrine')->getManager()->persist($reserva);
        $this->getContainer()->get('doctrine')->getManager()->flush();

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

    private function dameProducto($productoTexto, $productoCodigo) {
        
    	$producto = $this->getContainer()->get('doctrine')->getManager()->getRepository(Producto::ORM_ENTITY)->findOneByCodigo($productoCodigo);
        if (!$producto) {
            $producto = $this->getContainer()->get('doctrine')->getManager()->getRepository(Producto::ORM_ENTITY)->findOneByNombre("Otros");
        }

        return $producto;
    }

    private function dameTipoDeVenta($tipoDeVentaTexto) {
        switch ($tipoDeVentaTexto) {
            case "Stock" :
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDeVenta::ORM_ENTITY)->findOneByCodigo(TipoDeVenta::STOCK);
            case "Pedido sin/seña" :
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDeVenta::ORM_ENTITY)->findOneByCodigo(TipoDeVenta::PEDIDO_SIN_SENA );
            case "Pedido c/seña" :
            case "Pedido con/eña" :
            case "Pedido con/seña" :
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDeVenta::ORM_ENTITY)->findOneByCodigo(TipoDeVenta::PEDIDO_CON_SENA);
            default:
                return null;
                break;
        }
    }

    private function dameTipoDePago($tipoDePagoTexto) {
        switch ($tipoDePagoTexto) {
            case "EFECTIVO":
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDePago::ORM_ENTITY)->findOneByCodigo(TipoDePago::EFECTIVO);
            case "MP-USADOS":
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDePago::ORM_ENTITY)->findOneByCodigo(TipoDePago::MP_USADOS);
            case "MP-OROFULL":
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDePago::ORM_ENTITY)->findOneByCodigo(TipoDePago::MP_NUEVOS);
            default:
                return null;
                break;
        }
    }

    private function dameTipoDeEntrega($tipoDeEntregaTexto) {
        switch ($tipoDeEntregaTexto) {
            case 'Retira':
            case 'RETIRA':
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDeEntrega::ORM_ENTITY)->findOneByCodigo(TipoDeEntrega::RETIRO);
            case 'Remis s/cargo':
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDeEntrega::ORM_ENTITY)->findOneByCodigo(TipoDeEntrega::REMIS_SIN_CARGO);
            case 'Remis c/cargo':
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDeEntrega::ORM_ENTITY)->findOneByCodigo(TipoDeEntrega::REMIS_CON_CARGO);
            case 'Etiqueta OCA':
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDeEntrega::ORM_ENTITY)->findOneByCodigo(TipoDeEntrega::ETIQUETA_OCA);
            case 'Envio OCA a domicilio comun':
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(TipoDeEntrega::ORM_ENTITY)->findOneByCodigo(TipoDeEntrega::ENVIOS_OCA);
            default:
                return null;
                break;
        }
    }

    private function dameEstado($data) {
        
        for( $key = 0; $key < 16; $key++) {
            $value = $data[$key];
            if (strstr(strtoupper($value), "CANCELAD")) {
                return  $this->getContainer()->get('doctrine')->getManager()->getRepository(Estado::ORM_ENTITY)->findOneByCodigo(Estado::CANCELADO_CLIENTE);
            }
        }

        $fin = $data[8];
        if($fin == "si") {
            return  $this->getContainer()->get('doctrine')->getManager()->getRepository(Estado::ORM_ENTITY)->findOneByCodigo(Estado::ENTREGADO);
        }

        return  $this->getContainer()->get('doctrine')->getManager()->getRepository(Estado::ORM_ENTITY)->findOneByCodigo(Estado::RESERVADO);
    }
    
    private function dameCuenta($cuentaTexto) {

    }

    private function dameCuentaPago($cuentaTexto) {

    }

    private function damePrecio($precio) {
        if (is_numeric($precio))
            return $precio;
        else
            return 0;
    }

    private function dameLinkUsados($cuentaUsadosTexto, $link) {
        $pos = strpos($link, 'http://');
        if ($pos === false) {
            return $cuentaUsadosTexto;
        }

        return $link;
    }

    private function dameMoneda($precio) {
        if (strstr(strtoupper($precio), "USD")) {
            return "DOLARES";
        }
        else {
            return "PESOS";
        }
    }

    private function dameMailCliente($datosCliente) {
        if (!empty($datosCliente)) {
            $array = explode(' ', $datosCliente);

            foreach ($array as $key => $email_a) {
                $email_a = trim($email_a);
                if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                    return $email_a;
                }
            }

            $array = explode(PHP_EOL, $datosCliente);

            foreach ($array as $key => $email_a) {
                $email_a = trim($email_a);
                if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                    return $email_a;
                }
            }
            
            foreach ($array as $key => $cadena) {
                $variable =  explode(' ', $cadena);
                
                foreach ($variable as $key => $value) {
                    $email_a = trim($email_a);
                    if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                        return $email_a;
                    }
                }

                $variable =  explode(':', $cadena);
                foreach ($variable as $key => $value) {
                    $email_a = trim($email_a);
                    if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                        return $email_a;
                    }
                }
            }

            $array = explode('/', $datosCliente);

            foreach ($array as $key => $email_a) {
                $email_a = trim($email_a);
                if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                    return $email_a;
                }
            }

            $array = explode(':', $datosCliente);

            foreach ($array as $key => $email_a) {
                $email_a = trim($email_a);
                if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                    return $email_a;
                }
            }

            $array = explode('-', $datosCliente);

            foreach ($array as $key => $email_a) {
                $email_a = trim($email_a);
                if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                    return $email_a;
                }
            }

            $email_a = trim($datosCliente);
            if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                    return $email_a;
            }

            $datosCliente = utf8_encode($datosCliente);
            $arrayReplace = [":", " ", ",", "-", "/","Â"," ",'"'];
            $replace = str_replace($arrayReplace, PHP_EOL, $datosCliente);
            
            $array = explode(PHP_EOL, $replace);

            
            foreach ($array as $key => $email_a) {
                
                $email_a = trim($email_a);
                $email_a = trim($email_a,".");
                $email_a = trim($email_a,",");    
                
                if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
                    return $email_a;
                }
            }

        }

        return null;
    }
}