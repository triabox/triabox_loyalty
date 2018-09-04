<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Xtending\EntityBundle\Entity\XtendingConstantes;

/**
 * Producto
 */
class Producto
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
    private $codigo;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $especificacion;

    /**
     * @var string
     */
    private $registro;

    
    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $entidad;
	
    /**
     * @var file
     */
    private $fileEspecificacion;
    
    /**
     * @var file
     */
    private $fileImagen;
    
    /**
     * @var file
     */
    private $fileRegistro;
    
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
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
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
     * Set codigo
     *
     * @param string $codigo
     * @return Producto
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Producto
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set especificacion
     *
     * @param string $especificacion
     * @return Producto
     */
    public function setEspecificacion($especificacion)
    {
        $this->especificacion = $especificacion;
    
        return $this;
    }

    /**
     * Get especificacion
     *
     * @return string 
     */
    public function getEspecificacion()
    {
        return $this->especificacion;
    }

    /**
     * Set registro
     *
     * @param string $registro
     * @return Producto
     */
    public function setRegistro($registro)
    {
        $this->registro = $registro;
    
        return $this;
    }

    /**
     * Get registro
     *
     * @return string 
     */
    public function getRegistro()
    {
        return $this->registro;
    }

   

    /**
     * Set entidad
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $entidad
     * @return Producto
     */
    public function setEntidad(\Xtending\EntityBundle\Entity\Entidades $entidad = null)
    {
        $this->entidad = $entidad;
    
        return $this;
    }

    /**
     * Get entidad
     *
     * @return \Xtending\EntityBundle\Entity\Entidades 
     */
    public function getEntidad()
    {
        return $this->entidad;
    }
    
    /**
     * Get entidadId
     *
     * @return integer
     */
    public function getEntidadId()
    {
    	return $this->entidad->getId();
    }

    /**
     * Get fileEspecificacion.
     *
     * @return UploadedFile
     */
    public function getFileEspecificacion()
    {
    	return $this->fileEspecificacion;
    }
    
    /**
     * Get fileImagen.
     *
     * @return UploadedFile
     */
    public function getFileImagen()
    {
    	return $this->fileImagen;
    }
    
    /**
     * Get fileRegistro.
     *
     * @return UploadedFile
     */
    public function getFileRegistro()
    {
    	return $this->fileRegistro;
    }
    
    
    public function getAbsolutePathEspecificacion()
    {
    	return null === $this->especificacion
    	? null
    	: $this->getUploadRootDir().$this->especificacion;
    }
    
    public function getAbsolutePathImagen()
    {
    	return null === $this->imagen
    	? null
    	: $this->getUploadRootDir().$this->imagen;
    }
    
    public function getAbsolutePathRegistro()
    {
    	return null === $this->registro
    	? null
    	: $this->getUploadRootDir().$this->registro;
    }
    public function getWebPath()
    {
    	return null === $this->especificacion
    	? null
    	: $this->especificacion;
    }
    
    public function getWebPathImagen()
    {
    	return null === $this->imagen
    	? null
    	: $this->imagen;
    }
    
    public function getWebPathRegistro()
    {
    	return null === $this->registro
    	? null
    	: $this->registro;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/producto/';
    }
    
    /**
     * Set fileEspecificacion.
     *
     * @param UploadedFile $file
     *
     */
    public function setFileEspecificacion(UploadedFile $file = null)
    {
    	$this->fileEspecificacion = $file;
    	// check if we have an old image path
    	$extension = $this->getFileEspecificacion()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensi�n
    		$extension = 'bin';
    	}
    
//     	$filename = rand(1,99999).'.'.$extension;
//     	$this->especificacion = $this->getUploadRootDir().$filename;
    	$filename = strval(date("Ymdhis")).'-'.XtendingConstantes::sanear_string($this->getFileEspecificacion()->getClientOriginalName());
    	$this->especificacion = $filename;
    	$this->upload($this->fileEspecificacion, $this->especificacion);
    }
    
    /**
     * Set fileImagen.
     *
     * @param UploadedFile $file
     *
     */
    public function setFileImagen(UploadedFile $file = null)
    {
    	$this->fileImagen = $file;
    	// check if we have an old image path
    	$extension = $this->getFileImagen()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensi�n
    		$extension = 'bin';
    	}
    
//     	$filename = rand(1,99999).'.'.$extension;
//     	$this->imagen = $this->getUploadRootDir().$filename;
    	$filename = strval(date("Ymdhis")).'-'.XtendingConstantes::sanear_string($this->getFileImagen()->getClientOriginalName());
    	$this->imagen = $filename;
    	$this->upload($this->fileImagen, $this->imagen);
    }
    
    /**
     * Set fileRegistro.
     *
     * @param UploadedFile $file
     *
     */
    public function setFileRegistro(UploadedFile $file = null)
    {
    	$this->fileRegistro = $file;
    	// check if we have an old image path
    	$extension = $this->getFileRegistro()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensi�n
    		$extension = 'bin';
    	}
    
//     	$filename = rand(1,99999).'.'.$extension;
//     	$this->registro = $this->getUploadRootDir().$filename;
    	$filename = strval(date("Ymdhis")).'-'.XtendingConstantes::sanear_string($this->getFileRegistro()->getClientOriginalName());
    	$this->registro = $filename;
    	$this->upload($this->fileRegistro, $this->registro);
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload($file, $ubicacion)
    {
    	if (null === $file) {
    		return;
    	}
    
    	// si hay un error al mover el archivo, move() autom�ticamente
    	// env�a una excepci�n. This will properly prevent
    	// the entity from being persisted to the database on error
    	$file->move($this->getUploadRootDir(), $ubicacion);
    
    	// check if we have an old image
    	if (isset($this->temp)) {
    		// delete the old image
    		unlink($this->getUploadRootDir().'/'.$this->temp);
    		// clear the temp image path
    		$this->temp = null;
    	}
    	$file = null;
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
