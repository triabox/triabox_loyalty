<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * Labels Caratulas
 */
class EstadoFormularioValor
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var Contactos
     */
    private $contacto;
    
    /**
     * @var String
     */
    private $tipoParticipante;

    /**
     * @var EstadoFormulario
     */
    private $estadoFormulario;
    
    /**
     * @var FormulariosResultados
     */
    private $formularioResultado;
    
    /**
     * @var boolean
     */
    private $estado;
     


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
     * Get Contacto
     *
     * @return array
     */
    public function getTipoParticipante()
    {
    	return $this->tipoParticipante;
    }
    
    /**
     * Set Contacto
     *
     */
    public function setTipoParticipante($tipoParticipante)
    {
    	$this->tipoParticipante = $tipoParticipante;
    
    	return $this;
    }
    
    /**
     * Get Contacto
     *
     * @return array
     */
    public function getContacto()
    {
    	return $this->contacto;
    }
    
    /**
     * Set Contacto
     *
     */
    public function setContacto($contacto)
    {
    	$this->contacto = $contacto;
    
    	return $this;
    }
     
    /**
     * Get EstadoFormulario
     *
     * @return array
     */
    public function getEstadoFormulario()
    {
    	return $this->estadoFormulario;
    }
    
    /**
     * Set EstadoFormulario
     *
     */
    public function setEstadoFormulario($estadoFormulario)
    {
    	$this->estadoFormulario = $estadoFormulario;
    
    	return $this;
    }
    
    /**
     * Get FormularioResultado
     *
     * @return array
     */
    public function getFormularioResultado()
    {
    	return $this->formularioResultado;
    }
    
    /**
     * Set FormularioResultado
     *
     */
    public function setFormularioResultado($formularioResultado)
    {
    	$this->formularioResultado = $formularioResultado;
    
    	return $this;
    }
    
    /**
     * Get Estado
     *
     * @return array
     */
    public function getEstado()
    {
    	return $this->estado;
    }
    
    /**
     * Set Estado
     *
     */
    public function setEstado($estado)
    {
    	$this->estado = $estado;
    
    	return $this;
    }
    
    /**
     * Add formularioResultado
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosResultados $formularioResultado
     * @return LabelCaratulaValor
     */
    public function addFormularioResultado(\Xtending\EntityBundle\Entity\FormulariosResultados $formularioResultado = null)
    {
    	$this->formularioResultado = $formularioResultado;
    
    	return $this;
    }

   
}