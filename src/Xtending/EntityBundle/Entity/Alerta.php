<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * Alerta
 */
class Alerta
{
    /**
     * @var integers
     */
    private $id;

    /**
     * @var string
     */
    private $remitente;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string     
     */
    private $contenido;

    /**
     * @var string
     */
    private $destinatario;
    
    /**
     * @var integer
     */
    private $tipoDestinatario;
    
    /**
     * @var integer
     */
    private $tipoRepeticion;
    
    /**
     * @var integer
     */
    private $tipoBase;
    
    /**
     * @var string
     */
    private $repeticionDato;
    
    /**
     * @var integer
     */
    private $tipoFin;
    
    /**
     * @var string
     */
    private $finDato;
    
    /**
     * @var integer
     */
    private $counter;

    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosDefiniciones
    */
    private $formularioDefinicion;

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
     * Set remitente
     *
     * @param string $remitente
     * @return Alerta
     */
    public function setRemitente ($remitente = null)
    {
        $this->remitente = $remitente;
    
        return $this;
    }

    /**
     * Get remitente
     *
     * @return string 
     */
    public function getRemitente()
    {
        return $this->remitente;
    }

    
    /**
     * Set formularioDefinicion
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     * @return Alerta
     */
    public function setFormularioDefinicion( $formulario)
    {
        $this->formularioDefinicion = $formulario;
    
        return $this;
    }

    /**
     * Get formularioDefinicion
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosDefiniciones 
     */
    public function getFormularioDefinicion()
    {
        return $this->formularioDefinicion;
    }
    
    /**
     * Set asunto
     *
     * @param string $asunto
     * @return Alerta
     */
    public function setAsunto ($asunto = null)
    {
    	$this->asunto = $asunto;
    
    	return $this;
    }
    
    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
    	return $this->asunto;
    }
    
    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Alerta
     */
    public function setContenido ($contenido = null)
    {
    	$this->contenido = $contenido;
    
    	return $this;
    }
    
    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
    	return $this->contenido;
    }
    
    /**
     * Set destinatario
     *
     * @param string $destinatario
     * @return Alerta
     */
    public function setDestinatario ($destinatario = null)
    {
    	$this->destinatario = $destinatario;
    
    	return $this;
    }
    
    /**
     * Get destinatario
     *
     * @return string
     */
    public function getDestinatario()
    {
    	return $this->destinatario;
    }
    
    /**
     * Set tipoDestinatario
     *
     * @param integer $tipoDestinatario
     * @return Alerta
     */
    public function setTipoDestinatario ($tipoDestinatario = null)
    {
    	$this->tipoDestinatario = $tipoDestinatario;
    
    	return $this;
    }
    
    /**
     * Get tipoDestinatario
     *
     * @return integer
     */
    public function getTipoDestinatario()
    {
    	return $this->tipoDestinatario;
    }
    
    /**
     * Set tipoRepeticion
     *
     * @param integer $tipoRepeticion
     * @return Alerta
     */
    public function setTipoRepeticion ($tipo = null)
    {
    	$this->tipoRepeticion = $tipo;
    
    	return $this;
    }
    
    /**
     * Get tipoRepeticion
     *
     * @return integer
     */
    public function getTipoRepeticion()
    {
    	return $this->tipoRepeticion;
    }
    
    /**
     * Set tipoBase
     *
     * @param integer $tipoBase
     * @return Alerta
     */
    public function setTipoBase ($tipoBase = null)
    {
    	$this->tipoBase = $tipoBase;
    
    	return $this;
    }
    
    /**
     * Get tipoBase
     *
     * @return integer
     */
    public function getTipoBase()
    {
    	return $this->tipoBase;
    }
    
    /**
     * Set baseDato
     *
     * @param string $baseDato
     * @return Alerta
     */
    public function setBaseDato ($baseDato = null)
    {
    	$this->baseDato = $baseDato;
    
    	return $this;
    }
    
    /**
     * Get baseDato
     *
     * @return string
     */
    public function getBaseDato()
    {
    	return $this->baseDato;
    }
    
    /**
     * Set repeticionDato
     *
     * @param string $repeticionDato
     * @return Alerta
     */
    public function setRepeticionDato ($repeticionDato = null)
    {
    	$this->repeticionDato = $repeticionDato;
    
    	return $this;
    }
    
    /**
     * Get repeticionDato
     *
     * @return string
     */
    public function getRepeticionDato()
    {
    	return $this->repeticionDato;
    }
    
    /**
     * Set tipoFin
     *
     * @param integer $tipoFin
     * @return Alerta
     */
    public function setTipoFin ($tipoFin = null)
    {
    	$this->tipoFin = $tipoFin;
    
    	return $this;
    }
    
    /**
     * Get tipoFin
     *
     * @return integer
     */
    public function getTipoFin()
    {
    	return $this->tipoFin;
    }
    
    /**
     * Set finDato
     *
     * @param string $finDato
     * @return Alerta
     */
    public function setFinDato ($finDato = null)
    {
    	$this->finDato = $finDato;
    
    	return $this;
    }
    
    /**
     * Get finDato
     *
     * @return string
     */
    public function getFinDato()
    {
    	return $this->finDato;
    }
    
    /**
     * Set counter
     *
     * @param integer $counter
     * @return Alerta
     */
    public function setCounter ($counter = null)
    {
    	$this->counter = $counter;
    
    	return $this;
    }
    
    /**
     * Get counter
     *
     * @return integer
     */
    public function getCounter()
    {
    	return $this->counter;
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
