<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsignacionIndividual
 */
class AsignacionIndividual
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $entidad;

  
    /**
     * @var \Xtending\EntityBundle\Entity\EntidadFormularios
     */
    private $asignacion;
    
    /**
     * Externa
     * @var integer
     */
    private $externo;
    
    /**
     * @var integer
     */
    private $compartido;
    
    /**
     * Interna
     * @var integer
     */
    private $interno;
    
    /**
     * @var integer
     */
    private $habilitado;
    
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
     * Set entidad
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $entidad
     * @return Formularios
     */
    public function setEntidad(\Xtending\EntityBundle\Entity\Entidades $entidad = null)
    {
        $this->entidad = $entidad;
    
        return $this;
    }

    /**
     * Get entidad
     *
     * @return \Xtending\EntityBundle\Entity\Entidades 
     */
    public function getEntidad()
    {
        return $this->entidad;
    }

  

    /**
     * Set asignacion
     *
     * @param \Xtending\EntityBundle\Entity\EntidadFormularios $asignacion
     * @return Formularios
     */
    public function setAsignacion(\Xtending\EntityBundle\Entity\EntidadFormularios $asignacion = null)
    {
        $this->asignacion = $asignacion;
    
        return $this;
    }

    /**
     * Get asignacion
     *
     * @return \Xtending\EntityBundle\Entity\EntidadFormularios
     */
    public function getAsignacion()
    {
        return $this->asignacion;
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
    
    /**
     * Set externo
     *
     * @param integer $externo
     * @return AsignacionIndividual
     */
    public function setExterno($externo)
    {
    	$this->externo = $externo;
    
    	return $this;
    }
    
    /**
     * Get externo
     *
     * @return integer
     */
    public function getExterno()
    {
    	return $this->externo;
    }
    
    /**
     * Set interno
     *
     * @param integer $interno
     * @return AsignacionIndividual
     */
    public function setInterno($interno)
    {
    	$this->interno = $interno;
    
    	return $this;
    }
    
    /**
     * Get interno
     *
     * @return integer
     */
    public function getInterno()
    {
    	return $this->interno;
    }
    
    /**
     * Set compartido
     *
     * @param integer $compartido
     * @return AsignacionIndividual
     */
    public function setCompartido($compartido)
    {
    	$this->compartido = $compartido;
    
    	return $this;
    }
    
    /**
     * Get compartido
     *
     * @return integer
     */
    public function getCompartido()
    {
    	return $this->compartido;
    }
    
    /**
     * Set habilitado
     *
     * @param integer $valor
     * @return AsignacionIndividual
     */
    public function setHabilitado($valor)
    {
    	$this->habilitado = $valor;
    
    	return $this;
    }
    
    /**
     * Get habilitado
     *
     * @return integer
     */
    public function getHabilitado()
    {
    	return $this->habilitado;
    }

}
