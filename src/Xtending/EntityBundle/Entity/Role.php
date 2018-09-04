<?php 

namespace Xtending\EntityBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="roles")
 * @ORM\Entity()
 */
class Role implements RoleInterface
{

	private $id;

	
	private $name;

	
	private $role;


	private $contactos;

	public function __construct()
	{
		$this->contactos = new ArrayCollection();
	}

	/**
	 * @see RoleInterface
	public function getRole()
	{
		return $this->role;
	} */
	public function getRole()
	{
		return $this->role;
	}
	
	
	/**
	 * Set role
	 *
	 * @param string $role
	 * @return Role
	 */
	public function setRole($role)
	{
		$this->role = $role;
	
		return $this;
	}

	/**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    
    /**
     * Set username
     *
     * @param string $name
     * @return Contactos
     */
    public function setName($name)
    {
    	$this->name = $name;
    
    	return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
    	return $this->name;
    }
    
 
    
    /**
     * @inheritDoc
     */
    public function getContactos()
    {
    	return $this->contactos->toArray();
    }
    
    /**
     * Set Role
     *
     * @param string $contactos
     * @return Role
     */
    public function setContactos($contactos)
    {
    	$this->contactos = $contactos;
    
    	return $this;
    }
    
    public function addContacto($contacto)
    {
    	$this->contactos[] = $contacto;
    	return $this;
    }
}

?>