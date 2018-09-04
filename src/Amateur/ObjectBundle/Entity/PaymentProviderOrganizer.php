<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Punctuation
 */
class PaymentProviderOrganizer
{
    /**
     * @var integer
     */
    protected $id;    
    protected $name;    protected $isActive;
    protected $organizer;        protected $authorizationKey;        protected $segurityKey;        protected $currencyCode;        protected $merchant;
    
	public function getId() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getIsActive() {
		return $this->isActive;
	}
	public function setIsActive($isActive) {
		$this->isActive = $isActive;
		return $this;
	}
	public function getOrganizer() {
		return $this->organizer;
	}
	public function setOrganizer($organizer) {
		$this->organizer = $organizer;
		return $this;
	}
	public function getAuthorizationKey() {
		return $this->authorizationKey;
	}
	public function setAuthorizationKey($authorizationKey) {
		$this->authorizationKey = $authorizationKey;
		return $this;
	}
	public function getSegurityKey() {
		return $this->segurityKey;
	}
	public function setSegurityKey($segurityKey) {
		$this->segurityKey = $segurityKey;
		return $this;
	}
	public function getCurrencyCode() {
		return $this->currencyCode;
	}
	public function setCurrencyCode($currencyCode) {
		$this->currencyCode = $currencyCode;
		return $this;
	}
	public function getMerchant() {
		return $this->merchant;
	}
	public function setMerchant($merchant) {
		$this->merchant = $merchant;
		return $this;
	}	
	
    
}
