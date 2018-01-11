<?php

namespace AppBundle\Service;

use AppBundle\Entity\PublicacionML;
use AppBundle\Entity\AtributoML;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use AppBundle\Utils\Meli\Meli;


/**
 * Include the SDK by using the autoloader from Composer.
 */

class MeliService
{

	private $container;
    
    /**
    *
    * @var EntityManager
    */
    private $em;

    public function __construct( Container $container, EntityManager $entityManager )
    {
        $this->container = $container;
        $this->em = $entityManager;
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
    }

    public function buscarPublicacionesPorCategoria($categoria = "MLA82085", $mayorA = 4000) {
    	

    	$meli = new Meli("","");
    	$limit = 200;
    	$offset = 0;
    	$total = 2;
    	$publicacionesNuevas = 0;
    	$this->imprimo("Comienza .. ");
    	while ($total > $offset) {
    		$datos = $meli->get("sites/MLA/search/?category=".$categoria."&condition=new&price=".$mayorA."-*&limit=".$limit."&offset=".$offset);

    		$paging = $datos["body"]->paging;
    		$results = $datos["body"]->results;
    		
    		$this->imprimo("Offset: ".$offset);

    		foreach ($results as $key => $publicacionDatos) {

    			$publicacion = $this->em->getRepository(PublicacionML::class)->findOneByIdMl($publicacionDatos->id);

    			if (!$publicacion) {
    				
    				$publicacion = new PublicacionML();
    				$publicacionesNuevas++;
    				$datosItem = $meli->get("items/".$publicacionDatos->id);
    				$datosItem = $datosItem["body"];

    				if (isset($datosItem->pictures)) {
    					
    					$pictures = "";
		    			foreach ($datosItem->pictures as $key => $value) {
		    				$pictures .= $value->url.",";
		    			}

		    			$publicacion->setImagenes($pictures);
    				}
    				
    				if (isset($datosItem->attributes)) {
    					foreach ($datosItem->attributes as $key => $attr) {
    						
		    				$atributo = $this->em->getRepository(AtributoML::class)
	                            ->findOneBy(["idMl" => $attr->id, "valueName" => $attr->value_name]);

	                        if (!$atributo) {
	                        	$atributo = new AtributoML();
	                        	$atributo->setIdMl($attr->id);
	                        	$atributo->setName($attr->name);
	                        	$atributo->setValueId($attr->value_id);
	                        	$atributo->setValueName($attr->value_name);
	                        	$atributo->setAttributeGroupId($attr->attribute_group_id);
	                        	$atributo->setAttributeGroupName($attr->attribute_group_name);
	                        	$this->em->persist($atributo);
	                        	$this->em->flush();
	                        }

                            if ($atributo->getIdMl() == 'UPC') {
                                
                                    $publicacion->setUpc((int)$atributo->getValueName());
                            }

                            if ($atributo->getIdMl() == 'BRAND') {
                                $publicacion->setBrand($atributo->getValueName());
                            }

                            if ($atributo->getIdMl() == 'MODEL') {
                                $publicacion->setModel($atributo->getValueName());
                            }

                            if ($atributo->getIdMl() == 'MPN') {
                                $publicacion->setMpn($atributo->getValueName());
                            }

                            if ($atributo->getIdMl() == 'EAN') {
                                $publicacion->setEan($atributo->getValueName());
                            }
	                        $publicacion->addAtributo($atributo);
		    			}
    				}
	    			
    			}
	    			
	    			
    			$publicacion->setIdMl($publicacionDatos->id);
    			$publicacion->setTitulo($publicacionDatos->title);
    			$publicacion->setPrecioCompra($publicacionDatos->price);
    			$publicacion->setLink($publicacionDatos->permalink);
    			$publicacion->setVendedor($publicacionDatos->seller->id);
    			$publicacion->setCantidadVendidos($publicacionDatos->sold_quantity);
    			$publicacion->setCategoriaML($categoria);

    			/* Cargar datos */
    			$this->em->persist($publicacion);	
    			
    			
    		}

    		$this->em->flush();

    		$total = $paging->total;
    		$offset = $paging->offset + $limit;

    		$this->imprimo("Publicaciones cargadas -> ".$publicacionesNuevas);
    	}

    }

    private function imprimo($texto) {
		echo "\n".date("Y-m-d H:i:s"). " ****** ".$texto;
    }
}