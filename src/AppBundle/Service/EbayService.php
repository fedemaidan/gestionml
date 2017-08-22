<?php

namespace AppBundle\Service;

use AppBundle\Entity\PublicacionEbay;
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
    }


    public function actualizarPublicaciones(BusquedaEbay $busqueda)
    {
    	/* Creo servicios ebay */
    	$service = $this->getFindingService();
    	$serviceShopping = $this->getShoppingService();

    	/* Genero busqueda para calcular páginas*/
        $request = $this->generarRequestBusqueda($busqueda, 1, 200);
		$response = $service->findItemsAdvanced($request);

		if (isset($response->errorMessage)) {
		    foreach ($response->errorMessage->error as $error) {
		        printf(
		            "%s: %s\n\n",
		            $error->severity=== Enums\ErrorSeverity::C_ERROR ? 'Error' : 'Warning',
		            $error->message
		        );
		    }
		}

		$sqlExec = "";
		$countInserts = 0;
		$countUpdates = 0;

		/* Recorro las páginas y actualizo publicaciones */
		$limit = $response->paginationOutput->totalPages;
		for ($pageNum = 1; $pageNum <= $limit; $pageNum++) {
			
			$this->imprimo("Comienzo página ". $pageNum);

		    $request->paginationInput->pageNumber = $pageNum;
		    $response = $service->findItemsAdvanced($request);


			if (isset($response->errorMessage)) {
			    foreach ($response->errorMessage->error as $error) {
			    	$this->imprimo(($error->severity=== Enums\ErrorSeverity::C_ERROR ? 'Error' : 'Warning').": ". $error->message);
			    }
			}

		    if ($response->ack !== 'Failure') {
		    	//Si la busqueda no falla

		        foreach ($response->searchResult->item as $item) {
		        	
                    $publicacion = $this->em->getRepository(PublicacionEbay::ORM_ENTITY)->findOneByIdEbay($item->itemId);

                    $requestSingle = new GetSingleItemRequestType();
                    $requestSingle->IncludeSelector = 'ItemSpecifics,Variations,Compatibility,Details,ShippingCosts,Description';
                    $requestSingle->ItemID = $item->itemId;
                    
                    $datosItem = $serviceShopping->getSingleItem($requestSingle);
                    $categoriaId = $this->cargarCategoria($item->primaryCategory);
                    $imagenes = $this->cargoImagenes($item, $datosItem);

                    if (isset($datosItem->Item->ItemSpecifics) or isset($datosItem->Item->ItemCompatibilityList)) 
                    {
	                	//specip
                	}


                    if ($publicacion) {
                        /* Update si es necesario */
                        	$update = $this->sqlUpdate($publicacion, $item, $datosItem, $imagenes, $categoriaId );

                        	if ($update) {
                        		$sqlExec .= $update;
                        		$countUpdates++;
                        	}
                    }
                    else {
		                /* Inserto */
		                $sql = "insert into publicacion_ebay (id, id_ebay, titulo, precio_compra, link_publicacion, imagenes, cantidad_vendidos_ebay, categoria_ebay_id, vendedor, estado_ebay) values (null, '" . $item->itemId . "', '" . $this->stringLimpia($item->title) . "', '" . $item->sellingStatus->currentPrice->value . "', '" . $this->stringLimpia($item->viewItemURL) . "', '" . $this->stringLimpia($imagenes) . "', '".$datosItem->Item->sellingStatus->QuantitySold."', '" . $categoriaId . "', '" . $busqueda->getVendedorEbayId() . "', '".$item->sellingStatus->sellingState."');";

		                $this->imprimo("Inserto publicación " . $item->itemId);
                        $sqlExec .= $sql;
                        $countInserts++;
                    }
		        
		    	}
		    	

		    	$this->em->getConnection()->exec( $sqlExec );
		    	$this->imprimo("Proceso terminado ");
		    	$this->imprimo("Updates :" . $countUpdates);
		    	$this->imprimo("Inserts :" . $countInserts);
		    }
		}

		return $countInserts;
    }

    public function cargarProducto($productoEbay) {
    	$serviceProduct = new \DTS\eBaySDK\Product\Services\ProductService([
		    //'apiVersion'  => '1.13.0',
		    'globalId'    => Constants\GlobalIds::US,
		    'credentials' => [
		        'appId'  => $this->container->getParameter('ebay.app_id'),
		        'certId' => $this->container->getParameter('ebay.certId'),
		        'devId'  => $this->container->getParameter('ebay.devId')]
		        ]);

    	$requestProduct = new \DTS\eBaySDK\Product\Types\GetProductDetailsRequest();
                    	
    	$productDetails = new \DTS\eBaySDK\Product\Types\ProductDetailsRequestType();
    	//['DisplayableProductDetails','DisplayableSearchResults','Searchable', 'Sortable'];
    	$productDetails->dataset = ['DisplayableSearchResults'];
    	$productDetails->productIdentifier = new \DTS\eBaySDK\Product\Types\ProductIdentifier();
    	$productDetails->productIdentifier->ePID = $productoEbay->value;

        $requestProduct->productDetailsRequest[] = $productDetails;
		

		$datos = $serviceProduct->getProductDetails($requestProduct);
		return $datos;
		
    }

    public function generarRequestBusqueda($busqueda, $pageNumber = 1, $entriesPerPage = 200) {
    	
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
    	
    	return $categoria->getId();

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

    private function sqlUpdate ($publicacion, $item, $datosItem, $imagenes , $categoriaId) {
    	$updateSql = array();

        if ($publicacion->getTitulo() != $item->title )
        {
        	$updateSql[] = " titulo = '".$this->stringLimpia($item->title)."'";
     	}
        if ($publicacion->getPrecioCompra() != $item->sellingStatus->currentPrice->value )  
        {
        	$updateSql[] = " precio_compra = '".$this->stringLimpia($item->sellingStatus->currentPrice->value)."'";
        }
        if ($publicacion->getLinkPublicacion() != $item->viewItemURL)
        {
        	$updateSql[] = " link_publicacion = '".$this->stringLimpia($item->viewItemURL)."'";
        }
        if ($publicacion->getImagenes() != $imagenes) {
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
        if ($publicacion->getCategoriaEbay()->getId() != $categoriaId)
        {
            $updateSql[] = " categoria_ebay_id = '".$item->sellingStatus->sellingState."'";
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
            return $sql;
        }

        return null;
    }

    private function stringLimpia($str) {
    	return str_replace("'", "\'", $str);
    }
}
