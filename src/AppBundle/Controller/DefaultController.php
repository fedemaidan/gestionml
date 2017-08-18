<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BusquedaEbay;
use AppBundle\Utils\Meli\Meli;
use Symfony\Component\Finder\Finder;

    
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/testingEbay", name="ebay_test")
     */
    public function testEbayAction(Request $request)
    {   
        $busqueda = new BusquedaEbay();
        $busqueda->setVendedorEbayId("kp0one");
        $busqueda->setPrecioMinimo("1");
        $busqueda->setPrecioMaximo("900000");

        $count = $this->container->get('ebay_service')->guardarProductosDeLaBusquedaEbay($busqueda);
        
        var_dump("Se cargaron $count");die;


        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/cargarCategoriasTemporal", name="ebay_test")
     */
    public function cargarCategoriasTemporalAction(Request $request)
    {   
        
        $finder = new Finder();
        $finder->files()->in(__DIR__."/../Resources/public/");
        $categorias =  array();
        foreach ($finder as $file) {
            $row = 1;
            $first = true;
            if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {
              while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                
                if ($first == true) {
                    $first = false;
                }
                else {
                    $meli = new Meli("","");
                    $category_id = $meli->get("items/".$data[3])["body"]->category_id;
                    if (array_key_exists($category_id, $categorias)) {
                        $categorias[$category_id]["cantidad"]++;
                    } else {
                        $categorias[$category_id] = [ 'name' => $meli->get("categories/".$category_id)["body"]->name,
                        'cantidad' => 1];
                    }
                }
                $row++;
              }
              dump($categorias);die;1
              fclose($handle);
            }
        }
        die;
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
