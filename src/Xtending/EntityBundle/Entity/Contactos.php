<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Xtending\EntityBundle\Entity\XtendingConstantes;
// DON'T forget this use statement!!!
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Contactos
 */
class Contactos implements UserInterface, \Serializable
{
    /**
     * @var integer
     */
    private $id;
    
    ////AUTENTICACION Y AUTORIZACION
    
  
    private $username;


    private $salt;

   
    private $password;
    
  
    private $isActive;
    

    private $roles;
    
    private $role;
    
    /////////////////////////////////////////7

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $telefono;
    
    /**
     * @var string
     */
    private $codigoRecuperacion;

    /**
     * @var string
     */
    private $celular;

    /**
     * @var string
     */
    private $direccion;

    private $tyc;
    /**
     * @var string
     */
    private $foto;
    
    /**
     * @var file
     */
    private $file;
    
    private $temp;
    
    /**
     * @var string
     */
    private $idioma;
    
    /**
     * @var string
     */
    private $template;
    
    
    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $entidad;
    
    
    /**
     * @var Sites
     */
    private $site;
    
    /**
     * @var Corporaciones
     */
    private $corporacion;
  
    /**
     * @var CargosEntidades
     */
    private $cargo;
    
    /**
     * @var ArrayCollection
     */
    private $sites;
    
    /**
     * @var array
     */
    private $planificaciones;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    ////AUTENTICACION Y AUTORIZACION
    


    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->roles = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->planificaciones = new ArrayCollection();
    }
    
    /**
     * Set Corporaciones
     *
     * @param \Xtending\EntityBundle\Entity\Corporaciones $corporacion
     * @return Contactos
     */
    public function setCorporacion(\Xtending\EntityBundle\Entity\Corporaciones $corporacion = null)
    {
        $this->corporacion = $corporacion;
    
        return $this;
    }

    /**
     * Get Corporacion
     *
     * @return \Xtending\EntityBundle\Entity\Corporaciones 
     */
    public function getCorporacion()
    {
        return $this->corporacion;
    }
    
    /**
     * Set entidad
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $entidad
     * @return Formularios
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
     * Set site
     *
     * @param Sites $site
     * @return Contactos
     */
    public function setSite($site)
    {
    	$this->site = $site;
    
    	return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getSite()
    {
    	return $this->site;
    }
    
    /**
     * Set cargo
     *
     * @param $cargo
     * @return Contactos
     */
    public function setCargo(CargosEntidades $cargo)
    {
    	$this->cargo = $cargo;
    
    	return $this;
    }
    
    /**
     * Get cargo
     * @return CargosEntidades
     */
    public function getCargo()
    {
    	return $this->cargo;
    }
    
	/**
     * Set username
     *
     * @param string $username
     * @return Contactos
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }
    
	/**
     * Set salt
     *
     * @param string $salt
     * @return Contactos
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }
    
/**
     * Set $password
     *
     * @param string $password
     * @return Contactos
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
    	return $this->roles->toArray();
//         return array($this->getRole());
    }
    
    public function addRole($role)
    {
    	$this->roles[] = $role;
    	return $this;
    }
    
    public function getRolesNames()
    {
    	$nombres = "";
    	foreach ($this->getRoles() as $rol)
    	{
    		if ($nombres != "") {
    			$nombres = $nombres.' - '.$rol->getName();
    		} else {
    			$nombres = $rol->getName();
    		}
    		
    	}
    	return $nombres;
    }
    
    /**
     * Set $role
     *
     * @param string $role
     * @return Contactos
     */
    public function setRoles($role)
    {
    	$this->roles = $role;
    
    	return $this;
    }
    
    public function getRolesCollection()
	{
    	
	 return $this->roles;
    }
    
    /**
     * Set $role
     *
     * @param string $role
     * @return Contactos
     */
    public function setRolesCollection($roles)
    {
    	$this->roles = $roles;
    
    	return $this;
    }
    
    /**
    * Set $role
    *
    * @param string $role
    * @return Contactos
    */
    public function setRole($role)
    {
    	$this->role = $role;
    
    	return $this;
    }
    
    
    /**
     * @inheritDoc
     */
    public function getRole()
    {
    	return $this->role;
    	
    }
    
    

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }
    
    /////////////////////////////////////////////////////////

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Contactos
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
     * Set apellido
     *
     * @param string $apellido
     * @return Contactos
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contactos
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
     * Set telefono
     *
     * @param string $telefono
     * @return Contactos
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }
    
    /**
     * Set codigoRecuperacion
     *
     * @param string $codigo
     * @return Contactos
     */
    public function setCodigoRecuperacion($codigo)
    {
    	$this->codigoRecuperacion = $codigo;
    
    	return $this;
    }
    
    /**
     * Get codigoRecuperacion
     *
     * @return string
     */
    public function getCodigoRecuperacion()
    {
    	return $this->codigoRecuperacion;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Contactos
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Contactos
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

   

    /**
     * Set foto
     *
     * @param string $foto
     * @return Contactos
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    
        return $this;
    }
    
    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
    	return $this->foto;
    }
    
    /**
     * Get idioma
     *
     * @return string
     */
    public function getIdioma()
    {
    	return $this->idioma;
    }
    
    /**
     * Set idioma
     *
     * @param string $idioma
     * @return Contactos
     */
    public function setIdioma($idioma)
    {
    	$this->idioma = $idioma;
    
    	return $this;
    }

    
    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
    	return $this->template;
    }
    
    /**
     * Set template
     *
     * @param string $template
     * @return Contactos
     */
    public function setTemplate($template)
    {
    	$this->template = $template;
    
    	return $this;
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
    	return null === $this->foto
    	? null
    	: $this->getUploadRootDir().'/'.$this->foto;
    }
    
    public function getWebPath()
    {
    	return null === $this->foto
    	? null
    	: $this->foto;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/usuario/'.$this->id.'/';
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
    	$this->foto = $this->getUploadRootDir().$filename;
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
    	$this->getFile()->move($this->getUploadRootDir(), $this->foto);
    	 
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
	    	if (file_exists($file) && is_writable($file))
			{
				unlink ( $file );
			}
   		}
    }
    
    public function getTipoUsuario(){
    	if($this->getCorporacion() != null){
    		return XtendingConstantes::TIPO_ENTIDAD_CORPORACION;
    	}
    	if($this->getEntidad() != null){
    		return XtendingConstantes::TIPO_ENTIDAD_EMPRESA;
    	}
    	if($this->getSite() != null){
    		return XtendingConstantes::TIPO_ENTIDAD_SITE;
    	}
    }
    
    public function setTyc($valor) 
    {
    	$this->tyc = $valor;
    }
    
    public function getTyc()
    {
    	return $this->tyc;
    }
    
    /**
     * Get Sites
     *
     * @return array
     */
    public function getSites()
    {
    	return $this->sites;
    }
    
    /**
     * Add Sites
     *
     */
    public function addSites($site)
    {
    	$this->sites->add($site);
    }
    
    
    /**
     * Remove Sites
     *
     */
    public function removeSites($site)
    {
    	$this->sites->removeElement($site);
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
	 * Get Planificaciones
	 *
	 * @return array
	 */
	public function getPlanificaciones()
	{
		return $this->planificaciones;
	}
	
	/**
	 * Add Planificaciones
	 *
	 */
	public function addPlanificaciones($planificacion)
	{
		$this->planificaciones->add($planificacion);
	}
	
	
	/**
	 * Remove Planificaciones
	 *
	 */
	public function removePlanificaciones($planificacion)
	{
		$this->planificaciones->removeElement($planificacion);
	}
}
