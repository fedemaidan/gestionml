<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reserva;
use AppBundle\Entity\Cuenta;
use AppBundle\Entity\Producto;
use AppBundle\Entity\Estado;
use AppBundle\Utils\Meli\Meli;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{

    /**
     * @Route("/reserva/new", name="reserva_new")
     */

    public function  reservaNewAction(Request $request) {
        
    	//busco reserva si no existe la creo
        $estado = $this->getDoctrine()->getRepository(Estado::class)->findOneByCodigo(Estado::RESERVADO);
        $reserva = $this->getDoctrine()->getRepository(Reserva::class)->findOneByIdMl($request->get('orden_ml_id'));

        if (!$reserva){
          $reserva = new Reserva();  
          $reserva->setEstado($estado); 
          $reserva->setMailCliente($request->get('mail_cliente'));
        } 

        $reserva->setIdMl($request->get('orden_ml_id'));
        
        $fecha_alta = \DateTime::createFromFormat('Y-m-d H:i:s', $request->get('fecha_alta'));

    	$reserva->setFechaAlta($fecha_alta); 
    	$producto = $this->getDoctrine()->getRepository(Producto::class)->findOneByCodigo(Producto::NO_ESTA_CODIGO);
    	$reserva->setProducto($producto);
        
    	$reserva->setProductoNoCargado($request->get('productoNoCargado')); 
    	$reserva->setMoneda($request->get('moneda')); 
    	$reserva->setPrecioVenta($request->get('precio'));
        
    	$cuenta = $this->getDoctrine()->getRepository(Cuenta::class)->findOneById($request->get('cuenta_id'));
    	$reserva->setCuentaPrincipal($cuenta);
        $reserva->setNickCliente($request->get('nick_cliente'));
        
        $reserva->setNombreCliente($request->get('nombre_cliente'));
        $reserva->setTelefonoCliente($request->get('telefono_cliente'));
        $reserva->setNumeroDocumento($request->get('numero_documento_cliente'));
        $reserva->setProvinciaEntrega($request->get('provincia_entrega'));
        $reserva->setLocalidadEntrega($request->get('localidad_entrega'));
        $reserva->setCalleEntrega($request->get('calle_entrega'));
        $reserva->setCodigoPostalEntrega($request->get('codigo_postal_entrega'));
        //$reserva->setCostoClienteEntrega($request->get('costo_cliente_entrega'));
        

        if ($fecha_alta > new DateTime('2018-02-27 20:52:10')) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reserva);
            $em->flush();    
            return new Response($reserva->getId());
        }
        
    	//link
        return new Response("reserva antigua");
        
    }

}