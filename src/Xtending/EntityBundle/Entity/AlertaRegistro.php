<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * AlertaRegistro
 */
class AlertaRegistro
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $estado;
    
    /**
     * @var string
     */
    private $ultimaRepeticion;

    
    /**
     * @var integer
     */
    private $repeticiones;
    
    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosResultados
    */
    private $registro;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Alerta
     */
    private $alerta;

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
     * Set estado
     *
     * @param integer $estado
     * @return Alerta
     */
    public function setEstado ($estado = 1)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ultimaRepeticion
     *
     * @param string $ultimaRepeticion
     * @return Alerta
     */
    public function setUltimaRepeticion ($ultimaRepeticion = null)
    {
    	$this->ultimaRepeticion = $ultimaRepeticion;
    
    	return $this;
    }
    
    /**
     * Get ultimaRepeticion
     *
     * @return string
     */
    public function getUltimaRepeticion()
    {
    	return $this->ultimaRepeticion;
    }
    
    /**
     * Set registro
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosResultados
     * @return Alerta
     */
    public function setRegistro( $registro)
    {
        $this->registro = $registro;
    
        return $this;
    }

    /**
     * Get registro
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosResultados 
     */
    public function getRegistro()
    {
        return $this->registro;
    }
    
    /**
     * Set alerta
     *
     * @param \Xtending\EntityBundle\Entity\Alerta
     * @return Alerta
     */
    public function setAlerta( $alerta)
    {
    	$this->alerta = $alerta;
    
    	return $this;
    }
    
    /**
     * Get alerta
     *
     * @return \Xtending\EntityBundle\Entity\Alerta
     */
    public function getAlerta()
    {
    	return $this->alerta;
    }
    
    
    /**
     * Set repeticiones
     *
     * @param integer $repeticiones
     * @return Alerta
     */
    public function setRepeticiones ($repeticiones = null)
    {
    	$this->repeticiones = $repeticiones;
    
    	return $this;
    }
    
    /**
     * Get repeticiones
     *
     * @return integer
     */
    public function getRepeticiones()
    {
    	return $this->repeticiones;
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
