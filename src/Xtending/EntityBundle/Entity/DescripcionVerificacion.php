<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * DescripcionVerificacion
 * @ORM\Table(name="descripcion_verificacion")
 * @ORM\Entity
 */
class DescripcionVerificacion
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
     * @var \Xtending\EntityBundle\Entity\PreguntaValor
     */
    private $preguntaValor;
    
    /**
     * @var string
     *
     */
    private $responsableTxt;
    
    /**
    * @ORM\Column(name="descripcionFalla", type="string", length=255, nullable=true)
     */
    private $descripcionFalla;

    /**
     * @var string
     * 
     * @ORM\Column(name="riesgo", type="string", length=255, nullable=true)
     */
    private $riesgo;

    /**
     * @var string
     * 
      * @ORM\Column(name="archivoFalla", type="string", length=255, nullable=true)
     */
    private $archivoFalla;

    /**
     * @var string
     *
     *   @ORM\Column(name="descripcionEfectividad", type="string", length=250, nullable=true)
     */
    private $descripcionEfectividad;

    /**
     * @var Xtending\EntityBundle\Entity\Contactos
     * 
     *   @ORM\Column(name="efectividad_id", type="integer", length=11, nullable=true)
     */
    private $efectividad;

    /**
     * @var string
     * 
     *   @ORM\Column(name="fechaEfectividad", type="string", length=250, nullable=true)
     */
    private $fechaEfectividad;

    /**
     * @var booleano
     */
    private $responsable;


    
    /**
     * @var \Xtending\EntityBundle\Entity\AccionCorrectiva
     */
    private $accionCorrectiva;

    /**
     * @var file
     */
    private $file;
    
    private $temp;
    

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
     * Set descripcionFalla
     *
     * @param string $descripcionFalla
     * @return AccionCorrectiva
     */
    public function setDescripcionFalla($descripcionFalla)
    {
        $this->descripcionFalla = $descripcionFalla;
    
        return $this;
    }

    /**
     * Get descripcionFalla
     *
     * @return string 
     */
    public function getDescripcionFalla()
    {
        return $this->descripcionFalla;
    }

    /**
     * Set riesgo
     *
     * @param string $riesgo
     * @return AccionCorrectiva
     */
    public function setRiesgo($riesgo)
    {
        $this->riesgo = $riesgo;
    
        return $this;
    }

    /**
     * Get riesgo
     *
     * @return string 
     */
    public function getRiesgo()
    {
        return $this->riesgo;
    }

    /**
     * Set archivoFalla
     *
     * @param string $archivoFalla
     * @return AccionCorrectiva
     */
    public function setArchivoFalla($archivoFalla)
    {
        $this->archivoFalla = $archivoFalla;
    
        return $this;
    }

    /**
     * Get archivoFalla
     *
     * @return string 
     */
    public function getArchivoFalla()
    {
        return $this->archivoFalla;
    }

    /**
     * Set descripcionEfectividad
     *
     * @param string $descripcionEfectividad
     * @return AccionCorrectiva
     */
    public function setDescripcionEfectividad($descripcionEfectividad)
    {
        $this->descripcionEfectividad = $descripcionEfectividad;
    
        return $this;
    }

    /**
     * Get descripcionEfectividad
     *
     * @return string 
     */
    public function getDescripcionEfectividad()
    {
        return $this->descripcionEfectividad;
    }
    
    /**
     * Set responsableTxt
     *
     * @param string $responsable
     * @return DescripcionVerificacion
     */
    public function setResponsableTxt($responsable)
    {
    	$this->responsableTxt = $responsable;
    
    	return $this;
    }
    
    /**
     * Get responsableTxt
     *
     * @return string
     */
    public function getResponsableTxt()
    {
    	return $this->responsableTxt;
    }

    /**
     * Set responsable
     *
     * @param Contacto $responsable
     * @return AccionCorrectiva
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    
        return $this;
    }

    /**
     * Get responsable
     *
     * @return Contacto 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set fechaEfectividad
     *
     * @param string $fechaEfectividad
     * @return AccionCorrectiva
     */
    public function setFechaEfectividad($fechaEfectividad)
    {
        $this->fechaEfectividad = $fechaEfectividad;
    
        return $this;
    }

    /**
     * Get fechaEfectividad
     *
     * @return string 
     */
    public function getFechaEfectividad()
    {
        return $this->fechaEfectividad;
    }
    
    
    /**
     * Set efectividad
     *
     * @param string $efectividad
     * @return AccionCorrectiva
     */
    public function setEfectividad($efectividad)
    {
    	$this->efectividad = $efectividad;
    
    	return $this;
    }
    
    /**
     * Get fechaEfectividad
     *
     * @return string
     */
    public function getEfectividad()
    {
    	return $this->efectividad;
    }
    
    /**
     * Get accionesCorrectiva
     *
     * @return AccionCorrectiva
     */
    public function getAccionCorrectiva()
    {
    	return $this->accionCorrectiva;
    }
    
    /**
     * Add accionCorrectiva
     *
     */
    public function setAccionCorrectiva( $accionCorrectiva)
    {
    
    	$this->accionCorrectiva = $accionCorrectiva;
    	
    	return $this;
    }
    /**
     * Add accionesCorrectivas
     *
     */
    public function addAccionesCorrectiva( $accionCorrectiva)
    {
    
    	$this->accionCorrectiva = $accionCorrectiva;
    
    	return $this;
    }
    /**
     * Set preguntaValor
     *
     * @param \Xtending\EntityBundle\Entity\PreguntaValor
     * @return PreguntaValor
     */
    public function setPreguntaValor(PreguntaValor $pregunta)
    {
    	$this->preguntaValor = $pregunta;
    
    	return $this;
    }
    
    /**
     * Get preguntaValor
     *
     * @return \Xtending\EntityBundle\Entity\PreguntaValor
     */
    public function getPreguntaValor()
    {
    	return $this->preguntaValor;
    }
    

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
    	return $this->file;
    }
    
    
    public function getAbsolutePath()
    {
    	return null === $this->archivoFalla
    	? null
    	: $this->getUploadRootDir().$this->archivoFalla;
    }
    
    public function getWebPath()
    {
    	return null === $this->archivoFalla
    	? null
    	: $this->archivoFalla;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/pacs/descripcion/';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     *
     */
    public function setFile(UploadedFile $file = null)
    {
    	$this->file = $file;
    	// check if we have an old image path
    	$extension = $this->getFile()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensi�n
    		$extension = 'bin';
    	}
    
    	//     	$filename = rand(1,99999).'.'.$extension;
    	$filename = strval(date("Ymdhis")).'-'.XtendingConstantes::sanear_string($this->getFile()->getClientOriginalName());
    	$this->archivoFalla = $filename;
    	$this->upload();
    }
    
    
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
    	if (null === $this->getFile()) {
    		return;
    	}
    
    	// si hay un error al mover el archivo, move() autom�ticamente
    	// env�a una excepci�n. This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->getFile()->move($this->getUploadRootDir(), $this->archivoFalla);
    
    	// check if we have an old image
    	if (isset($this->temp)) {
    		// delete the old image
    		unlink($this->getUploadRootDir().'/'.$this->temp);
    		// clear the temp image path
    		$this->temp = null;
    	}
    	$this->file = null;
    }
     
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
    	if ($file = $this->getAbsolutePath()) {
    		unlink($file);
    	}
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
