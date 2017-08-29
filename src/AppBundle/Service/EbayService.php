<?php

namespace AppBundle\Service;

use AppBundle\Entity\PublicacionEbay;
use AppBundle\Entity\EspecificacionesProductoEbay;
use AppBundle\Entity\CategoriaEbay;
use DTS\eBaySDK\Shopping\Types\GetSingleItemRequestType;
use DTS\eBaySDK\Finding\Types\FindItemsAdvancedRequest;
use DTS\eBaySDK\Constants;
use DTS\eBaySDK\Finding\Services;
use DTS\eBaySDK\Finding\Types;
use DTS\eBaySDK\Finding\Enums;
use AppBundle\Entity\BusquedaEbay;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

/**
 * Include the SDK by using the autoloader from Composer.
 */

class EbayService
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


    public function actualizarPublicaciones(BusquedaEbay $busqueda)
    {
        $this->cambiarEstadoBusqueda($busqueda, "Comienza actualización ..");

    	/* Creo servicios ebay */
    	$serviceFinding = $this->getFindingService();
    	$serviceShopping = $this->getShoppingService();

    	/* Genero busqueda para calcular páginas*/
        $request = $this->generarRequestBusqueda($busqueda, 1, 100);
		$response = $serviceFinding->findItemsAdvanced($request);

        /* Intentar hasta que conecte */
        $intentos = 10;
        while ($this->validarError($response) && $intentos > 0) {
            $response = $serviceFinding->findItemsAdvanced($request);
            $intentos--;
            $this->imprimo("Intentos conectar ... - ".$intentos);
        }
        if ($intentos == 0) {
            $this->imprimo("Fin proceso con error");
            $this->cambiarEstadoBusqueda($busqueda, "Error - No pudo conectarse con Ebay");
            return 0;
        }
        //////////////////////////////


		$countInserts = 0;
		$countUpdates = 0;

		/* Recorro las páginas y actualizo publicaciones */
		$limit = $response->paginationOutput->totalPages;
        
		for ($pageNum = 1; $pageNum <= $limit; $pageNum++) {
			
            $sqlExec = "";
            $sqlEspecificaciones = "";
            $maxId = $this->em->getRepository(PublicacionEbay::ORM_ENTITY)->selectMaxId();
            $maxIdEsp = $this->em->getRepository(EspecificacionesProductoEbay::ORM_ENTITY)->selectMaxId();
			
            $this->imprimo("Comienzo página ". $pageNum);

		    $request->paginationInput->pageNumber = $pageNum;
		    $response = $serviceFinding->findItemsAdvanced($request);
            
            $this->validarError($response);

		    if ($response->ack !== 'Failure') {
		    	//Si la busqueda no falla

		        foreach ($response->searchResult->item as $item) {
		        	/* Por cada item de la página */
                    
            
                    $publicacion = $this->em->getRepository(PublicacionEbay::ORM_ENTITY)->findOneByIdEbay($item->itemId);
            
                    $requestSingle = new GetSingleItemRequestType();
                    $requestSingle->IncludeSelector = 'ItemSpecifics,Variations,Compatibility,Details,ShippingCosts,Description';
                    $requestSingle->ItemID = $item->itemId;
            
 
                    $datosItem = $serviceShopping->getSingleItem($requestSingle);
                    $categoria = $this->cargarCategoria($item->primaryCategory);
                    $imagenes = $this->cargoImagenes($item, $datosItem);
                    $especificaciones = $this->cargoEspecificaciones($datosItem);
                    $brand = array_key_exists("Brand", $especificaciones) ? $especificaciones["Brand"] : "";
                    
                    if ($publicacion) {
                        /* Update si es necesario */
                        	$sqlUpdate = $this->update($publicacion, $item, $datosItem, $imagenes, $categoria, $brand );

                            if ($sqlUpdate) {
                                       $sqlExec .= $sqlUpdate;
                                       $countUpdates++;
                               }
                               unset($sqlUpdate);
                            
                    }
                    else {
		                /* Inserto */
                        $maxId++;
                        

		                $sql = "insert into publicacion_ebay (id, id_ebay, titulo, precio_compra, link_publicacion, imagenes, cantidad_vendidos_ebay, categoria_ebay_id, vendedor, estado_ebay, brand) values (".$maxId.", '" . $item->itemId . "', '" . $this->stringLimpia($item->title) . "', '" . $item->sellingStatus->currentPrice->value . "', '" . $this->stringLimpia($item->viewItemURL) . "', '" . $this->stringLimpia($imagenes) . "', '".$datosItem->Item->QuantitySold."', '" . $categoria->getId() . "', '" . $busqueda->getVendedorEbayId() . "', '".$item->sellingStatus->sellingState."','".$this->stringLimpia($brand)."');";

		                //$this->imprimo("Inserto publicación " . $item->itemId);
                        $sqlExec .= $sql;
                        $countInserts++;
                        unset($sql);
                    }

                    $idPublicacion = $publicacion ? $publicacion->getId() : $maxId;
                    $sqlEspecificaciones .= $this->insertoEspecificaciones($especificaciones,$idPublicacion);
                    
                    $this->unset2($datosItem);
                    $brand = null;
                    
                    $especificaciones = null;
                    
		            $this->unset2($requestSingle);
                    $categoria = null;
                    $imagenes = null;
                    
                    if ($publicacion) $this->unset2($publicacion);
		    	}
		    	
                $sql = $sqlExec." ".$sqlEspecificaciones;
                if ($sql != " ")
		    	    $this->em->getConnection()->exec( $sql );
                
                $porcentajeProcesado = round(($request->paginationInput->pageNumber / $limit) * 100) ;
                $this->cambiarEstadoBusqueda($busqueda, $porcentajeProcesado."% procesado");

                $sqlEspecificaciones = null;
                $sqlExec = null;
                
                $this->unset2($response);
                $this->em->clear();
                $sql = null;
                gc_collect_cycles();
                $this->imprimo("Memory 1: " . ( (memory_get_usage() /1024) /1024));
                $this->imprimo("Memory 2: " . ( (memory_get_peak_usage() /1024) /1024));
                $this->imprimo("Memory 3: " . ( (memory_get_peak_usage(true) /1024) /1024));
		    	$this->imprimo("Updates :" . $countUpdates);
		    	$this->imprimo("Inserts :" . $countInserts);

		    }else {
                $this->imprimo("Error procesando página");
                $pageNumber--;
            }



		}

        $this->unset2($serviceFinding);
        $this->unset2($serviceShopping);
        gc_collect_cycles();
        $this->imprimo("Proceso terminado ");
        $this->cambiarEstadoBusqueda($busqueda, "Finalizado");
		return $countInserts;
    }

    public function generarRequestBusqueda($busqueda, $pageNumber = 1, $entriesPerPage = 100) {
    	
    	$request = new FindItemsAdvancedRequest();
        if ($busqueda->getCategoriaEbay())
       		$request->categoryId = [$busqueda->getCategoriaEbay()->getIdEbay()];

        $itemFilter = new Types\ItemFilter();
		$itemFilter->name = 'ListingType';
		$itemFilter->value[] = 'StoreInventory';
		//$request->itemFilter[] = $itemFilter;

		$itemFilter = new Types\ItemFilter();
		$itemFilter->name = 'Seller';
		$itemFilter->value[] = $busqueda->getVendedorEbayId();
		$request->itemFilter[] = $itemFilter;

        if ($busqueda->getPrecioMinimo()) {
            $request->itemFilter[] = new Types\ItemFilter([
                'name' => 'MinPrice',
                'value' => [$busqueda->getPrecioMinimo()]
            ]);    
        }
        if ($busqueda->getPrecioMaximo())
		{
            $request->itemFilter[] = new Types\ItemFilter([
                'name' => 'MaxPrice',
                'value' => [$busqueda->getPrecioMaximo()]
            ]);
        }

		$request->paginationInput = new Types\PaginationInput();
		$request->paginationInput->entriesPerPage = $entriesPerPage;
		$request->paginationInput->pageNumber = $pageNumber;

		return $request;
    }

    private function imprimo($texto) {
		echo "\n".date("Y-m-d H:i:s"). " ****** ".$texto;
    }

    private function cargarCategoria($primaryCategory) {
    	
    	$categoria = $this->em->getRepository(CategoriaEbay::ORM_ENTITY)->findOneByIdEbay($primaryCategory->categoryId);

    	if (!$categoria) {
    		$this->imprimo("Guardo categoría " . $primaryCategory->categoryName . " - ". $primaryCategory->categoryId);
    		$categoria = new CategoriaEbay();
    		$categoria->setIdEbay($primaryCategory->categoryId);
    		$categoria->setName($primaryCategory->categoryName);
    		$this->em->persist($categoria);
    		$this->em->flush();
    	}
    	
    	return $categoria;

    }

    private function cargoImagenes($item, $datosItem) {

    	$imagenes = $item->galleryURL;

        foreach ($datosItem->Item->PictureURL as $key => $value) {
            $imagenes .= ",".$value;
        }

        return $imagenes;
    }

    private function getFindingService() {
    	return new \DTS\eBaySDK\Finding\Services\FindingService([
		    //'apiVersion'  => '1.13.0',
		    'globalId'    => Constants\GlobalIds::US,
		    'credentials' => [
		        'appId'  => $this->container->getParameter('ebay.app_id'),
		        'certId' => $this->container->getParameter('ebay.certId'),
		        'devId'  => $this->container->getParameter('ebay.devId')]
		        ]);
    }

    private function getShoppingService() {
    	return new \DTS\eBaySDK\Shopping\Services\ShoppingService([
		    //'apiVersion'  => '1.13.0',
		    'globalId'    => Constants\GlobalIds::US,
		    'credentials' => [
		        'appId'  => $this->container->getParameter('ebay.app_id'),
		        'certId' => $this->container->getParameter('ebay.certId'),
		        'devId'  => $this->container->getParameter('ebay.devId')]
		        ]);
    }

    private function update($publicacion, $item, $datosItem, $imagenes , $categoria, $brand) {
    	$updateSql = array();

        if ($this->stringLimpia($publicacion->getTitulo()) != $this->stringLimpia($item->title) )
        {
        	$updateSql[] = " titulo = '".$this->stringLimpia($item->title)."'";
            
     	}
        if ($publicacion->getPrecioCompra() != $item->sellingStatus->currentPrice->value )  
        {
        	$updateSql[] = " precio_compra = '".$this->stringLimpia($item->sellingStatus->currentPrice->value)."'";
            
            
        }
        if ($this->stringLimpia($publicacion->getLinkPublicacion()) != $this->stringLimpia($item->viewItemURL))
        {
        	$updateSql[] = " link_publicacion = '".$this->stringLimpia($item->viewItemURL)."'";
            
        }
        if ($publicacion->getImagenes() != $this->stringLimpia($imagenes)) {
        	$updateSql[] = " imagenes = '".$this->stringLimpia($imagenes)."'";
            
        } 
        if ($publicacion->getCantidadVendidosEbay() != $datosItem->Item->QuantitySold)
        {
			$updateSql[] = " cantidad_vendidos_ebay = '".$datosItem->Item->QuantitySold."'";                  	
            
            
        } 
        if ($publicacion->getEstadoEbay() != $item->sellingStatus->sellingState)
        {
			$updateSql[] = " estado_ebay = '".$item->sellingStatus->sellingState."'";
            
            
        }
        if ($publicacion->getCategoriaEbay()->getId() != $categoria->getId())
        {
            $updateSql[] = " categoria_ebay_id = '".$categoria->getId()."'";
            
        }

        if ($publicacion->getBrand() != $brand)
        {
            $updateSql[] = " brand = '".$brand."'";
        }

        if (count($updateSql) > 0) {
            $this->imprimo("Actualizo publicación " . $item->itemId);

            $sql = "UPDATE publicacion_ebay ";

            foreach ($updateSql as $key => $value) {
                if ($key != 0) {
                    $sql .= " , ";
                }
                else {
                    $sql .= " set ";
                }
                $sql .= $value;
            }

            $sql .= " WHERE id = ".$publicacion->getId().";";
            unset($updateSql);
            return $sql;
        }
        $this->unset2($updateSql);

        return null;
    }

    private function stringLimpia($str, $limit = 255) {
        $str = str_replace("'", "\'", $str);
        if (strlen($str) > $limit)
            $str = substr($str, 0, $limit - 4) . '...';
        return $str;
    	 
    }

    private function validarError($response) {
        $hayError = false;
        if (isset($response->errorMessage)) {
                foreach ($response->errorMessage->error as $error) {
                    $hayError = true;
                    $this->imprimo(($error->severity=== Enums\ErrorSeverity::C_ERROR ? 'Error' : 'Warning').": ". $error->message);
                }
            }

        return $hayError;
    }

    private function cargoEspecificaciones($datosItem) {
        $especificaciones = [];
        if (isset($datosItem->Item->ItemSpecifics)) 
        {
            foreach ($datosItem->Item->ItemSpecifics->NameValueList as $key => $value) {
                $especificaciones[$value->Name] = $value->Value[0];
            }
        }
        return $especificaciones;
    }

    private function insertoEspecificaciones($especificaciones,$idPublicacion) {
        $sql = "";
        foreach ($especificaciones as $name => $value) {
            $espObj = $this->em->getRepository(EspecificacionesProductoEbay::ORM_ENTITY)
                            ->findOneBy(["name" => $this->stringLimpia($name), "value" => $this->stringLimpia($value) ]);

            if (!$espObj) {
                $espObj = new EspecificacionesProductoEbay();
                $espObj->setName($this->stringLimpia($name));
                $espObj->setValue($this->stringLimpia($value));
                $this->em->persist($espObj);
                $this->em->flush();

            }

            $tiene = $this->em->getRepository(EspecificacionesProductoEbay::ORM_ENTITY)->tieneRelacionConPublicacionId($espObj->getId(), $idPublicacion);
            
            //verificar asociacion con publicacion
            if (!$tiene) {
                //si no la tiene -> inserto relacion con la publicacion
                $sql .= "insert into publicaciones_espeficaciciones_ebay (publicacion_ebay_id,
                                especificaciones_producto_ebay_id) values (".$idPublicacion.",".$espObj->getId().");";
            }
        }

        unset($tiene);
        $this->unset2($espObj);
        return $sql;
    }

    private function cambiarEstadoBusqueda($busqueda, $texto) {
        $busqueda = $this->em->getRepository(BusquedaEbay::ORM_ENTITY)->findOneById($busqueda->getId());
        $busqueda->setEstadoActual(date('Y-m-d h:i:s')." - ".$texto);
        $this->em->persist($busqueda);
        $this->em->flush();
    }

    private function unset2($obj) {
        
        if (is_array($obj)) {
            foreach ($obj as $key => $value) {
                if (isset($obj->$key))
                    $this->unset2($obj->$key);
            }    
        }
        else if (is_object($obj)) {
            foreach (get_object_vars($obj) as $key => $value) {
                if (isset($obj->$key))
                    $this->unset2($obj->$key);
            }
        }
        else {
            echo "no anduvo";
        }
        

        $obj = null;
    }
}
