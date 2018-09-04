<?php

namespace Amateur\ObjectBundle\Entity;

use Symfony\Component\Translation\Tests\String;

/**
 * Activity
 */
class EventPath
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $latitude;

    /**
     * @var string
     */
    protected $longitude;

    /**
     * @var string
     */
    protected $time;
    
    /**
     * @var string
     */
    protected $event;
    
    /**
     * @var User
     */
    protected $user;        protected $training;
    
    /**
     * 
     */
    protected $idPath;
	
	/**
	 * Get String
	 *
	 * @return String
	 */
	public function __toString() {
		return strval ( $this->id );
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getLatitude() {
		return $this->latitude;
	}
	public function setLatitude( $latitude) {
		$this->latitude = $latitude;
		return $this;
	}
	public function getLongitude() {
		return $this->longitude;
	}
	public function setLongitude( $longitude) {
		$this->longitude = $longitude;
		return $this;
	}
	public function getTime() {
		return $this->time;
	}
	public function setTime( $time) {
		$this->time = $time;
		return $this;
	}
	public function getEvent() {
		return $this->event;
	}
	public function setEvent( $event) {
		$this->event = $event;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser(User $user) {
		$this->user = $user;
		return $this;
	}
	public function getIdPath() {
		return $this->idPath;
	}
	public function setIdPath($idPath) {
		$this->idPath = $idPath;
		return $this;
	}
	public function getTraining() {
		return $this->training;
	}
	public function setTraining($training) {
		$this->training = $training;
		return $this;
	}	
	
	
	
	

   
}
