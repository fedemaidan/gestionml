<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductoAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('idEbay')
            ->add('vendedor')
            ->add('titulo')
            ->add('linkPublicacion')
            ->add('cantidadVendidosEbay')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('titulo')
            ->add('vendedor')
            ->add('precioCompra')
            ->add('linkPublicacion')
            ->add('cantidadVendidosEbay')
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
            ->add('idEbay')
            ->add('vendedor')
            ->add('titulo')
            ->add('precioCompra')
            ->add('linkPublicacion')
            ->add('imagenes')
            ->add('cantidadVendidosEbay')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('idEbay')
            ->add('vendedor')
            ->add('titulo')
            ->add('precioCompra')
            ->add('linkPublicacion')
            ->add('imagenes')
            ->add('cantidadVendidosEbay')
        ;
    }
}
