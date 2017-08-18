<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Utils\Meli\Meli;

class dameCategoriasCommand extends Command
{
    protected function configure()
{
    $this
        ->setName('app:cargar:categorias')
        ->setDescription('Creates a new user.')
        ->addOption('archivo', null,         InputOption::VALUE_REQUIRED,    'Archivo de csv');
    ;
}


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $archivo = $input->getOption('archivo');
        if(!file_exists($archivo))
        {
            throw new InvalidArgumentException("No existe el archivo $archivo");
        }
 		
 		$categorias =  array();
 		$row = 1;
        $first = true;
        if (($handle = fopen($archivo, "r")) !== FALSE) {
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
      }
      dump($categorias);die;
      fclose($handle);

    }
}