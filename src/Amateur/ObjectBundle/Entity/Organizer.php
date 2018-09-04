<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Organizer
 */
class Organizer
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $web;

    /**
     * @var string
     */
    protected $twitter;

    /**
     * @var string
     */
    protected $facebook;

    /**
     * @var string
     */
    protected $logo;

    protected $file;
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $latitude;
    
    /**
     * @var string
     */
    protected $longitude;

    protected $isActive;

    protected $events;        protected $paymentProvidersOrganizer;
    
    public function __construct() {
    	$this->events = new ArrayCollection();    	$this->paymentProvidersOrganizer = new ArrayCollection();
    
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
     * @return Organizer
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
     * Set address
     *
     * @param string $address
     * @return Organizer
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Organizer
     */
    public function setWeb($web)
    {
        $this->web = $web;
    
        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Organizer
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    
        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Organizer
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    
        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Organizer
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Organizer
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Organizer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Organizer
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
	public function getUser() {
		return $this->user;
	}
	public function setUser(User $user) {
		$this->user = $user;
		return $this;
	}
	
	
	//Admin file load
	
	/**
	 * Get file.
	 *
	 * @return UploadedFile
	 */
	public function getFile()
	{
		return $this->file;
	}
	
	
	public function getAbsolutePath()
	{
		return null === $this->logo
		? null
		: $this->getUploadRootDir().'/'.$this->logo;
	}
	
	public function getWebPath()
	{
		return null === $this->logo
		? null
		: $this->logo;
	}
	
	protected function getUploadRootDir()
	{
		// la ruta absoluta del directorio donde se deben
		// guardar los archivos cargados
		return 'uploads/usuario/'.$this->id.'/';
	}
	
	/**
	 * Sets file.
	 *
	 * @param UploadedFile $file
	 *
	 */
	public function setFile(UploadedFile $file = null)
	{
		$this->file = $file;
		// check if we have an old image path
		$extension = $this->getFile()->guessExtension();
		if (!$extension) {
			// no se puede deducir la extensi�n
			$extension = 'bin';
		}
	
		//     	$filename = rand(1,99999).'.'.$extension;
		$filename = strval(date("Ymdhis")).'-'.$this->sanear_string($this->getFile()->getClientOriginalName());
		$this->logo = $this->getUploadRootDir().$filename;
		$this->upload();
	}
	
	
	
	/**
	 * @ORM\PostPersist()
	 * @ORM\PostUpdate()
	 */
	public function upload()
	{
		if (null === $this->getFile()) {
			return;
		}
	
		// si hay un error al mover el archivo, move() autom�ticamente
		// env�a una excepci�n. This will properly prevent
		// the entity from being persisted to the database on error
		$this->getFile()->move($this->getUploadRootDir(), $this->logo);
	
		// check if we have an old image
		if (isset($this->temp)) {
			// delete the old image
			unlink($this->getUploadRootDir().'/'.$this->temp);
			// clear the temp image path
			$this->temp = null;
		}
		$this->file = null;
	}
	
	/**
	 * @ORM\PostRemove()
	 */
	public function removeUpload()
	{
		if ($file = $this->getAbsolutePath()) {
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
	public function getIsActive() {
		return $this->isActive;
	}
	public function setIsActive($isActive) {
		$this->isActive = $isActive;
		return $this;
	}
	public function getEvents() {
		return $this->events;
	}
	public function setEvents($events) {
		$this->events = $events;
		return $this;
	}
	public function getPaymentProvidersOrganizer() {
		return $this->paymentProvidersOrganizer;
	}
	public function setPaymentProvidersOrganizer($paymentProvidersOrganizer) {						if (!empty($paymentProvidersOrganizer) && $paymentProvidersOrganizer === $this->paymentProvidersOrganizer) {			reset($paymentProvidersOrganizer);			$paymentProvidersOrganizer[key($paymentProvidersOrganizer)] = clone current($paymentProvidersOrganizer);		}		$this->paymentProvidersOrganizer = $paymentProvidersOrganizer;		
		return $this;
	}		/**		* Add Entries		*		* @return PaymentProviderOrganizer		*/		public function addPaymentProvidersOrganizer(PaymentProviderOrganizer $paymentProvider)	{		$paymentProvider->setOrganizer($this);		$this->paymentProvidersOrganizer->add($paymentProvider);	}				/**		* Remove PaymentProviderOrganizer		*		*/		public function removePaymentProvidersOrganizer(PaymentProviderOrganizer $paymentProvider)		{			$this->paymentProvidersOrganizer->removeElement($paymentProvider);		}				
	
	
	
	

   
}
