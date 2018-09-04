<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Xtending\EntityBundle\Entity\XtendingConstantes;

/**
 * LabelCaratulaValor
 */
class LabelCaratulaValor
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var \Xtending\EntityBundle\Entity\LabelsCriterio
     */
    private $tipoSelect;
	
    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosResultados
     */
    private $formularioResultado;
    
    /**
     * @var \Xtending\EntityBundle\Entity\CriterioValor
     */
    private $criterioValor;
    
    /**
     * @var \Xtending\EntityBundle\Entity\LabelsCaratula
     */
    private $labelCaratula;
    
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
     * Set valor
     *
     * @param string $valor
     * @return LabelCaratulaValor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set tipoSelect
     *
     * @param \Xtending\EntityBundle\Entity\LabelsCriterio $tipoSelect
     * @return LabelCaratulaValor
     */
    public function setTipoSelect(\Xtending\EntityBundle\Entity\LabelsCriterio $tipoSelect = null)
    {
        $this->tipoSelect = $tipoSelect;
    
        return $this;
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
     * Get formularioResultado
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosResultados
     */
    public function getFormularioResultado()
    {
    	return $this->formularioResultado;
    }
    
    /**
     * Add tipoSelect
     *
     * @param \Xtending\EntityBundle\Entity\LabelsCriterio $tipoSelect
     * @return LabelCaratulaValor
     */
    public function addTipoSelect(\Xtending\EntityBundle\Entity\LabelsCriterio $tipoSelect = null)
    {
    	$this->tipoSelect = $tipoSelect;
    
    	return $this;
    }

    /**
     * Get tipoSelect
     *
     * @return \Xtending\EntityBundle\Entity\LabelsCriterio 
     */
    public function getTipoSelect()
    {
        return $this->tipoSelect;
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
     * Set criterioValor
     *
     * @param \Xtending\EntityBundle\Entity\CriterioValor $criterioValor
     * @return LabelCaratulaValor
     */
    public function setCriterioValor(\Xtending\EntityBundle\Entity\CriterioValor $criterioValor = null)
    {
    	$this->criterioValor = $criterioValor;
    
    	return $this;
    }
    
    /**
     * Add criterioValor
     *
     * @param \Xtending\EntityBundle\Entity\CriterioValor $criterioValor
     * @return LabelCaratulaValor
     */
    public function addCriterioValor(\Xtending\EntityBundle\Entity\CriterioValor $criterioValor = null)
    {
    	$this->criterioValor = $criterioValor;
    
    	return $this;
    }
    
    /**
     * Get criterioValor
     *
     * @return \Xtending\EntityBundle\Entity\CriterioValor
     */
    public function getCriterioValor()
    {
    	return $this->criterioValor;
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
    	return null === $this->valor
    	? null
    	: $this->getUploadRootDir().'/'.$this->valor;
    }
    
    public function getWebPath()
    {
    	return null === $this->valor
    	? null
    	: $this->valor;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/registros/labels';
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
    
//     	$filename = rand(1,99999).'.'.$extension;
    	$filename = strval(date("Ymdhis")).'-'.XtendingConstantes::sanear_string($this->getFile()->getClientOriginalName());
    	$this->valor = $filename;
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
    	$this->getFile()->move($this->getUploadRootDir(), $this->valor);
    
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
