<?php

namespace Xtending\EntityBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Planificacion
 */
class Planificacion
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
     * @var \DateTime
     */
    private $fechaDesde;
    
    /**
     * @var \DateTime
     */
    private $fechaHasta;
    
    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     */
    private $proceso;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Contactos
     */
    private $autor;
    
    /**
     * @var integer
     */
    private $estado;
    
    /**
     * @var array
     */
    private $registros;
    
    public function __construct()
    {
    	$this->registros = new ArrayCollection();
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
     * Set fechaDesde
     *
     * @param \DateTime $fecha
     * @return Planificacion
     */
    public function setFechaDesde($fecha)
    {
        $this->fechaDesde = $fecha;
    
        return $this;
    }

    /**
     * Get fechaDesde
     *
     * @return \DateTime 
     */
    public function getFechaDesde()
    {
        return $this->fechaDesde;
    }
    
    /**
     * Set fechaHasta
     *
     * @param \DateTime $fecha
     * @return Planificacion
     */
    public function setFechaHasta($fecha)
    {
    	$this->fechaHasta = $fecha;
    
    	return $this;
    }
    
    /**
     * Get fechaHasta
     *
     * @return \DateTime
     */
    public function getFechaHasta()
    {
    	return $this->fechaHasta;
    }
    
    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fecha
     * @return Planificacion
     */
    public function setFechaCreacion($fecha)
    {
    	$this->fechaCreacion = $fecha;
    
    	return $this;
    }
    
    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
    	return $this->fechaCreacion;
    }

    /**
     * Set proceso
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     * @return Planificacion
     */
    public function setProceso($formulariosDefiniciones)
    {
        $this->proceso = $formulariosDefiniciones;
    
        return $this;
    }

    /**
     * Get proceso
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosDefiniciones 
     */
    public function getProceso()
    {
        return $this->proceso;
    }
    
    /**
     * Set estado
     * @return Planificacion
     */
    
    public function setEstado($estado)
    {
    	$this->estado = $estado;
    	 
    	return $this;
    }
    
    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
    	return $this->estado;
    }
    
    /**
     * Get Registros
     *
     * @return array
     */
    public function getRegistros()
    {
    	return $this->registros;
    }
    
    /**
     * Add Registros
     *
     */
    public function addRegistros( $registro)
    {
    	$this->registros->add($registro);
    }
    
    
    /**
     * Remove Registros
     *
     */
    public function removeRegistros($registro)
    {
    	$this->registros->removeElement($registro);
    }
    
    /**
     * Set autor
     *
     * @param \Xtending\EntityBundle\Entity\Contactos $contacto
     * @return Planificacion
     */
    public function setAutor($contacto)
    {
    	$this->autor = $contacto;
    
    	return $this;
    }
    
    /**
     * Get autor
     *
     * @return \Xtending\EntityBundle\Entity\Contactos
     */
    public function getAutor()
    {
    	return $this->autor;
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
