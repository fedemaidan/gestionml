<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Entity\Estado;
use AppBundle\Entity\Reserva;


class SeleccionDeCompraAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('limiteDinero')
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
            ->add('limiteDinero')
            ->add('informacion')
            ->add('fechaAlta', 'datetime', array( 'label' => 'Fecha de alta', 'format' => 'Y-m-d H:i'))
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
            ->add('limiteDinero')
            ->add('informacion')
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
            ->add('limiteDinero')
            ->add('informacion')
            ->add('fechaAlta')
            ->add('reservas', null, array('label' => 'Reservas', 'expanded' => true, 'by_reference' => true, 'multiple' => true))
        ;
    }

     public function getExportFields()
    {
        $results = $this->getModelManager()->getExportFields($this->getClass()); 
        $results[] = 'reservas';
        
        return $results;
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
        $estado = $em->getRepository(Estado::class)->findOneByCodigo(Estado::PROCESO_DE_COMPRA);
        $estado_reservado = $em->getRepository(Estado::class)->findOneByCodigo(Estado::RESERVADO);

        if (null === $entity->getFile()) {

            $reservas = $em->getRepository(Reserva::class)->findBySeleccionDeCompra($entity);

            foreach ($reservas as $key => $reserva) {
                $reserva->setSeleccionDeCompra(null);
                $reserva->setEstado($estado_reservado);
            }

            foreach ($entity->getReservas() as $key => $reserva) {
                $reserva->setSeleccionDeCompra($entity);
                $reserva->setEstado($estado);
                $em->persist($reserva);
            }
        }
        else {
            $row = 0;
            if (($handle = fopen($entity->getFile(), "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                    $row++;
                    if ($row == 1) continue;

                    /* Buscar reserva y cargarle la selección de compra */
                    $reserva = $em->getRepository(Reserva::class)->findOneById($data[0]);
                    /* TIRAR EXCEPTION SI NO ESTA LA RESERVA O SU ESTADO NO ES VALIDO */
                    
                    $reserva->setSeleccionDeCompra($entity);
                    $reserva->setEstado($estado);
                    $em->persist($reserva);

              }
            }

            // Empty the 
            $entity->setFile(null);
        }

    }
}
