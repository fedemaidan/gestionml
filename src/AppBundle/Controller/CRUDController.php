<?php
// src/AppBundle/Controller/CRUDController.php

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CRUDController extends Controller
{
    public function buscarEnEbayAction()
    {
        $object = $this->admin->getSubject();

        exec("php /server/app/console ebay:actualizar:publicaciones --busqueda_id=".$object->getId()." >> /server/logs/logs_publicaciones.log &");

        $this->addFlash('sonata_flash_success', 'La carga de datos se esta realizando, pronto estaran cargados los resultados');

        return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
    }
}