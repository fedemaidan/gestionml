<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Entity\CargaImportacion;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use AppBundle\Entity\Estado;
use AppBundle\Entity\Reserva;

class CargaImportacionAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('numeroVuelo')
            ->add('empresaEnvio')
            ->add('estado', null, [],  'choice', ['choices' => [ CargaImportacion::ESTADO_GENERADA => "Generada", CargaImportacion::ESTADO_RECIBIDA => 'Recibida']])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('numeroVuelo')
            ->add('empresaEnvio')
            ->add('estado')
            ->add('reservas')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('estado','choice', ['choices' => [ CargaImportacion::ESTADO_GENERADA => "Generada", CargaImportacion::ESTADO_RECIBIDA => 'Recibida']])
            ->add('numeroVuelo')
            ->add('empresaEnvio')
            ->add('informacion','textarea',["required" => false, 'label' => 'Información'])
            ->add('fechaEstimadaLlegada','sonata_type_datetime_picker',array(
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => true,
                    'dp_use_seconds'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'format'                => 'yyyy-MM-dd H:m',
                    'label'                 => 'Fecha estimada de llegada',
                    "required"              => false
            ))
            ->add('reservas')
            ->add('file', 'file', array(
                'required' => false,
                'data_class' => null,
                'label' => 'Reserva seleccionadas CSV'
            ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('numeroVuelo')
            ->add('empresaEnvio')
            ->add('estado')
        ;
    }

    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit', 'show', 'list'))) {
            return;
        }

        $url = $this->routeGenerator->generate('descargarCsvReservasParaCargaImportacion');

        $menu->addChild('Download CVS para carga', array('uri' => $url));
    }


    // Called on submit create form.
    public function prePersist($entity)
    {
        $this->manageFileUpload($entity);

        return $entity;
    }

    // Called on submit edit form.
    public function preUpdate($entity)
    {
        $this->manageFileUpload($entity);

         if ($entity->getEstado() == CargaImportacion::ESTADO_RECIBIDA) {
            $em =  $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
            $reservas = $em->getRepository(Reserva::class)->findByCargaImportacion($entity);
            foreach ($reservas as $key => $reserva) {
                $estado = $em->getRepository(Estado::class)->findOneByCodigo(Estado::DEPOSITO_INNOVA);
                $reserva->setEstado($estado);
            }
         }

        return $entity;
    }

    protected function manageFileUpload($entity)
    {
        $em =  $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();

        if (null === $entity->getFile()) {
            return;
        }

        $row = 0;
        if (($handle = fopen($entity->getFile(), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $row++;
                if ($row == 1) continue;

                $reserva = $em->getRepository(Reserva::class)->findOneById($data[6]);
                /* TIRAR EXCEPTION SI NO ESTA LA RESERVA O SU ESTADO NO ES VALIDO */

                $estado = $em->getRepository(Estado::class)->findOneByCodigo(Estado::IMPORTANDO);
                $reserva->setCargaImportacion($entity);
                $reserva->setCostoCompraProductoDeclarado($data[2]);
                $reserva->setEstado($estado);
                $em->persist($reserva);

          }
        }
        
        // Empty the 
        $entity->setFile(null);
    }

}
