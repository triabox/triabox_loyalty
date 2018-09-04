<?php



namespace Amateur\ObjectBundle\Entity;



use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Translation\Tests\String;





/**

 * Training

 *

 */

class Training

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

     */

    protected $name;



   	protected $isFinish; 

    /**

     * @var string

     *

     */

    protected $startTime;



    /**

     * @var \DateTime

     *

     */

    protected $createTime;



    /**

     * @var string

     *

     */

    protected $distance;

    

    

    protected $speed;



    /**

     * @var string

     *


     */

    protected $calories;



    /**

     * @var String

     */

    protected $idMobile;

    /**

     * @var string

     *

     */

    

    protected $startHs;

    /**
    
    * Result event
    
    *
    
    * @var ArrayCollection
    
    */
    
    protected $paths;

    

    /**

     *

     * @var User

     */

    protected $user;

    

    /**

     * @var Sport

     */

    protected $sport;
    
    
	protected $time;

   
    
    
    /**
    
    *
    
    * @return the ArrayCollection
    
    */
    
    public function getPaths() {
    
    	return $this->paths;
    
    }
    
    
    
    /**
    
    *
    
    * @param ArrayCollection $paths
    
    */
    
    public function setPaths( $paths) {
    
    	$this->paths = $paths;
    
    	return $this;
    
    }
    
    
    
    /**
    
    * Add Paths
    
    *
    
    * @return Paths
    
    */
    
    public function addEventPath(EventPath $paths)
    {
    	$paths->addTraining($this);
    	$this->paths->add($paths);
    }
    
    
    
    /**
    
    * Remove paths
    
    *
    
    */
    
    public function removeEventPath(EventPath $paths)
    
    {
    
    	$this->paths->removeElement($paths);
    
    }


    

    public function __construct()

    {
    	
    	$this->paths= new ArrayCollection();
    	

    }
	public function getId() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}
	public function setName( $name) {
		$this->name = $name;
		return $this;
	}
	public function getIsFinish() {
		return $this->isFinish;
	}
	public function setIsFinish($isFinish) {
		$this->isFinish = $isFinish;
		return $this;
	}
	public function getStartTime() {
		return $this->startTime;
	}
	public function setStartTime( $startTime) {
		$this->startTime = $startTime;
		return $this;
	}
	public function getCreateTime() {
		return $this->createTime;
	}
	public function setCreateTime( $createTime) {
		$this->createTime = $createTime;
		return $this;
	}
	public function getDistance() {
		return $this->distance;
	}
	public function setDistance( $distance) {
		$this->distance = $distance;
		return $this;
	}
	public function getSpeed() {
		return $this->speed;
	}
	public function setSpeed($speed) {
		$this->speed = $speed;
		return $this;
	}
	public function getCalories() {
		return $this->calories;
	}
	public function setCalories( $calories) {
		$this->calories = $calories;
		return $this;
	}
	public function getIdMobile() {
		return $this->idMobile;
	}
	public function setIdMobile( $idMobile) {
		$this->idMobile = $idMobile;
		return $this;
	}
	public function getStartHs() {
		return $this->startHs;
	}
	public function setStartHs( $startHs) {
		$this->startHs = $startHs;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser(User $user) {
		$this->user = $user;
		return $this;
	}
	public function getSport() {
		return $this->sport;
	}
	public function setSport(Sport $sport) {
		$this->sport = $sport;
		return $this;
	}
	public function getTime() {
		return $this->time;
	}
	public function setTime($time) {
		$this->time = $time;
		return $this;
	}
	
	

    

	

	

	

	

	

}