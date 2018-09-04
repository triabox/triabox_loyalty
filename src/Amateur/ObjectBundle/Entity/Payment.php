<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity
 */
class Payment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected  $id;

    /**
     * @var string      * 02 -> Pendiente de pago     * 01 -> Pagado
     *
     * @ORM\Column(name="state", type="string", length=45, nullable=true)
     */
    protected $state;
    protected $entry;        protected $enrolled;
    public function __toString() {
    	return strval ( $this->id);
    }
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getState() {
		return $this->state;
	}
	public function setState( $state) {
		$this->state = $state;
		return $this;
	}
	public function getEntry() {
		return $this->entry;
	}
	public function setEntry($entry) {
		$this->entry = $entry;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function getEnrolled() {
		return $this->enrolled;
	}
	public function setEnrolled($enrolled) {
		$this->enrolled = $enrolled;
		return $this;
	}				
}