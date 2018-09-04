<?php 

namespace Xtending\EntityBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cargos
 */
class CargosEntidades
{

	private $id;

	
	private $name;

	
	private $entidad;

	
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
     * Set name
     *
     * @param string $name
     * @return CargosEntidades
     */
    public function setName($name)
    {
    	$this->name = $name;
    
    	return $this;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
    	return $this->name;
    }
    
    
    /**
     * @return Entidades
     */
    public function getEntidad()
    {
    	return $this->entidad;
    }
    
    /**
     * Set Empresa
     *
     * @param $empresa
     * @return CargosEntidades
     */
    public function setEntidad(Entidades $entidad)
    {
    	$this->entidad = $entidad;
    
    	return $this;
    }
   
}

?>