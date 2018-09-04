<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * Activity
 */
class ActivityLogUsers
{
    /**
     * @var integer
     */
    protected $id;

   
    protected $comment;

    protected $section;

  
    protected $page;
    
   
    protected $date;
    
  
    protected  $user;
    
   


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
	 * Get String
	 *
	 * @return String
	 */
	public function __toString() {
		return strval ( $this->id );
	}
	public function getComment() {
		return $this->comment;
	}
	public function setComment($comment) {
		$this->comment = $comment;
		return $this;
	}
	public function getSection() {
		return $this->section;
	}
	public function setSection($section) {
		$this->section = $section;
		return $this;
	}
	public function getPage() {
		return $this->page;
	}
	public function setPage($page) {
		$this->page = $page;
		return $this;
	}
	public function getDate() {
		return $this->date;
	}
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	
	

   
}
