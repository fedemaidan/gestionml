<?php

namespace AppBundle\Service;

use AppBundle\Entity\PublicacionML;
use AppBundle\Entity\PublicacionPropia;
use AppBundle\Entity\AtributoML;
use AppBundle\Entity\Producto;
use AppBundle\Entity\CategoriaML;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use AppBundle\Utils\Meli\Meli;
use GuzzleHttp\Client;

/**
 * Include the SDK by using the autoloader from Composer.
 */



class MeliService
{
    const DOLAR = 40;
    const MATCH_ARRAY = [
                            "titulo"        =>"title",
                            "categoriaML"   =>"category_id",
                            "precioCompra"  => "price",
                            "estado"        => "status",
                            "descripcion"   => "description"
                        ];

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

    public function buscarCategoriasHijas($categoriaML) {
        $meli = new Meli("","");

        $this->imprimo("Comienza categrias hijo de .. ".$categoriaML->getNombre());
        
        $datos = $meli->get("categories/".$categoriaML->getIdMl());
        
        $results = $datos["body"]->children_categories;
        
        foreach ($results as $key => $categoriaDatos) {
            
            $categoria = $this->addCategoria($categoriaDatos);
            $categoria->setCategoriaPadre($categoriaML);
            $this->em->persist($categoria);
            $this->buscarCategoriasHijas($categoria);
        }

        $this->em->flush();
    }

    public function cargoCategoriasPadres($recursividad = true) {
        $meli = new Meli("","");

        $this->imprimo("Comienza .. ");
        
        $datos = $meli->get("sites/MLA/categories");
        
        $results = $datos["body"];
        
        foreach ($results as $key => $categoriaDatos) {
            $categoria = $this->addCategoria($categoriaDatos);
            $this->em->persist($categoria);
            if ($recursividad) $this->buscarCategoriasHijas($categoria);
        }

        $this->em->flush();
        
    }

    public function addCategoria($categoriaDatos) {
        $categoria = $this->em->getRepository(CategoriaML::class)->findOneByIdMl($categoriaDatos->id);

        if (!$categoria) {
            $categoria = new CategoriaML();
            $categoria->setIdMl($categoriaDatos->id);
        }
        
        $categoria->setNombre($categoriaDatos->name);
        
        return $categoria;
    }

    public function buscarPublicacionesPorCategoria($categoria, $mayorA='*', $menorA='*') {
    	

    	$meli = new Meli("","");
    	$limit = 50;
    	$offset = 0;
    	$total = 2;
    	$publicacionesNuevas = 0;
    	$this->imprimo("Comienza .. ");
    	while ($total > $offset) {
    		$datos = $meli->get("sites/MLA/search/?category=".$categoria."&condition=new&price=".$mayorA."-".$menorA."&limit=".$limit."&offset=".$offset);

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

    public function replicarPublicacionEbayEnMl($ebay, $cuentaML) {
        

        $publicacionExistente = $this->em->getRepository(PublicacionPropia::class)->findOneBy([ "publicacion_ebay" => $ebay]);


        if ($publicacionExistente != null) {
            var_dump("Ya esta cargada ".$ebay->getId());
            return;
        }

        $publicacion = $this->ebayToMlObj($ebay, $cuentaML);
        $datos = $this->publicar($publicacion);
        if (isset($datos["body"]->id)) {
            $publicacion->setIdMl($datos["body"]->id);
            $publicacion->setLink($datos["body"]->permalink);
            $publicacion->setVendedor($datos["body"]->seller_id);
            $this->em->persist($publicacion);
            $this->em->flush();
        }
        else {
            var_dump("Error cargando publicacion ".$ebay->getId());
            var_dump($datos);
        }
    }

    public function publicar($publicacion) {
        $token = $this->dameToken($publicacion->getCuenta());
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


    public function editarCamposPublicacionMercadolibre($publicacionPropia, $campos = [] ) {
        
        $token = $this->dameToken($publicacionPropia->getCuenta());

        $body = [ ];
        

        foreach ($campos as $key => $campo) {
            if ($key != "descripcion")
                $body[self::MATCH_ARRAY[$key]] = $campo[1];
        }


        $meli = new Meli("","");
        $datos = $meli->put("items/".$publicacionPropia->getIdMl(), $body, [ "access_token" => $token ]);
        
        if ($datos["httpCode"] != 200 ) {
            throw new Exception($datos["body"]->message, 1);
        }

        return $datos;

    }

    public function sincronizarPublicacionesPropiasConMercadoLibre($cuenta) {
        //consulta que publicaciones de mercado libre hay , las agrega o actualiza en nuestra DB
        
    }

    public function ebayToMlObj($ebay, $cuentaML) {
        
        $publicacion = new PublicacionPropia();
        $publicacion->setPublicacionEbay($ebay);
        $precio = $this->calcularPrecio($ebay->getCategoriaEbay(), $ebay->getPrecioCompra());
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

    private function calcularPrecio($categoria, $precioCompra) {
        /*
        $precioCompra = $precioCompra * 21;
        return $precioCompra * $rentabilidad;
        
        $porcentajeImpuestoPorCategoria = 20;
        $impuesto = $precioCompra * ($porcentajeImpuestoPorCategoria / 100);
        $costoEnvio = 100;
        $comisionML = $precioCompra * 0.12;

        $precio = ($precioCompra + $impuesto + $costoEnvio + $comisionML) * ($rentabilidad + 1);
        */

        $ratio = $categoria->getRatio();
        $shipping = $categoria->getShipping();
        $precio = (($precioCompra * $ratio) + $shipping) * self::DOLAR;
        
        return intdiv($precio, 100) * 100 - 1;
    }

    private function imprimo($texto) {
		echo "\n".date("Y-m-d H:i:s"). " ****** ".$texto;
    }

    public function dameToken($cuenta) {
        $client = new Client();
        
        $res = $client->request('GET', 'https://multiml.xyz/token?cuenta_id='.$cuenta->getId())
        ;

        $dato = json_decode($res->getBody()->getContents());
        
        return $dato->token;
        
    }
}