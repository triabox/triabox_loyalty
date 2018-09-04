<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormulariosDefiniciones
 */
class FormulariosDefiniciones
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
     * @var string
     */
    private $tienefechaautomatica;
    
    /**
     * @var string
     */
    private $tienefechacierre;

    /**
     * @var string
     */
    private $tienesite;
    
    /**
     * @var string
     */
    private $tieneProducto;
    
    /**
     * @var string
     */
    private $tieneempresa;
    
    /**
     * @var string
     */
    private $caratula;
    
    /**
     * @var string
     */
    private $tienecodigo;
    
    /**
     * @var string
     */
    private $tieneproveedor;

    /**
     * @var string
     */
    private $tienefechamanual;

 
    /**
     * @var string
     */
    private $tieneContacto;
    
    /**
     * @var string
     */
    private $tieneContactoEntidad;
    
    /**
     * @var string
     */
    private $tieneCapitulos;
    
    /**
     * @var integer
     */
    private $descripcionEstado;
    
    /**
     * @var string
     */
    private $tieneResumen;
    
    /**
     * @var string
     */
    private $botonNoevalua;

    
    /**
     * @var array
     */
    private $labelsCaratula;
    
    /**
     * @var array
     */
    private $estados;
    
    /**
     * @var ConfigCustom
     */
    private $config;
    
    
    /**
     * @var array
     */
    private $gruposPregunta;
    
    /**
     * @var boolean
     */
    private $activo;
    
    /**
     * @var FormularioConfiguracion
     */
    private $formularioConfiguracion;
    
    /**
     * @var CodigoDinamico
     */
    private $codigoDinamico;
    
    /**
     * @var integer
     */
    private $tieneHistorial;
    
    /**
     * @var TipoFormulario
     */
    private $tipoFormulario;
    
    /**
     * @var integer
     */
    private $tienePac;
    
    /**
     * @var integer
     */
    private $tieneCopia;
    
    /**
     * @var integer
     */
    private $agrupable;
    
    /**
     * @var integer
     */
    private $codigoManual;
    
    /**
     * @var integer
     */
    private $tienePdf;
    
    /**
     * Set FormularioConfiguracion
     *
     * @param FormularioConfiguracion $formularioConfiguracion
     * @return FormulariosDefiniciones
     */
    public function setFormularioConfiguracion(FormularioConfiguracion $formularioConfiguracion)
    {
    	$this->formularioConfiguracion = $formularioConfiguracion;
    
    	return $this;
    }
    
    /**
     * Get FormulariosDefiniciones
     *
     * @return FormulariosDefiniciones
     */
    public function getFormularioConfiguracion()
    {
    	return $this->formularioConfiguracion;
    }
    
    /**
     * Set CodigoDinamico
     *
     * @param CodigoFD $codigo
     * @return FormulariosDefiniciones
     */
    public function setCodigoDinamico(CodigoFD $codigo)
    {
    	$this->codigoDinamico = $codigo;
    
    	return $this;
    }
    
    /**
     * Get CodigoDinamico
     *
     * @return CodigoFD
     */
    public function getCodigoDinamico()
    {
    	return $this->codigoDinamico;
    }

	public function __construct()
    {
        $this->labelsCaratula = new ArrayCollection();
        $this->gruposPregunta = new ArrayCollection();
        $this->estados = new ArrayCollection();
    }
    
	/**
     * Get GrupoPregunta
     *
     * @return array 
     */
    public function getGruposPregunta()
    {
        return $this->gruposPregunta;
    }
    
	/**
     * Add Pregunta
     *
     */
	public function addGrupospregunton( $grupoPregunta)
    {
    	$grupoPregunta->addFormulariosDefiniciones($this);
    	
        $this->gruposPregunta->add($grupoPregunta);
    }
    

	/**
     * Remove Pregunta
     *
     */
	public function removeGrupospregunton($gruposPregunta)
    {
    	$this->gruposPregunta->removeElement($gruposPregunta);
    }
    
	/**
     * Get LabelsCaratula
     *
     * @return array 
     */
    public function getLabelsCaratula()
    {
        return $this->labelsCaratula;
    }
    
	/**
     * Add LabelsCaratula
     *
     * @return LabelsCaratula
     */
	public function addLabelsCaratulon($label)
    {
    	$label->addFormulariosDefiniciones($this);
    	
        $this->labelsCaratula->add($label);
    }

     /**
     * Remove 
     *
     */
    public function removeLabelsCaratulon($label)
    {
    	$this->labelsCaratula->removeElement($label);
    }

    /**
     * Get Estados
     *
     * @return array
     */
    public function getEstados()
    {
    	return $this->estados;
    }
    
    /**
     * Add Estados
     *
     * @return Estados
     */
    public function addEstado($estado)
    {
    	$estado->addFormulariosDefiniciones($this);
    	 
    	$this->estados->add($estado);
    }
    
    /**
     * Remove
     *
     */
    public function removeEstado($estado)
    {
    	$this->estados->removeElement($estado);
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
     * @return FormulariosDefiniciones
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
     * Set tienefechaautomatica
     *
     * @param string $tienefechaautomatica
     * @return FormulariosDefiniciones
     */
    public function setTienefechaautomatica($tienefecha)
    {
        $this->tienefechaautomatica = $tienefecha;
    
        return $this;
    }

    /**
     * Get tienefechaautomatica
     *
     * @return string 
     */
    public function getTienefechaautomatica()
    {
        return $this->tienefechaautomatica;
    }
    
    /**
     * Set tienefechacierre
     *
     * @param string $tienefechacierre
     * @return FormulariosDefiniciones
     */
    public function setTienefechacierre($tienefecha)
    {
    	$this->tienefechacierre = $tienefecha;
    
    	return $this;
    }
    
    /**
     * Get tienefechacierre
     *
     * @return string
     */
    public function getTienefechacierre()
    {
    	return $this->tienefechacierre;
    }
	
    /**
     * Get tieneProducto
     *
     * @return string
     */
    public function getTieneProducto()
    {
    	return $this->tieneProducto;
    }
    
    /**
     * Set tieneProducto
     *
     * @param string $tieneProducto
     * @return FormulariosDefiniciones
     */
    public function setTieneProducto($tieneProducto)
    {
    	$this->tieneProducto = $tieneProducto;
    
    	return $this;
    }

    /**
     * Set tienesite
     *
     * @param string $tienesite
     * @return FormulariosDefiniciones
     */
    public function setTienesite($tienesite)
    {
        $this->tienesite = $tienesite;
    
        return $this;
    }

    /**
     * Get tieneempresa
     *
     * @return string 
     */
    public function getTieneempresa()
    {
        return $this->tieneempresa;
    }
    
    /**
     * Set tieneempresa
     *
     * @param string $tieneempresa
     * @return FormulariosDefiniciones
     */
    public function setTieneempresa($tieneempresa)
    {
    	$this->tieneempresa = $tieneempresa;
    
    	return $this;
    }
    
    /**
     * Get tienesite
     *
     * @return string
     */
    public function getTienesite()
    {
    	return $this->tienesite;
    }
  
    /**
     * Set tienecodigo
     *
     * @param string $codigo
     * @return FormulariosDefiniciones
     */
    public function setTienecodigo($codigo)
    {
    	$this->tienecodigo = $codigo;
    
    	return $this;
    }
    
    /**
     * Get tienecodigo
     *
     * @return string
     */
    public function getTienecodigo()
    {
    	return $this->tienecodigo;
    }
    
    /**
     * Set tieneproveedor
     *
     * @param string $tieneproveedor
     * @return FormulariosDefiniciones
     */
    public function setTieneproveedor($tieneproveedor)
    {
    	$this->tieneproveedor = $tieneproveedor;
    
    	return $this;
    }
    
    /**
     * Get tieneproveedor
     *
     * @return string
     */
    public function getTieneproveedor()
    {
    	return $this->tieneproveedor;
    }

    /**
     * Set tienefechamanual
     *
     * @param string $tienefechamanual
     * @return FormulariosDefiniciones
     */
    public function setTienefechamanual($tienefechamanual)
    {
        $this->tienefechamanual = $tienefechamanual;
    
        return $this;
    }

    /**
     * Get tienefechamanual
     *
     * @return string 
     */
    public function getTienefechamanual()
    {
        return $this->tienefechamanual;
    }

	
	/**
     * Set tieneContacto
     *
     * @param string tieneContacto
     * @return FormulariosDefiniciones
     */
    public function setTieneContacto($tieneContacto)
    {
        $this->tieneContacto = $tieneContacto;
    
        return $this;
    }

    /**
     * Get tieneContacto
     *
     * @return string 
     */
    public function getTieneContacto()
    {
        return $this->tieneContacto;
    }
    
    /**
     * Set tieneContactoEntidad
     *
     * @param string tieneContacto
     * @return FormulariosDefiniciones
     */
    public function setTieneContactoEntidad($tieneContacto)
    {
    	$this->tieneContactoEntidad = $tieneContacto;
    
    	return $this;
    }
    
    /**
     * Get tieneContactoEntidad
     *
     * @return string
     */
    public function getTieneContactoEntidad()
    {
    	return $this->tieneContactoEntidad;
    }
    
  
    /**
     * Set tieneCapitulos
     *
     * @param string $capitulos
     * @return FormulariosDefiniciones
     */
    public function setTieneCapitulos($capitulos)
    {
    	$this->tieneCapitulos = $capitulos;
    
    	return $this;
    }
    
    /**
     * Get tieneCapitulos
     *
     * @return string
     */
    public function getTieneCapitulos()
    {
    	return $this->tieneCapitulos;
    }
    
    /**
     * Set descripcionEstado
     *
     * @param string $descripcionEstado
     * @return FormulariosDefiniciones
     */
    public function setDescripcionEstado($descripcionEstado)
    {
    	$this->descripcionEstado = $descripcionEstado;
    
    	return $this;
    }
    
    /**
     * Get descripcionEstado
     *
     * @return string
     */
    public function getDescripcionEstado()
    {
    	return $this->descripcionEstado;
    }
    
    /**
     * Set tieneResumen
     *
     * @param string $tieneResumen
     * @return FormulariosDefiniciones
     */
    public function setTieneResumen($tieneResumen)
    {
    	$this->tieneResumen = $tieneResumen;
    
    	return $this;
    }
    
    /**
     * Get botonNoevalua
     *
     * @return string
     */
    public function getBotonNoevalua()
    {
    	return $this->botonNoevalua;
    }
    
    /**
     * Set botonNoevalua
     *
     * @param string $botonNoevalua
     * @return FormulariosDefiniciones
     */
    public function setBotonNoevalua($botonNoevalua)
    {
    	$this->botonNoevalua = $botonNoevalua;
    
    	return $this;
    }
    
    /**
     * Get tieneResumen
     *
     * @return string
     */
    public function getTieneResumen()
    {
    	return $this->tieneResumen;
    }
    
    /**
     * Set caratula
     *
     * @param string $caratula
     * @return FormulariosDefiniciones
     */
    public function setCaratula($caratula)
    {
    	$this->caratula = $caratula;
    
    	return $this;
    }
    
    /**
     * Get caratula
     *
     * @return string
     */
    public function getCaratula()
    {
    	return $this->caratula;
    }
    
  	/**
     * Set activo
     *
     * @param boolean $activo
     * @return FormulariosDefiniciones
     */
    public function setActivo($activo)
    {
    	if ($this->activo == 1) {
        	$this->activo = 0;
        }else{
        	$this->activo = 1;
        }

    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }
    
    /**
     * Set tieneHistorial
     *
     * @param integer $valor
     * @return FormulariosDefiniciones
     */
    public function setTieneHistorial($valor)
    {
    	$this->tieneHistorial = $valor;
    
    	return $this;
    }
    
    /**
     * Get tieneHistorial
     *
     * @return integer
     */
    public function getTieneHistorial()
    {
    	return $this->tieneHistorial;
    }
    
    /**
     * Set tipoFormulario
     *
     * @param TipoFormulario $valor
     * @return FormulariosDefiniciones
     */
    public function setTipoFormulario($valor)
    {
    	$this->tipoFormulario = $valor;
    
    	return $this;
    }
    
    /**
     * Get tipoFormulario
     *
     * @return TipoFormulario
     */
    public function getTipoFormulario()
    {
    	return $this->tipoFormulario;
    }
    
    /**
     * Set tienePac
     *
     * @param integer $valor
     * @return FormulariosDefiniciones
     */
    public function setTienePac($valor)
    {
    	$this->tienePac = $valor;
    
    	return $this;
    }
    
    /**
     * Get tienePac
     *
     * @return integer
     */
    public function getTienePac()
    {
    	return $this->tienePac;
    }
    
    /**
     * Set tieneCopia
     *
     * @param integer $valor
     * @return FormulariosDefiniciones
     */
    public function setTieneCopia($valor)
    {
    	$this->tieneCopia = $valor;
    
    	return $this;
    }
    
    /**
     * Get agrupable
     *
     * @return integer
     */
    public function getAgrupable()
    {
    	return $this->agrupable;
    }
    
    /**
     * Set agrupable
     *
     * @param integer $valor
     * @return FormulariosDefiniciones
     */
    public function setAgrupable($valor)
    {
    	$this->agrupable = $valor;
    
    	return $this;
    }
    
    /**
     * Get tieneCopia
     *
     * @return integer
     */
    public function getTieneCopia()
    {
    	return $this->tieneCopia;
    }
    
    /**
     * Set tienePdf
     *
     * @param integer $valor
     * @return FormulariosDefiniciones
     */
    public function setTienePdf($valor)
    {
    	$this->tienePdf = $valor;
    
    	return $this;
    }
    
    /**
     * Get tienePdf
     *
     * @return integer
     */
    public function getTienePdf()
    {
    	return $this->tienePdf;
    }
    
    /**
     * Set config
     *
     * @param $config
     * @return FormulariosDefiniciones
     */
    public function setConfig(ConfigCustom $config = null)
    {
    	$this->config = $config;
    
    	return $this;
    }
    
    /**
     * Get config
     *
     * @return ConfigCustom
     */
    public function getConfig()
    {
    	return $this->config;
    }
    
    /**
     * Get codigoManual
     *
     * @return integer
     */
    public function getCodigoManual()
    {
    	return $this->codigoManual;
    }
    
    /**
     * Set codigoManual
     *
     * @param integer $valor
     * @return FormulariosDefiniciones
     */
    public function setCodigoManual($valor)
    {
    	$this->codigoManual = $valor;
    
    	return $this;
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