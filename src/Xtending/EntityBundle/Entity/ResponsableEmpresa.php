<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * ResponsableEmpresa
 */
class ResponsableEmpresa
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Xtending\EntityBundle\Entity\Contactos
     */
    private $contacto;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $contactoEmpresa;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $contactoAsignadoEmpresa;
   
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
     * Set contacto 
     *
	 * @param \Xtending\EntityBundle\Entity\Contactos $contacto
     * @return responsableEmpresa
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    
        return $this;
    }

    /**
     * Get contacto 
     *
     * @return \Xtending\EntityBundle\Entity\Contactos $contacto
     */
    public function getContacto()
    {
        return $this->contacto;
    }
    
    /**
     * Set contactoEmpresa 
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $empresa
     * @return responsableEmpresa
     */
    public function setContactoEmpresa($empresa)
    {
    	$this->contactoEmpresa = $empresa;
    
    	return $this;
    }
    
    /**
     * Get contactoEmpresa 
     *
     * @return \Xtending\EntityBundle\Entity\Entidades
     */
    public function getContactoEmpresa()
    {
    	return $this->contactoEmpresa ;
    }
    
    /**
     * Set contactoAsignadoEmpresa 
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $empresa
     * @return responsableEmpresa
     */
    public function setContactoAsignadoEmpresa($empresa)
    {
    	$this->contactoAsignadoEmpresa = $empresa;
    
    	return $this;
    }
    
    /**
     * Get contactoAsignadoEmpresa 
     *
     * @return \Xtending\EntityBundle\Entity\Entidades
     */
    public function getContactoAsignadoEmpresa()
    {
    	return $this->contactoAsignadoEmpresa;
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