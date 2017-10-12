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
            ->add('nombre')
            ->add('marca')
            ->add('modelo')
            ->add('codigo')
            ->add('categoria_interna')
            ->add('categoria_match_ml')
            ->add('rotacion')
            ->add('descripcion')
            ->add('peso')
            ->add('peso_caja')
            ->add('ancho')
            ->add('largo')
            ->add('profundidad')
            ->add('precio_maximo')
            ->add('precio_minimo')
            ->add('modelo2')
            ->add('modelo3')
            ->add('cantidad')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nombre')
            ->add('marca')
            ->add('modelo')
            ->add('cantidad')
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
            ->add('nombre')
            ->add('marca')
            ->add('modelo')
            ->add('codigo')
            ->add('categoria_interna')
            ->add('categoria_match_ml')
            ->add('rotacion')
            ->add('descripcion')
            ->add('peso')
            ->add('peso_caja')
            ->add('ancho')
            ->add('largo')
            ->add('profundidad')
            ->add('precio_maximo')
            ->add('precio_minimo')
            ->add('web_oficial')
            ->add('manual_url')
            ->add('origen')
            ->add('modelo2')
            ->add('modelo3')
            ->add('cantidad')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nombre')
            ->add('marca')
            ->add('modelo')
            ->add('codigo')
            ->add('categoria_interna')
            ->add('categoria_match_ml')
            ->add('rotacion')
            ->add('descripcion')
            ->add('peso')
            ->add('peso_caja')
            ->add('ancho')
            ->add('largo')
            ->add('profundidad')
            ->add('precio_maximo')
            ->add('precio_minimo')
            ->add('web_oficial')
            ->add('manual_url')
            ->add('origen')
            ->add('modelo2')
            ->add('modelo3')
            ->add('cantidad')
        ;
    }
}
