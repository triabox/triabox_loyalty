<?php

namespace Amateur\EventBundle\Services;


use Amateur\ObjectBundle\Entity\Enrolled;
use Amateur\ObjectBundle\Entity\Payment;
use Amateur\ObjectBundle\Entity\Entry;
use Doctrine\ORM\NoResultException;


/**
 * @author jonatan
 *
 */
class PaymentServices
{

	protected $controller;
	protected $eventServices;

	/**
	 * 
	 * @param $controller
	 */
	public function __construct($controller)
	{
		$this->controller = $controller;
		$this->eventServices =  new EventServices($controller);

	}
	
	public function createPayment($idEntry,$idEvent){
		
		$em = $this->controller->getDoctrine()->getManager();
		$entry = $em->getRepository('ObjectBundle:Entry')->find($idEntry);
		$enrolled = $this->eventServices->getEnrolledByEventAndCurrentUser($idEvent);		
		$payment = $this->getPaymentByEnrolled($enrolled);
		$payment->setState("02");//pendiente de pago
		$payment->setEntry($entry);		
// 		$enrolled = new Enrolled();
		$enrolled->setPayment($payment);
		$payment->setEnrolled($enrolled);
		$em->persist($enrolled);
		$em->flush();
		
		return $payment;
	}
	
	public function confirmPayment($idPayment){
	
		$em = $this->controller->getDoctrine()->getManager();
		$payment = $this->getPaymentById($idPayment);
// 		$entry = new Entry();
		$entry = $payment->getEntry();
		$entry->setCant($entry->getCant()-1);
		
		$payment->setState("01");//pagado
		$em->persist($entry);
		$em->persist($payment);
		$em->flush();
	
		return $payment;
	}
	
	public  function getPaymentByEnrolled($enrolled){

		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		
		$payment = new Payment();
		try {
		
			$payment = $qb->select("en")
			->add('from', 'ObjectBundle:Payment en')
			->innerJoin('en.enrolled','e')
			->where('e.id = :idEnrolled')
			->setParameter('idEnrolled', $enrolled->getId())
			->getQuery ()
			->getSingleResult();
			
		} catch (NoResultException $e) {
				
		
		}
			
		
		return  $payment;
		
	}
	
	public function getPaymentById($id){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		$payment = $em->getRepository('ObjectBundle:Payment')->find($id);
		
		return $payment;
	}
	
	
	
		
}
