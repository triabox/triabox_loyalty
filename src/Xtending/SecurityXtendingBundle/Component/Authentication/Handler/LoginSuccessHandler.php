<?php

namespace Xtending\SecurityXtendingBundle\Component\Authentication\Handler;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Xtending\EntityBundle\Entity\XtendingConstantes;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {
	
	protected $router;
	protected $security;
	
	public function __construct(Router $router, SecurityContext $security) {
		$this->router = $router;
		$this->security = $security;
	}
	public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
// 		$user = $this->security->getToken ()->getUser ();
		
// 		$request->setLocale ( $user->getIdioma () );
// 		$request->getSession ()->set ( '_locale', $user->getIdioma () );
		
		$response = new RedirectResponse ( $this->router->generate ( 'newsuser' ) );
		return $response;
	}
}
