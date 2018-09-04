<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodigoFd
 */
class CodigoFD
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $tipoA;

    /**
     * @var string
     */
    private $caracterA;
    
    /**
     * @var integer
     */
    private $tipoB;
    
    /**
     * @var string
     */
    private $caracterB;
    
    /**
     * @var integer
     */
    private $tipoC;
    
    /**
     * @var string
     */
    private $caracterC;
    
    /**
     * @var integer
     */
    private $tipoD;
    
    /**
     * @var string
     */
    private $caracterD;
    
    /**
     * @var integer
     */
    private $tipoE;
    
    /**
     * @var string
     */
    private $caracterE;
    
    /**
     * @var \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     */
    private $formularioDefinicion;

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
     * Set formularioDefinicion
     *
     * @param \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     * @return Alerta
     */
    public function setFormularioDefinicion(FormulariosDefiniciones $formulario)
    {
    	$this->formularioDefinicion = $formulario;
    
    	return $this;
    }
    
    /**
     * Get formularioDefinicion
     *
     * @return \Xtending\EntityBundle\Entity\FormulariosDefiniciones
     */
    public function getFormularioDefinicion()
    {
    	return $this->formularioDefinicion;
    }

    /**
     * Set tipoA
     *
     * @param integer $tipo
     * @return CodigoFD
     */
    public function setTipoA($tipo)
    {
        $this->tipoA = $tipo;
    
        return $this;
    }

    /**
     * Get tipoA
     *
     * @return integer 
     */
    public function getTipoA()
    {
        return $this->tipoA;
    }
    
    /**
     * Set caracterA
     *
     * @param string $caracter
     * @return CodigoFD
     */
    public function setCaracterA($caracter)
    {
        $this->caracterA = $caracter;
    
        return $this;
    }

    /**
     * Get caracterA
     *
     * @return string 
     */
    public function getCaracterA()
    {
        return $this->caracterA;
    }
    
    /**
     * Set tipoB
     *
     * @param integer $tipo
     * @return CodigoFD
     */
    public function setTipoB($tipo)
    {
    	$this->tipoB = $tipo;
    
    	return $this;
    }
    
    /**
     * Get tipoB
     *
     * @return integer
     */
    public function getTipoB()
    {
    	return $this->tipoB;
    }
    
    /**
     * Set caracterB
     *
     * @param string $caracter
     * @return CodigoFD
     */
    public function setCaracterB($caracter)
    {
    	$this->caracterB = $caracter;
    
    	return $this;
    }
    
    /**
     * Get caracterB
     *
     * @return string
     */
    public function getCaracterB()
    {
    	return $this->caracterB;
    }
    
    /**
     * Set tipoC
     *
     * @param integer $tipo
     * @return CodigoFD
     */
    public function setTipoC($tipo)
    {
    	$this->tipoC = $tipo;
    
    	return $this;
    }
    
    /**
     * Get tipoC
     *
     * @return integer
     */
    public function getTipoC()
    {
    	return $this->tipoC;
    }
    
    /**
     * Set caracterC
     *
     * @param string $caracter
     * @return CodigoFD
     */
    public function setCaracterC($caracter)
    {
    	$this->caracterC = $caracter;
    
    	return $this;
    }
    
    /**
     * Get caracterC
     *
     * @return string
     */
    public function getCaracterC()
    {
    	return $this->caracterC;
    }
    
    /**
     * Set tipoD
     *
     * @param integer $tipo
     * @return CodigoFD
     */
    public function setTipoD($tipo)
    {
    	$this->tipoD = $tipo;
    
    	return $this;
    }
    
    /**
     * Get tipoD
     *
     * @return integer
     */
    public function getTipoD()
    {
    	return $this->tipoD;
    }
    
    /**
     * Set caracterD
     *
     * @param string $caracter
     * @return CodigoFD
     */
    public function setCaracterD($caracter)
    {
    	$this->caracterD = $caracter;
    
    	return $this;
    }
    
    /**
     * Get caracterD
     *
     * @return string
     */
    public function getCaracterD()
    {
    	return $this->caracterD;
    }
    
    /**
     * Set tipoE
     *
     * @param integer $tipo
     * @return CodigoFD
     */
    public function setTipoE($tipo)
    {
    	$this->tipoE = $tipo;
    
    	return $this;
    }
    
    /**
     * Get tipoE
     *
     * @return integer
     */
    public function getTipoE()
    {
    	return $this->tipoE;
    }
    
    /**
     * Set caracterE
     *
     * @param string $caracter
     * @return CodigoFD
     */
    public function setCaracterE($caracter)
    {
    	$this->caracterE = $caracter;
    
    	return $this;
    }
    
    /**
     * Get caracterE
     *
     * @return string
     */
    public function getCaracterE()
    {
    	return $this->caracterE;
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
}
