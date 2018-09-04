<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Punctuation
 */
class UserConfiguration
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $shareWith;

    /**
     * @var integer
     */
    protected $activeFollowMe;

    /**
     * @var User
     */
    protected $user;
    
	public function getId() {
		return $this->id;
	}
	public function getShareWith() {
		return $this->shareWith;
	}
	public function setShareWith($shareWith) {
		$this->shareWith = $shareWith;
		return $this;
	}
	public function getActiveFollowMe() {
		return $this->activeFollowMe;
	}
	public function setActiveFollowMe($activeFollowMe) {
		$this->activeFollowMe = $activeFollowMe;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser(User $user) {
		$this->user = $user;
		return $this;
	}
	
    
}
