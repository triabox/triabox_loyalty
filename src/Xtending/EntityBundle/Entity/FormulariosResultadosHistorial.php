<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * FormulariosResultados
 */
class FormulariosResultadosHistorial 
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
	 * @var \Xtending\EntityBundle\Entity\FormulariosDefiniciones
	 */
	private $formulariosDefiniciones;
	
	/**
	 * @var \Xtending\EntityBundle\Entity\Contactos
	 */
	private $contacto;
	
	/**
	 * @var \Xtending\EntityBundle\Entity\Entidades
	 */
	private $proveedor;
	
	/**
	 * @var \Xtending\EntityBundle\Entity\Entidades
	 */
	private $empresa;
	
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
	private $formulariosResultadosHistorial;
	
	private $discr;
	
	/**
	 * @var array
	 */
	private $labelsCaratulaValorHistorial;
	
	/**
	 * @var \Xtending\EntityBundle\Entity\FormulariosResultados
	 */
	private $formularioResultado;
	
	
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
	 * @param integer version
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
	 * @return integer
	 */
	public function getVersion()
	{
		return $this->version;
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
	 * Set formularioResultado
	 *
	 * @param \Xtending\EntityBundle\Entity\FormulariosResultados $formularioResultado
	 * @return LabelCaratulaValor
	 */
	public function setFormularioResultado(\Xtending\EntityBundle\Entity\FormulariosResultados $formularioResultado = null)
	{
		$this->formularioResultado = $formularioResultado;
	
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
	
	/**
	 * De un Formulario Resultado Historial devuelve un Formulario Resultado
	 * 
	 * @param FormulariosResultadosHistorial $formularioResultado
	 * @return \Xtending\EntityBundle\Entity\FormulariosResultados
	 */
	public function getRegistro(){
	
		$formularioResultado = new FormulariosResultados();
		 
		//     	$formularioResultado->addFormularioResultado($formularioResultado);
		$formularioResultado->setId($this->getId());
		$formularioResultado->setContacto($this->getContacto());
		$formularioResultado->setEmpresa($this->getEmpresa());
		$formularioResultado->setEstado($this->getEstado());
		$formularioResultado->setFechaautomatica($this->getFechaautomatica());
		$formularioResultado->setFormulariosDefiniciones($this->getFormulariosDefiniciones());
		$formularioResultado->setNombre($this->getNombre());
		$formularioResultado->setProveedor($this->getProveedor());
		$formularioResultado->setSite($this->getSite());
		$formularioResultado->setModificadoPor($this->getModificadoPor());
		$formularioResultado->setFechaModificado($this->getFechaModificado());
		$formularioResultado->setVersion($this->getVersion());
		$formularioResultado->setComentario($this->getComentario());
		 
		$lavelsValor = $this->getLabelsCaratulaValor();
		$lavelsNew = new ArrayCollection();
		foreach ($lavelsValor as $lavels) {
			$lavelValor = new LabelCaratulaValor();
			$lavelValor->setCriterioValor($lavels->getCriterioValor());
			//     		$lavelValor->setFile($lavels->getFile());
			//     		$lavelValor->setFormularioResultado($lavels->getFormularioResultado());
			$lavelValor->setLabelCaratula($lavels->getLabelCaratula());
			$lavelValor->setTipoSelect($lavels->getTipoSelect());
			$lavelValor->setValor($lavels->getValor());
			$formularioResultado->addLabelsCaratulaValor($lavelValor);
	
		}
		 
		 
		$preguntasValor =$this->getPreguntasValor();
		foreach ($preguntasValor as $pregunta) {
			$preguntaValor = new PreguntaValor();
			$preguntaValor->setArchivo($pregunta->getArchivo());
			$preguntaValor->setCriterioSeleccion($pregunta->getCriterioSeleccion());
			$preguntaValor->setFecha($pregunta->getFecha());
			//     		$preguntaValor->setFile($pregunta->getFile());
			//     		$preguntaValor->setFormulariosResultados($pregunta->getFormulariosResultados());
			$preguntaValor->setPregunta($pregunta->getPregunta());
			$preguntaValor->setText($pregunta->getText());
			$preguntaValor->setTextarea($pregunta->getTextarea());
			$formularioResultado->addPreguntasValor($preguntaValor);
		}
	
		return $formularioResultado;
	
	
	}
}
