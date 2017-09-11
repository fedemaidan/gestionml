<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class MandarMailsProveedoresCommand extends ContainerAwareCommand
{
    protected function configure()
{
    $this
        ->setName('app:email:proveedores')
        ->setDescription('Creates a new user.')
        ->addOption('archivo', null,         InputOption::VALUE_REQUIRED,    'Archivo de csv');
    ;
}

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $proveedores = array();
        $archivo = $input->getOption('archivo');
        
        if(!file_exists($archivo))
        {
            throw new InvalidArgumentException("No existe el archivo $archivo");
        }
 		
 		
        if (($handle = fopen($archivo, "r")) !== FALSE) {
	        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	           $producto = $data[0];
               $email = $data[1];

               if (array_key_exists($email, $proveedores))
                    $proveedores[$email][] = $producto;
                else{
                    $proveedores[$email] = array();
                    $proveedores[$email][] = $producto;
                }

	      }
      }
      
      fclose($handle);

      foreach ($proveedores as $email => $productos) {

          $transport = \Swift_SmtpTransport::newInstance('smtp.live.com', 587, 'tls')
                            ->setUsername('fede_915@hotmail.com')
                            ->setPassword('1324neco');
                $textoProductos = implode(", ", $productos);
                
               
               $texto = "Hola ".$textoProductos." como";
               
               $mailer = \Swift_Mailer::newInstance($transport);

                $message = \Swift_Message::newInstance()
                    ->setSubject("Asunto")
                    ->setFrom('fede_915@hotmail.com')
                    ->setTo($email)
                    ->setBody($texto);

                $mailer->send($message);
      }

    }
}