<?php

namespace AppBundle\Service;

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


        $request = new FindItemsAdvancedRequest();
        if ($busqueda->getCategoria())
       		$request->categoryId = [$busqueda->getCategoria()];

        $itemFilter = new Types\ItemFilter();
		$itemFilter->name = 'ListingType';
		$itemFilter->value[] = 'StoreInventory';
		$request->itemFilter[] = $itemFilter;

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

		/**
		 * Limit the results to 10 items per page and start at page 1.
		 */
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

		$limit = $response->paginationOutput->totalPages;
		for ($pageNum = 1; $pageNum <= $limit; $pageNum++) {
		    $request->paginationInput->pageNumber = $pageNum;
		    $response = $service->findItemsAdvanced($request);

		    if ($response->ack !== 'Failure') {
		        foreach ($response->searchResult->item as $item) {
		        	
		        	$sql = "insert into producto (id, id_ebay, titulo, precio_compra, link_publicacion, imagenes, cantidad_vendidos_ebay, json, vendedor) values (null, '" . $item->itemId . "', '" . $item->title . "', '" . $item->sellingStatus->currentPrice->value . "', '" . $item->viewItemURL . "', '" . $item->galleryURL . "', '0', 'json', '" . $busqueda->getVendedorEbayId() . "');";
		        	$this->em->getConnection()->exec( $sql );
		        	echo $sql;
		        	die;
		        	//insertar producto en la base de datos 
		        }
		    }

		}

    }
}