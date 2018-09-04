<?php

namespace Xtending\RoleBundle\Services;

use Symfony\Component\HttpFoundation\Request;

use Xtending\EntityBundle\Entity\Role;
use Xtending\RoleBundle\DAO\RoleDAO;
use Symfony\Component\Validator\Constraints\Length;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\BrowserKit\Response;
use Doctrine\DBAL\Query\QueryBuilder;




/**
 * 
 * @author Chavarria Miguel
 *
 */
class RoleServices 
{

	protected $controller;
	protected $roleDAO;
	
	/**
	 * 
	 * @param $controller
	 */
	public function __construct($controller)
	{
		$this->controller = $controller;
		$this->roleDAO = new RoleDAO($controller);
	}
	
	/**
	 * @return array
	 */
	public function getAllRoles() {
		$roles = $this->roleDAO->getAllRoles();
		return $roles;
	}
	
	/**
	 * @param integer $id
	 * @return Role
	 */
	public function getRole ($id) {
		$role = $this->roleDAO->getRole($id);
		return $role;
	}
	
	
}
