<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Positive
 */
class Positive
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $newsUser;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $photoId;

    /**
     * @var integer
     */
    private $albumPhotoId;


 
    
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
     * Set userId
     *
     * @param integer $userId
     * @return Positive
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

    /**
     * Set photoId
     *
     * @param integer $photoId
     * @return Positive
     */
    public function setPhotoId($photoId)
    {
        $this->photoId = $photoId;
    
        return $this;
    }

    /**
     * Get photoId
     *
     * @return integer 
     */
    public function getPhotoId()
    {
        return $this->photoId;
    }

    /**
     * Set albumPhotoId
     *
     * @param integer $albumPhotoId
     * @return Positive
     */
    public function setAlbumPhotoId($albumPhotoId)
    {
        $this->albumPhotoId = $albumPhotoId;
    
        return $this;
    }

    /**
     * Get albumPhotoId
     *
     * @return integer 
     */
    public function getAlbumPhotoId()
    {
        return $this->albumPhotoId;
    }
	
	/**
	 *
	 * @return the integer
	 */
	public function getNewsUser() {
		return $this->newsUser;
	}
	
	/**
	 *
	 * @param
	 *        	$newsUser
	 */
	public function setNewsUser($newsUser) {
		$this->newsUser = $newsUser;
		return $this;
	}
	
}
