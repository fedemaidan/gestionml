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

class AnalisisController extends Controller
{
    
    /**
     * @Route("/csvProductosPorMinimoYVendidos", name="csvProductosPorMinimoYVendidos")
     */

    public function  formularioCsvProductosPorMinimoYVendidos(Request $request) {
        $form =  $this->createFormBuilder()
            ->setAction($this->generateUrl('csvProductosPorMinimoYVendidos'));
        $form->add('precio_minimo','number');
        $form->add('cantidad_vendidos','number');
        $form->add('Descargar', FormType\SubmitType::class, [
            'label' => 'Descargar',
        ]);

        $form = $form->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $data = $form->getData();
            
            $minimo     = $data['precio_minimo'];
            $vendidos    = $data['cantidad_vendidos'];

            try {
                $response = new Response();

                $contenido  = $this->container->get('analisis_service')->productosPorMinimoYVendidos($minimo, $vendidos);

                $response->setContent($contenido);

                $response->headers->set('Content-Type', 'text/csv');
                $response->headers->set('Content-Disposition', 'attachment; filename="productos_analisis.csv"');

                return $response;
            }
            catch(\Exception $e) {
                $this->addFlash('sonata_flash_error', 'Error: '.$e->getMessage());
                $url = $this->generateUrl('csvProductosPorMinimoYVendidos');
            }
            
            return new RedirectResponse($url);
        }

        return $this->render('AppBundle:Analisis:analisis_productos_vendidos_minimo.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
}