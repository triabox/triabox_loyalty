<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AccionCorrectiva
 * @ORM\Table(name="accion_correctiva")
 * @ORM\Entity
 */
class AccionCorrectiva
{
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var date
     * 
     *   @ORM\Column(name="fechaInicio", type="date",  nullable=true)
     */
    private $fechaInicio;

    /**
     * @var string
     * 
     *   @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;
    
    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosResultados
     */
    private $formularioResultado;
    
    /**
     * @var ArrayCollection
     */
    private $descripcionesVerificaciones;
    
    /**
     * @var ArrayCollection
     */
    private $causasPropuestas;
    
    /**
     * @var ArrayCollection
     */
    private $accionesEjecuciones;
    
    /**
     * @var ArrayCollection
     */
    private $verificacionesEfectivas;
    
    /**
     * @var integer
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
    
    public function __construct()
    {
    	$this->descripcionesVerificaciones = new ArrayCollection();
    	$this->causasPropuestas = new ArrayCollection();
    	$this->accionesEjecuciones = new ArrayCollection();
    	$this->verificacionesEfectivas = new ArrayCollection();
    	 
    }
    
    /**
     * Get $
     *
     * @return array
     */
    public function getDescripcionesVerificaciones()
    {
    	return $this->descripcionesVerificaciones;
    }
    
    /**
     * Add $descripcionesVerificaciones
     *
     */
    public function addDescripcionesVerificacion( $descripcionesVerificaciones)
    {
    	$descripcionesVerificaciones->addAccionesCorrectiva($this);
    
    	$this->descripcionesVerificaciones->add($descripcionesVerificaciones);
    }
    
 
    
    
    /**
     * Remove $descripcionesVerificaciones
     *
     */
    public function removeDescripcionesVerificacion($descripcionesVerificaciones)
    {
    	$this->descripcionesVerificaciones->removeElement($descripcionesVerificaciones);
    }
    
    
    /**
     * Get $causasPropuestas
     *
     * @return array
     */
    public function getCausasPropuestas()
    {
    	return $this->causasPropuestas;
    }
    
    /**
     * Add $causasPropuestas
     *
     */
    public function addCausasPropuesta( $causasPropuestas)
    {
    	$causasPropuestas->addAccionesCorrectiva($this);
    
    	$this->causasPropuestas->add($causasPropuestas);
    }
    
    
    
    
    /**
     * Remove $causasPropuestas
     *
     */
    public function removeCausasPropuesta($causasPropuestas)
    {
    	$this->causasPropuestas->removeElement($causasPropuestas);
    }
    
    
    /**
     * Get $accionesEjecuciones
     *
     * @return array
     */
    public function getAccionesEjecuciones()
    {
    	return $this->accionesEjecuciones;
    }
    
    /**
     * Add $accionesEjecuciones
     *
     */
    public function addAccionesEjecucione( $accionesEjecuciones)
    {
    	$accionesEjecuciones->addAccionesCorrectiva($this);
    
    	$this->accionesEjecuciones->add($accionesEjecuciones);
    }
    
    
    
    /**
     * Remove $accionesEjecuciones
     *
     */
    public function removeAccionesEjecucione($accionesEjecuciones)
    {
    	$this->accionesEjecuciones->removeElement($accionesEjecuciones);
    }
    
    /**
     * Get $verificaciones
     *
     * @return array
     */
    public function getVerificacionesEfectivas()
    {
    	return $this->verificacionesEfectivas;
    }
    
    /**
     * Add $verificacion
     *
     */
    public function addVerificacionesEfectiva($verificacion)
    {
    	$verificacion->addAccionCorrectiva($this);
    
    	$this->verificacionesEfectivas->add($verificacion);
    }
    
    
    
    /**
     * Remove $verificacion
     *
     */
    public function removeVerificacionesEfectiva($verificacion)
    {
    	$this->verificacionesEfectivas->removeElement($verificacion);
    }

  
    
    /**
     * Add FormulacioDefinicion
     *
     * @return Labels
     */
    public function addFormularioResultado(\Xtending\EntityBundle\Entity\FormulariosResultados $formularioResultado)
    {
    	$this->formularioResultado = $formularioResultado;
    
    	return $this;
    }
    
    
    /**
     * Get formularioResultado
     *
     * @return FormulariosResultados
     */
    public function getFormularioResultado()
    {
    	return $this->formularioResultado;
    }

   

    /**
     * Set formularioResultado
     *
     * @param integer $formularioResultado
     * @return AccionCorrectiva
     */
    public function setFormularioResultado($formularioResultado)
    {
        $this->formularioResultado = $formularioResultado;
    
        return $this;
    }


    /**
     * Set fechaInicio
     *
     * @param date $fechaInicio
     * @return AccionCorrectiva
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return date 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return AccionCorrectiva
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
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
    	return $this->estado;
    }
    
    /**
     * Set estado
     * @return AccionCorrectiva
     */
    
    public function setEstado($estado)
    {
    	$this->estado = $estado;
    	 
    	return $this;
    }
    
    /**
     * Verifica el estado general de la AccionCorrectiva
     * @return integer
     */
    public function verificarEstado()
    {
    	$aprobado = 1;
    	foreach ($this->getVerificacionesEfectivas() as $verificacion)
    	{
    		if ($verificacion->getEstado() != 4)
    		{
    			$aprobado = 0;
    		}
    	}
    	return $aprobado;
    }
    
    /**
     * Verifica el estado del pac con respecto al supervisor
     * @return number
     */
    public function verificarEstadoSupervisor()
    {
    	$apr = 1;
    	foreach ($this->getVerificacionesEfectivas() as $verificacion)
    	{
    		if ($verificacion->getEstado() == 2)
    		{
    			$apr = 0;
    		}
    	}
    	return $apr;
    }
    
    /**
     * verifica el estado del pac con respecto al auditor
     * @return number
     */
    public function verificarEstadoAuditor($id)
    {
    	$apr = 1;
    	if ($id == $this->formularioResultado->getContacto()->getId())
    	{
    		foreach ($this->getVerificacionesEfectivas() as $verificacion)
	    	{
	    		if ($verificacion->getEstado() == 3)
	    		{
	    			$apr = 0;
	    		}
	    	}
    	} 
    	return $apr;
    }
    
    /**
     * Verifica si se puede editar el pac
     * @param array $responsables
     * @param array $contactos
     * @param array $user
     * @return boolean
     */
    public function verificarEstadoUsuarios($contactos,$responsables,Contactos $user)
    {
    	$bool = false;
    	if (in_array($user,$contactos->toArray()) && $this->estado != 0)
    	{//Usuario local
    		$bool = true;
    	}
    	elseif ( in_array($user, $responsables->toArray()) && $this->verificarEstadoSupervisor() == 0)
    	{//Supervisor
    		$bool = true;
    	}
    	elseif ($this->verificarEstadoAuditor($user->getId()) == 0)
    	{//Auditor
    		$bool = true;
    	}
    	return $bool;
    }
}
