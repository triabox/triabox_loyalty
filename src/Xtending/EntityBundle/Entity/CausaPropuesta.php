<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Causa Propuesta
 * @ORM\Table(name="causa_propuesta")
 * @ORM\Entity
 */
class CausaPropuesta
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
     * @ORM\Column(name="descripcionAnalisis", type="string", length=255, nullable=true)
     */
    private $descripcionAnalisis;

    /**
     * @var string
     * 
      * @ORM\Column(name="archivoAnalisis", type="string", length=255, nullable=true)
     */
    private $archivoAnalisis;

    /**
     * @var string
     * 
      * @ORM\Column(name="fechaAnalisis", type="string", length=255, nullable=true)
     */
    private $fechaAnalisis;

    /**
     * @var integer
     * 
     *  @ORM\Column(name="autor_id", type="integer", length=11, nullable=true)
     */
    private $autor;

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
     * Set descripcionAnalisis
     *
     * @param string $descripcionAnalisis
     * @return AccionCorrectiva
     */
    public function setDescripcionAnalisis($descripcionAnalisis)
    {
        $this->descripcionAnalisis = $descripcionAnalisis;
    
        return $this;
    }

    /**
     * Get descripcionAnalisis
     *
     * @return string 
     */
    public function getDescripcionAnalisis()
    {
        return $this->descripcionAnalisis;
    }

    /**
     * Set archivoAnalisis
     *
     * @param string $archivoAnalisis
     * @return AccionCorrectiva
     */
    public function setArchivoAnalisis($archivoAnalisis)
    {
        $this->archivoAnalisis = $archivoAnalisis;
    
        return $this;
    }

    /**
     * Get archivoAnalisis
     *
     * @return string 
     */
    public function getArchivoAnalisis()
    {
        return $this->archivoAnalisis;
    }

    /**
     * Set fechaAnalisis
     *
     * @param string $fechaAnalisis
     * @return AccionCorrectiva
     */
    public function setFechaAnalisis($fechaAnalisis)
    {
        $this->fechaAnalisis = $fechaAnalisis;
    
        return $this;
    }

    /**
     * Get fechaAnalisis
     *
     * @return string 
     */
    public function getFechaAnalisis()
    {
        return $this->fechaAnalisis;
    }

    /**
     * Set autor
     *
     * @param integer $autor
     * @return AccionCorrectiva
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    
        return $this;
    }

    /**
     * Get autor
     *
     * @return integer 
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
    	return null === $this->archivoAnalisis
    	? null
    	: $this->getUploadRootDir().$this->archivoAnalisis;
    }
    
    public function getWebPath()
    {
    	return null === $this->archivoAnalisis
    	? null
    	: $this->archivoAnalisis;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/pacs/causaPropuesta/';
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
    	$this->archivoAnalisis = $filename;
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
    	$this->getFile()->move($this->getUploadRootDir(), $this->archivoAnalisis);
    
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
