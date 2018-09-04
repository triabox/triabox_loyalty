<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entry
 *
 * @ORM\Table(name="entry")
 * @ORM\Entity
 */
class Entry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    protected $name;
    protected $description;    protected $start;        protected $end;    
    protected $event;
    protected $isActive;
    protected $amount;
    protected $money;        protected $cant; 
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getStart() {
		return $this->start;
	}
	public function setStart($start) {
		$this->start = $start;
		return $this;
	}
	public function getEnd() {
		return $this->end;
	}
	public function setEnd($end) {
		$this->end = $end;
		return $this;
	}
	public function getEvent() {
		return $this->event;
	}
	public function setEvent($event) {
		$this->event = $event;
		return $this;
	}	/**		* Add Event		*		* @return Entry		*/		public function addEvent(Event $event)		{			$this->event = $event;					return $this;		}	
	public function getIsActive() {
		return $this->isActive;
	}
	public function setIsActive($isActive) {
		$this->isActive = $isActive;
		return $this;
	}
	public function getAmount() {
		return $this->amount;
	}
	public function setAmount($amount) {
		$this->amount = $amount;
		return $this;
	}
	public function getMoney() {
		return $this->money;
	}
	public function setMoney($money) {
		$this->money = $money;
		return $this;
	}	
	/**
	 * Get String
	 *
	 * @return String
	 */
	public function __toString() {
		return strval ($this->name." - ".$this->amount." $");
	}
	public function getCant() {
		return $this->cant;
	}
	public function setCant($cant) {
		$this->cant = $cant;
		return $this;
	}
	public function getId() {
		return $this->id;
	}		
	
}