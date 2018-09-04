<?php

namespace Xtending\ServicesBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Xtending\EntityBundle\Entity\FormulariosResultados;
use Symfony\Component\Validator\Constraints\Length;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\BrowserKit\Response;
use Doctrine\DBAL\Query\QueryBuilder;
use Xtending\EntityBundle\Entity\Contactos;
use Xtending\EntityBundle\Entity\Entidades;
use Xtending\EntityBundle\Entity\AccionCorrectiva;
use Xtending\EntityBundle\Entity\XtendingConstantes;
use Amateur\ObjectBundle\Entity\User;
use Amateur\ObjectBundle\Entity\Event;



class MailerServices 
{
	protected $controller;
	
	public function __construct($controller)
	{
		$this->controller = $controller;
	}
	

    
   
    public function sendMail ($message) {
    	try {
    		$this->controller->get('mailer')->send($message);
    		$respuesta = 1;
    	} catch (Exception $e) {
    		$respuesta = 0;
    	}
    	return $respuesta;
    }
    
    
    
    
    
    public function enviarEmailEventos($template, $entities)
    {
    
        
        $respuesta = $this->sendgridmail('info@triabox.com', 'triatleta.amateur@gmail.com',
                "Eventos TriaBox", $this->controller->renderView(
    					$template, array(
    						'entities' => $entities,
                                                'title' => "TriaBox - Proximos Eventos",
    					)
    			), "");
    	return $respuesta;
    
    }
    
    
    public function sendEmailRequestUser(User $user,User $userFriend)
    {
    
    	$title = "Solicitud de amistad de ".$user->getName();
    	$url = $this->controller->generateUrl('add_friend', array('id' =>  $user->getId()));
    		
    	$enviar =  $this->controller->renderView(
    						':email:userToOtherFriend.html.twig', array(
    								'user' => $user,
    								'title' => $title,
    								'body' => $user->getName()." quiere ser tu amigo",
    								'botonTitle' => "Aceptar amistad",
    								'botonUrl' => $url,
    						)
    						);
    		$respuesta = $this->sendgridmail('info@triabox.com', $userFriend->getEmail(),
    				$title,$enviar, "");
    	
    	return $respuesta;
    
    }
    
    public function sendConfirEnrolledUser(Event $event,User $user)
    {
    
    	$title = "Confirmacion Inscripcion a evento ".$event->getName();
    	$url = $this->controller->generateUrl('enrolled_new', array('idEvent' =>  $event->getId()));
    
    	$enviar =  $this->controller->renderView(
    			':email:userNotification.html.twig', array(
    					'user' => $user,
    					'title' => $title,
    					'body' => "Se Inscribio al evento ".$event->getName()." el cual se realizada el dia ".$event->getStartTime()."El pago todavia no esta confirmado, si ya pago espere a que le llegue la confirmacion, si pago y no llega la confirmacion en la brevedad comuniquese con el equipo de TriaBox a través de las redes sociales",
    					'botonTitle' => "Ver Comprobante",
    					'botonUrl' => $url,
    			)
    			);
    	$respuesta = $this->sendgridmail('info@triabox.com', $user->getEmail(),
    			$title,$enviar, "");
    	 
    	return $respuesta;
    
    }
    
    /**
     * @param User $user
     * @param User $userFriend
     * @return mixed
     */
    public function confirmFriend(User $user,User $userFriend)
    {
    
    	$title = "Ahora eres amigo de ".$user->getName();
    	$url = $this->controller->generateUrl('user_show', array('id' =>  $user->getId()));
    
    	$enviar =  $this->controller->renderView(
    			':email:userToOtherFriend.html.twig', array(
    					'user' => $user,
    					'title' => $title,
    					'body' => "Ahora sos amigo de ".$user->getName().", puedes compartir eventos, seguir sus resultados, comentarios y mucho mas... ",
    					'botonTitle' => "Ver Perfil de ".$user->getName(),
    					'botonUrl' => $url,
    			)
    			);
    	$respuesta = $this->sendgridmail('info@triabox.com', $userFriend->getEmail(),
    			$title,$enviar, "");
    	 
    	return $respuesta;
    
    }
    
    
     public function enviarEmailEventosToUsers($template, $entities,$users,$title)
    {
    
        foreach($users as $user) {
        	
            $respuesta = $this->sendgridmail('triatleta.amateur@gmail.com', $user->getEmail(),
                $title, $this->controller->renderView(
    					$template, array(
    						'entities' => $entities,
                                                'title' => $title,
    					)
    			), "");
        }
        return $respuesta;
    
    }
    
  
    function sendgridmail($from, $to, $subject, $message, $headers)
{
    
    $url = 'https://api.sendgrid.com/';
    $user='triabox';
    $pass='Triabox2017';

    $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'to'        => $to,
        'subject'   => $subject,
        'html'      => $message,
        'text'      => "",
        'from'      => $from,
    	'fromname'      => "TriaBox",
    		
      );

    $request =  $url.'api/mail.send.json';

    // Generate curl request
    $session = curl_init($request);

    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);

    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);

    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        //print_r('obtaining the response');
    // obtain response
    $response = curl_exec($session);
    $json = json_decode($response);


    curl_close($session);

    // print everything out

    //print_r($response);
    return $response;

}
   
}
