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
use Symfony\Component\HttpFoundation\Response;

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
            $data = $form->getData();
            $archivo = $data["archivo"];

            try {
                $this->container->get('compras_service')->cargaMasivaOrdenDeCompra($archivo);    
                $this->addFlash('sonata_flash_success', 'Ordenes creadas correctamente');
                $url = 'admin/app/ordendecompra/list';
            }
            catch(\Exception $e) {
                $this->addFlash('sonata_flash_error', 'Error: '.$e->getMessage());
                $url = $this->generateUrl('cargaMasivaOrdenCompra');
            }
            
            return new RedirectResponse($url);
        }

        return $this->render('AppBundle:Default:list__action_carga_masiva_orden_compra.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/descargarCsvReservasParaCargaImportacion", name="descargarCsvReservasParaCargaImportacion")
     */
    public function descargarCsvReservasParaCargaImportacionAction() {
        $response = new Response();
        $contenido = $this->container->get('cargas_service')->csvContent_pendiente_carga();
        $response->setContent($contenido);

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="carga.csv"');

        return $response;

    }

    /**
     * @Route("/descargarCsvBaseParaOrdenCompra", name="descargarCsvBaseParaOrdenCompra")
     */
    public function descargarCsvBaseParaOrdenCompraAction() {
        $response = new Response();
        $contenido = $this->container->get('compras_service')->csvContent_seleccion_compra();
        $response->setContent($contenido);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="OrdenesCompraBase.csv"');

        return $response;

    }

    /**
     * @Route("/testApiCategorias", name="testApiCategorias")
     */
    public function testApiCategoriasAction() {
        $response = new Response();
        $contenido = $this->container->get('meli_service')->buscarPublicacionesPorCategoria();
        

        return $response;

    }
}
