<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * Enrolled
 *
 * @ORM\Table(name="enrolled")
 * @ORM\Entity
 */
class Enrolled
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
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     */
    protected $event;

    /**
     * @var Classification
     *
     * 
     */
    protected $classification;        /**        * @var Payment        *        *        */        protected $payment;        

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    protected $number;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20, nullable=true)
     */
    protected $code;
    
    /**
     * @var String
     * 
     * @ORM\Column(name="time", type="string", length=50, nullable=true)
     */
    protected $time;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    protected $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    protected $user;



    /**
     * @var Punctuation
     */
    protected $punctuation;
    
    
    protected $objetive;
    
   	protected $entry;		protected $available;
    
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
     * Set number
     *
     * @param integer $number
     * @return Enrolled
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Enrolled
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get Time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }
    
    /**
     * Set Time
     *
     * @param string $code
     * @return Enrolled
     */
    public function setTime($time)
    {
    	$this->time = $time;
    
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
     * Set category
     *
     * @param integer $category
     * @return Enrolled
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }

    


   
	
	/**
	 *
	 * @return the integer
	 */
	public function getUser() {
		return $this->user;
	}
	
	/**
	 *
	 * @param
	 *        	$user
	 */
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getEvent() {
		return $this->event;
	}
	
	/**
	 *
	 * @param
	 *        	$event
	 */
	public function setEvent($event) {
		$this->event = $event;
		return $this;
	}
	public function getClassification() {
		return $this->classification;
	}
	public function setClassification(Classification $classification) {
		$this->classification = $classification;
		return $this;
	}
	
	/**
	 *
	 * @return the Punctuation
	 */
	public function getPunctuation() {
		return $this->punctuation;
	}
	
	/**
	 *
	 * @param Punctuation $punctuation        	
	 */
	public function setPunctuation(Punctuation $punctuation) {
		$this->punctuation = $punctuation;
		return $this;
	}
	
	/**
	 * Get String
	 *
	 * @return String
	 */
	public function __toString() {
		return strval ( $this->id);
	}
	
	public function getSeconds(){
		
		list($horas, $minutos, $segundos) = array_pad(explode(':', $this->time,3), 3, null);;
		$hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;
		
		return  $hora_en_segundos;
	}
	
	public function setSeconds(){
	
		// 		list($horas, $minutos, $segundos) = array_pad(explode(':', $this->time,2), 2, null);;
		// 		$hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;
	
		return  "36000";
	}
	public function getObjetive() {
		return $this->objetive;
	}
	public function setObjetive($objetive) {
		$this->objetive = $objetive;
		return $this;
	}
	public function getPayment() {
		return $this->payment;
	}
	public function setPayment(Payment $payment) {
		$this->payment = $payment;
		return $this;
	}
	public function getEntry() {
		return $this->entry;
	}
	public function setEntry($entry) {
		$this->entry = $entry;
		return $this;
	}
	public function getAvailable() {
		return $this->available;
	}
	public function setAvailable($available) {
		$this->available = $available;
		return $this;
	}			
	
	
	
}