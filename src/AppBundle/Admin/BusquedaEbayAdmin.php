<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BusquedaEbayAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('vendedorEbayId')
            ->add('filtrarNew')
            ->add('precioMinimo')
            ->add('precioMaximo')
            ->add('categoria')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('vendedorEbayId')
            ->add('filtrarNew')
            ->add('precioMinimo')
            ->add('precioMaximo')
            ->add('categoria')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('vendedorEbayId')
            ->add('filtrarNew')
            ->add('precioMinimo')
            ->add('precioMaximo')
            ->add('categoria')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('vendedorEbayId')
            ->add('filtrarNew')
            ->add('precioMinimo')
            ->add('precioMaximo')
            ->add('categoria')
        ;
    }
}
