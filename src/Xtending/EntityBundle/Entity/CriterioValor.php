<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * CriterioValor
 */
class CriterioValor
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var Entidades
     */
    private $empresa;
    
    /**
     * @var Sites
     */
    private $site;

    /**
     * @var Producto
     */
    private $producto;
    
    
    /**
     * @var Contactos
     */
    private $contacto;
    
    

    /**
     * @var string
     */
    private $criterioDefinicion;
    
   
    
     /**
     * @var array
     */
    private $labelsCaratulaValor;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->labelsCaratulaValor = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set labelsCaratulaValor
     *
     * @param 
     * @return FormulariosResultados
     */
    public function setlabelsCaratulaValor($label)
    {
    	
    	
    	$this->labelsCaratulaValor= $label;
    
    	
    
    	return $this;
    }
    
    /**
     * Add labelsCaratulaValor
     *
     * @param 
     * @return FormulariosResultados
     */
    public function addLabelsCaratulaValor($label)
    {
    	$label->addCriterioValor($this);
    	
    	$this->labelsCaratulaValor->add($label); 	
    
    	return $this;
    }
    
    /**
     * Remove labelCaratulaValor
     *
     */
    public function removeLabelsCaratulaValor($label)
    {
    	$this->labelsCaratulaValor->removeElement($label);
    }
    
    /**
     * Get labelsCaratulaValor
     *
     * @return array
     */
    public function getLabelsCaratulaValor()
    {
    	return $this->labelsCaratulaValor;
    }

    /**
     * Set criterioDefinicion
     *
     * @param \Xtending\EntityBundle\Entity\CriterioDefinicion $criterioDefinicion
     * @return CriterioValor
     */
    public function setCriterioDefinicion(\Xtending\EntityBundle\Entity\CriterioDefinicion $criterioDefinicion = null)
    {
        $this->criterioDefinicion = $criterioDefinicion;
    
        return $this;
    }

    /**
     * Get criterioDefinicion
     *
     * @return \Xtending\EntityBundle\Entity\CriterioDefinicion 
     */
    public function getCriterioDefinicion()
    {
        return $this->criterioDefinicion;
    }

    /**
     * Set empresa
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $empresa
     * @return CriterioValor
     */
    public function setEmpresa(\Xtending\EntityBundle\Entity\Entidades $empresa = null)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Xtending\EntityBundle\Entity\Entidades 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set producto
     *
     * @param \Xtending\EntityBundle\Entity\Producto $producto
     * @return CriterioValor
     */
    public function setProducto(\Xtending\EntityBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \Xtending\EntityBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set site
     *
     * @param \Xtending\EntityBundle\Entity\Sites $site
     * @return CriterioValor
     */
    public function setSite(\Xtending\EntityBundle\Entity\Sites $site = null)
    {
        $this->site = $site;
    
        return $this;
    }

    /**
     * Get site
     *
     * @return \Xtending\EntityBundle\Entity\Sites 
     */
    public function getSite()
    {
        return $this->site;
    }
    
    
    /**
     * Set contacto
     *
     * @param \Xtending\EntityBundle\Entity\Contactos $contacto
     * @return CriterioValor
     */
    public function setContacto(\Xtending\EntityBundle\Entity\Contactos $contacto = null)
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
}