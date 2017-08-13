<?php

namespace AppBundle\Service;

use DTS\eBaySDK\Finding\Types\FindItemsAdvancedRequest;
use DTS\eBaySDK\Constants;
use DTS\eBaySDK\Finding\Services;
use DTS\eBaySDK\Finding\Types;
use DTS\eBaySDK\Finding\Enums;


/**
 * Include the SDK by using the autoloader from Composer.
 */

class EbayService
{
    public function dameProductos(BusquedaEbay $busqueda = null)
    {

    	$service = new \DTS\eBaySDK\Finding\Services\FindingService([
		    //'apiVersion'  => '1.13.0',
		    'globalId'    => Constants\GlobalIds::US,
		    'credentials' => [
		        'appId'  => 'Federico-gestionm-PRD-5b7edec1b-d763d994',
		        'certId' => 'PRD-b7edec1b3431-b185-4e5c-b460-907f',
		        'devId'  => 'f8e2e10d-4125-4977-ac00-b7dae16018f4']
		        ]);


        $request = new FindItemsAdvancedRequest();
       	//$request->categoryId = ['617', '171228'];


        $itemFilter = new Types\ItemFilter();
		$itemFilter->name = 'ListingType';
		$itemFilter->value[] = 'StoreInventory';
		$request->itemFilter[] = $itemFilter;

		$itemFilter = new Types\ItemFilter();
		$itemFilter->name = 'Seller';
		$itemFilter->value[] = 'inhimiamp413';
		$request->itemFilter[] = $itemFilter;

		$request->itemFilter[] = new Types\ItemFilter([
			    'name' => 'MinPrice',
			    'value' => ['1']
			]);
			$request->itemFilter[] = new Types\ItemFilter([
			    'name' => 'MaxPrice',
			    'value' => ['1000000']
			]);

		/**
		 * Limit the results to 10 items per page and start at page 1.
		 */
		$request->paginationInput = new Types\PaginationInput();
		$request->paginationInput->entriesPerPage = 50;
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
		/**
		 * Output the result of the search.
		 */
		printf(
		    "%s items found over %s pages.\n\n",
		    $response->paginationOutput->totalEntries,
		    $response->paginationOutput->totalPages
		);

		/**
		 * Paginate through 2 more pages worth of results.
		 */
		$limit = $response->paginationOutput->totalPages;
		for ($pageNum = 1; $pageNum <= $limit; $pageNum++) {
		    $request->paginationInput->pageNumber = $pageNum;
		    $response = $service->findItemsAdvanced($request);
		    echo "==================\nResults for page $pageNum\n==================\n";
		    if ($response->ack !== 'Failure') {
		        foreach ($response->searchResult->item as $item) {
		        	var_dump($item);
		        	//filtrar los que salen por numero de item   
		        }
		    }

		}

		die;
        //
    }
}