<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * CriterioDefinicion
 */
class CriterioDefinicion
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
    private $tipo;

    /**
     * @var string
     */
    private $esProveedorSite;

    /**
     * @var string
     */
    private $esProveedorEmpresa;
    
    /**
     * @var string
     */
    private $esProveedorProducto;
    
    /**
     * @var string
     */
    private $esProveedorContacto;
    
    /**
     * @var string
     */
    private $esClienteSite;
    
    /**
     * @var string
     */
    private $esClienteEmpresa;

    /**
     * @var string
     */
    private $esClienteProducto;
    
    /**
     * @var string
     */
    private $esClienteContacto;

 
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
     * @var integer
     */
    private $esPropioContacto;
   
    
    /**
     * @var array
     */
    private $labelsCaratula;
    
    /**
     * @var array
     */
    private $empresas;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->labelsCaratula = new \Doctrine\Common\Collections\ArrayCollection();
    	$this->empresas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @inheritDoc
     */
    public function getEmpresas()
    {
    	return $this->empresas;
    }
    
    /**
     * Set $role
     *
     * @param string $role
     * @return Contactos
     */
    public function setEmpresas($empresas)
    {
    	$this->empresas = $empresas;
    
    	return $this;
    }
    
    
    
    /**
     * @var boolean
     */
    private $activo;
    
  
    
    /**
     * Set caratula
     *
     * @param string $caratula
     * @return FormulariosDefiniciones
     */
    public function setCaratula($caratula)
    {
    	$this->caratula = $caratula;
    
    	return $this;
    }
    
    /**
     * Get caratula
     *
     * @return string
     */
    public function getCaratula()
    {
    	return $this->caratula;
    }
    
  	/**
     * Set activo
     *
     * @param boolean $activo
     * @return FormulariosDefiniciones
     */
    public function setActivo($activo)
    {
    	if ($this->activo == 1) {
        	$this->activo = 0;
        }else{
        	$this->activo = 1;
        }

    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
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
     * @return CriterioDefinicion
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
     * Set esProveedorSite
     *
     * @param string $esProveedorSite
     * @return CriterioDefinicion
     */
    public function setEsProveedorSite($esProveedorSite)
    {
        $this->esProveedorSite = $esProveedorSite;
    
        return $this;
    }

    /**
     * Get esProveedorSite
     *
     * @return string 
     */
    public function getEsProveedorSite()
    {
        return $this->esProveedorSite;
    }

    /**
     * Set esProveedorEmpresa
     *
     * @param string $esProveedorEmpresa
     * @return CriterioDefinicion
     */
    public function setEsProveedorEmpresa($esProveedorEmpresa)
    {
        $this->esProveedorEmpresa = $esProveedorEmpresa;
    
        return $this;
    }

    /**
     * Get esProveedorEmpresa
     *
     * @return string 
     */
    public function getEsProveedorEmpresa()
    {
        return $this->esProveedorEmpresa;
    }

    /**
     * Set esProveedorProducto
     *
     * @param string $esProveedorProducto
     * @return CriterioDefinicion
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
     * Set esClienteSite
     *
     * @param string $esClienteSite
     * @return CriterioDefinicion
     */
    public function setEsClienteSite($esClienteSite)
    {
        $this->esClienteSite = $esClienteSite;
    
        return $this;
    }

    /**
     * Get esClienteSite
     *
     * @return string 
     */
    public function getEsClienteSite()
    {
        return $this->esClienteSite;
    }

    /**
     * Set esClienteEmpresa
     *
     * @param string $esClienteEmpresa
     * @return CriterioDefinicion
     */
    public function setEsClienteEmpresa($esClienteEmpresa)
    {
        $this->esClienteEmpresa = $esClienteEmpresa;
    
        return $this;
    }

    /**
     * Get esClienteEmpresa
     *
     * @return string 
     */
    public function getEsClienteEmpresa()
    {
        return $this->esClienteEmpresa;
    }

    /**
     * Set esClienteProducto
     *
     * @param string $esClienteProducto
     * @return CriterioDefinicion
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
     * @return CriterioDefinicion
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
     * @return CriterioDefinicion
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
     * @return CriterioDefinicion
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
    
    /**
     * Get esProveedorContacto
     *
     * @return string
     */
    public function getEsProveedorContacto()
    {
    	return $this->esProveedorContacto;
    }
    
    /**
     * Set esProveedorContacto
     *
     * @param string $esProveedorContacto
     * @return CriterioDefinicion
     */
    public function setEsProveedorContacto($esProveedorContacto)
    {
    	$this->esProveedorContacto = $esProveedorContacto;
    
    	return $this;
    }
    
    /**
     * Get esClienteContacto
     *
     * @return string
     */
    public function getEsClienteContacto()
    {
    	return $this->esClienteContacto;
    }
    
    /**
     * Set esClienteContacto
     *
     * @param string $esClienteContacto
     * @return CriterioDefinicion
     */
    public function setEsClienteContacto($esClienteContacto)
    {
    	$this->esClienteContacto = $esClienteContacto;
    
    	return $this;
    }
    
    /**
     * Get esPropioContacto
     *
     * @return string
     */
    public function getEsPropioContacto()
    {
    	return $this->esPropioContacto;
    }
    
    /**
     * Set esPropioContacto
     *
     * @param string $esPropioContacto
     * @return CriterioDefinicion
     */
    public function setEsPropioContacto($esPropioContacto)
    {
    	$this->esPropioContacto = $esPropioContacto;
    
    	return $this;
    }
    

/**
     * Get LabelsCaratula
     *
     * @return array 
     */
    public function getLabelsCaratula()
    {
        return $this->labelsCaratula;
    }
    
	/**
     * Add LabelsCaratula
     *
     * @return LabelsCaratula
     */
	public function addLabelsCaratulon($label)
    {
    	$label->addCriterioDefinicion($this);
    	
        $this->labelsCaratula->add($label);
    }

     /**
     * Remove 
     *
     */
    public function removeLabelsCaratulon($label)
    {
    	$this->labelsCaratula->removeElement($label);
    }
    
}