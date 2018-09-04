<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Translation\Tests\String;


/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event
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
     * @ORM\Column(name="name", type="string", length=1000, nullable=false)
     */
    protected $name;

   	protected $isActive;   	   	protected $isTop;
    protected $emailContact;
    protected $description;
    /**
     * @var \Date
     *
     * @ORM\Column(name="start_time", type="string",  nullable=false)
     */
    protected $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=true)
     */
    protected $createTime;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=1000, nullable=true)
     */
    protected $photo;
    
    
    protected $filePhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_background", type="string", length=1000, nullable=true)
     */
    protected $photoBackground;

    /**
     * @var String
     */
    protected $filePhotoBackground;
    
    /**
     * @var string
     *
     * @ORM\Column(name="link_page", type="string", length=1000, nullable=true)
     */
    protected $linkPage;

    /**
     * @var string
     *
     * @ORM\Column(name="label_link", type="string", length=30, nullable=true)
     */
    protected $labelLink;

    /**
     * @var string
     *
     * @ORM\Column(name="flyer_path", type="string", length=1000, nullable=true)
     */
    protected $flyerPath;

    /**
     * @var string
     *
     * @ORM\Column(name="start_hs", type="string", length=1000, nullable=false)
     */
    
    protected $startHs;
    
    /**
     * Result event
     * 
     * @var ArrayCollection
     */
    protected $classifications;    /**        * Result event        *        * @var ArrayCollection        */        protected $entries;    
    
    
    /**
     * @var archivo de resultado
     */
    protected $fileResult;
    
    
    /**
     * Usuarios participantes
     *
     * @var ArrayCollection
     */
    protected $registrations;
    
    /**
     * @var Sport
     */
    protected $sport;
    
    /**
     * @var ArrayCollection
     */
    protected $categories;
    
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
    
    protected $city;
    
    protected $province;
    
    protected $country;
    
    /**
     * @var string
     */
    protected $latitude;
    
    /**
     * @var string
     */
    protected $longitude;
    
    /**
     * @var Organizer
     */
    protected $organizer;
    
    /**
     * @var String
     */
    protected $distanceMe;
    
    public function __construct()
    {
    	$this->classifications = new ArrayCollection();
    	$this->registrations = new ArrayCollection();
    	$this->categories= new ArrayCollection();    	    	$this->entries= new ArrayCollection();    	
    }
    
    public function getPuntuation(){
    	
    	$enrolled = $this->registrations;
    	$cant = 0;
    	$total = 0;
    	foreach($enrolled as $e) {
    		//$e = new Enrolled();
    		if($e->getPunctuation()){
    			$total = $e->getPunctuation()->getTotal();
    			$cant = $cant +1;
    		}
		}
		

		if($cant != 0){
			$puntuation = $total/$cant;
		}else{
			$puntuation = 0;
		}
		return $puntuation;
    }
    
    
    /**
     * Set name
     *
     * @param string $name
     * @return Event
     */
    public function setClassifications($name)
    {
    	$this->classifications = $name;
    
    	return $this;
    }
    
    /**
     * Get Classification
     *
     * @return ArrayCollection
     */
    public function getClassifications()
    {
    	return $this->classifications;
    }
    
    /**
     * Add Classification
     *
     * @return Classification
     */
    public function addClassification($label)
    {
    	$label->addEvent($this);
    	 
    	$this->classifications->add($label);
    }
    
    /**
     * Remove Classification
     *
     */
    public function removeClassification($label)
    {
    	$this->classifications->removeElement($label);
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
     * @return Event
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
     * Set emailContact
     *
     * @param string $emailContact
     * @return Event
     */
    public function setEmailContact($emailContact)
    {
        $this->emailContact = $emailContact;
    
        return $this;
    }

    /**
     * Get emailContact
     *
     * @return string 
     */
    public function getEmailContact()
    {
        return $this->emailContact;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Event
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    
        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }
	
    /**
     * Set startHs
     *
     * @param \DateTime $startHs
     * @return Event
     */
    public function setStartHs($startHs)
    {
    	$this->startHs = $startHs;
    
    	return $this;
    }
    
    
    
    /**
     * Get startHs
     *
     * @return \DateTime
     */
    public function getStartHs()
    {
    	return $this->startHs;
    }
    
    
    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Event
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
    
        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime 
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Event
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set photoBackground
     *
     * @param string $photoBackground
     * @return Event
     */
    public function setPhotoBackground($photoBackground)
    {
        $this->photoBackground = $photoBackground;
    
        return $this;
    }

    /**
     * Get photoBackground
     *
     * @return string 
     */
    public function getPhotoBackground()
    {
        return $this->photoBackground;
    }

    /**
     * Set linkPage
     *
     * @param string $linkPage
     * @return Event
     */
    public function setLinkPage($linkPage)
    {
        $this->linkPage = $linkPage;
    
        return $this;
    }

    /**
     * Get linkPage
     *
     * @return string 
     */
    public function getLinkPage()
    {
        return $this->linkPage;
    }

    /**
     * Set labelLink
     *
     * @param string $labelLink
     * @return Event
     */
    public function setLabelLink($labelLink)
    {
        $this->labelLink = $labelLink;
    
        return $this;
    }

    /**
     * Get labelLink
     *
     * @return string 
     */
    public function getLabelLink()
    {
        return $this->labelLink;
    }

    /**
     * Set flyerPath
     *
     * @param string $flyerPath
     * @return Event
     */
    public function setFlyerPath($flyerPath)
    {
        $this->flyerPath = $flyerPath;
    
        return $this;
    }

    /**
     * Get flyerPath
     *
     * @return string 
     */
    public function getFlyerPath()
    {
        return $this->flyerPath;
    }
	
    
    //Admin file load
    
    /**
     * Get FilePhoto.
     *
     * @return UploadedFile
     */
    public function getFilePhoto()
    {
    	return $this->filePhoto;
    }
    
    
    public function getAbsolutePath()
    {
    	return null === $this->photo
    	? null
    	: $this->getUploadRootDir().'/'.$this->photo;
    }
    
    public function getWebPath()
    {
    	return null === $this->photo
    	? null
    	: $this->photo;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/event/'.$this->id.'/';
    }
    
    /**
     * Sets filePhoto.
     *
     * @param UploadedfilePhoto $filePhoto
     *
     */
    public function setFilePhoto(UploadedFile $filePhoto = null)
    {
    	$this->filePhoto = $filePhoto;
    	// check if we have an old image path
    	$extension = $this->getFilePhoto()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensi�n
    		$extension = 'bin';
    	}
    
    	//     	$filename = rand(1,99999).'.'.$extension;
    	$filename = strval(date("Ymdhis")).'-'.$this->sanear_string($this->getFilePhoto()->getClientOriginalName());
    	$this->photo = $this->getUploadRootDir().$filename;
    	$this->upload();
    }
    
    
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
    	if (null === $this->getFilePhoto()) {
    		return;
    	}
    
    	// si hay un error al mover el archivo, move() autom�ticamente
    	// env�a una excepci�n. This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->getFilePhoto()->move($this->getUploadRootDir(), $this->photo);
    
    	// check if we have an old image
    	if (isset($this->temp)) {
    		// delete the old image
    		unlink($this->getUploadRootDir().'/'.$this->temp);
    		// clear the temp image path
    		$this->temp = null;
    	}
    	$this->filePhoto = null;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
    	if ($filePhoto = $this->getAbsolutePath()) {
    		if (file_exists($filePhoto) && is_writable($filePhoto))
    		{
    			unlink ( $filePhoto );
    		}
    	}
    }
    
    
    //Admin photoBackground load
    
    /**
     * Get FilePhotoBackground.
     *
     * @return UploadedFile
     */
    public function getFilePhotoBackground()
    {
    	return $this->filePhotoBackground;
    }
    
    
    public function getAbsolutePathB()
    {
    	return null === $this->photoBackground
    	? null
    	: $this->getUploadRootDir().'/'.$this->photoBackground;
    }
    
    public function getWebPathB()
    {
    	return null === $this->photoBackground
    	? null
    	: $this->photoBackground;
    }
    
  
    
    /**
     * Sets filePhotoBackground.
     *
     * @param UploadedfilePhotoBackground $filePhotoBackground
     *
     */
    public function setFilePhotoBackground(UploadedFile $filePhotoBackground = null)
    {
    	$this->filePhotoBackground = $filePhotoBackground;
    	// check if we have an old image path
    	$extension = $this->getFilePhotoBackground()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensi�n
    		$extension = 'bin';
    	}
    
    	//     	$filename = rand(1,99999).'.'.$extension;
    	$filename = strval(date("Ymdhis")).'-'.$this->sanear_string($this->getFilePhotoBackground()->getClientOriginalName());
    	$this->photoBackground = $this->getUploadRootDir().$filename;
    	$this->uploadB();
    }
    
    
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadB()
    {
    	if (null === $this->getFilePhotoBackground()) {
    		return;
    	}
    
    	// si hay un error al mover el archivo, move() autom�ticamente
    	// env�a una excepci�n. This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->getFilePhotoBackground()->move($this->getUploadRootDir(), $this->photoBackground);
    
    	// check if we have an old image
    	if (isset($this->temp)) {
    		// delete the old image
    		unlink($this->getUploadRootDir().'/'.$this->temp);
    		// clear the temp image path
    		$this->temp = null;
    	}
    	$this->filePhotoBackground = null;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUploadB()
    {
    	if ($filePhotoBackground = $this->getAbsolutePathB()) {
    		if (file_exists($filePhotoBackground) && is_writable($filePhotoBackground))
    		{
    			unlink ( $filePhotoBackground );
    		}
    	}
    }
    
    /////Cargar archivo resultados
    
    
    //Admin file load
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFileResult()
    {
    	return $this->fileResult;
    }
    
    
    public function getAbsolutePathFileResult()
    {
    	return null === $this->labelLink
    	? null
    	: $this->getUploadRootDirFileResult().'/'.$this->labelLink;
    }
    
    public function getWebPathFileResult()
    {
    	return null === $this->labelLink
    	? null
    	: $this->labelLink;
    }
    
    protected function getUploadRootDirFileResult()
    {
    	
    	return 'uploads/result/';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     *
     */
    public function setFileResult(UploadedFile $file = null)
    {
    	$this->fileResult = $file;
    	// check if we have an old image path
//     	$extension = $this->getFileResult()->guessExtension();
//     	if (!$extension) {
//     		// no se puede deducir la extensi�n
//     		$extension = 'bin';
//     	}
    
    	//     	$filename = rand(1,99999).'.'.$extension;
    	$filename = strval(date("Ymdhis")).'-'.$this->sanear_string($this->getFileResult()->getClientOriginalName());
    	$this->labelLink = $this->getUploadRootDirFileResult().$filename;
    	$this->uploadFileResult();
    }
    
    
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadFileResult()
    {
    	if (null === $this->getFileResult()) {
    		return;
    	}
    
    	// si hay un error al mover el archivo, move() autom�ticamente
    	// env�a una excepci�n. This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->getFileResult()->move($this->getUploadRootDirFileResult(), $this->labelLink);
    
    	// check if we have an old image
    	if (isset($this->temp)) {
    		// delete the old image
    		unlink($this->getUploadRootDirFileResult().'/'.$this->temp);
    		// clear the temp image path
    		$this->temp = null;
    	}
    	$this->fileResult = null;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUploadFileResult()
    {
    	if ($file = $this->getAbsolutePathFileResult()) {
    		if (file_exists($file) && is_writable($file))
    		{
    			unlink ( $file );
    		}
    	}
    }
    
    /**
     * Reemplaza todos los acentos por sus equivalentes sin ellos
     *
     * @param $string
     *  string la cadena a sanear
     *
     * @return $string
     *  string saneada
     */
    public static function sanear_string($string)
    {
    
    	$string = trim($string);
    
    	$string = str_replace(
    			array('�', '�', '�', '�', '�', '�', '�', '�', '�'),
    			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
    			$string
    	);
    
    	$string = str_replace(
    			array('�', '�', '�', '�', '�', '�', '�', '�'),
    			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
    			$string
    	);
    
    	$string = str_replace(
    			array('�', '�', '�', '�', '�', '�', '�', '�'),
    			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
    			$string
    	);
    
    	$string = str_replace(
    			array('�', '�', '�', '�', '�', '�', '�', '�'),
    			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
    			$string
    	);
    
    	$string = str_replace(
    			array('�', '�', '�', '�', '�', '�', '�', '�'),
    			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
    			$string
    	);
    
    	$string = str_replace(
    			array('�', '�', '�', '�'),
    			array('n', 'N', 'c', 'C',),
    			$string
    	);
    
    	//Esta parte se encarga de eliminar cualquier caracter extra�o
    	$string = str_replace(
    			array("\\", "�", "�", "-", "~",
    					"#", "@", "|", "!", "\"",
    					"�", "$", "%", "&", "/",
    					"(", ")", "?", "'", "�",
    					"�", "[", "^", "`", "]",
    					"+", "}", "{", "�", "�",
    					">", "< ", ";", ",", ":"," "),'',$string
    	);
    
    
    	return $string;
    }

    

    /**
     * @var \DateTime
     */
    protected $startDate;


   
    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }
	public function getRegistrations() {
		return $this->registrations;
	}
	public function setRegistrations(ArrayCollection $registrations) {
		$this->registrations = $registrations;
		return $this;
	}
	
	/**
	 *
	 * @return the Sport
	 */
	public function getSport() {
		return $this->sport;
	}
	
	/**
	 *
	 * @param Sport $sport        	
	 */
	public function setSport(Sport $sport) {
		$this->sport = $sport;
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
	public function setDistanceTotal($distanceTotal) {
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
	 *
	 * @return the ArrayCollection
	 */
	public function getCategories() {
		return $this->categories;
	}
	
	/**
	 *
	 * @param ArrayCollection $categories        	
	 */
	public function setCategories( $categories) {
		$this->categories = $categories;
		return $this;
	}
	
	/**
	 * Add Categories
	 *
	 * @return Classification
	 */
	public function addCategories($label)
	{
		$label->addEvent($this);
	
		$this->categories->add($label);
	}
	
	/**
	 * Remove Categories
	 *
	 */
	public function removeCategories($label)
	{
		$this->categories->removeElement($label);
	}
	
	/**
	 * Get String
	 *
	 * @return String
	 */
	/**		*		* @return the ArrayCollection		*/		public function getEntries() {			return $this->entries;		}				/**		*		* @param ArrayCollection $entries		*/		public function setEntries( $entries) {			$this->entries = $entries;			return $this;		}				/**		* Add Entries		*		* @return Entries		*/		public function addEntry(Entry $entry)	{		$entry->addEvent($this);		$this->entries->add($entry);	}				/**		* Remove entries		*		*/		public function removeEntry(Entry $entry)		{			$this->entries->removeElement($entry);		}				/**		* Get String		*		* @return String		*/			public function __toString() {
		return strval ( $this->name );
	}
	public function getIsActive() {
		return $this->isActive;
	}
	public function setIsActive($isActive) {
		$this->isActive = $isActive;
		return $this;
	}
	public function getCity() {
		return $this->city;
	}
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}
	public function getProvince() {
		return $this->province;
	}
	public function setProvince($province) {
		$this->province = $province;
		return $this;
	}
	public function getCountry() {
		return $this->country;
	}
	public function setCountry($country) {
		$this->country = $country;
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
	public function getOrganizer() {
		return $this->organizer;
	}
	public function setOrganizer(Organizer $organizer) {
		$this->organizer = $organizer;
		return $this;
	}
	public function getDistanceMe() {
		return $this->distanceMe;
	}
	public function setDistanceMe($distanceMe) {
		$this->distanceMe = $distanceMe;
		return $this;
	}
	public function getIsTop() {
		return $this->isTop;
	}
	public function setIsTop($isTop) {
		$this->isTop = $isTop;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}		
	
	
	
	
	
	
	
}