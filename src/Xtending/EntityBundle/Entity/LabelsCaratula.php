<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Labels Caratulas
 */
class LabelsCaratula
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
    private $obligatorio;

    /**
     * @var integer
     */
    private $orden;
    
    /**
     * @var \Xtending\EntityBundle\Entity\EntidadesFormulariosDefiniciones
     */
    private $formulariosDefiniciones;
    
    /**
     * @var integer
     */
    private $tipoLabel;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Criterios
     */
    private $tipoSelect;
    
    /**
     * @var \Xtending\EntityBundle\Entity\CriterioDefinicion
     */
    private  $criterioDefinicion;
     
    
    /**
     * Add CriterioDefinicion
     *
     * @return Labels
     */
    public function addCriterioDefinicion(\Xtending\EntityBundle\Entity\CriterioDefinicion $criterioDefinicion)
    {
    	$this->criterioDefinicion = $criterioDefinicion;
    
    	return $this;
    }
    
    
    
    /**
     * Get criterioDefinicion
     *
     * @return CriterioDefinicion
     */
    public function getCriterioDefinicion()
    {
    	return $this->criterioDefinicion;
    }
    
	/**
     * Add FormulacioDefinicion
     *
     * @return Labels 
     */
	public function addFormulariosDefiniciones(\Xtending\EntityBundle\Entity\FormulariosDefiniciones $formulariosDefiniciones)
    {
		$this->formulariosDefiniciones = $formulariosDefiniciones;

		return $this;
    }
    
    
    
  	/**
     * Get formulariosDefiniciones
     *
     * @return FormulariosDefiniciones
     */
    public function getFormulariosDefiniciones()
    {
        return $this->formulariosDefiniciones;
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
     * @return Labels
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
     * Set tipoLabel
     *
     * @param integer $tipoLabel
     * @return Labels
     */
    public function setTipoLabel($tipoLabel)
    {
    	$this->tipoLabel = $tipoLabel;
    
    	return $this;
    }
    
    /**
     * Get tipoLabel
     *
     * @return integer
     */
    public function getTipoLabel()
    {
    	return $this->tipoLabel;
    }
    
    /**
     * Get tipoSelect
     *
     * @return tipoSelect
     */
    public function getTipoSelect()
    {
    	return $this->tipoSelect;
    }
    
    /**
     * Set tipoSelect
     *
     * @return pregunta
     */
    public function setTipoSelect(\Xtending\EntityBundle\Entity\Criterios $tipoSelect = null)
    {
    	$this->tipoSelect = $tipoSelect;
    
    	return $this;
    }
    

    /**
     * Set obligatorio
     *
     * @param integer $obligatorio
     * @return Labels
     */
    public function setObligatorio($obligatorio)
    {
        $this->obligatorio = $obligatorio;
    
        return $this;
    }

    /**
     * Get obligatorio
     *
     * @return integer 
     */
    public function getObligatorio()
    {
        return $this->obligatorio;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return Labels
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
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