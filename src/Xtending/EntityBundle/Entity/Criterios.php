<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Criterios
 */
class Criterios
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
     * @var integer
     */
    private $tipo;
    
    /**
     * @var integer
     */
    private $unidadBase;
    
     /**
     * @var Arrays
     */
    private $labelsCriterio;
    /**
     * Inicializa los Arrays
     */
	public function __construct()
    {
        $this->labelsCriterio = new ArrayCollection();
       
    }
    
  
    
    
    
	/**
     * Get LabelsCriterio
     *
     * @return array 
     */
    public function getLabelsCriterio()
    {
        return $this->labelsCriterio;
    }
    
	/**
     * Add LabelsCriterio
     *
     * @return Labels 
     */
	public function addLabelsCriterio($label)
    {
    	$label->addCriterio($this);
    	
        $this->labelsCriterio->add($label);
    }

     /**
     * Remove 
     *
     */
    public function removeLabelsCriterio($label)
    {
    	$this->labelsCriterio->removeElement($label);
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
     * Set nombre
     *
     * @param string $nombre
     * @return Criterios
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
     * Set tipo
     *
     * @param integer $tipo
     * @return Criterios
     */
    public function setTipo($tipo)
    {
    	$this->tipo = $tipo;
    
    	return $this;
    }
    
    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
    	return $this->tipo;
    }
    
    /**
     * Set unidadBase
     *
     * @param integer $unidadBase
     * @return Criterios
     */
    public function setUnidadBase($unidadBase)
    {
    	$this->unidadBase = $unidadBase;
    
    	return $this;
    }
    
    /**
     * Get unidadBase
     *
     * @return integer
     */
    public function getUnidadBase()
    {
    	return $this->unidadBase;
    }
    
	/**
     * Get String ID
     *
     * @return integer 
     */
	public function __toString()
	{
    return strval($this->nombre);
	}
}