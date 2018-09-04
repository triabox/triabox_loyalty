<?php

namespace Xtending\EntityBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * LabelsCriterio
 */
class LabelsCriterio
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
     * @var string
     */
    private $valor;
    
    /**
     * @var integer
     */
    private $convertible;

    /**
     * @var \Xtending\EntityBundle\Entity\Criterios
     */
    private $criterio;
    
    
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
     * @return LabelsCriterio
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
     * Set valor
     *
     * @param string $valor
     * @return LabelsCriterio
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set criteriosId
     *
     * @param \Xtending\EntityBundle\Entity\Criterios $criterios
     * @return LabelsCriterio
     */
    public function setCriterio(\Xtending\EntityBundle\Entity\Criterios $criterios = null)
    {
        $this->criterio = $criterios;
    
        return $this;
    }

    /**
     * add criteriosId
     *
     * @param \Xtending\EntityBundle\Entity\Criterios $criterios
     * @return LabelsCriterio
     */
    public function addCriterio(\Xtending\EntityBundle\Entity\Criterios $criterios = null)
    {
    	$this->criterio = $criterios;
    
    	return $this;
    }
    /**
     * Get criteriosId
     *
     * @return \Xtending\EntityBundle\Entity\Criterios 
     */
    public function getCriterio()
    {
        return $this->criterio;
    }
    
    /**
     * Set convertible
     *
     * @param integer $valor
     * @return LabelsCriterio
     */
    public function setConvertible($valor)
    {
    	$this->convertible = $valor;
    
    	return $this;
    }
    
    /**
     * Get convertible
     *
     * @return integer
     */
    public function getConvertible()
    {
    	return $this->convertible;
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
