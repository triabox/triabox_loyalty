<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Preguntas
 */
class Preguntas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $punto;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \Xtending\EntityBundle\Entity\Criterios
     */
  	private $criterio;
    
     /**
     * @var integer
     */
    private $tieneTextarea;
    
    /**
     * @var integer
     */
    private $tieneText;
    
    /**
     * @var integer
     */
    private $tieneFecha;
    
    /**
     * @var integer
     */
    private $tieneArchivo;
    
    /**
     * @var string
     */
    private $tieneAyuda;
    
    /**
     * @var string
     */
    private $tieneUnidad;
   
    
    /**
     * @var integer
     */
    private $destacado;
    
    /**
     * @var integer
     */
    private $resumen;
    
     /**
     * @var integer
     */
    private $tieneAccionCorrectiva;
    
	/**
     * @var \Xtending\EntityBundle\Entity\GrupoPregunta
     */
    private $grupoPregunta;

      
    
        
    
   
    
	/**
     * Add grupoPregunta
     *
     * @return Preguntas 
     */
	public function addGrupoPregunta(\Xtending\EntityBundle\Entity\GrupoPregunta $grupoPregunta)
    {
		$this->grupoPregunta = $grupoPregunta;

		return $this;
    }
    
    
    
  	/**
     * Get grupoPreguntaId
     *
     * @return GrupoPregunta 
     */
    public function getGrupoPregunta()
    {
        return $this->grupoPregunta;
    }
    
	/**
     * Set grupoPreguntaId
     *
     * @return GrupoPregunta 
     */
    public function setGrupoPregunta(\Xtending\EntityBundle\Entity\GrupoPregunta $grupoPregunta)
    {
		$this->grupoPregunta = $grupoPregunta;

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
     * Set tieneTextarea
     *
     * @param integer $tieneTextarea
     * @return Preguntas
     */
    public function setTieneTextarea($tieneTextarea)
    {
        $this->tieneTextarea = $tieneTextarea;
    
        return $this;
    }
	
    /**
     * Set destacado
     *
     * @param integer $destacado
     * @return Preguntas
     */
    public function setDestacado($destacado)
    {
    	$this->destacado = $destacado;
    
    	return $this;
    }
    
    /**
     * Get destacado
     *
     * @return integer
     */
    public function getDestacado()
    {
    	return $this->destacado;
    }
    
    /**
     * Set resumen
     *
     * @param integer $resumen
     * @return Preguntas
     */
    public function setResumen($valor)
    {
    	$this->resumen = $valor;
    
    	return $this;
    }
    
    /**
     * Get resumen
     *
     * @return integer
     */
    public function getResumen()
    {
    	return $this->resumen;
    }
    
    /**
     * Get tieneTextarea
     *
     * @return string
     */
    public function getTieneTextarea()
    {
        return $this->tieneTextarea;
    }
    
    
    /**
     * Get tieneText
     *
     * @return integer
     */
    public function getTieneText()
    {
    	return $this->tieneText;
    }
    
    /**
     * Set tieneText
     *
     * @param integer $valor
     * @return Preguntas
     */
    public function setTieneText($valor)
    {
    	$this->tieneText = $valor;
    
    	return $this;
    }
    
    /**
     * Get tieneAyuda
     *
     * @return string
     */
    public function getTieneAyuda()
    {
    	return $this->tieneAyuda;
    }
    
    /**
     * Get tieneUnidad
     *
     * @return string
     */
    public function getTieneUnidad()
    {
    	return $this->tieneUnidad;
    }
   
    
    /**
     * Get criterio
     *
     * @return criterio
     */
    public function getCriterio()
    {
    	return $this->criterio;
    }
    
    /**
     * Set criterio
     *
     * @return pregunta
     */
    public function setCriterio(\Xtending\EntityBundle\Entity\Criterios $criterio)
    {
    	$this->criterio = $criterio;
    
    	return $this;
    }
    
    
	
    
    /**
     * Set tieneAyuda
     *
     * @param string tieneAyuda
     * @return Preguntas
     */
    public function setTieneAyuda($tieneAyuda)
    {
    	$this->tieneAyuda = $tieneAyuda;
    
    	return $this;
    }

    /**
     * Set tieneUnidad
     *
     * @param string unidad
     * @return Preguntas
     */
    public function setTieneUnidad($unidad)
    {
    	$this->tieneUnidad = $unidad;
    
    	return $this;
    }
        
	/**
     * Set tieneAccionCorrectiva
     *
     * @param integer tieneAccionCorrectiva
     * @return Preguntas
     */
    public function setTieneAccionCorrectiva($tieneAccionCorrectiva)
    {
        $this->tieneAccionCorrectiva = $tieneAccionCorrectiva;
    
        return $this;
    }

    /**
     * Get tieneAccionCorrectiva
     *
     * @return integer 
     */
    public function getTieneAccionCorrectiva()
    {
        return $this->tieneAccionCorrectiva;
    }
    
    
    

    /**
     * Set punto
     *
     * @param string $punto
     * @return Preguntas
     */
    public function setPunto($punto)
    {
        $this->punto = $punto;
    
        return $this;
    }

    /**
     * Get punto
     *
     * @return string 
     */
    public function getPunto()
    {
        return $this->punto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Preguntas
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    /**
     * Set tieneFecha
     *
     * @param integer $tieneFecha
     * @return Preguntas
     */
    public function setTieneFecha($tieneFecha)
    {
    	$this->tieneFecha = $tieneFecha;
    
    	return $this;
    }
    
    /**
     * Get tieneFecha
     *
     * @return integer
     */
    public function getTieneFecha()
    {
    	return $this->tieneFecha;
    }

    /**
     * Set tieneArchivo
     *
     * @param integer $tieneArchivo
     * @return Preguntas
     */
    public function setTieneArchivo($tieneArchivo)
    {
    	$this->tieneArchivo = $tieneArchivo;
    
    	return $this;
    }
    
    /**
     * Get tieneArchivo
     *
     * @return integer
     */
    public function getTieneArchivo()
    {
    	return $this->tieneArchivo;
    }

}