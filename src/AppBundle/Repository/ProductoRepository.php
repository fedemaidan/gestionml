<?php

namespace AppBundle\Repository;

/**
 * ProductoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductoRepository extends \Doctrine\ORM\EntityRepository
{
	public function dameProductos($brand, $model, $upc, $mpn, $ean) {
		
		$query  = $this->createQueryBuilder('p');
     
		if ($brand && $model) {
			$query->orWhere("(p.marca = '$brand' and p.modelo = '$model')");
		}
		if ($upc) {
			$query->orWhere("p.upc = $upc");
		}
		if ($mpn) {
			$query->orWhere("p.mpn = $mpn");
		}
		if ($ean) {
			$query->orWhere("p.ean = $ean");
		}

		return $query->getQuery()->getResult();
	
	}

}
