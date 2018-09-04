<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Xtending\EntityBundle\Entity\XtendingConstantes;

/**
 * PreguntaValor
 */
class PreguntaValor
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $textarea;
    
    /**
     * @var string
     */
    private $fecha;

    /**
     * @var string
     */
    private $text;
    
    /**
     * @var string
     */
    private $archivo;
    
    /**
     * @var \Xtending\EntityBundle\Entity\LabelsCriterio
     */
    private $criterioSeleccion;

    /**
     * @var \Xtending\EntityBundle\Entity\Preguntas
     */
    private $pregunta;

    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosResultados
     */
    private $formulariosResultados;
    
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
     * Set textarea
     *
     * @param string $textarea
     * @return PreguntaValor
     */
    public function setTextarea($textarea)
    {
        $this->textarea = $textarea;
    
        return $this;
    }

    /**
     * Get textarea
     *
     * @return string 
     */
    public function getTextarea()
    {
        return $this->textarea;
    }

    /**
     * Set criterioSeleccion
     *
     * @param \Xtending\EntityBundle\Entity\LabelsCriterio $criterio
     * @return PreguntaValor
     */
    public function setCriterioSeleccion($criterio)
    {
    	$this->criterioSeleccion = $criterio;
    
    	return $this;
    }
    
    /**
     * Get criterioSeleccion
     *
     * @return \Xtending\EntityBundle\Entity\LabelsCriterio
     */
    public function getCriterioSeleccion()
    {
    	return $this->criterioSeleccion;
    }
    
    /**
     * Set text
     *
     * @param string $text
     * @return PreguntaValor
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * Set archivo
     *
     * @param string $archivo
     * @return PreguntaValor
     */
    public function setArchivo($archivo)
    {
    	$this->archivo = $archivo;
    
    	return $this;
    }
    
    /**
     * Get archivo
     *
     * @return string
     */
    public function getArchivo()
    {
    	return $this->archivo;
    }
    
    
    /**
     * Set fecha
     *
     * @param string $fecha
     * @return FormulariosResultados
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
    public function getfecha()
    {
    	return $this->fecha;
    }
    
    /**
     * Set pregunta
     *
     * @param \Xtending\EntityBundle\Entity\Preguntas
     * @return PreguntaValor
     */
    public function setPregunta(\Xtending\EntityBundle\Entity\Preguntas $pregunta)
    {
        $this->pregunta = $pregunta;
    
        return $this;
    }

    /**
     * Get pregunta
     *
     * @return \Xtending\EntityBundle\Entity\Preguntas 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Set formulariosResultados
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosResultados $formulariosResultados
     * @return PreguntaValor
     */
    public function setFormulariosResultados(\Xtending\EntityBundle\Entity\FormulariosResultados $formulariosResultados = null)
    {
        $this->formulariosResultados = $formulariosResultados;
    
        return $this;
    }
    /**
     * Add formulariosResultados
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosResultados $formulariosResultados
     * @return PreguntaValor
     */
    public function addFormulariosResultados(\Xtending\EntityBundle\Entity\FormulariosResultados $formulariosResultados = null)
    {
    	$this->formulariosResultados = $formulariosResultados;
    
    	return $this;
    }
    /**
     * Get formulariosResultados
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosResultados 
     */
    public function getFormulariosResultados()
    {
        return $this->formulariosResultados;
    }
    
    public function getPosicionRegistro()
    {
    	$counter = 0;
    	foreach ($this->formulariosResultados->getPreguntasValor() as $pregunta)
    	{
    		if ($this->id != $pregunta->getId())
    		{
    			$counter++;
    		} else {
    			break;
    		}
    	}
    	return $counter;
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
    	return null === $this->archivo
    	? null
    	: $this->getUploadRootDir().'/'.$this->archivo;
    }
    
    public function getWebPath()
    {
    	return null === $this->archivo
    	? null
    	: $this->archivo;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/registros/preguntas';
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
    	$this->archivo = $filename;
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
    	$this->getFile()->move($this->getUploadRootDir(), $this->archivo);
    
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
