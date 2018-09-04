<?php

namespace Xtending\SecurityXtendingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Xtending\ServicesBundle\Services\MailerServices;
use Xtending\AlertasBundle\Services\AlertasServices;
use Xtending\ContactoBundle\Services\ContactoServices;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityXtendingController extends Controller
{
// 	protected $alertasServices;
// 	protected $mailerServices;
// 	protected $contactoServices;
	
	public function __construct()
	{
// 		$this->alertasServices = new AlertasServices($this);
// 		$this->mailerServices = new MailerServices($this);
// 		$this->contactoServices = new ContactoServices($this);
	}
	
	public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
//         //DESCOMENTAR PARA PRODUCCI�N
//         $estado = $this->alertasServices->actualizarAlertasRegistro();
        
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
		
        return $this->render(
            'SecurityXtendingBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }
   
    /**
     * Muestra un formulario para buscar la informaci�n
     * del usuario.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recuperarPasswordAction () {
    	$error = 0;
    	return $this->render(
    			'SecurityXtendingBundle:Security:recuperar.html.twig',
    			array(
    					'error'   => $error,
    			)
    	);
    }
    
    /**
     * Busca el usuario por mail o username
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function informacionAction () {
    	
    	$request = $this->getRequest();
    	$error = 0;
    	$userEmail = $request->get('userEmail');
    	
    	$usuario = $this->contactoServices->getInformacionUsuario($userEmail);
    	
    	if (!$usuario) {
    		$error = 1;
    		return $this->render(
    				'SecurityXtendingBundle:Security:recuperar.html.twig',
    				array(
    						'error'   => $error,
    				)
    		);
    	}
    	return $this->render(
    			'SecurityXtendingBundle:Security:info.html.twig',
    			array(
    					'usuario' => $usuario,
    			)
    	);
    	
    }
    
    /**
     * Valida que el c�digo ingresado sea el enviado.
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function codigoPasswordAction ($id) {
    	$usuario = $this->contactoServices->getContacto($id);
    	$request = $this->getRequest();
    	$codigo = $request->get('codigo');
    	$respuesta = $this->contactoServices->validarCodigoRecuperacion($codigo, $usuario);
    	if ($respuesta) {
    		return $this->render(
    				'SecurityXtendingBundle:Security:cambio.html.twig',array(
    						'usuario' => $usuario,
    				)
    		);
    	} else {
    		$error = 1;
    		return $this->render(
    				'SecurityXtendingBundle:Security:codigo.html.twig', array(
    						'usuario' => $usuario,
    						'error'   => $error,
    				)
    		);
    	}
    	
    }
    
    public function cambioAction ($id) {
    	$request = $this->getRequest();
    	$nuevaPass = $request->get('nuevaPass');
    	$repNueva = $request->get('repNueva');
    	$usuario = $this->contactoServices->getContacto($id);
    	if ($repNueva != $nuevaPass) {
    		return $this->render(
    				'SecurityXtendingBundle:Security:cambio.html.twig',array(
    						'usuario' => $usuario,
    				)
    		);
    	} else {
	    	$this->contactoServices->cambiarPassword($usuario, $nuevaPass);
	    	return $this->redirect($this->generateUrl('login'));
    	}
    }
    
    /**
     * Prepara los datos para enviar el email de recuperaci�n
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function enviarEmailAction ($id) {
    	$usuario = $this->contactoServices->getContacto($id);
    	$codigo = rand(1,99999);
    	$error = 0;
    	$respuesta = $this->mailerServices->enviarMailRecuperarPassword($usuario, $codigo);
    	$this->contactoServices->setCodigoRecuperacion($codigo, $usuario);
    	return $this->render(
    			'SecurityXtendingBundle:Security:codigo.html.twig', array(	
    			'usuario' => $usuario,
    			'error'   => $error,
    			)
    	);
    }
    
    public function timeoutAvisoAction(){
    	return $this->redirect($this->generateUrl('login'));
    }
    
    public function contactoAction() {
    if ($this->getRequest()->isXmlHttpRequest()) {

    		//tomo los valores del formulario ajax
    		$nombre = $this->getRequest()->get('nombre');
    		$email = $this->getRequest()->get('email');
    		$telefono = $this->getRequest()->get('telefono');
    		$mensaje = $this->getRequest()->get('mensaje');
    		
    		// descomentar cuando haya que usarlo para no generar spam.
    		$this->mailerServices->enviarMailContactoLanding($nombre, $email, $telefono, $mensaje);
			
    		$mensaje_resp= $this->get('translator')->trans('mensaje.exitoso');
    		$return=array("responseCode"=>200,  "mensaje"=>$mensaje_resp);
    		 
    		$return=json_encode($return);//jscon encode the array
    		return new Response($return,200,array('Content-Type'=>'application/json'));//make sure it has the correct content type
    	}
    }
    
    public function publicDataAction(){
    	
    	return $this->render('SecurityXtendingBundle:Security:public.html.twig')
    	;
    	
    }
}