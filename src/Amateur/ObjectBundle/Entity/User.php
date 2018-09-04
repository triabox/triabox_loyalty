<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
// DON'T forget this use statement!!!
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Amateur\ObjectBundle\Entity\UserRepository;
use Symfony\Component\Security\Core\Role\Role;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUser;
use Doctrine\Common\Collections\Doctrine\Common\Collections;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Amateur\ObjectBundle\Entity\UserRepository")
 */
class User extends OAuthUser implements  UserInterface, EquatableInterface {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;
	
	/**
	 *
	 * @var string @ORM\Column(name="username", type="string", length=16, nullable=false)
	 */
	protected $username;
	
	/**
	 *
	 * @var string @ORM\Column(name="email", type="string", length=255, nullable=false)
	 */
	protected $email;
	
	/**
	 *
	 * @var \DateTime @ORM\Column(name="create_time", type="datetime", nullable=true)
	 */
	protected $createTime;
	
	/**
	 *
	 * @var string @ORM\Column(name="salt", type="string", length=32, nullable=true)
	 */
	protected $salt;
	
	/**
	 *
	 * @var string @ORM\Column(name="password", type="string", length=100, nullable=true)
	 */
	protected $password;
	
	/**
	 *
	 * @var boolean @ORM\Column(name="isActive", type="boolean", nullable=true)
	 */
	protected $isActive;
	
	/**
	 *
	 * @var string @ORM\Column(name="name", type="string", length=300, nullable=true)
	 */
	protected $name;
	
	/**
	 *
	 * @var string @ORM\Column(name="lastname", type="string", length=300, nullable=true)
	 */
	protected $lastname;
	
	/**
	 *
	 * @var string @ORM\Column(name="code_password", type="string", length=45, nullable=true)
	 */
	protected $codePassword;
	
	/**
	 *
	 * @var string @ORM\Column(name="photo", type="string", length=500, nullable=true)
	 */
	protected $photo;
	
	/**
	 *
	 * @var boolean @ORM\Column(name="tyc", type="boolean", nullable=true)
	 */
	protected $tyc;
	
	/**
	 *
	 * @var string @ORM\Column(name="language", type="string", length=20, nullable=true)
	 */
	protected $language;
	
	/**
	 *
	 * @var \DateTime @ORM\Column(name="last_update_date", type="datetime", nullable=true)
	 */
	protected $lastUpdateDate;
	
	/**
	 *
	 * @var boolean @ORM\Column(name="is_online", type="boolean", nullable=true)
	 */
	protected $isOnline;
	
	/**
	 *
	 * @var string 
	 * 
	 * @ORM\Column(name="tipe_user", type="string", length=20, nullable=true)
	 */
	protected $tipeUser;
	
	/**
	 * Friends
	 *
	 */
	protected $friends;
	
	/**
	 * @var file
	 */
	protected $file;
	
	/**
	 * @var Role
	 */
	protected $roles;
	
	protected $street;
	
	protected $number;
	
	protected $piso;
	
	protected $city;
	
	protected $province;
	
	protected $birhDate;
	
	protected $country;
	
	protected $sport;
	
	protected $firstTime;
	
	/**
	 * @var string
	 */
	protected $latitude;
	
