<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Activity
 */
class ReportsSport
{
    /**
     * @var integer
     */
    protected $sport;

    /**
     * @var string
     */
    protected $distance;

    /**
     * @var ArrayCollection
     */
    protected $enrolleds;
    


    public function __construct()
    {
    	$this->enrolleds = new ArrayCollection();
    }
    
    
	public function getSport() {
		return $this->sport;
	}
	
	public function setSport($sport) {
		$this->sport = $sport;
		return $this;
	}
	
	public function getDistance() {
		return $this->distance;
	}
	
	public function setDistance( $distance) {

		$this->distance = $distance;
		return $this;
	}
	
	public function getEnrolleds() {
		return $this->enrolleds;
	}
	
	public function setEnrolleds( $enrolleds) {
		$this->enrolleds = $enrolleds;
		return $this;
	}
	
	

   
}
