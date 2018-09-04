<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Accion y Ejecucion de la Accion Correctiva
 * @ORM\Table(name="accion_ejecucion")
 * @ORM\Entity
 */
class AccionEjecucion
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
     * @var string
     * 
     *   @ORM\Column(name="descripcionAccion", type="string", length=250, nullable=true)
     */
    private $descripcionAccion;

    /**
     * @var date
     * 
     *   @ORM\Column(name="fechaAccion", type="string", length=250, nullable=true)
     */
    private $fechaAccion;

    /**
     * @var Xtending\EntityBundle\Entity\Contactos
     * 
     *   @ORM\Column(name="responsable_id", type="integer", length=11, nullable=true)
     */
    private $responsable;
	
    /**
     * @var string
     *
     */
    private $responsableTxt;
    
    /**
     * @var string
     * 
     *   @ORM\Column(name="descripcionEjecucion", type="string", length=250, nullable=true)
     */
    private $descripcionEjecucion;

    /**
     * @var string
     * 
      *   @ORM\Column(name="archivoEjecucion", type="string", length=250, nullable=true)
     */
    private $archivoEjecucion;

    /**
     * @var string
     * 
     *   @ORM\Column(name="fechaEjecucion", type="string", length=250, nullable=true)
     */
    private $fechaEjecucion;

    /**
     * @var string
     * 
     */
    private $ejecutor;
    
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
     * Set descripcionAccion
     *
     * @param string $descripcionAccion
     * @return AccionCorrectiva
     */
    public function setDescripcionAccion($descripcionAccion)
    {
        $this->descripcionAccion = $descripcionAccion;
    
        return $this;
    }

    /**
     * Get descripcionAccion
     *
     * @return string 
     */
    public function getDescripcionAccion()
    {
        return $this->descripcionAccion;
    }

    /**
     * Set fechaAccion
     *
     * @param string $fechaAccion
     * @return AccionCorrectiva
     */
    public function setFechaAccion($fechaAccion)
    {
        $this->fechaAccion = $fechaAccion;
    
        return $this;
    }

    /**
     * Get fechaAccion
     *
     * @return string 
     */
    public function getFechaAccion()
    {
        return $this->fechaAccion;
    }
	
    /**
     * Set responsableTxt
     *
     * @param string $responsable
     * @return AccionCorrectiva
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
     * @param integer $responsable
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
     * @return integer 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set descripcionEjecucion
     *
     * @param string $descripcionEjecucion
     * @return AccionCorrectiva
     */
    public function setDescripcionEjecucion($descripcionEjecucion)
    {
        $this->descripcionEjecucion = $descripcionEjecucion;
    
        return $this;
    }

    /**
     * Get descripcionEjecucion
     *
     * @return string 
     */
    public function getDescripcionEjecucion()
    {
        return $this->descripcionEjecucion;
    }

    /**
     * Set archivoEjecucion
     *
     * @param string $archivoEjecucion
     * @return AccionCorrectiva
     */
    public function setArchivoEjecucion($archivoEjecucion)
    {
        $this->archivoEjecucion = $archivoEjecucion;
    
        return $this;
    }

    /**
     * Get archivoEjecucion
     *
     * @return string 
     */
    public function getArchivoEjecucion()
    {
        return $this->archivoEjecucion;
    }

    /**
     * Set fechaEjecucion
     *
     * @param string $fechaEjecucion
     * @return AccionCorrectiva
     */
    public function setFechaEjecucion($fechaEjecucion)
    {
        $this->fechaEjecucion = $fechaEjecucion;
    
        return $this;
    }

    /**
     * Get fechaEjecucion
     *
     * @return string 
     */
    public function getFechaEjecucion()
    {
        return $this->fechaEjecucion;
    }

    /**
     * Set ejecutor
     *
     * @param string $ejecutor
     * @return AccionCorrectiva
     */
    public function setEjecutor($ejecutor)
    {
        $this->ejecutor = $ejecutor;
    
        return $this;
    }

    /**
     * Get ejecutor
     *
     * @return string 
     */
    public function getEjecutor()
    {
        return $this->ejecutor;
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
    
    	$this->accionCorrectiva = $accionCorrectiva;
    	
    	return $this;
    }
    
    
    /**
     * Remove accionesCorrectivas
     *
     */
    public function removeAccionesCorrectiva($accionCorrectiva)
    {
    	$this->accionesCorrectivas->removeElement($accionCorrectiva);
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
    	return null === $this->archivoEjecucion
    	? null
    	: $this->getUploadRootDir().$this->archivoEjecucion;
    }
    
    public function getWebPath()
    {
    	return null === $this->archivoEjecucion
    	? null
    	: $this->archivoEjecucion;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/pacs/ejecucion/';
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
    	$this->archivoEjecucion = $filename;
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
    	$this->getFile()->move($this->getUploadRootDir(), $this->archivoEjecucion);
    
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
    
}