	/**
	 * @var string
	 */
	protected $longitude;
	/**
	 *
	 * @var ArrayCollection @ORM\OneToMany(targetEntity="NewsUser", mappedBy="user", cascade={"persist", "remove", "merge"})
	 */
	protected $news;
	
	
	protected $registrations;
	
	
	/**
	 * @var UserConfiguration
	 */
	protected $userConfiguration;
	/**
	 * @var string
	 *
	 * @ORM\Column(name="google_id", type="string", length=255, unique=true, nullable=true)
	 */
	protected $googleId;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="nickname", type="string", length=255, nullable=true)
	 */
	protected $nickname;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="work_hour_start", type="time", nullable=true)
	 */
	protected $workHourStart;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="work_hour_end", type="time", nullable=true)
	 */
	protected $workHourEnd;
	
	/**
	 * @var Organizer
	 */
	protected $organizer;			protected $phoneNumber;		protected $postalCode;		protected $codeState;
	
	public function __construct() {
		
		// $this->username = $username;
		// $this->password = $password;
		// $this->salt = $salt;
		// $this->roles = $roles;
		$this->frieds = new ArrayCollection();
		$this->news = new ArrayCollection ();
		$this->registrations = new ArrayCollection ();
		$this->isActive = true;
		$this->salt = md5(uniqid(null, true));
		
		$workHourStart = new \DateTime();
		$workHourStart->setTime(8, 0, 0);
		$this->workHourStart = $workHourStart;
		
		$workHourEnd = new \DateTime();
		$workHourEnd->setTime(16, 0, 0);
		$this->workHourEnd = $workHourEnd;
	}
	
	public function getRoles() {
		return array ('ROLE_USER');
	}
	public function addRole($role) {
		$this->roles [] = $role;
		return $this;
	}
	public function getRolesNames() {
		$nombres = "ROLE_USER";
// 		foreach ( $this->getRoles () as $rol ) {
// 			if ($nombres != "") {
// 				$nombres = $nombres . ' - ' . $rol->getName ();
// 			} else {
// 				$nombres = $rol->getName ();
// 			}
// 		}
		return $nombres;
	}
	
	/**
	 * Set $role
	 *
	 * @param string $role        	
	 * @return Contactos
	 */
	public function setRoles($role) {
		$this->roles = $role;
		
		return $this;
	}
	
	/**
	 * @return \Symfony\Component\Security\Core\Role\Role
	 */
	public function getRolesCollection() {
		return array ('ROLE_USER');
		//return $this->roles;
	}
	
	/**
	 * Set $role
	 *
	 * @param string $role        	
	 * @return Contactos
	 */
	public function setRolesCollection($roles) {
		$this->roles = $roles;
		
		return $this;
	}
	

	
	/**
	 * Set $street
	 *
	 * @param string $street
	 * @return User
	 */
	public function setStreet($street) {
		$this->street = $street;
	
		return $this;
	}
	
	
	/**
	 * Get Street
	 * 
	 * @return string
	 */
	public function getStreet() {
		return $this->street;
	}
	
	
	/**
	 * Set $number
	 *
	 * @param string $number
	 * @return User
	 */
	public function setNumber($number) {
		$this->number = $number;
	
		return $this;
	}
	
	
	/**
	 * Get Number
	 *
	 * @return string
	 */
	public function getNumber() {
		return $this->number;
	}
	
	/**
	 * Set $piso
	 *
	 * @param string $piso
	 * @return User
	 */
	public function setPiso($piso) {
		$this->piso = $piso;
	
		return $this;
	}
	
	
	/**
	 * Get Piso
	 *
	 * @return string
	 */
	public function getPiso() {
		return $this->piso;
	}
	
	/**
	 * Set $city
	 *
	 * @param string $city
	 * @return User
	 */
	public function setCity($city) {
		$this->city = $city;
	
		return $this;
	}
	
	
	/**
	 * Get City
	 *
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}
	
	/**
	 * Set $province
	 *
	 * @param string $province
	 * @return User
	 */
	public function setProvince($province) {
		$this->province = $province;
	
		return $this;
	}
	
	
	/**
	 * Get Province
	 *
	 * @return string
	 */
	public function getProvince() {
		return $this->province;
	}
	
	/**
	 * Set $country
	 *
	 * @param string $country
	 * @return User
	 */
	public function setCountry($country) {
		$this->country = $country;
	
		return $this;
	}
	
	
	/**
	 * Get Country
	 *
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}
	
	
	
	/**
	 * Get Friends
	 *
	 * @return array
	 */
	public function getFriends()
	{
		return $this->friends;
	}
	
	/**
	 * Add Friend
	 *
	 */
	public function addFriend($friend)
	{
	
		$this->friends->add($friend);
	}
	
	
	/**
	 * Remove Friend
	 *
	 */
	public function removeFriend($friend)
	{
		$this->friends->removeElement($friend);
	}
	
	
	/**
	 * @inheritDoc
	 */
	public function eraseCredentials() {
	}
	
	/**
	 *
	 * @see \Serializable::serialize()
	 */
	public function serialize() {
		return serialize ( array (
				$this->id 
		) );
	}
	
	/**
	 *
	 * @see \Serializable::unserialize()
	 */
	public function unserialize($serialized) {
		list ( $this->id, ) = unserialize ( $serialized );
	}
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set username
	 *
	 * @param string $username        	
	 * @return User
	 */
	public function setUsername($username) {
		$this->username = $username;
		
		return $this;
	}
	
	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}
	
	/**
	 * Get News
	 *
	 * @return array
	 */
	public function getNews() {
		return $this->news;
	}
	
	/**
	 * Set news
	 *
	 * @param string $news        	
	 * @return Arr
	 */
	public function setNews($news) {
		$this->news = $news;
		
		return $this;
	}
	/**
	 * Add New
	 */
	public function addNew($newsUser) {
		$newsUser->setUser ( $this );
		
		$this->news->add ( $newsUser );
	}
	
	/**
	 * Remove New
	 */
	public function removeNew($new) {
		$this->news->removeElement ( $new );
	}
	
	/**
	 * Set email
	 *
	 * @param string $email        	
	 * @return User
	 */
	public function setEmail($email) {
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Set createTime
	 *
	 * @param \DateTime $createTime        	
	 * @return User
	 */
	public function setCreateTime($createTime) {
		$this->createTime = $createTime;
		
		return $this;
	}
	
	/**
	 * Get createTime
	 *
	 * @return \DateTime
	 */
	public function getCreateTime() {
		return $this->createTime;
	}
	
	/**
	 * Set salt
	 *
	 * @param string $salt        	
	 * @return User
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
		
		return $this;
	}
	
	/**
	 * Get salt
	 *
	 * @return string
	 */
	public function getSalt() {
		return $this->salt;
	}
	
	/**
	 * Set password
	 *
	 * @param string $password        	
	 * @return User
	 */
	public function setPassword($password) {
		$this->password = $password;
		
		return $this;
	}
	
	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}
	
	
	/**
	 * Set name
	 *
	 * @param string $name        	
	 * @return User
	 */
	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Set lastname
	 *
	 * @param string $lastname        	
	 * @return User
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
		
		return $this;
	}
	
	/**
	 * Get lastname
	 *
	 * @return string
	 */
	public function getLastname() {
		return $this->lastname;
	}
	
	/**
	 * Set codePassword
	 *
	 * @param string $codePassword        	
	 * @return User
	 */
	public function setCodePassword($codePassword) {
		$this->codePassword = $codePassword;
		
		return $this;
	}
	
	/**
	 * Get codePassword
	 *
	 * @return string
	 */
	public function getCodePassword() {
		return $this->codePassword;
	}
	
	/**
	 * Set photo
	 *
	 * @param string $photo        	
	 * @return User
	 */
	public function setPhoto($photo) {
		$this->photo = $photo;
		
		return $this;
	}
	
	/**
	 * Get photo
	 *
	 * @return string
	 */
	public function getPhoto() {
		return $this->photo;
	}
	
	/**
	 * Set tyc
	 *
	 * @param boolean $tyc        	
	 * @return User
	 */
	public function setTyc($tyc) {
		$this->tyc = $tyc;
		
		return $this;
	}
	
	/**
	 * Get tyc
	 *
	 * @return boolean
	 */
	public function getTyc() {
		return $this->tyc;
	}
	
	/**
	 * Set language
	 *
	 * @param string $language        	
	 * @return User
	 */
	public function setLanguage($language) {
		$this->language = $language;
		
		return $this;
	}
	
	/**
	 * Get language
	 *
	 * @return string
	 */
	public function getLanguage() {
		return $this->language;
	}
	
	/**
	 * Set lastUpdateDate
	 *
	 * @param \DateTime $lastUpdateDate        	
	 * @return User
	 */
	public function setLastUpdateDate($lastUpdateDate) {
		$this->lastUpdateDate = $lastUpdateDate;
		
		return $this;
	}
	
	/**
	 * Get lastUpdateDate
	 *
	 * @return \DateTime
	 */
	public function getLastUpdateDate() {
		return $this->lastUpdateDate;
	}
	
	/**
	 * Set isOnline
	 *
	 * @param boolean $isOnline
	 * @return User
	 */
	public function setIsActive($isActive) {
		$this->isActive = $isActive;
	
		return $this;
	}
	
	/**
	 * Get isOnline
	 *
	 * @return boolean
	 */
	public function getIsActive() {
		return $this->isActive;
	}
	/**
	 * Set isOnline
	 *
	 * @param boolean $isOnline        	
	 * @return User
	 */
	public function setIsOnline($isOnline) {
		$this->isOnline = $isOnline;
		
		return $this;
	}
	
	/**
	 * Get isOnline
	 *
	 * @return boolean
	 */
	public function getIsOnline() {
		return $this->isOnline;
	}
	
	/**
	 * Set tipeUser
	 *
	 * @param string $tipeUser        	
	 * @return User
	 */
	public function setTipeUser($tipeUser) {
		$this->tipeUser = $tipeUser;
		
		return $this;
	}
	
	/**
	 * Get tipeUser
	 *
	 * @return string
	 */
	public function getTipeUser() {
		return $this->tipeUser;
	}
	public function isEqualTo(UserInterface $user) {
		if (! $user instanceof WebserviceUser) {
			return false;
		}
		
		if ($this->password !== $user->getPassword ()) {
			return false;
		}
		
		if ($this->salt !== $user->getSalt ()) {
			return false;
		}
		
		if ($this->username !== $user->getUsername ()) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Get String
	 *
	 * @return String
	 */
	public function __toString() {
		return strval ( $this->username );
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
		$this->photo = $this->getUploadRootDir().$filename;
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
		$this->getFile()->move($this->getUploadRootDir(), $this->photo);
	
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
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getRegistrations() {
		return $this->registrations;
	}
	
	/**
	 *
	 * @param unknown_type $registrations        	
	 */
	public function setRegistrations($registrations) {
		$this->registrations = $registrations;
		return $this;
	}
	
	/**
	 * Add Registration
	 */
	public function addRegistration($registration) {
		$registration->setUser ( $this );
	
		$this->registrations->add ( $registration );
	}
	
	/**
	 * Remove Registration
	 */
	public function removeRegistration($registration) {
		$this->registrations->removeElement ( $registration );
	}
	public function getBirhDate() {
		return $this->birhDate;
	}
	public function setBirhDate($birhDate) {
		$this->birhDate = $birhDate;
		return $this;
	}
	public function getSport() {
		return $this->sport;
	}
	public function setSport($sport) {
		$this->sport = $sport;
		return $this;
	}
	public function getGoogleId() {
		return $this->googleId;
	}
	public function setGoogleId( $googleId) {
		$this->googleId = $googleId;
		return $this;
	}
	public function getNickname() {
		return $this->nickname;
	}
	public function setNickname( $nickname) {
		$this->nickname = $nickname;
		return $this;
	}
	public function getWorkHourStart() {
		return $this->workHourStart;
	}
	public function setWorkHourStart($workHourStart) {
		$this->workHourStart = $workHourStart;
		return $this;
	}
	public function getWorkHourEnd() {
		return $this->workHourEnd;
	}
	public function setWorkHourEnd($workHourEnd) {
		$this->workHourEnd = $workHourEnd;
		return $this;
	}
	public function getFirstTime() {
		return $this->firstTime;
	}
	public function setFirstTime($firstTime) {
		$this->firstTime = $firstTime;
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
	public function getUserConfiguration() {
		return $this->userConfiguration;
	}
	public function setUserConfiguration(UserConfiguration $userConfiguration) {
		$this->userConfiguration = $userConfiguration;
		return $this;
	}
	
	public function getFriendsUser(){
		
		$friendUser = new ArrayCollection();
		
		foreach($this->getFriends() as $friend) {
			if($friend->getTipeFriend() == 0){//sie el tipo de amigo es 0 es amigo
			
			$friendUser->add($friend->getUserFriend());
			}
		}
		
		return $friendUser;
	}
	
	public function getFollowerUser(){
	
		$friendUser = new ArrayCollection();
		
		foreach($this->getFriends() as $friend) {
			if($friend->getTipeFriend() == 1){//sie el tipo de amigo es 0 es un seguidor
			
			$friendUser->add($friend->getUserFriend());
			}
		}
		
		return $friendUser;
	}
	
	public function getFriendsAndFolloweUser(){
		$friendUser = new ArrayCollection();
		
		foreach($this->getFriends() as $friend) {
			
					
				$friendUser->add($friend->getUserFriend());
			
		}
		
		return $friendUser;
		
	}
	public function setFriends($friends) {
		$this->friends = $friends;
		return $this;
	}
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
		return $this;
	}
	public function getPostalCode() {
		return $this->postalCode;
	}
	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
		return $this;
	}
	public function getCodeState() {
		return $this->codeState;
	}
	public function setCodeState($codeState) {
		$this->codeState = $codeState;
		return $this;
	}	
	
	
	
	
		
	
	
}