<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="point")
 * @ORM\Entity
 */
class Point
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    protected $description;
    
    protected $code;

    protected $event;

    protected $isDefeated;

    protected $cant;
    
    protected $date;
    
    protected $userFriend;
    
    protected $user;
    
    
    
    function getUser() {
        return $this->user;
    }

    function setUser($user) {
        $this->user = $user;
    }

        function getUserFriend() {
        return $this->userFriend;
    }

    function setUserFriend($userFriend) {
        $this->userFriend = $userFriend;
    }

    
    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getCode() {
        return $this->code;
    }

    function getEvent() {
        return $this->event;
    }

    function getIsDefeated() {
        return $this->isDefeated;
    }

    function getCant() {
        return $this->cant;
    }

    function getDate() {
        return $this->date;
    }
    function setDescription($description) {
        $this->description = $description;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setEvent($event) {
        $this->event = $event;
    }

    function setIsDefeated($isDefeated) {
        $this->isDefeated = $isDefeated;
    }

    function setCant($cant) {
        $this->cant = $cant;
    }

    function setDate($date) {
        $this->date = $date;
    }

        	public function __toString() {
		return strval ( $this->code );
	}
	
}