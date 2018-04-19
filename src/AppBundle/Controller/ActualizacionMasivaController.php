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

class ActualizacionMasivaController extends Controller
{
    
    /**
     * @Route("/actualizarReservas", name="actualizarReservas")
     */

    public function  actualizarReservasAction(Request $request) {
        $form =  $this->createFormBuilder()
            ->setAction($this->generateUrl('actualizarReservas'));
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
                $this->container->get('reservas_service')->cargaMasivaReservas($archivo);    
                $this->addFlash('sonata_flash_success', 'Reservas actualizadas correctamente');
                $url = 'admin/reserva/list';
            }
            catch(\Exception $e) {
                $this->addFlash('sonata_flash_error', 'Error: '.$e->getMessage());
                $url = $this->generateUrl('actualizarReservas');
            }
            
            return new RedirectResponse($url);
        }

        return $this->render('AppBundle:Reserva:cargaMasiva.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
}