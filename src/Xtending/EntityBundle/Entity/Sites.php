<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Xtending\EntityBundle\Entity\XtendingConstantes;

/**
 * Sites
 */
class Sites
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
    private $ciudad;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $domicilio;

    /**
     * @var string
     */
    private $codpostal;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var \DateTime
     */
    private $fechaalta;

    /**
     * @var string
     */
    private $telefonos;

    /**
     * @var string
     */
    private $email;
    
    /**
     * @var string
     */
    private $emailAlternativo;

    /**
     * @var string
     */
    private $web;

    /**
     * @var string
     */
    private $descripcionSite;
    
    /**
     * @var string
     */
    private $descripcionProductos;

    /**
     * @var string
     */
    private $codigoplanta;
    
    /**
     * @var string
     */
    private $operador;


    /**
     * @var string
     */
    private $adjunto;

    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $entidad;

    /**
     * @var \Xtending\EntityBundle\Entity\Contactos
     */
    private $contacto;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Paises
     */
    private $pais;
    
    /**
     * @var file
     */
    private $file;
    
    private $temp;
    
    /**
     * @var ArrayCollection
     */
    private $responsables;
    
    /**
     * @var ArrayCollection
     */
    private $contactos;
    
    /**
     * Contructor
     */
    public function __construct()
    {
    	$this->contactos = new ArrayCollection();
    	$this->responsables = new ArrayCollection();
    }
    
    
    /**
     * Get Contactos
     *
     * @return array
     */
    public function getContactos()
    {
    	return $this->contactos;
    }
    
    /**
     * Add Contactos
     *
     */
    public function addContactos($contactos)
    {
    
    	$this->contactos->add($contactos);
    }
    
    
    /**
     * Remove Contactos
     *
     */
    public function removeContactos($contactos)
    {
    	$this->contactos->removeElement($contactos);
    }
    
    /**
     * Get Responsables
     *
     * @return array
     */
    public function getResponsables()
    {
    	return $this->responsables;
    }
    
    /**
     * Add Responsables
     *
     */
    public function addResponsables($contacto)
    {
    	$this->responsables->add($contacto);
    }
    
    
    /**
     * Remove Responsables
     *
     */
    public function removeResponsables($contacto)
    {
    	$this->responsables->removeElement($contacto);
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
     * @return Sites
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
     * Set operador
     *
     * @param string $operador
     * @return Sites
     */
    public function setOperador($operador)
    {
    	$this->operador = $operador;
    
    	return $this;
    }
    
    /**
     * Get operador
     *
     * @return string
     */
    public function getOperador()
    {
    	return $this->operador;
    }

    /**
     * Set pais
     *
     * @param \Xtending\EntityBundle\Entity\Paises $pais
     * @return Sites
     */
    public function setPais(\Xtending\EntityBundle\Entity\Paises $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return integer 
     */
    public function getPais()
    {
        return $this->pais;
    }

	 /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return Sites
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    
        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Sites
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     * @return Sites
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    
        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set codpostal
     *
     * @param string $codpostal
     * @return Sites
     */
    public function setCodpostal($codpostal)
    {
        $this->codpostal = $codpostal;
    
        return $this;
    }

    /**
     * Get codpostal
     *
     * @return string 
     */
    public function getCodpostal()
    {
        return $this->codpostal;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Sites
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set fechaalta
     *
     * @param \DateTime $fechaalta
     * @return Sites
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;
    
        return $this;
    }

    /**
     * Get fechaalta
     *
     * @return \DateTime 
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     * @return Sites
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;
    
        return $this;
    }

    /**
     * Get telefonos
     *
     * @return string 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Sites
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set emailAlternativo
     *
     * @param string $email
     * @return Sites
     */
    public function setEmailAlternativo($email)
    {
    	$this->emailAlternativo = $email;
    
    	return $this;
    }
    
    /**
     * Get emailAlternativo
     *
     * @return string
     */
    public function getEmailAlternativo()
    {
    	return $this->emailAlternativo;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Sites
     */
    public function setWeb($web)
    {
        $this->web = $web;
    
        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set descripcionProductos
     *
     * @param string $descripcionProductos
     * @return Sites
     */
    public function setDescripcionProductos($descripcion)
    {
        $this->descripcionProductos = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcionProductos
     *
     * @return string 
     */
    public function getDescripcionProductos()
    {
        return $this->descripcionProductos;
    }
    
    /**
     * Set descripcionSite
     *
     * @param string $descripcionSite
     * @return Sites
     */
    public function setDescripcionSite($descripcion)
    {
    	$this->descripcionSite = $descripcion;
    
    	return $this;
    }
    
    /**
     * Get descripcionSite
     *
     * @return string
     */
    public function getDescripcionSite()
    {
    	return $this->descripcionSite;
    }

    /**
     * Set codigoplanta
     *
     * @param string $codigoplanta
     * @return Sites
     */
    public function setCodigoplanta($codigoplanta)
    {
        $this->codigoplanta = $codigoplanta;
    
        return $this;
    }

    /**
     * Get codigoplanta
     *
     * @return string 
     */
    public function getCodigoplanta()
    {
        return $this->codigoplanta;
    }

   

    /**
     * Set adjunto
     *
     * @param string $adjunto
     * @return Sites
     */
    public function setAdjunto($adjunto)
    {
        $this->adjunto = $adjunto;
    
        return $this;
    }

    /**
     * Get adjunto
     *
     * @return string 
     */
    public function getAdjunto()
    {
        return $this->adjunto;
    }

    /**
     * Set entidad
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $entidad
     * @return Sites
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
     * Set contacto
     *
     * @param \Xtending\EntityBundle\Entity\Contactos $contacto
     * @return Sites
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
    	return null === $this->logo
    	? null
    	: $this->getUploadRootDir().$this->logo;
    }
    
    public function getWebPath()
    {
    	return null === $this->logo
    	? null
    	: $this->logo;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/sites/'.$this->id.'/';
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
    	$this->logo = $this->getUploadRootDir().$filename;
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
    	$this->getFile()->move($this->getUploadRootDir(), $this->logo);
    
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
     * Indica si pueden editar la información del site
     * @param \Xtending\EntityBundle\Entity\Contactos $usuario
     * @return boolean
     */
    public function esPropiaEntidad($usuario)
    {
    	$editable = false;
    	if ($usuario->getEntidad() != null)
    	{
    		if (($usuario->getEntidad()->getId() == $this->entidad->getId()) )
    		{
    			$editable = true;
    		}
    	}
    	return $editable;
    }
    
    public function getEntidadId()
    {
    	return $this->entidad->getId();
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
