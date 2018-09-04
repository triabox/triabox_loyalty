<?php

namespace Xtending\EntityBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilesRegistro
 */
class FilesRegistro
{
    /**
     * @var integer
     */
    private $id;

    
    /**
     * @var string
     */
    private $path;
    
    /**
     * @var string
     */
    private $uploadDir;
    
    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosResultados
     */
    private $formularioResultado;
    
    /**
     * @var \Xtending\EntityBundle\Entity\LabelsCaratula
     */
    private $labelCaratula;
    
    /**
     * @var file
     */
    private $file;
   
    
    
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
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
    	return $this->file;
    }
    
	private $temp;

    
    
    public function getAbsolutePath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadRootDir().$this->path;
    }
    
    public function getWebPath()
    {
    	return null === $this->path
    	? null
    	: $this->path;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/registros/';
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
    		// no se puede deducir la extensión
    		$extension = 'bin';
    	}
		
		$filename = rand(1,99999).'.'.$extension;
    	$this->path = $filename;
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
    
    	// si hay un error al mover el archivo, move() automáticamente
    	// envía una excepción. This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->getFile()->move($this->getUploadRootDir(), $this->path);
    	
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
     * Set formularioResultado
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosResultados $formularioResultado
     * @return Files
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
     * @return Files
     */
    public function addFormularioResultado(\Xtending\EntityBundle\Entity\FormulariosResultados $formularioResultado = null)
    {
    	$this->formularioResultado = $formularioResultado;
    	
    
    	return $this;
    }
    
    /**
     * Get formularioResultado
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosResultados
     */
    public function getFormularioResultado()
    {
    	return $this->formularioResultado;
    }
    
    /**
     * Set labelCaratula
     *
     * @param \Xtending\EntityBundle\Entity\LabelsCaratula $labelCaratula
     * @return LabelCaratulaValor
     */
    public function setLabelCaratula(\Xtending\EntityBundle\Entity\LabelsCaratula $labelCaratula = null)
    {
    	$this->labelCaratula = $labelCaratula;
    
    	return $this;
    }
    
    /**
     * Get labelCaratula
     *
     * @return \Xtending\EntityBundle\Entity\LabelsCaratula
     */
    public function getLabelCaratula()
    {
    	return $this->labelCaratula;
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