<?php

namespace AppBundle\Service;

use AppBundle\Entity\PublicacionML;
use AppBundle\Entity\PublicacionPropia;
use AppBundle\Entity\AtributoML;
use AppBundle\Entity\Producto;
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
                                $publicacion->setEan((int)$atributo->getValueName());
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

    public function replicarPublicacionEbayEnMl($ebay, $cuentaML, $token, $rentabilidad = 4, $shipping = 10) {

        $publicacionExistente = $this->em->getRepository(PublicacionPropia::class)->findOneBy([ "publicacion_ebay" => $ebay]);


        if ($publicacionExistente != null) {
            //var_dump("Ya esta cargada ".$ebay->getId());
            return;
        }

        $publicacion = $this->ebayToMlObj($ebay, $cuentaML,$rentabilidad, $shipping);
        $datos = $this->publicar($publicacion, $token);
        if (isset($datos["body"]->id)) {
            $publicacion->setIdMl($datos["body"]->id);
            $publicacion->setLink($datos["body"]->permalink);
            $publicacion->setVendedor($datos["body"]->seller_id);
            $this->em->persist($publicacion);
            $this->em->flush();
        }
        else {
            echo $ebay->getId().",\n";
            //var_dump($datos);
        }
    }

    public function publicar($publicacion, $token) {
        $arrayimagenes = explode(',', $publicacion->getImagenes());
        $imagenes = [];
        foreach ($arrayimagenes as $key => $img) {
            $imagenes[] = ["source" => $img];
        }

        $body = [
                "title" =>$publicacion->getTitulo(),
                "category_id"=>$publicacion->getCategoriaML(),
                "price"=>$publicacion->getPrecioCompra(),
                "currency_id"=>"ARS",
                "available_quantity"=>99,
                "buying_mode"=>"buy_it_now",
                "condition" => "new",
                "listing_type_id"=>"gold_special",
                "description"=> [ "plain_text" => $publicacion->getDescripcion()],
                "sale_terms"=>[
                        ["id"=> "WARRANTY_TIME", "value_name"=> "180 dias"]
                ],
                "pictures"=> $imagenes
            ];
            
        $meli = new Meli("","");
        $datos = $meli->post("items", $body, [ "access_token" => $token ]);
        
        return $datos;
    }

    public function ebayToMlObj($ebay, $cuentaML, $rentabilidad = 3, $shipping = 10) {
        
        $publicacion = new PublicacionPropia();
        $publicacion->setPublicacionEbay($ebay);
        $precio = $this->calcularPrecio($ebay->getCategoriaEbay(), $ebay->getPrecioCompra(), $rentabilidad, $shipping);
        $publicacion->setTitulo($this->armarTitulo($ebay->getTitulo()));
        $publicacion->setDescripcion($this->generarDescripcion($ebay->getTitulo()));
        $publicacion->setPrecioCompra($precio);
        $publicacion->setCuenta($cuentaML);
        $imagenes = $ebay->getImagenes();
        $imagnesArray = explode(",", $imagenes);
        
        if (count($imagnesArray) > 12) {
            $imagnesArray2 = [];
            foreach ($imagnesArray as $key => $value) {
                if ($key == 12) continue;
                $imagnesArray2[] = $value;
            }

            $imagenes = implode(',', $imagnesArray2);
        }

        $publicacion->setImagenes($imagenes);
        $publicacion->setCategoriaML($this->predecirCategoria($publicacion));
        return $publicacion;
    }

    private function armarTitulo($texto) {
        $sufijo = "*a Pedido 30dias!";
        $texto = substr($texto, 0, 60 - strlen($sufijo));
        
        return $texto.$sufijo;
    }

    private function predecirCategoria($publicacion) {
        $meli = new Meli("","");
        $titulo = str_replace("&", " ", $publicacion->getTitulo());
        $titulo = str_replace("\"", " ", $titulo);
        
        $url = "sites/MLA/category_predictor/predict?title=".$titulo."&seller_id=".$publicacion->getCuenta()->getIdMl()."&price=".$publicacion->getPrecioCompra();
        $url = str_replace(" ", "%", $url);

        $datos = $meli->get($url);
        if ( property_exists($datos["body"], "id") ) {
            return $datos["body"]->id;
        } else {
            return null;
        }
        
    }

    private function generarDescripcion($titulo) {

        return  "----- PRODUCTO TRAIDO BAJO PEDIDO en 20-35 días ------
Una vez ofertado el producto, procesamos tu pedido, y en un tiempo promedio de 30 días te estaremos notificando para coordinar la entrega o envío del mismo. Te esperamos en INOVAMUSICNET !!!

Producto: ".$titulo."

Una manera FÁCIL y DIFERENTE de comprar. Al mejor precio, GARANTIZADO!

+ Producto Nuevo de fábrica en Caja Original
+ GARANTIA escrita de 6 meses y cobertura en todo el país.

* Hacemos Envíos a todo el país!
* Podés retirarlo en Caballito a metros del Subte \"A\", sobre Av. Rivadavia.
* Hacemos Factura A o B.
* Podés abonar tu compra en efectivo, tarjeta de crédito y todos los medios de pago que ofrece Mercadolibre.
* Si el item publicado viene de fábrica con fuente de alimentación, la misma será extraida de la caja previo al ingreso al país por normativas de seguridad eléctrica.
* Producto ORIGINAL / Último modelo de la serie.

Te esperamos para coordinar la reserva! * INOVAMUSICNET *";
    
    }

    private function calcularPrecio($categoria, $precioCompra, $rentabilidad, $shipping) {
        /*
        $precioCompra = $precioCompra * 21;
        return $precioCompra * $rentabilidad;
        
        $porcentajeImpuestoPorCategoria = 20;
        $impuesto = $precioCompra * ($porcentajeImpuestoPorCategoria / 100);
        $costoEnvio = 100;
        $comisionML = $precioCompra * 0.12;

        $precio = ($precioCompra + $impuesto + $costoEnvio + $comisionML) * ($rentabilidad + 1);
        */
        $rentabilidad = str_replace(",", ".", $rentabilidad);
        $precio = (($precioCompra * $rentabilidad) + $shipping) * 21;
        
        return intdiv($precio, 100) * 100 - 1;
    }

    private function imprimo($texto) {
		echo "\n".date("Y-m-d H:i:s"). " ****** ".$texto;
    }
}