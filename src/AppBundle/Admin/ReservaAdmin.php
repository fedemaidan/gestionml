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
            ->add('estado')
            ->add('fechaAlta')
            ->add('fechaModificacion')
            ->add('precio')
            ->add('informacion', null, array( 'label' => 'Información'))
            ->add('sena', null, array( 'label' => 'Seña'))
            ->add('linkUsados')
            ->add('mailCliente')
            ->add('facebookCliente')
            ->add('telefonoCliente')
            ->add('datosCliente')
            ->add('moneda', null, [],  'choice', ['choices' => [ "PESOS" => "PESOS", "DOLARES" => "DOLARES"]])
            ->add('productoNoCargado')
            ->add('codigoReserva')
            ->add('producto')
            ->add('tipoDePago_1')
            ->add('valorPago1')
            ->add('tipoDePago_2')
            ->add('valorPago2')
            ->add('tipoDePago_3')
            ->add('valorPago3')
            ->add('tipoDePago_4')
            ->add('valorPago4')
            ->add('tipoDeEntrega')
            ->add('tipoDeVenta')
            ->add('cuentaPago')
            ->add('cuentaPrincipal')
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
            ->add('tipoDePago_1')
            ->add('tipoDeEntrega')
            ->add('tipoDeVenta')
            ->add('estado')
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
            ->with('Principal')
            //->add('id')
            ->add('estado',null, ["required" => true])
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
            ->add('cuentaPrincipal')
            ->end()
            ->with('Cliente')
            ->add('mailCliente')
            ->add('facebookCliente')
            ->add('telefonoCliente')
            ->add('tipoDocumento', 'choice', ['choices' => [ "DNI" => "DNI", "CUIT" => "CUIT"]])
            ->add('numeroDocumento')
            ->add('nombreCliente')
            ->add('apellidoCliente')
            ->add('datosCliente','textarea',["required" => false])
            ->end()
            ->with('Pago')
            ->add('linkUsados')
            ->add('cuentaPrincipal')
            ->add('moneda', 'choice', ['choices' => [ "PESOS" => "PESOS", "DOLARES" => "DOLARES"]])
            ->add('precio',  'number', array( 'precision' => 3))
            ->add('sena', null, array( 'label' => 'Seña'))
            ->add('tipoDeVenta')
            ->add('tipoDePago_1')
            ->add('valorPago1')
            ->add('tipoDePago_2')
            ->add('valorPago2')
            ->add('tipoDePago_3')
            ->add('valorPago3')
            ->add('tipoDePago_4')
            ->add('valorPago4')
            ->add('cuentaPago')
            ->add('factura')
            ->end()
            ->with('Entrega')
            ->add('tipoDeEntrega')
            ->add('costoClienteEntrega')
            ->add('costoNosotrosEntrega')
            ->add('provinciaEntrega')
            ->add('localidadEntrega')
            ->add('calleEntrega')
            ->add('alturaEntrega')
            ->add('pisoEntrega')
            ->add('departamentoEntrega')
            ->add('codigoPostalEntrega')
            ->add('nombreRecibeEntrega')
            ->add('celularRecibeEntrega')
            ->add('fechaEntrega')
            ->add('observacionesEntrega')
            ->end()
            ->with('Otros')
            ->add('informacion', null, array( 'label' => 'Información'))
            ->add('codigoReserva')
            ->end()
            ->with('------')
            ->end()
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
            ->add('mailCliente')
            ->add('facebookCliente')
            ->add('telefonoCliente')
            ->add('datosCliente')
            ->add('producto')
            ->add('productoNoCargado')
            ->add('codigoReserva')
            ->add('tipoDePago_1')
            ->add('valorPago1')
            ->add('tipoDePago_2')
            ->add('valorPago2')
            ->add('tipoDePago_3')
            ->add('valorPago3')
            ->add('tipoDePago_4')
            ->add('valorPago4')
            ->add('tipoDeEntrega')
            ->add('tipoDeVenta')
            ->add('cuentaPago')
            ->add('cuentaPrincipal')
        ;
    }
}
