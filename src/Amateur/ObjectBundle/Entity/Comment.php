<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 */
class Comment
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
     * @var string
     */
    private $comment;

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
     * @return Comment
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
     * Set comment
     *
     * @param string $comment
     * @return Comment
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
     * Set photoId
     *
     * @param integer $photoId
     * @return Comment
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
     * @return Comment
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
	public function getNewsUser() {
		return $this->newsUser;
	}
	public function setNewsUser($newsUser) {
		$this->newsUser = $newsUser;
		return $this;
	}
	
}
