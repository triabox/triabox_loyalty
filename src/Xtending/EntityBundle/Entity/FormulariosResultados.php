<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * FormulariosResultados
 */
class FormulariosResultados
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
    private $fechaautomatica;

    /**
     * @var string     
     */
    private $fechamanual;

    /**
     * @var string
     */
    private $fechaCierre;

    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosDefiniciones
    */
    private $formulariosDefiniciones;

    /**
     * @var \Xtending\EntityBundle\Entity\Contactos
     */
    private $contacto;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Contactos
     */
    private $contactoEntidad;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $proveedor;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $empresa;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Producto
     */
    private $producto;

    /**
     * @var \Xtending\EntityBundle\Entity\Sites
     */
    private $site;
    
    /**
     * @var array
     */
    private $labelsCaratulaValor;
    
    
    /**
     * @var array
     */
    private $labelsCaratulaFile;
   
    /**
     * @var \Xtending\EntityBundle\Entity\AsignacionIndividual
     */
    private $compartido;
    
    /**
     * @var integer
     */
    private $estado;
    
    /**
     * @var integer
     */
    private $privado;
    
    /**
     * @var integer
     */
    private $eliminado;
    
    
    /**
     * @var array
     */
    private $accionesCorrectivas;
    
    
    /**
     * @var array
     */
    private $preguntasValor;
    
    /**
     * @var array
     */
    private $estadosFormularioValor;
    
    /**
     * @var array
     */
    private $formulariosResultadosHistorial;
    
    /**
     * @var unknown
     */
    private $discr;
    
    private $modificadoPor;
    
    private $fechaModificado;
    
    private $comentario;
    
    private $version;
    
    
    /**
     * Set nombre
     *
     * @param string $nombre
     * @return FormulariosResultados
     */
    public function setDiscr($discr)
    {
    	$this->discr = $discr;
    	return $this;
    }
    
    /**
     * Get nombre
     *
     * @return string
     */
    public function getDiscr()
    {
    	return $this->discr;
    }
    
    public function __construct() 
    {
    	$this->labelsCaratulaValor = new ArrayCollection();
    	$this->preguntasValor = new ArrayCollection();
    	$this->accionesCorrectivas = new ArrayCollection();
    	$this->labelsCaratulaFile = new ArrayCollection();
    	$this->formulariosResultadosHistorial = new ArrayCollection();
    	$this->estadosFormularioValor = new ArrayCollection();
    	
    	
    	
    }
    
    
    /**
     * Get estadosFormularioValor
     *
     * @return array
     */
    public function getEstadosFormularioValor()
    {
    	return $this->estadosFormularioValor;
    }
    
    /**
     * Add estadosFormularioValor
     *
     */
    public function addEstadosFormularioValor( $estadosFormularioValor)
    {
    	$estadosFormularioValor->addFormularioResultado($this);
    
    	$this->estadosFormularioValor->add($estadosFormularioValor);
    }
    
    
    /**
     * Remove Pregunta
     *
     */
    public function removeEstadosFormularioValor($estadosFormularioValor)
    {
    	$this->estadosFormularioValor->removeElement($estadosFormularioValor);
    }
    
    
    /**
     * Get accionesCorrectivas
     *
     * @return array
     */
    public function getAccionesCorrectivas()
    {
    	return $this->accionesCorrectivas;
    }
    
    /**
     * Add accionesCorrectivas
     *
     */
    public function addAccionesCorrectiva( $accionCorrectiva)
    {
    	$accionCorrectiva->addFormularioResultado($this);
    
    	$this->accionesCorrectivas->add($accionCorrectiva);
    }
    
    
    /**
     * Remove accionesCorrectivas
     *
     */
    public function removeAccionesCorrectiva($accionCorrectiva)
    {
    	$this->accionesCorrectivas->removeElement($accionCorrectiva);
    }
    
    /** Get labelsCaratulaFile
    *
    * @return array
    */
    public function getLabelsCaratulaFile()
    {
    	return $this->labelsCaratulaFile;
    }
    
    /**
     * Add labelsCaratulaFile
     *
     */
    public function addLabelsCaratulaFile( $file)
    {
    	
    	$file->addFormularioResultado($this);
    	
    
    	$this->labelsCaratulaFile->add($file);
    }
    
    
    /**
     * Remove labelsCaratulaFile
     *
     */
    public function removeLabelsCaratulaFile($file)
    {
    	$this->labelsCaratulaFile->removeElement($file);
    }
    
    /**
     * Get preguntasValor
     *
     * @return array
     */
    public function getPreguntasValor()
    {
    	return $this->preguntasValor;
    }
    
    /**
     * Get preguntasResumen
     *
     * @return array
     */
    public function getPreguntasResumenGrupo($grupo)
    {
    	$preguntasResumen = new ArrayCollection();
    	foreach ($this->preguntasValor as $preguntaValor)
    	{
    		if ($preguntaValor->getPregunta()->getResumen() != 0 && $preguntaValor->getPregunta()->getGrupoPregunta()->getId() == $grupo)
    		{
    			$preguntasResumen->add($preguntaValor);
    		}
    	}
    	return $preguntasResumen;
    }
    
    /**
     * Add preguntasValor
     *
     */
    public function addPreguntasValor( $preguntasValor)
    {
    	$preguntasValor->addFormulariosResultados($this);
    	 
    	$this->preguntasValor->add($preguntasValor);
    }
    
    
    /**
     * Remove Pregunta
     *
     */
    public function removePreguntasValor($preguntasValor)
    {
    	$this->preguntasValor->removeElement($preguntasValor);
    }
    
    
    
    /**
     * Get formulariosResultadosHistorial
     *
     * @return array
     */
    public function getFormulariosResultadosHistorial()
    {
    	return $this->formulariosResultadosHistorial;
    }
    
    /**
     * Add formulariosResultadosHistorial
     *
     */
    public function addFormulariosResultadosHistorial( $formulariosResultadosHistorial)
    {
    	$formulariosResultadosHistorial->addFormulariosResultados($this);
    
    	$this->formulariosResultadosHistorial->add($formulariosResultadosHistorial);
    }
    
    
    /**
     * Remove Pregunta
     *
     */
    public function removeFormulariosResultadosHistorial($formulariosResultadosHistorial)
    {
    	$this->formulariosResultadosHistorial->removeElement($formulariosResultadosHistorial);
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
     * @return FormulariosResultados
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
     * @return FormulariosResultados
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
     * Set fechaautomatica
     *
     * @param \DateTime $fechaautomatica
     * @return FormulariosResultados
     */
    public function setFechaautomatica($fechaautomatica)
    {
        $this->fechaautomatica = $fechaautomatica;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFechaautomatica()
    {
        return $this->fechaautomatica;
    }

    /**
     * Set fechamanual
     *
     * @param string $fechamanual
     * @return FormulariosResultados
     */
    public function setFechamanual($fechamanual)
    {
        $this->fechamanual = $fechamanual;
    
        return $this;
    }

    /**
     * Get fechamanual
     *
     * @return string 
     */
    public function getFechamanual()
    {
        return $this->fechamanual;
    }

    /**
     * Set fechaCierre
     *
     * @param string $fechaCierre
     * @return FormulariosResultados
     */
    public function setFechaCierre($fechaCierre)
    {
    	$this->fechaCierre = $fechaCierre;
    
    	return $this;
    }
    
    /**
     * Get fechaCierre
     *
     * @return string
     */
    public function getFechaCierre()
    {
    	return $this->fechaCierre;
    }

    /**
     * Set formulariosDefiniciones
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     * @return FormulariosResultados
     */
    public function setFormulariosDefiniciones( $formulariosDefiniciones)
    {
        $this->formulariosDefiniciones = $formulariosDefiniciones;
    
        return $this;
    }

    /**
     * Get formulariosDefiniciones
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosDefiniciones 
     */
    public function getFormulariosDefiniciones()
    {
        return $this->formulariosDefiniciones;
    }
    
    /**
     * Set labelsCaratulaValor
     *
     * @param 
     * @return FormulariosResultados
     */
    public function setlabelsCaratulaValor($label)
    {
    	$label->addFormularioResultado($this);
    	
    	$this->labelsCaratulaValor->add($label);
    	
    	
    
    	return $this;
    }
    
    /**
     * Add labelsCaratulaValor
     *
     * @param 
     * @return FormulariosResultados
     */
    public function addLabelsCaratulaValor($label)
    {
    	$label->addFormularioResultado($this);
    	
    	$this->labelsCaratulaValor->add($label); 	
    
    	return $this;
    }
    
    /**
     * Remove labelCaratulaValor
     *
     */
    public function removeLabelsCaratulaValor($label)
    {
    	$this->labelsCaratulaValor->removeElement($label);
    }
    
    /**
     * Get labelsCaratulaValor
     *
     * @return array
     */
    public function getLabelsCaratulaValor()
    {
    	return $this->labelsCaratulaValor;
    }
    
    /**
     * Set contacto
     *
     * @param \Xtending\EntityBundle\Entity\Contactos $contacto
     * @return FormulariosResultados
     */
    public function setContacto(\Xtending\EntityBundle\Entity\Contactos $contacto = null)
    {
        $this->contacto = $contacto;
    
        return $this;
    }

    /**
     * Get contacto
     *
     * @return \Xtending\EntityBundle\Entity\Contactos 
     */
    public function getContacto()
    {
        return $this->contacto;
    }
    
    /**
     * Set contactoEntidad
     *
     * @param \Xtending\EntityBundle\Entity\Contactos $contacto
     * @return FormulariosResultados
     */
    public function setContactoEntidad(\Xtending\EntityBundle\Entity\Contactos $contacto = null)
    {
    	$this->contactoEntidad = $contacto;
    
    	return $this;
    }
    
    /**
     * Get contactoEntidad
     *
     * @return \Xtending\EntityBundle\Entity\Contactos
     */
    public function getContactoEntidad()
    {
    	return $this->contactoEntidad;
    }

    /**
     * Set proveedor
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $entidad
     * @return FormulariosResultados
     */
    public function setProveedor(\Xtending\EntityBundle\Entity\Entidades $entidad = null)
    {
    	$this->proveedor = $entidad;
    
    	return $this;
    }
    
    /**
     * Get proveedor
     *
     * @return \Xtending\EntityBundle\Entity\Entidades
     */
    public function getProveedor()
    {
    	return $this->proveedor;
    }
    
    /**
     * Set compartido
     *
     * @param \Xtending\EntityBundle\Entity\AsignacionIndividual $ai
     * @return FormulariosResultados
     */
    public function setCompartido(AsignacionIndividual $ai = null)
    {
    	$this->compartido = $ai;
    
    	return $this;
    }
    
    /**
     * Get compartido
     *
     * @return AsignacionIndividual
     */
    public function getCompartido()
    {
    	return $this->compartido;
    }
    
    /**
     * Set site
     *
     * @param \Xtending\EntityBundle\Entity\Sites $site
     * @return FormulariosResultados
     */
    public function setSite(\Xtending\EntityBundle\Entity\Sites $site = null)
    {
        $this->site = $site;
    
        return $this;
    }

    /**
     * Get procesoSite
     *
     * @return \Xtending\EntityBundle\Entity\Sites
     */
    public function getSite()
    {
        return $this->site;
    }
    
    /**
     * Set empresa
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $empresa
     * @return FormulariosResultados
     */
    public function setEmpresa(\Xtending\EntityBundle\Entity\Entidades $empresa = null)
    {
    	$this->empresa = $empresa;
    
    	return $this;
    }
    
    /**
     * Get empresa
     *
     * @return \Xtending\EntityBundle\Entity\Entidades
     */
    public function getEmpresa()
    {
    	return $this->empresa;
    }
    
    /**
     * Get producto
     *
     * @return \Xtending\EntityBundle\Entity\Producto
     */
    public function getProducto()
    {
    	return $this->producto;
    }
    
    /**
     * Set producto
     *
     * @param \Xtending\EntityBundle\Entity\Producto $producto
     * @return FormulariosResultados
     */
    public function setProducto(\Xtending\EntityBundle\Entity\Producto $producto = null)
    {
    	$this->producto = $producto;
    
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
    
    public function getEstadoNombre(){
    
    	$nombreEstado = 'cerrado';
    
    	if($this->getEstado() == 1){
    		$nombreEstado = 'programado';
    	}elseif ($this->getEstado() == 2) {
    		$nombreEstado = 'no.evaluado';
    	}
    
    	return  $nombreEstado;
    
    }
    
    /**
     * Set estado
     * @return FormulariosResultados
     */
    
    public function setEstado($estado)
    {
    	$this->estado = $estado;
    	
    	return $this;
    }
    
    /**
     * Set privado
     * @return FormulariosResultados
     */
    
    public function setPrivado($valor)
    {
    	$this->privado = $valor;
    	 
    	return $this;
    }
    
    /**
     * Get privado
     *
     * @return integer
     */
    public function getPrivado()
    {
    	return $this->privado;
    }
    
    /**
     * Set eliminado
     * Defecto 0. El 1 es Eliminado
     * @return FormulariosResultados
     */
    
    public function setEliminado($estado)
    {
    	$this->eliminado = $estado;
    	 
    	return $this;
    }
    
    /**
     * Get eliminado
     *
     * @return integer
     */
    public function getEliminado()
    {
    	return $this->eliminado;
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
    
    /**
     * Set nombre
     *
     * @param string modificadoPor
     * @return FormulariosResultados
     */
    public function setModificadoPor($modificadoPor)
    {
    	$this->modificadoPor = $modificadoPor;
    
    	return $this;
    }
    
    /**
     * Get modificadoPor
     *
     * @return string
     */
    public function getModificadoPor()
    {
    	return $this->modificadoPor;
    }
    
    /**
     * Set fechaautomatica
     *
     * @param \DateTime $fechaautomatica
     * @return FormulariosResultados
     */
    public function setFechaModificado($fechaModificado)
    {
    	$this->fechaModificado = $fechaModificado;
    
    	return $this;
    }
    
    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFechaModificado()
    {
    	return $this->fechaModificado;
    }
    
    /**
     * Set comentario
     *
     * @param string comentario
     * @return FormulariosResultados
     */
    public function setComentario($comentario)
    {
    	$this->comentario = $comentario;
    
    	return $this;
    }
    
    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
    	return $this->comentario;
    }
    
    /**
     * Set version
     *
     * @param string version
     * @return FormulariosResultados
     */
    public function setVersion($version)
    {
    	$this->version = $version;
    
    	return $this;
    }
    
    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
    	return $this->version;
    }
    
    
    
    /**
     * transforma Formulario Resultado en un Formulario Resultado Historial
     * 
     * @param FormulariosResultados $formularioResultado
     * @return \Xtending\EntityBundle\Entity\FormulariosResultadosHistorial
     */
    public function getHistorialRegistro(){
    
    	$formularioResultadoHistorial = new FormulariosResultadosHistorial();
    
    	$formularioResultadoHistorial->addFormularioResultado($this);
    	$formularioResultadoHistorial->setContacto($this->getContacto());
    	$formularioResultadoHistorial->setEmpresa($this->getEmpresa());
    	$formularioResultadoHistorial->setEstado($this->getEstado());
    	$formularioResultadoHistorial->setFechaautomatica($this->getFechaautomatica());
    	$formularioResultadoHistorial->setFormulariosDefiniciones($this->getFormulariosDefiniciones());
    	$formularioResultadoHistorial->setNombre($this->getNombre());
    	$formularioResultadoHistorial->setProveedor($this->getProveedor());
    	$formularioResultadoHistorial->setSite($this->getSite());
    	$formularioResultadoHistorial->setFechaModificado($this->getFechaModificado());
    	$formularioResultadoHistorial->setModificadoPor($this->getModificadoPor());
    	$formularioResultadoHistorial->setVersion($this->getVersion());
    	$formularioResultadoHistorial->setComentario($this->getComentario());
    	
    	$lavelsValor = $this->getLabelsCaratulaValor();
    	$lavelsNew = new ArrayCollection();
    	foreach ($lavelsValor as $lavels) {
    		$lavelValor = new LabelCaratulaValorHistorial();
    		$lavelValor->setCriterioValor($lavels->getCriterioValor());
    		//     		$lavelValor->setFile($lavels->getFile());
    		//     		$lavelValor->setFormularioResultado($lavels->getFormularioResultado());
    		$lavelValor->setLabelCaratula($lavels->getLabelCaratula());
    		$lavelValor->setTipoSelect($lavels->getTipoSelect());
    		$lavelValor->setValor($lavels->getValor());
    		$formularioResultadoHistorial->addLabelsCaratulaValor($lavelValor);
    
    	}
    
    
    	$preguntasValor =$this->getPreguntasValor();
    	foreach ($preguntasValor as $pregunta) {
    		$preguntaValor = new PreguntaValorHistorial();
    		$preguntaValor->setArchivo($pregunta->getArchivo());
    		$preguntaValor->setCriterioSeleccion($pregunta->getCriterioSeleccion());
    		$preguntaValor->setFecha($pregunta->getFecha());
    		//     		$preguntaValor->setFile($pregunta->getFile());
    		//     		$preguntaValor->setFormulariosResultados($pregunta->getFormulariosResultados());
    		$preguntaValor->setPregunta($pregunta->getPregunta());
    		$preguntaValor->setText($pregunta->getText());
    		$preguntaValor->setTextarea($pregunta->getTextarea());
    		$formularioResultadoHistorial->addPreguntasValor($preguntaValor);
    	}
    
    	return $formularioResultadoHistorial;
    
    
    }
    
    /**
     * Segun un Array de Formularios Resultado Historial, devuelve un Array de Formulario Resultado
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRegistrosByHistorial(){
    	 
    	$formulariosResultados = new ArrayCollection();

    	$formulariosResultadosHistorial = $this->getFormulariosResultadosHistorial();
    	
    	foreach ($formulariosResultadosHistorial as $formularioResultadoHistorial) {

    		$formulariosResultados->add($formularioResultadoHistorial->getRegistro());
    
    	}
    	 
    	return $formulariosResultados;
    	 
    	 
    }
    
    /**
     * Indica si el registro se puede compartir o no
     * @return boolean
     */
    public function esCompartible(){
    	$compartible = false;
    	if ($this->estado == 0 && $this->compartido != null){
    		$compartible = true;
    	}
    	return $compartible;
    }
    
    public function getIdByTipoEntidad()
    {
    	if ($this->formulariosDefiniciones->getTienesite() != "")
    	{
    		return $this->site->getId();
    	} elseif ($this->formulariosDefiniciones->getTieneProducto() != "")
    	{
    		return $this->producto->getId();
    	} else {
    		return $this->empresa->getId();
    	}
    }
    
    public function setEntidad($entidad)
    {
    	if ($this->formulariosDefiniciones->getTienesite() != '')
    	{
    		$this->site = $entidad;
    	} elseif ($this->formulariosDefiniciones->getTieneempresa() != '')
    	{
    		$this->empresa = $entidad;
    	} else {
    		$this->producto = $entidad;
    	}
    }
    
    public function getEntidad()
    {
    	if ($this->site != null)
    	{
    		return $this->site;
    	} elseif ($this->empresa != null)
    	{
    		return $this->empresa;
    	} else {
    		return $this->producto;
    	}
    }
}
