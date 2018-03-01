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
use AppBundle\Entity\TipoDePago;
use AppBundle\Entity\TipoDeVenta;
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
        $producto = $this->getDoctrine()->getRepository(Producto::class)->findOneByCodigo(Producto::NO_ESTA_CODIGO);
        $cuenta = $this->getDoctrine()->getRepository(Cuenta::class)->findOneById($request->get('cuenta_id'));
        $tipoDePago = $this->getDoctrine()->getRepository(TipoDePago::class)->findOneByCodigo(TipoDePago::MP_USADOS);
        $tipoDeVenta = $this->getDoctrine()->getRepository(TipoDeVenta::class)->findOneByCodigo(TipoDeVenta::PEDIDO_CON_SENA);
        
        $fecha_alta = \DateTime::createFromFormat('Y-m-d H:i:s', $request->get('fecha_alta'));

        if (!$reserva){
          $reserva = new Reserva();  
          $reserva->setEstado($estado); 
          $reserva->setMailCliente($request->get('mail_cliente'));
          $reserva->setIdMl($request->get('orden_ml_id'));
        
            
            
            $fecha_entrega = \DateTime::createFromFormat('Y-m-d H:i:s', $request->get('fecha_alta'));
            $fecha_entrega->add(new \DateInterval('P28D'));

            $reserva->setFechaAlta($fecha_alta); 
            $reserva->setFechaEntrega($fecha_entrega); 
            $reserva->setProducto($producto);
            $reserva->setTipoDePago1($tipoDePago);
            $reserva->setValorPago1($request->get('precio'));
            $reserva->setTipoDeVenta($tipoDeVenta);
            $reserva->setProductoNoCargado($request->get('productoNoCargado')); 
            $reserva->setMoneda($request->get('moneda')); 
            $reserva->setPrecioVenta($request->get('precio'));
            $reserva->setCuentaPago($cuenta);
            $reserva->setCuentaPrincipal($cuenta);

            $reserva->setNickCliente($request->get('nick_cliente'));
            
            $reserva->setNombreCliente($request->get('nombre_cliente'));
            $reserva->setTelefonoCliente($request->get('telefono_cliente'));
            $reserva->setNumeroDocumento($request->get('numero_documento_cliente'));
            $reserva->setProvinciaEntrega($request->get('provincia_entrega'));
            $reserva->setLocalidadEntrega($request->get('localidad_entrega'));
            $reserva->setCalleEntrega($request->get('calle_entrega'));
            $reserva->setCodigoPostalEntrega($request->get('codigo_postal_entrega'));
            $reserva->setLink($request->get('link'));
        } 

        //$reserva->setCostoClienteEntrega($request->get('costo_cliente_entrega'));

        if ($fecha_alta > new \DateTime('2018-02-27 20:52:10')) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reserva);
            $em->flush();    
            return new Response($reserva->getId());
        }
        
        return new Response("reserva antigua");
        
    }

}