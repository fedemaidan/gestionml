<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
Use AppBundle\Entity\BusquedaEbay;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/testingEbay", name="ebay_test")
     */
    public function testEbayAction(Request $request)
    {   
        $busqueda = new BusquedaEbay();
        $busqueda->setVendedorEbayId("kp0one");
        $busqueda->setPrecioMinimo("1");
        $busqueda->setPrecioMaximo("900000");

        $count = $this->container->get('ebay_service')->guardarProductosDeLaBusquedaEbay($busqueda);
        
        var_dump("Se cargaron $count");die;
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
