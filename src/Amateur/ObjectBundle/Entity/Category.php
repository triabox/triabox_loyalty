<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=300, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20, nullable=true)
     */
    protected $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     */
    protected $events;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_global", type="boolean", nullable=true)
     */
    protected $isGlobal;

    /**
     * @var String
     */
    protected $distanceTotal;
    
    /**
     * @var String
     */
    protected $distanceFirstRun;
    
    /**
     * @var String
     */
    protected $distanceLastRun;
    
    /**
     * @var String
     */
    protected $distanceSwim;
    
    /**
     * @var String
     */
    protected $distanceBike;


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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Category
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set isGlobal
     *
     * @param boolean $isGlobal
     * @return Category
     */
    public function setIsGlobal($isGlobal)
    {
        $this->isGlobal = $isGlobal;
    
        return $this;
    }

    /**
     * Get isGlobal
     *
     * @return boolean 
     */
    public function getIsGlobal()
    {
        return $this->isGlobal;
    }
	
	/**
	 *
	 * @return the integer
	 */
	public function getEvents() {
		return $this->events;
	}
	
	/**
	 *
	 * @param
	 *        	$events
	 */
	public function setEvents($events) {
		$this->events = $events;
		return $this;
	}
	
	/**
	 *
	 * @return the String
	 */
	public function getDistanceTotal() {
		return $this->distanceTotal;
	}
	
	/**
	 *
	 * @param String $distanceTotal        	
	 */
	public function setDistanceTotal( $distanceTotal) {
		$this->distanceTotal = $distanceTotal;
		return $this;
	}
	
	/**
	 *
	 * @return the String
	 */
	public function getDistanceFirstRun() {
		return $this->distanceFirstRun;
	}
	
	/**
	 *
	 * @param String $distanceFirstRun        	
	 */
	public function setDistanceFirstRun( $distanceFirstRun) {
		$this->distanceFirstRun = $distanceFirstRun;
		return $this;
	}
	
	/**
	 *
	 * @return the String
	 */
	public function getDistanceLastRun() {
		return $this->distanceLastRun;
	}
	
	/**
	 *
	 * @param String $distanceLastRun        	
	 */
	public function setDistanceLastRun( $distanceLastRun) {
		$this->distanceLastRun = $distanceLastRun;
		return $this;
	}
	
	/**
	 *
	 * @return the String
	 */
	public function getDistanceSwim() {
		return $this->distanceSwim;
	}
	
	/**
	 *
	 * @param String $distanceSwim        	
	 */
	public function setDistanceSwim( $distanceSwim) {
		$this->distanceSwim = $distanceSwim;
		return $this;
	}
	
	/**
	 *
	 * @return the String
	 */
	public function getDistanceBike() {
		return $this->distanceBike;
	}
	
	/**
	 *
	 * @param String $distanceBike        	
	 */
	public function setDistanceBike( $distanceBike) {
		$this->distanceBike = $distanceBike;
		return $this;
	}
	
	/**
	 * Get String
	 *
	 * @return String
	 */
	public function __toString() {
		return strval ( $this->name." ".$this->distanceFirstRun."k" );
	}
	
}