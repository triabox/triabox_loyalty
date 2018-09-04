<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friend
 *
 * @ORM\Table(name="friend")
 * @ORM\Entity
 */
class Friend
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
     * @var User
     *
     */
    protected $user;
    
    /**
     * @var User
     *
     */
    protected $userFriend;
    


    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    protected $isActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipe_friend_id", type="integer", nullable=false)
     */
    protected $tipeFriend;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_pending_active", type="integer", nullable=true)
     */
    protected $userPendingActive;
    
	public function getId() {
		return $this->id;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser(User $user) {
		$this->user = $user;
		return $this;
	}
	public function getIsActive() {
		return $this->isActive;
	}
	public function setIsActive($isActive) {
		$this->isActive = $isActive;
		return $this;
	}
	public function getTipeFriend() {
		return $this->tipeFriend;
	}
	public function setTipeFriend($tipeFriend) {
		$this->tipeFriend = $tipeFriend;
		return $this;
	}
	public function getUserPendingActive() {
		return $this->userPendingActive;
	}
	public function setUserPendingActive($userPendingActive) {
		$this->userPendingActive = $userPendingActive;
		return $this;
	}
	public function getUserFriend() {
		return $this->userFriend;
	}
	public function setUserFriend(User $userFriend) {
		$this->userFriend = $userFriend;
		return $this;
	}
	
	public function setFollower(User $friend, User $yo){
	
		$this->setTipeFriend(1);
		$this->setUser($yo);
		$this->setUserFriend($friend);
		return $this;
	}
	
	public function setFriend(User $friend, User $yo){
	
	
		$this->setTipeFriend(0);
		$this->setUser($yo);
		$this->setUserFriend($friend);
		return $this;
	}



}