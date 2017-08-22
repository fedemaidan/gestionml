<?php

namespace AppBundle\Service;

use AppBundle\Entity\PublicacionEbay;
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


    public function guardarProductosDeLaBusquedaEbay(BusquedaEbay $busqueda)
    {

    	$service = new \DTS\eBaySDK\Finding\Services\FindingService([
		    //'apiVersion'  => '1.13.0',
		    'globalId'    => Constants\GlobalIds::US,
		    'credentials' => [
		        'appId'  => $this->container->getParameter('ebay.app_id'),
		        'certId' => $this->container->getParameter('ebay.certId'),
		        'devId'  => $this->container->getParameter('ebay.devId')]
		        ]);

    	$serviceShopping = new \DTS\eBaySDK\Shopping\Services\ShoppingService([
		    //'apiVersion'  => '1.13.0',
		    'globalId'    => Constants\GlobalIds::US,
		    'credentials' => [
		        'appId'  => $this->container->getParameter('ebay.app_id'),
		        'certId' => $this->container->getParameter('ebay.certId'),
		        'devId'  => $this->container->getParameter('ebay.devId')]
		        ]);

        $request = new FindItemsAdvancedRequest();
        if ($busqueda->getCategoria())
       		$request->categoryId = [$busqueda->getCategoria()];

        $itemFilter = new Types\ItemFilter();
		$itemFilter->name = 'ListingType';
		$itemFilter->value[] = 'StoreInventory';
		//$request->itemFilter[] = $itemFilter;

		$itemFilter = new Types\ItemFilter();
		$itemFilter->name = 'Seller';
		$itemFilter->value[] = $busqueda->getVendedorEbayId();
		$request->itemFilter[] = $itemFilter;

		$request->itemFilter[] = new Types\ItemFilter([
			    'name' => 'MinPrice',
			    'value' => [$busqueda->getPrecioMinimo()]
			]);
			$request->itemFilter[] = new Types\ItemFilter([
			    'name' => 'MaxPrice',
			    'value' => [$busqueda->getPrecioMaximo()]
			]);

		$request->paginationInput = new Types\PaginationInput();
		$request->paginationInput->entriesPerPage = 200;
		$request->paginationInput->pageNumber = 1;

		/**
		 * Send the request.
		 */
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

		$sqlInserts = "";
		$countInserts = 0;
		$limit = $response->paginationOutput->totalPages;
		for ($pageNum = 1; $pageNum <= $limit; $pageNum++) {
		    $request->paginationInput->pageNumber = $pageNum;
		    $response = $service->findItemsAdvanced($request);

		    if ($response->ack !== 'Failure') {
		        
		        foreach ($response->searchResult->item as $item) {
                    $producto = $this->em->getRepository(PublicacionEbay::ORM_ENTITY)->findByIdEbay($item->itemId);

                    $requestSingle = new GetSingleItemRequestType();
                    $requestSingle->IncludeSelector = 'ItemSpecifics,Variations,Compatibility,Details,ShippingCosts,Description';
                    $requestSingle->ItemID = $item->itemId;
                    $datosItem = $serviceShopping->getSingleItem($requestSingle);
                    $imagenes = $item->galleryURL;
                    $cate = $busqueda->getCategoria() ? $busqueda->getCategoria() : "";

                    foreach ($datosItem->Item->PictureURL as $key => $value) {
                        $imagenes .= ",".$value;
                    }

                    
                    if (isset($datosItem->Item->ProductID)) {
                    	$datosProducto =$this->cargarProducto($datosItem->Item->ProductID);
                    }
                    
                    

		            if ($producto) {
                        /* Update si es necesario */

                            $update = false;
                            if ($producto->getTitulo() != $item->title ) $update = true;
                            if ($producto->getPrecioCompra() != $item->sellingStatus->currentPrice->value ) $update = true;
                            if ($producto->getLinkPublicacion() != $item->viewItemURL) $update = true;
                            if ($producto->getImagenes() != $imagenes) $update = true;
                            if ($producto->getCantidadVendidosEbay() != $datosItem->Item->QuantitySold) $update = true;

                            if ($update) {
                                //sentencia update
                            }
                    }
                    else {
		                /* Inserto */
		                if (isset($datosItem->Item->ItemSpecifics) or isset($datosItem->Item->ItemCompatibilityList)) {
		                	dump($datosItem->Item);
		                	
                    	}
		                $sql = "insert into publicacion_ebay (id, id_ebay, titulo, precio_compra, link_publicacion, imagenes, cantidad_vendidos_ebay, categoria, vendedor) values (null, '" . $item->itemId . "', '" . $item->title . "', '" . $item->sellingStatus->currentPrice->value . "', '" . $item->viewItemURL . "', '" . $imagenes . "', '".$datosItem->Item->QuantitySold."', '" . $cate . "', '" . $busqueda->getVendedorEbayId() . "');";

                        $sqlInserts .= $sql;
                        $countInserts++;
                    }
		        
		    	}
		    	die;
		    	$this->em->getConnection()->exec( $sqlInserts );
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
		dump($datos);
		return $datos;
		
    }
}