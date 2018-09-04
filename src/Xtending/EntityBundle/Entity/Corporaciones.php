<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Corporaciones
 */
class Corporaciones
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;
    
    /**
     * @var Array
     */
    private $entidades;
    
    /**
     * @var Array
     */
    private $contactos;
    
    public function __construct()
    {
    	$this->entidades = new ArrayCollection();
    	$this->contactos = new ArrayCollection();
    	
    }
    
    /**
     * Get Contactos
     *
     * @return array
     */
    public function getContactos()
    {
    	return $this->contactos;
    }
    
    /**
     * Add Contactos
     *
     */
    public function addContactos($contactos)
    {
    
    	$this->contactos->add($contactos);
    }
    
    
    /**
     * Remove Contactos
     *
     */
    public function removeContactos($contactos)
    {
    	$this->contactos->removeElement($contactos);
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
     * Get Entidades
     *
     * @return array
     */
    public function getEntidades()
    {
    	return $this->entidades;
    }
    
    /**
     * Add Entidad
     *
     */
    public function addEntidade( $entidades)
    {
    	$entidades->addCorporacion($this);
    	 
    	$this->entidades->add($entidades);
    }
    
    
    /**
     * Remove Entidades
     *
     */
    public function removeEntidade($entidades)
    {
    	$this->entidades->removeElement($entidades);
    }
    
    
    /**
     * SET Entidades
     * @param Arrayr $entidades
     * @return Corporaciones
     */
    public function setEntidades( $entidades)
    {
    
    	$this->entidades = $entidades;
    	
    	return this;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Corporaciones
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

   
	/**
	* Get String ID
	*
	* @return integer 
	*/
	public function __toString()
	{
		return strval($this->id);
	}
}
