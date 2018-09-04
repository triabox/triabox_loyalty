<?php

namespace Xtending\RoleBundle\DAO;



use Xtending\EntityBundle\Entity\Role;

use Symfony\Component\Validator\Constraints\Length;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\BrowserKit\Response;
use Doctrine\DBAL\Query\QueryBuilder;




/**
 * @author Miguel Chavarria
 *
 */
class RoleDAO 
{

	protected $controller;
	
	
	/**
	 * Contructor
	 * @param Controller $controller
	 */
	public function __construct($controller) {
		
		$this->controller = $controller;
		
	
	}

	/**
	 * Devuelve todos los Roles
	 * @return array
	 */
	public function getAllRoles() {
		$em = $this->controller->getDoctrine()->getManager();
		$roles = $em->getRepository('EntityBundle:Role')->findAll();
		return $roles;
	}
	
	/**
	 * @param integer $id
	 * @return Role
	 */
	public function getRole ($id) {
		$em = $this->controller->getDoctrine()->getManager();
		$role = $em->getRepository('EntityBundle:Role')->find($id);
		return $role;
	}
	
}
