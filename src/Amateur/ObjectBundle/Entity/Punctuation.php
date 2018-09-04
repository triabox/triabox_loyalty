<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Punctuation
 */
class Punctuation
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $location;

    /**
     * @var integer
     */
    protected $circuit;

    /**
     * @var integer
     */
    protected $organization;

    /**
     * @var integer
     */
    protected $nutrition;

    /**
     * @var integer
     */
    protected $punctuality;

    /**
     * @var integer
     */
    protected $assistance;

    /**
     * @var integer
     */
    protected $kit;
    
    /**
     * @var integer
     */
    protected $total;    

    /**
     * @var string
     */
    protected $mostPositive;

    /**
     * @var string
     */
    protected $mostNegative;

    /**
     * @var string
     */
    protected $comment;


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
     * Set location
     *
     * @param integer $location
     * @return Punctuation
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return integer 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set circuit
     *
     * @param integer $circuit
     * @return Punctuation
     */
    public function setCircuit($circuit)
    {
        $this->circuit = $circuit;
    
        return $this;
    }

    /**
     * Get circuit
     *
     * @return integer 
     */
    public function getCircuit()
    {
        return $this->circuit;
    }

    /**
     * Set organization
     *
     * @param integer $organization
     * @return Punctuation
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return integer 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set nutrition
     *
     * @param integer $nutrition
     * @return Punctuation
     */
    public function setNutrition($nutrition)
    {
        $this->nutrition = $nutrition;
    
        return $this;
    }

    /**
     * Get nutrition
     *
     * @return integer 
     */
    public function getNutrition()
    {
        return $this->nutrition;
    }

    /**
     * Set punctuality
     *
     * @param integer $punctuality
     * @return Punctuation
     */
    public function setPunctuality($punctuality)
    {
        $this->punctuality = $punctuality;
    
        return $this;
    }

    /**
     * Get punctuality
     *
     * @return integer 
     */
    public function getPunctuality()
    {
        return $this->punctuality;
    }

    /**
     * Set assistance
     *
     * @param integer $assistance
     * @return Punctuation
     */
    public function setAssistance($assistance)
    {
        $this->assistance = $assistance;
    
        return $this;
    }

    /**
     * Get assistance
     *
     * @return integer 
     */
    public function getAssistance()
    {
        return $this->assistance;
    }

    /**
     * Set kit
     *
     * @param integer $kit
     * @return Punctuation
     */
    public function setKit($kit)
    {
        $this->kit = $kit;
    
        return $this;
    }

    /**
     * Get kit
     *
     * @return integer 
     */
    public function getKit()
    {
        return $this->kit;
    }

    /**
     * Set mostPositive
     *
     * @param string $mostPositive
     * @return Punctuation
     */
    public function setMostPositive($mostPositive)
    {
        $this->mostPositive = $mostPositive;
    
        return $this;
    }

    /**
     * Get mostPositive
     *
     * @return string 
     */
    public function getMostPositive()
    {
        return $this->mostPositive;
    }

    /**
     * Set mostNegative
     *
     * @param string $mostNegative
     * @return Punctuation
     */
    public function setMostNegative($mostNegative)
    {
        $this->mostNegative = $mostNegative;
    
        return $this;
    }

    /**
     * Get mostNegative
     *
     * @return string 
     */
    public function getMostNegative()
    {
        return $this->mostNegative;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Punctuation
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }
	public function getTotal() {
		return $this->total;
	}
	public function setTotal($total) {
		$this->total = $total;
		return $this;
	}
	
}
