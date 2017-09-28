<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ReservaAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('fechaAlta')
            ->add('fechaModificacion')
            ->add('precio')
            ->add('informacion', null, array( 'label' => 'Información'))
            ->add('sena', null, array( 'label' => 'Seña'))
            ->add('linkUsados')
            ->add('cliente')
            ->add('estado')
            ->add('productoNoCargado')
            ->add('codigoReserva')
            ->add('producto')
            ->add('tipoDePago')
            ->add('tipoDeEntrega')
            ->add('tipoDeVenta')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('producto')
            ->add('fechaAlta', 'datetime', array( 'label' => 'Fecha de alta', 'format' => 'Y-m-d H:i'))
            ->add('fechaModificacion', 'datetime', array( 'label' => 'Última modificación', 'format' => 'Y-m-d H:i'))
            ->add('precio')
            ->add('sena', null, array( 'label' => 'Seña'))
            ->add('linkUsados','url')
            ->add('tipoDePago')
            ->add('tipoDeEntrega')
            ->add('tipoDeVenta')
            ->add('estado')
            ->add('cliente')
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
            //->add('id')
            ->add('fechaAlta','sonata_type_datetime_picker',array(
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => true,
                    'dp_use_seconds'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'format'                => 'yyyy-MM-dd H:m'
            ))
            ->add('producto', 'sonata_type_model_autocomplete', array(
                'property' => 'nombre',
                'minimum_input_length' => 1
            ))
            ->add('productoNoCargado')
            ->add('tipoDePago')
            ->add('tipoDeEntrega')
            ->add('tipoDeVenta')
            ->add('estado')
            ->add('precio',  'number', array( 'precision' => 3))
            ->add('informacion', null, array( 'label' => 'Información'))
            ->add('sena', null, array( 'label' => 'Seña'))
            ->add('linkUsados')
            ->add('cliente')
            ->add('codigoReserva')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('fechaAlta', 'datetime', array( 'label' => 'Fecha de alta', 'format' => 'Y-m-d H:i'))
            ->add('fechaModificacion', 'datetime', array( 'label' => 'Última modificación', 'format' => 'Y-m-d H:i'))
            ->add('precio')
            ->add('estado')
            ->add('informacion', null, array( 'label' => 'Información'))
            ->add('sena', null, array( 'label' => 'Seña'))
            ->add('linkUsados','url')
            ->add('cliente')
            ->add('producto')
            ->add('productoNoCargado')
            ->add('codigoReserva')
            ->add('tipoDePago')
            ->add('tipoDeEntrega')
            ->add('tipoDeVenta')
        ;
    }
}
