<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Paises
 */
class ConfigCustom
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
     * @var integer
     */
    private $tienePac;
    
    /**
     * @var integer
     */
    private $tieneResumen;
    
    /**
     * @var integer
     */
    private $tienePdf;
    
    /**
     * @var integer
     */
    private $tienePdfFull;
    
    /**
     * @var ArrayCollection
     */
    private $formulariosDefiniciones;
    
    /**
     * Contructor
     */
    public function __construct()
    {
    	$this->formulariosDefiniciones = new ArrayCollection();
    }
    
    /**
     * Get FormulariosDefiniciones
     *
     * @return array
     */
    public function getFormulariosDefiniciones()
    {
    	return $this->formulariosDefiniciones;
    }
    
    /**
     * Add FormulariosDefiniciones
     *
     */
    public function addFormulariosDefiniciones($fd)
    {
    
    	$this->formulariosDefiniciones->add($fd);
    }
    
    
    /**
     * Remove FormulariosDefiniciones
     *
     */
    public function removeFormulariosDefiniciones($fd)
    {
    	$this->formulariosDefiniciones->removeElement($fd);
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
     * @return Paises
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
     * Set tienePac
     *
     * @param integer $valor
     * @return ConfigCustom
     */
    public function setTienePac($valor)
    {
    	$this->tienePac = $valor;
    
    	return $this;
    }
    
    /**
     * Get tienePac
     *
     * @return integer
     */
    public function getTienePac()
    {
    	return $this->tienePac;
    }
    
    /**
     * Set tienePdf
     *
     * @param integer $valor
     * @return ConfigCustom
     */
    public function setTienePdf($valor)
    {
    	$this->tienePdf = $valor;
    
    	return $this;
    }
    
    /**
     * Get tienePdf
     *
     * @return integer
     */
    public function getTienePdf()
    {
    	return $this->tienePdf;
    }
    
    /**
     * Set tienePdfFull
     *
     * @param integer $valor
     * @return ConfigCustom
     */
    public function setTienePdfFull($valor)
    {
    	$this->tienePdfFull = $valor;
    
    	return $this;
    }
    
    /**
     * Get tienePdfFull
     *
     * @return integer
     */
    public function getTienePdfFull()
    {
    	return $this->tienePdfFull;
    }
    
    /**
     * Set tieneResumen
     *
     * @param integer $valor
     * @return ConfigCustom
     */
    public function setTieneResumen($valor)
    {
    	$this->tieneResumen = $valor;
    
    	return $this;
    }
    
    /**
     * Get tieneResumen
     *
     * @return integer
     */
    public function getTieneResumen()
    {
    	return $this->tieneResumen;
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
