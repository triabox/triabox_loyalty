<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Xtending\EntityBundle\Entity\XtendingConstantes;

/**
 * Entidades
 */
class Entidades
{
    /**
     * @var integer //me rompia, por alguna razon el framework lo usaba
     */
    public $id;

    /**
     * @var \Xtending\EntityBundle\Entity\Corporaciones
     */
    private $corporacion;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $razonsocial;

    /**
     * @var string
     */
    private $descripcionempresa;

    /**
     * @var string
     */
    private $descripcionproductos;
    
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $idImpuestos;
    
    /**
     * @var string
     */
    private $emailalternativo;


    /**
     * @var \Xtending\EntityBundle\Entity\Paises
     */
    private $pais;

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
    private $telefonos;

    /**
     * @var string
     */
    private $codpostal;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $fechaalta;

  
    /**
     * @var string
     */
    private $fechabaja;

    /**
     * @var \Xtending\EntityBundle\Entity\Contactos
     */
    private $contactobajaId;
    
    /**
     * @var Array
     */
    private $sites;
    
    /**
     * @var Array
     */
    private $proveedores;
    
    /**
     * @var Array
     */
    private $clientes;
    
    /**
     * @var Array
     */
    private $contactos;
    
    /**
     * @var Array
     */
    private $productos;
    
    /**
     * @var Array
     */
    private $procesos;
    
    /**
     * @var integer
     */
    private $registrada;
    
    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $invitadaPor;
    
    /**
     * @var file
     */
    private $file;
    
    private $temp;
    
    /**
     * @var Arrays
     */
    private $cargos;
    
    /**
     * @var CriteriosDefinicion
     */
    private $criteriosDefinicion;
    
    
    public function __construct()
    {
    	$this->sites = new ArrayCollection();
    	$this->proveedores = new ArrayCollection();
    	$this->clientes = new ArrayCollection();
    	$this->contactos = new ArrayCollection();
    	$this->productos = new ArrayCollection();
    	$this->criteriosDefinicion = new ArrayCollection();
    	$this->procesos = new ArrayCollection();
    	$this->cargos = new ArrayCollection();
    }
    
    /**
     * Get cargos
     *
     * @return array
     */
    public function getCargos()
    {
    	return $this->cargos;
    }
    
    /**
     * Add cargo
     *
     * @return Entidades
     */
    public function addCargo($cargo)
    {
    	$this->cargos->add($cargo);
    }
    
    /**
     * Remove
     *
     */
    public function removeCargo($cargo)
    {
    	$this->cargos->removeElement($cargo);
    }
    
    /**
     * Get Procesos
     *
     * @return array
     */
    public function getProcesos()
    {
    	return $this->procesos;
    }
    
    /**
     * Add Procesos
     *
     */
    public function addProcesos($procesos)
    {
    
    	$this->procesos->add($procesos);
    }
    
    
    /**
     * Remove Procesos
     *
     */
    public function removeProcesos($procesos)
    {
    	$this->procesos->removeElement($procesos);
    }
    
    /**
     * Get Productos
     *
     * @return array
     */
    public function getProductos()
    {
    	return $this->productos;
    }
    
