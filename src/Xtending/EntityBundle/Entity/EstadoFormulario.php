<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Labels Caratulas
 */
class EstadoFormulario
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
    private $orden;
    
    /**
     * @var integer
     */
    private $creaVersion;
    
    /**
     * @var \Xtending\EntityBundle\Entity\EntidadesFormulariosDefiniciones
     */
    private $formulariosDefiniciones;
     
    
    
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
     * Set creaVersion
     *
     * @param integer $creaVersion
     * @return EstadoFormulario
     */
    public function setCreaVersion($creaVersion)
    {
    	$this->creaVersion = $creaVersion;
    
    	return $this;
    }
    
    /**
     * Get creaVersion
     *
     * @return integer
     */
    public function getCreaVersion()
    {
    	return $this->creaVersion;
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