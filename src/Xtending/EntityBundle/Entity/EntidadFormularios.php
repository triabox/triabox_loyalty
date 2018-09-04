<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadFormularios
 */
class EntidadFormularios
{
    /**
     * @var integer
     */
    private $id;

   

    /**
     * @var \DateTime
     */
    private $fecha;

  
    /**
     * @var \Xtending\EntityBundle\Entity\Entidades
     */
    private $entidad;

  
    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     */
    private $formulariodefinicion;
    
    /**
     * @var string
     */
    private $esProveedor;
    
    /**
     * @var string
     */
    private $soyProveedor;
    
    /**
     * @var string
     */
    private $esProveedorProducto;
    
    /**
     * @var string
     */
    private $esCliente;
    
    /**
     * @var string
     */
    private $soyCliente;
    
    /**
     * @var string
     */
    private $esClienteProducto;
    
    
    /**
     * @var string
     */
    private $esPropioSite;
    
    /**
     * @var string
     */
    private $esPropioEmpresa;
    
    /**
     * @var integer
     */
    private $esPropioProducto;
    
    /**
     * @var Entidades
     */
    private $entidadesCompartidas;
    
    /**
     * @var integer
     */
    private $esPrivada;
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	
    	$this->entidadesCompartidas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @inheritDoc
     */
    public function getEntidadesCompartidas()
    {
    	return $this->entidadesCompartidas;
    }
    
    /**
     * Set $role
     *
     * @param string $role
     * @return EntidadFormularios
     */
    public function setEntidadesCompartidas($entidadesCompartidas)
    {
    	$this->entidadesCompartidas = $entidadesCompartidas;
    
    	return $this;
    }
    

  
    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return EntidadFormularios
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

   

    /**
     * Set entidad
     *
     * @param \Xtending\EntityBundle\Entity\Entidades $entidad
     * @return EntidadFormularios
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
     * Set formulariodefinicion
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosDefiniciones $formulariodefinicion
     * @return EntidadFormularios
     */
    public function setFormulariodefinicion(\Xtending\EntityBundle\Entity\FormulariosDefiniciones $formulariodefinicion = null)
    {
        $this->formulariodefinicion = $formulariodefinicion;
    
        return $this;
    }

    /**
     * Get formulariodefinicion
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosDefiniciones 
     */
    public function getFormulariodefinicion()
    {
        return $this->formulariodefinicion;
    }

    
    /**
     * Get String ID
     *
     * @return integer
     */
    public function __toString()
    {
    	return strval($this->id);
    }
    
    /**
     * Set esProveedor
     *
     * @param string $esProveedor
     * @return EntidadFormularios
     */
    public function setEsProveedor($esProveedor)
    {
    	$this->esProveedor = $esProveedor;
    
    	return $this;
    }
    
    /**
     * Get esProveedor
     *
     * @return string
     */
    public function getEsProveedor()
    {
    	return $this->esProveedor;
    }
    
    /**
     * Set esPrivada
     *
     * @param boolean $esPrivada
     * @return EntidadFormularios
     */
    public function setEsPrivada($esPrivada)
    {
    	$this->esPrivada = $esPrivada;
    
    	return $this;
    }
    
    /**
     * Get esPrivada
     *
     * @return boolean
     */
    public function getEsPrivada()
    {
    	return $this->esPrivada;
    }
    
    
    
    
    /**
     * Set SoyProveedor
     *
     * @param string $proveedor
     * @return EntidadFormularios
     */
    public function setSoyProveedor($proveedor)
    {
    	$this->soyProveedor = $proveedor;
    
    	return $this;
    }
    
    /**
     * Get SoyProveedor
     *
     * @return string
     */
    public function getSoyProveedor()
    {
    	return $this->soyProveedor;
    }
    
    /**
     * Set esProveedorProducto
     *
     * @param string $esProveedorProducto
     * @return EntidadFormularios
     */
    public function setEsProveedorProducto($esProveedorProducto)
    {
    	$this->esProveedorProducto = $esProveedorProducto;
    
    	return $this;
    }
    
    /**
     * Get esProveedorProducto
     *
     * @return string
     */
    public function getEsProveedorProducto()
    {
    	return $this->esProveedorProducto;
    }
    
    /**
     * Set esCliente
     *
     * @param string $esCliente
     * @return EntidadFormularios
     */
    public function setEsCliente($esCliente)
    {
    	$this->esCliente = $esCliente;
    
    	return $this;
    }
    
    /**
     * Get esCliente
     *
     * @return string
     */
    public function getEsCliente()
    {
    	return $this->esCliente;
    }
    
    /**
     * Set soyCliente
     *
     * @param string $cliente
     * @return EntidadFormularios
     */
    public function setSoyCliente($cliente)
    {
    	$this->soyCliente = $cliente;
    
    	return $this;
    }
    
    /**
     * Get esClienteEmpresa
     *
     * @return string
     */
    public function getSoyCliente()
    {
    	return $this->soyCliente;
    }
    
    /**
     * Set esClienteProducto
     *
     * @param string $esClienteProducto
     * @return EntidadFormularios
     */
    public function setEsClienteProducto($esClienteProducto)
    {
    	$this->esClienteProducto = $esClienteProducto;
    
    	return $this;
    }
    
    /**
     * Get esClienteProducto
     *
     * @return string
     */
    public function getEsClienteProducto()
    {
    	return $this->esClienteProducto;
    }
    
    /**
     * Set esPropioSite
     *
     * @param string $esPropioSite
     * @return EntidadFormularios
     */
    public function setEsPropioSite($esPropioSite)
    {
    	$this->esPropioSite = $esPropioSite;
    
    	return $this;
    }
    
    /**
     * Get esPropioSite
     *
     * @return string
     */
    public function getEsPropioSite()
    {
    	return $this->esPropioSite;
    }
    
    /**
     * Set esPropioEmpresa
     *
     * @param string $esPropioEmpresa
     * @return EntidadFormularios
     */
    public function setEsPropioEmpresa($esPropioEmpresa)
    {
    	$this->esPropioEmpresa = $esPropioEmpresa;
    
    	return $this;
    }
    
    /**
     * Get esPropioEmpresa
     *
     * @return string
     */
    public function getEsPropioEmpresa()
    {
    	return $this->esPropioEmpresa;
    }
    
    /**
     * Set esPropioProducto
     *
     * @param string $esPropioProducto
     * @return EntidadFormularios
     */
    public function setEsPropioProducto($esPropioProducto)
    {
    	$this->esPropioProducto = $esPropioProducto;
    
    	return $this;
    }
    
    /**
     * Get esPropioProducto
     *
     * @return string
     */
    public function getEsPropioProducto()
    {
    	return $this->esPropioProducto;
    }
}
