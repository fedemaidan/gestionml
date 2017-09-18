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
               $precio = $data[2];
               $texto = $producto." - ".$precio;

               if (!empty($email)) {
                  if (array_key_exists($email, $proveedores))
                    $proveedores[$email][] = $texto;
                  else{
                      $proveedores[$email] = array();
                      $proveedores[$email][] = $texto;
                  }
               }
	      }
      }
      
      fclose($handle);

      foreach ($proveedores as $email => $productos) {

          $transport = \Swift_SmtpTransport::newInstance('smtp.live.com', 587, 'tls')
                            ->setUsername('mariano_cardenes1@hotmail.com')
                            ->setPassword('od2wsv56cf8?');
                
                $aux = [];

                foreach ($productos as $key => $value) {
                  if (!array_key_exists($value, $aux)) {
                    $aux[$value] = 1;
                  }
                  else {
                   $aux[$value]++; 
                  }
                }

                $textoProductos = "";
                foreach ($aux as $producto => $cantidad) {
                  $textoProductos = $textoProductos  . " ". $cantidad. " - ".$producto. "\n";
                }
                
                
               
               $texto = "Hi, how are you? I,m Mariano. I am a reseller in Argentina and I buy very often. My ebay Users´re: mmbuys (249) and mv-maria (258). I´m looking for this items, I reelevated these prices that are from ebay: \n Qty - Items - PRICE ($)\n ".$textoProductos."\n I could make the payment as soon as possible. If the purchase I make it out of ebay, I make the payment directly for paypal, what is the best price you can make me? I hope your answer, thank you very much! Mariano";
               
               $mailer = \Swift_Mailer::newInstance($transport);

                $message = \Swift_Message::newInstance()
                    ->setSubject("New order")
                    ->setFrom('mariano_cardenes1@hotmail.com')
                    ->setTo($email)
                    ->setBody($texto);

                $mailer->send($message);
      }

    }
}