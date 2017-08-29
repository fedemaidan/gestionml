<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PublicacionEbayAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

        $datagridMapper
            
                ->add('id')
                ->add('idEbay')
                ->add('titulo')
                ->add('precio_compra')
                ->add('linkPublicacion')
                ->add('vendedor')
                ->add('cantidadVendidosEbay')
                ->add('categoriaEbay')
                ->add('brand')
                ->add('estado_ebay')
                //->add('especificaciones')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('imagenPrincipal','html')
            ->add('titulo')
            ->add('precio_compra')
            ->add('linkPublicacion','url')
            ->add('vendedor')
            ->add('cantidadVendidosEbay')
            ->add('categoriaEbay')
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
            ->with('General')
                ->add('id')
                ->add('idEbay')
                ->add('titulo')
                ->add('precio_compra')
                ->add('linkPublicacion')
                ->add('vendedor')
                ->add('imagenes')
                ->add('cantidadVendidosEbay')
                ->add('categoriaEbay')
                ->add('estado_ebay')
            ->end()
            ->with('Especificaciones')
                ->add('especificaciones')
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
            ->add('idEbay')
            ->add('titulo')
            ->add('precio_compra')
            ->add('linkPublicacion','url')
            ->add('vendedor')
            ->add('imagenesFoto','html')
            ->add('cantidadVendidosEbay')
            ->add('categoriaEbay')
            ->add('estado_ebay')
            ->add('brand')
            ->add('especificaciones', null, array('label' => 'Especificaciones', 'expanded' => true, 'by_reference' => true, 'multiple' => true))
        ;
    }

    public function getExportFields()
    {
        $results = $this->getModelManager()->getExportFields($this->getClass()); 

        // Need to add again our foreign key field here
        $results[] = 'categoriaEbay';
        return $results;
    }
}
