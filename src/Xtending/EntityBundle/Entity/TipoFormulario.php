<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paises
 */
class TipoFormulario
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
     * Set sigla
     *
     * @param string $sigla
     * @return Paises
     */
    public function setSigla($sigla)
    {
    	$this->sigla = $sigla;
    
    	return $this;
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
