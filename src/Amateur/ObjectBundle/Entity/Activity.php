<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * Activity
 */
class Activity
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var string
     */
    protected $distance;

    /**
     * @var string
     */
    protected $time;
    
    /**
     * @var string
     */
    protected $sport;
    
    /**
     * @var string
     */
    protected  $newsUser;
    
   


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
	 * @return \Amateur\ObjectBundle\Entity\string
	 */
	public function getComment() {
		return $this->comment;
	}
	/**
	 * @param String $comment
	 * @return \Amateur\ObjectBundle\Entity\Activity
	 */
	public function setComment( $comment) {
		$this->comment = $comment;
		return $this;
	}
	/**
	 * @return \Amateur\ObjectBundle\Entity\String
	 */
	public function getDistance() {
		return $this->distance;
	}
	/**
	 * @param String $distance
	 * @return \Amateur\ObjectBundle\Entity\Activity
	 */
	public function setDistance($distance) {
		$this->distance = $distance;
		return $this;
	}
	/**
	 * @return \Amateur\ObjectBundle\Entity\string
	 */
	public function getTime() {
		return $this->time;
	}
	/**
	 * @param string $time
	 * @return \Amateur\ObjectBundle\Entity\Activity
	 */
	public function setTime( $time) {
		$this->time = $time;
		return $this;
	}
	/**
	 * @return \Amateur\ObjectBundle\Entity\Sport
	 */
	public function getSport() {
		return $this->sport;
	}
	/**
	 * @param Sport $sport
	 * @return \Amateur\ObjectBundle\Entity\Activity
	 */
	public function setSport( $sport) {
		$this->sport = $sport;
		return $this;
	}
	/**
	 * @return \Amateur\ObjectBundle\Entity\NewsUser
	 */
	public function getNewsUser() {
		return $this->newsUser;
	}
	/**
	 * @param NewsUser $newsUser
	 * @return \Amateur\ObjectBundle\Entity\Activity
	 */
	public function setNewsUser( $newsUser) {
		$this->newsUser = $newsUser;
		return $this;
	}
	
	/**
	 * Get String
	 *
	 * @return String
	 */
	public function __toString() {
		return strval ( $this->id );
	}
	

   
}