    /**
     * Add Productos
     *
     */
    public function addProductos($productos)
    {
    
    	$this->productos->add($productos);
    }
    
    
    /**
     * Remove Productos
     *
     */
    public function removeProductos($productos)
    {
    	$this->productos->removeElement($productos);
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
     * Get Clientes
     *
     * @return array
     */
    public function getClientes()
    {
    	return $this->clientes;
    }
    
    /**
     * Add Cliente
     *
     */
    public function addCliente($cliente)
    {
    
    	$this->clientes->add($cliente);
    }
    
    
    /**
     * Remove Cliente
     *
     */
    public function removeCliente($cliente)
    {
    	$this->clientes->removeElement($cliente);
    }
    
    
    /**
     * Get Proveedores
     *
     * @return array
     */
    public function getProveedores()
    {
    	return $this->proveedores;
    }
    
    /**
     * Add Proveedor
     *
     */
    public function addProveedor($proveedor)
    {

    	$this->proveedores->add($proveedor);
    }
    
    
    /**
     * Remove Proveedor
     *
     */
    public function removeProveedor($proveedor)
    {
    	$this->proveedores->removeElement($proveedor);
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
     * Add Site
     *
     */
    public function addSite( $site)
    {
    	$site->setEntidad($this);
    
    	$this->sites->add($site);
    }
    
    
    /**
     * Remove Site
     *
     */
    public function removeSite($site)
    {
    	$this->sites->removeElement($site);
    }
    
    
    /**
     * SET Entidades
     * @param Arrayr $entidades
     * @return Corporaciones
     */
    public function setEntidades( $entidades)
    {
    
    	$this->entidades = $entidades;
    	 
    	return this;
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
     * Set criteriosDefinicion
     *
     * @param Array $criteriosDefinicion
     * @return Entidades
     */
    public function setCriteriosDefinicion($criteriosDefinicion)
    {
    	$this->criteriosDefinicion = $criteriosDefinicion;
    
    	return $this;
    }
    
    /**
     * Get criteriosDefinicion
     *
     * @return integer
     */
    public function getCriteriosDefinicion()
    {
    	return $this->criteriosDefinicion;
    }
    
    /**
     * Add CriterioDefinicion
     *
     */
    public function addCriteriosDefinicion($criteriosDefinicion)
    {
    
    	$this->criteriosDefinicion->add($criteriosDefinicion);
    }
    
    
    /**
     * Remove CriterioDefinicion
     *
     */
    public function removeCriteriosDefinicion($criteriosDefinicion)
    {
    	$this->criteriosDefinicion->removeElement($criteriosDefinicion);
    }

    /**
     * Set corporacion
     *
     * @param \Xtending\EntityBundle\Entity\Corporaciones $corporacion
     * @return Entidades
     */
    public function setCorporacion($corporacion)
    {
        $this->corporacion = $corporacion;
    
        return $this;
    }

    /**
     * Get corporacion
     *
     * @return integer 
     */
    public function getCorporacion()
    {
        return $this->corporacion;
    }
    
    /**
     * Set corporacion
     *
     * @param \Xtending\EntityBundle\Entity\Corporaciones $corporacion
     * @return Entidades
     */
    public function addCorporacion($corporacion)
    {
    	$this->corporacion = $corporacion;
    
    	return $this;
    }
    

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Entidades
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
     * Set razonsocial
     *
     * @param string $razonsocial
     * @return Entidades
     */
    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;
    
        return $this;
    }

    /**
     * Get razonsocial
     *
     * @return string 
     */
    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    /**
     * Set descripcionempresa
     *
     * @param string $descripcionempresa
     * @return Entidades
     */
    public function setDescripcionempresa($descripcionempresa)
    {
        $this->descripcionempresa = $descripcionempresa;
    
        return $this;
    }

    /**
     * Get descripcionempresa
     *
     * @return string 
     */
    public function getDescripcionempresa()
    {
        return $this->descripcionempresa;
    }

    /**
     * Set descripcionproductos
     *
     * @param string $descripcionproductos
     * @return Entidades
     */
    public function setDescripcionproductos($descripcionproductos)
    {
    	$this->descripcionproductos = $descripcionproductos;
    
    	return $this;
    }
    
    /**
     * Get descripcionproductos
     *
     * @return string
     */
    public function getDescripcionproductos()
    {
    	return $this->descripcionproductos;
    }
    

    /**
     * Set email
     *
     * @param string $email
     * @return Entidades
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
     * Set idImpuestos
     *
     * @param string $idImpuestos
     * @return Entidades
     */
    public function setIdImpuestos($idImpuestos)
    {
    	$this->idImpuestos = $idImpuestos;
    
    	return $this;
    }
    
    /**
     * Get idImpuestos
     *
     * @return string
     */
    public function getIdImpuestos()
    {
    	return $this->idImpuestos;
    }

    /**
     * Set emailalternativo
     *
     * @param string $emailalternativo
     * @return Entidades
     */
    public function setEmailalternativo($emailalternativo)
    {
        $this->emailalternativo = $emailalternativo;
    
        return $this;
    }

    /**
     * Get emailalternativo
     *
     * @return string 
     */
    public function getEmailalternativo()
    {
        return $this->emailalternativo;
    }


    /**
     * Set pais
     *
     * @param \Xtending\EntityBundle\Entity\Paises $pais
     * @return Entidades
     */
    public function setPais($pais)
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
     * @return Entidades
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
     * @return Entidades
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
     * @return Entidades
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
     * Set telefonos
     *
     * @param string $telefonos
     * @return Entidades
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
     * Set codpostal
     *
     * @param string $codpostal
     * @return Entidades
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
     * Set url
     *
     * @param string $url
     * @return Entidades
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Entidades
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
     * @param string $fechaalta
     * @return Entidades
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;
    
        return $this;
    }

    /**
     * Get fechaalta
     *
     * @return string 
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

   
    /**
     * Set fechabaja
     *
     * @param string $fechabaja
     * @return Entidades
     */
    public function setFechabaja($fechabaja)
    {
        $this->fechabaja = $fechabaja;
    
        return $this;
    }

    /**
     * Get fechabaja
     *
     * @return string 
     */
    public function getFechabaja()
    {
        return $this->fechabaja;
    }

    /**
     * Set contactobajaId
     *
	 * @param \Xtending\EntityBundle\Entity\Contactos $contactobajaId
     * @return entidades
     */
    public function setContactobajaId($contactobajaId)
    {
        $this->contactobajaId = $contactobajaId;
    
        return $this;
    }

    /**
     * Get contactobajaId
     *
     * @return integer 
     */
    public function getContactobajaId()
    {
        return $this->contactobajaId;
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
    	return 'uploads/empresas/'.$this->id.'/';
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
    		// no se puede deducir la extensiï¿½n
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
    
    	// si hay un error al mover el archivo, move() automï¿½ticamente
    	// envï¿½a una excepciï¿½n. This will properly prevent
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
     * Obtiene los Ids de las entidades relacionadas de la empresa
     * @param string $tipoEmpresa
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
	public function getRelacionIds($tipoEmpresa,$corp = null) {
    	$entidadesId = new ArrayCollection();
    	if ($tipoEmpresa == XtendingConstantes::PROCESO_CLIENTE || $tipoEmpresa == XtendingConstantes::TIPO_FILTRO_CLIENTE){
    		$entidades = $this->getEmpresasCorporativas(XtendingConstantes::TIPO_FILTRO_CLIENTE);
    	} elseif ($tipoEmpresa == XtendingConstantes::PROCESO_PROVEEDOR || $tipoEmpresa == XtendingConstantes::TIPO_FILTRO_PROVEEDOR){
    		$entidades = $this->getEmpresasCorporativas(XtendingConstantes::TIPO_FILTRO_PROVEEDOR);
    	} elseif ($tipoEmpresa == XtendingConstantes::PROCESO_PROPIO) {
    		$entidades = $this->getEmpresasCorporativas(XtendingConstantes::PROCESO_PROPIO);
    	} else {
    		$entidades = array();
    		if ($corp != null){
    			$entidades = $this->corporacion->getEntidades();
    		} else {
    			$entidadesId->add($this->id);
    		}
    	}
    	
    	foreach ($entidades as $entidad) {
    		$entidadesId->add($entidad->getId());
    	}
    	return $entidadesId;
    }
    
    /**
     * Obtiene las empresas de la corporación
     * @param string $tipoEmpresa
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
	public function getEmpresasCorporativas($tipoEmpresa){
    	
    	$empresasCorporativas = new ArrayCollection();
    	if ($this->corporacion != null)
    	{
	    	$empresas = $this->corporacion->getEntidades();
	    	if ($tipoEmpresa == XtendingConstantes::TIPO_FILTRO_CLIENTE) {
	    		foreach ($empresas as $empresa) {
	    			$empresasCorporativas = $this->mergeEmpresas($empresasCorporativas, $empresa->getClientes());
	    		}
	    	} elseif ($tipoEmpresa == XtendingConstantes::TIPO_FILTRO_PROVEEDOR){
	    		foreach ($empresas as $empresa) {
	    			$empresasCorporativas = $this->mergeEmpresas($empresasCorporativas, $empresa->getProveedores());
	    		}
	    	} elseif ($tipoEmpresa == XtendingConstantes::PROCESO_PROPIO){
	    		foreach ($empresas as $empresa) {
	    			$empresasCorporativas = $this->mergeEmpresas($empresasCorporativas, $empresa->getProveedores());
	    		}
	    		foreach ($empresas as $empresa) {
	    			$empresasCorporativas = $this->mergeEmpresas($empresasCorporativas, $empresa->getClientes());
	    		}
	    		$empresasCorporativas = $this->mergeEmpresas($empresasCorporativas, $this->corporacion->getEntidades());
	    	} 
    	
    	} else {
    		$empresasCorporativas->add($this);
    	}
    	return $empresasCorporativas;
    }
    
    private function mergeEmpresas( $empresas,  $mergeEmpresas)
    {
    	foreach ($mergeEmpresas as $empresa) {
    		if(!$empresas->contains($empresa)){
    			$empresas->add($empresa);
    		}
    	}
    	return $empresas;
    }
    
    public function getStringCliente () {
    	return XtendingConstantes::CLIENTE_EMPRESA;
    }
    
    public function getStringProveedor () {
    	return XtendingConstantes::PROVEEDOR_EMPRESA;
    }
    
    /**
     * Set registrada
     *
     * @param integer $registrada
     * @return Entidades
     */
    public function setRegistrada($registrada)
    {
    	$this->registrada = $registrada;
    
    	return $this;
    }
    
    /**
     * Get registrada
     *
     * @return integer
     */
    public function getRegistrada()
    {
    	return $this->registrada;
    }
    
    /**
     * Set invitadaPor
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $entidad
     * @return Entidades
     */
    public function setInvitadaPor($entidad)
    {
    	$this->invitadaPor = $entidad;
    
    	return $this;
    }
    
    /**
     * Get invitadaPor
     *
     * @return Entidades
     */
    public function getInvitadaPor()
    {
    	return $this->invitadaPor;
    }
    
    
    
    /**
     * Get Nombre Entidad
     *
     * @return Nombre Entidad
     */
    public function getCodigoplanta()
    {
    	return $this->nombre;
    }
    
    public function getResponsables(Sites $site)
    {
    	$contactosSite = $site->getContactos()->toArray();
    	$responsablesSite = $site->getResponsables()->toArray();
    	
    	$responsables = new ArrayCollection();
    	foreach ($this->contactos as $contacto)
    	{
    		$disponible = 1;
    		if ((in_array($contacto, $contactosSite)) || (in_array($contacto, $responsablesSite)))
    		{
    			$disponible = 0;
    		}
    		
    		if ($disponible && is_null($contacto->getSite()))
    		{
    			$responsables[] = $contacto;
    		}
    	}
    	return $responsables;
    }
    
    /**
     * Indica si pueden editar la informaciÃ³n de la empresa
     * @param \Xtending\EntityBundle\Entity\Contactos $usuario
     * @return boolean
     */
    public function esEditable($usuario)
    {
    	$editable = false;
    	if ($usuario->getEntidad() != null && ($this->registrada != 1) && ($this->invitadaPor != null))
    	{
    		if (($usuario->getEntidad()->getId() == $this->invitadaPor->getId()) )
    		{
    			$editable = true;
    		}
    	}
    	return $editable;
    }
    
    public function getEntidadId()
    {
    	return $this->id;
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