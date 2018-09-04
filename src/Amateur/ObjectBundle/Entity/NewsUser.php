<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * NewsUser
 *
 * @ORM\Table(name="news_user")
 * @ORM\Entity
 */
class NewsUser
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
     * @ORM\Column(name="comment", type="string", length=45, nullable=true)
     */
    protected $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="news_path", type="string", length=45, nullable=true)
     */
    protected $newsPath;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="news")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=true)
     */
    protected $createTime;
    
    /**
     * @var ArrayCollection
     */
    protected $likes;
    
    /**
     * @var Event
     */
    protected $event;
    
    /**
     * @var String
     */
    protected $type;
    
    /**
     * @var Enrolled
     */
    protected $enrolled;
    
    /**
     * @var User
     */
    protected $friend;
    
    /**
     * @var ArrayCollection;
     */
    protected $newsUsers;
    
    /**
     * @var Activi
     */
    protected  $activity;
    
    protected $urlImagen;
    
    protected $url;
    
    
    protected $title;
    
    protected $description;
 
	
    
    public function __construct() {
    
    	$this->likes = new ArrayCollection();
    	$this->newsUsers = new ArrayCollection(); 
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
     * Set comment
     *
     * @param string $comment
     * @return NewsUser
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set newsPath
     *
     * @param string $newsPath
     * @return NewsUser
     */
    public function setNewsPath($newsPath)
    {
        $this->newsPath = $newsPath;
    
        return $this;
    }

    /**
     * Get newsPath
     *
     * @return string 
     */
    public function getNewsPath()
    {
        return $this->newsPath;
    }

    /**
     * Set user
     *
     * @param integer $user
     * @return NewsUser
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return NewsUser
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
     * @var integer
     */
    protected $userId;


    /**
     * Set userId
     *
     * @param integer $userId
     * @return NewsUser
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
	public function getLikes() {
		return $this->likes;
	}
	public function setLikes(ArrayCollection $likes) {
		$this->likes = $likes;
		return $this;
	}
	
	/**
	 *
	 * @return the Event
	 */
	public function getEvent() {
		return $this->event;
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
	 * @return the String
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 *
	 * @param String $type        	
	 */
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	
	/**
	 *
	 * @return the Enrolled
	 */
	public function getEnrolled() {
		return $this->enrolled;
	}
	
	/**
	 *
	 * @param Enrolled $enrolled        	
	 */
	public function setEnrolled(Enrolled $enrolled) {
		$this->enrolled = $enrolled;
		return $this;
	}
	
	/**
	 *
	 * @return the User
	 */
	public function getFriend() {
		return $this->friend;
	}
	
	/**
	 *
	 * @param User $friend        	
	 */
	public function setFriend(User $friend) {
		$this->friend = $friend;
		return $this;
	}

	public function getNewsUsers() {
		return $this->newsUsers;
	}
	public function setNewsUsers($newsUsers) {
		$this->newsUsers = $newsUsers;
		return $this;
	}
	
	/**
	 * Add Classification
	 *
	 * @return Classification
	 */
	public function addNewsUsers($newsUsers)
	{
	
		$this->newsUsers->add($newsUsers);
	}
	
	/**
	 * Remove Classification
	 *
	 */
	public function removeNewsUsers($newsUsers)
	{
		$this->newsUsers->removeElement($newsUsers);
	}
	public function getActivity() {
		return $this->activity;
	}
	public function setActivity($activity) {
		$this->activity = $activity;
		return $this;
	}
	public function getUrlImagen() {
		return $this->urlImagen;
	}
	public function setUrlImagen($urlImagen) {
		$this->urlImagen = $urlImagen;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getUrl() {
		return $this->url;
	}
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	
	
	
	
	
	
	
}