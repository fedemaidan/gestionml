<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BusquedaEbay;
use AppBundle\Utils\Meli\Meli;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\HttpFoundation\RedirectResponse;
    
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
        $busqueda->setVendedorEbayId("mlm32");
        $busqueda->setPrecioMinimo("1");
        $busqueda->setPrecioMaximo("900000");

        $count = $this->container->get('ebay_service')->actualizarPublicaciones($busqueda);
        
        var_dump("Se cargaron $count");die;


        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }


    /**
     * @Route("/cargaMasivaOrdenCompra", name="cargaMasivaOrdenCompra")
     */
    public function cargaMasivaOrdenDeCompraAction(Request $request)
    {
        
        $form =  $this->createFormBuilder()
            ->setAction($this->generateUrl('cargaMasivaOrdenCompra'));
        $form->add('archivo','file');
        $form->add('Cargar', FormType\SubmitType::class, [
            'label' => 'Cargar',
        ]);

        $form = $form->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            
            $this->addFlash('sonata_flash_success', 'Si te cabe, re piola');
            $url = 'admin/app/ordendecompra/list';
            return new RedirectResponse($url);
        }

        return $this->render('AppBundle:Default:list__action_carga_masiva_orden_compra.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
