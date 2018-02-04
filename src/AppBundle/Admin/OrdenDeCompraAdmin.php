<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use AppBundle\Entity\Estado;
use AppBundle\Entity\Reserva;

class OrdenDeCompraAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('informacion')
            ->add('fechaAlta')
            ->add('reservas','doctrine_orm_model_autocomplete',[], null, ['property'=>'id', 'multiple' => true, 'minimum_input_length' => 1])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('proveedor')
            ->add('reservas')
            ->add('pagosValidos','boolean')
            ->add('fechaAlta')
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
            ->add('fechaPrimerPago','sonata_type_datetime_picker',array(
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => true,
                    'dp_use_seconds'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'format'                => 'yyyy-MM-dd H:m'
            ))
            ->add('cuentaPaypal')
            ->add('proveedor')
            ->add('informacion')
            ->add('reservas')
            ->add('cuentaEbayCompra')
            ->add('warehouse')
            ->add('shipping')
            ->add('tarjeta1')
            ->add('pago1')
            ->add('tarjeta2')
            ->add('pago2')
            ->add('tarjeta3')
            ->add('pago3')
            ->add('tarjeta4')
            ->add('pago4')
            ->add('tarjeta5')
            ->add('pago5')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('fechaPrimerPago', 'datetime', array( 'label' => 'Fecha 1° pago', 'format' => 'Y-m-d'))
            ->add('cuentaPaypal')
            ->add('pagosValidosTexto', null, array( 'label' => 'Pagos validos'))
            ->add('informacion')
            ->add('fechaAlta', 'datetime', array( 'label' => 'Fecha de alta', 'format' => 'Y-m-d H:i'))
            ->add('costoTotal')
            ->add('pagosTotal')
            ->add('reservas')
            ->add('proveedor')
            ->add('cuentaEbayCompra')
            ->add('warehouse')
            ->add('shipping')
            ->add('tarjeta1')
            ->add('pago1')
            ->add('tarjeta2')
            ->add('pago2')
            ->add('tarjeta3')
            ->add('pago3')
            ->add('tarjeta4')
            ->add('pago4')
            ->add('tarjeta5')
            ->add('pago5')
            ;
    }

    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit', 'show', 'list'))) {
            return;
        }

        $url = $this->routeGenerator->generate('cargaMasivaOrdenCompra');

        $menu->addChild('Carga masiva', array('uri' => $url));
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

        return $entity;
    }

    protected function manageFileUpload($entity)
    {
        $em =  $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $estado = $em->getRepository(Estado::class)->findOneByCodigo(Estado::COMPRADO);
        $estado_reservado = $em->getRepository(Estado::class)->findOneByCodigo(Estado::PROCESO_DE_COMPRA);
        $reservas = $em->getRepository(Reserva::class)->findByOrdenDeCompra($entity);

        foreach ($reservas as $key => $reserva) {
            $reserva->setOrdenDeCompra(null);
            $reserva->setEstado($estado_reservado);
        }

        foreach ($entity->getReservas() as $key => $reserva) {
            $reserva->setOrdenDeCompra($entity);
            $reserva->setEstado($estado);
            $em->persist($reserva);
        }
     
    }
}
?>