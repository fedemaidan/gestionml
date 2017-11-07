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
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('informacion')
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
            ->add('reservas')
            ->add('informacion')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('pagosValidosTexto', null, array( 'label' => 'Pagos validos'))
            ->add('informacion')
            ->add('fechaAlta')
            ->add('reservas')
            ->add('proveedor')
            ->add('cuentaEbayCompra')
            ->add('warehouse')
            ->add('shipping')
            ->add('costoTotal')
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
}
