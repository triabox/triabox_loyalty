<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classification
 *
 * @ORM\Table(name="classification")
 * @ORM\Entity
 */
class Classification
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
     * @ORM\Column(name="name", type="string", length=600, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=300, nullable=true)
     */
    protected $categoryName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="official_time", type="datetime", nullable=true)
     */
    protected $officialTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="neto_time", type="datetime", nullable=true)
     */
    protected $netoTime;

    /**
     * @var string
     *
     * @ORM\Column(name="classificationcol", type="string", length=20, nullable=true)
     */
    protected $classificationcol;

    /**
     * @var string
     *
     * @ORM\Column(name="extra_data", type="string", length=2000, nullable=true)
     */
    protected $extraData;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=20, nullable=true)
     */
    protected $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=300, nullable=true)
     */
    protected $lastname;

    /**
     * @var Event
     */
    protected $event;
    
    
    /**
     * @var string
     *
     */
    protected $overallRank;
    
   
    /**
     * @var string
     *
     */
    protected $divRank;
    
    
    /**
     * @var string
     *
     */
    protected $bib;

    /**
     * @var string
     */
    protected $nationality;
    /**
     * @var string
     *
     */
    protected $swim;
    
    /**
     * @var string
     *
     */
    protected $bike;
    
    /**
     * @var string
     *
     */
    protected $runFirst;
    
    /**
     * @var string
     *
     */
    protected $runLast;
    
    /**
     * @var integer
     *
     */
    protected $isUser;
    
    
    protected $enrolled;
    

    /**
     * Add Event
     *
     * @return Classification
     */
    public function addEvent(Event $event)
    {
    	$this->event = $event;
    
    	return $this;
    }
    
    
    
    /**
     * Get Event
     *
     * @return Event
     */
    public function getEvent()
    {
    	return $this->event;
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
     * Set name
     *
     * @param string $name
     * @return Classification
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
     * Set categoryName
     *
     * @param string $categoryName
     * @return Classification
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    
        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string 
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set officialTime
     *
     * @param \DateTime $officialTime
     * @return Classification
     */
    public function setOfficialTime($officialTime)
    {
        $this->officialTime = $officialTime;
    
        return $this;
    }

    /**
     * Get officialTime
     *
     * @return \DateTime 
     */
    public function getOfficialTime()
    {
        return $this->officialTime;
    }

    /**
     * Set netoTime
     *
     * @param \DateTime $netoTime
     * @return Classification
     */
    public function setNetoTime($netoTime)
    {
        $this->netoTime = $netoTime;
    
        return $this;
    }

    /**
     * Get netoTime
     *
     * @return \DateTime 
     */
    public function getNetoTime()
    {
        return $this->netoTime;
    }

    /**
     * Set classificationcol
     *
     * @param string $classificationcol
     * @return Classification
     */
    public function setClassificationcol($classificationcol)
    {
        $this->classificationcol = $classificationcol;
    
        return $this;
    }

    /**
     * Get classificationcol
     *
     * @return string 
     */
    public function getClassificationcol()
    {
        return $this->classificationcol;
    }

    /**
     * Set extraData
     *
     * @param string $extraData
     * @return Classification
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;
    
        return $this;
    }

    /**
     * Get extraData
     *
     * @return string 
     */
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Classification
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    
        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Classification
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    /**
     * @var integer
     */
    protected $categoryId;


    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Classification
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    
        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
	
	/**
	 *
	 * @param Event $event        	
	 */
	public function setEvent(Event $event) {
		$this->event = $event;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getOverallRank() {
		return $this->overallRank;
	}
	
	/**
	 *
	 * @param string $overallRank        	
	 */
	public function setOverallRank($overallRank) {
		$this->overallRank = $overallRank;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getDivRank() {
		return $this->divRank;
	}
	
	/**
	 *
	 * @param string $divRank        	
	 */
	public function setDivRank( $divRank) {
		$this->divRank = $divRank;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getBib() {
		return $this->bib;
	}
	
	/**
	 *
	 * @param string $bib        	
	 */
	public function setBib( $bib) {
		$this->bib = $bib;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getSwim() {
		return $this->swim;
	}
	
	/**
	 *
	 * @param string $swim        	
	 */
	public function setSwim( $swim) {
		$this->swim = $swim;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getBike() {
		return $this->bike;
	}
	
	/**
	 *
	 * @param string $bike        	
	 */
	public function setBike( $bike) {
		$this->bike = $bike;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getRunFirst() {
		return $this->runFirst;
	}
	
	/**
	 *
	 * @param string $runFirst        	
	 */
	public function setRunFirst( $runFirst) {
		$this->runFirst = $runFirst;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getRunLast() {
		return $this->runLast;
	}
	
	/**
	 *
	 * @param string $runLast        	
	 */
	public function setRunLast( $runLast) {
		$this->runLast = $runLast;
		return $this;
	}
	public function getIsUser() {
		return $this->isUser;
	}
	public function setIsUser($isUser) {
		$this->isUser = $isUser;
		return $this;
	}
	public function getNationality() {
		return $this->nationality;
	}
	public function setNationality($nationality) {
		$this->nationality = $nationality;
		return $this;
	}
	
	public function getSecondsNetoTime(){
	
		list($horas, $minutos, $segundos) = array_pad(explode(':', $this->netoTime,3), 3, null);;
		$hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;
	
		return  $hora_en_segundos;
	}
	
	public function setSecondsNetoTime(){
	
		// 		list($horas, $minutos, $segundos) = array_pad(explode(':', $this->time,2), 2, null);;
		// 		$hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;
	
		return  "36000";
	}
	public function getEnrolled() {
		return $this->enrolled;
	}
	public function setEnrolled($enrolled) {
		$this->enrolled = $enrolled;
		return $this;
	}
		
	
	
}