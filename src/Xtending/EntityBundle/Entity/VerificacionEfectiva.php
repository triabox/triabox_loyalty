<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VerificacionEfectiva
 */
class VerificacionEfectiva
{
    /**
     * @var integer
     */
    private $id;


    /**
     * @var string
     */
    private $supervisor;

    /**
     * @var string
     */
    private $auditor;

    /**
     * @var date
     */
    private $fecha;

    /**
     * @var Contactos
     */
    private $autor;
    
    /**
     * @var integer
     */
    private $estadoAuditor;

    /**
     * @var integer
     */
    private $estadoSupervisor;
    
    /**
     * @var integer
     */
    private $estado;
    
    /**
     * @var \Xtending\EntityBundle\Entity\AccionCorrectiva
     */
    private $accionCorrectiva;

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
     * Set supervisor
     *
     * @param string $supervisor
     * @return VerificacionEfectiva
     */
    public function setSupervisor($supervisor)
    {
        $this->supervisor = $supervisor;
    
        return $this;
    }

    /**
     * Get supervisor
     *
     * @return string 
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Set auditor
     *
     * @param string $auditor
     * @return VerificacionEfectiva
     */
    public function setAuditor($auditor)
    {
        $this->auditor = $auditor;
    
        return $this;
    }

    /**
     * Get auditor
     *
     * @return string 
     */
    public function getAuditor()
    {
        return $this->auditor;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     * @return VerificacionEfectiva
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set autor
     *
     * @param $autor
     * @return VerificacionEfectiva
     */
    public function setAutor(Contactos $autor)
    {
        $this->autor = $autor;
    
        return $this;
    }

    /**
     * Get autor
     *
     * @return Contactos 
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Get accionesCorrectivas
     *
     * @return array
     */
    public function getAccionesCorrectivas()
    {
    	return $this->accionCorrectiva;
    }
    
    /**
     * Add accionCorrectiva
     *
     */
    public function addAccionCorrectiva( $accionCorrectiva)
    {
    	
    
    	$this->accionCorrectiva = $accionCorrectiva;
    	
    	return $this;
    }
    
    /**
     * set accionCorrectiva
     *
     */
    public function setAccionCorrectiva( $accionCorrectiva)
    {
    	$this->accionCorrectiva = $accionCorrectiva;
    	return $this;
    }
    
    
    /**
     * Remove accionCorrectivas
     *
     */
    public function removeAccionesCorrectiva($accionCorrectiva)
    {
    	$this->accionCorrectiva->removeElement($accionCorrectiva);
    }
    
    /**
     * @param integer $estado
     * @return \Xtending\EntityBundle\Entity\VerificacionEfectiva
     */
    public function setEstadoSupervisor($estado)
    {
    	$this->estadoSupervisor = $estado;
    	return $this;
    }
    
    /**
     * @return integer
     */
    public function getEstadoSupervisor()
    {
    	return $this->estadoSupervisor;
    }
    
    /**
     * @return integer
     */
    public function getEstadoNombre()
    {
    	
    	if($this->estadoSupervisor == 2){
    		return 'rechazado';
    	}
    	if($this->estadoSupervisor == 1){
    		return 'aprobado';
    	}else{
    		return 'pendiente.aprobacion';
    	}
    	
    }
    
    public function getEstadoNombreAuditor()
    {
    	 
    	if($this->estadoAuditor == 2){
    		return 'rechazado';
    	}
    	if($this->estadoAuditor == 1){
    		return 'aprobado';
    	}else{
    		return 'pendiente.aprobacion';
    	}
    	 
    }
    
    public function getEstadoString()
    {
    
    	if($this->estado == 4){
    		return 'aprobado';
    	}else{
    		if($this->estadoAuditor == 2 || $this->estadoSupervisor == 2)
    		{
    			return 'rechazado';
    		} else {
    			return 'pendiente.aprobacion';
    		}
    		
    	}
    
    }
    /**
     * @param integer $estado
     * @return \Xtending\EntityBundle\Entity\VerificacionEfectiva
     */
    public function setEstadoAuditor($estado)
    {
    	$this->estadoAuditor = $estado;
    	return $this;
    }
    
    /**
     * @return integer
     */
    public function getEstadoAuditor()
    {
    	return $this->estadoAuditor;
    }
    
    /**
     * @param integer $estado
     * @return \Xtending\EntityBundle\Entity\VerificacionEfectiva
     */
    public function setEstado($estado)
    {
    	$this->estado = $estado;
    	return $this;
    }
    
    /**
     * @return integer
     */
    public function getEstado()
    {
    	return $this->estado;
    }
    
}
