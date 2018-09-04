<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoPregunta
 */
class GrupoPregunta
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
     * @var array
     */
    private $preguntas;
    
     /**
     * @var \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     */
    private $formulariosDefiniciones;
    

	public function __construct()
    {
        
        $this->preguntas = new ArrayCollection();
    }
    

    
	/**
     * Add FormulacioDefinicion
     *
     * @return GrupoPregunta 
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
     * Get Preguntas
     *
     * @return array
     */
    public function getPreguntas()
    {
    	return $this->preguntas;
    }
    
    
	/**
     * Get PreguntasResumen
     *
     * @return array 
     */
    public function getPreguntasResumen()
    {
        return $this->evaluarPreguntas(1);
    }
    
    /**
     * Get PreguntasCapitulos 
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPreguntasCapitulo()
    {
    	return $this->evaluarPreguntas(0);
    }
    
    private function evaluarPreguntas($val)
    {
    	$coleccion = new ArrayCollection();
    	foreach ($this->preguntas as $pregunta)
    	{
    		if ($pregunta->getResumen() == $val)
    		{
    			$coleccion->add($pregunta);
    		}
    	}
    	return $coleccion;
    }
    
	/**
     * Add Pregunta
     *
     */
	public function addPregunta($pregunta)
    {
    	$pregunta->addGrupoPregunta($this);
    	
        $this->preguntas->add($pregunta);
    }
    

	/**
     * Remove Pregunta
     *
     */
	public function removePregunta($pregunta)
    {
    	$this->preguntas->removeElement($pregunta);
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
     * Set id
     *
     * @param integer $id
     * @return GrupoPregunta
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tipolabels
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
