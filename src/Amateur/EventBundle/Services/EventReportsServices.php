<?php

namespace Amateur\EventBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Amateur\ObjectBundle\Entity\Punctuation;
use Doctrine\ORM\NoResultException;
use Amateur\ObjectBundle\Entity\Classification;
use Amateur\ObjectBundle\Entity\Enrolled;
use Amateur\ObjectBundle\Entity\User;
use Amateur\NewsUserBundle\Services\NewsUserServices;
use Amateur\ObjectBundle\Entity\Event;
use Xtending\ServicesBundle\Services\ExcelServices;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Amateur\ObjectBundle\Entity\Category;
use Amateur\ObjectBundle\Entity\ReportsSport;





/**
 * @author jonatan
 *
 */
class EventReportsServices 
{

	protected $controller;
	
	protected $newsUserServices;
	
	protected $excelServices;
	

	
	/**
	 * 
	 * @param $controller
	 */
	public function __construct($controller)
	{
		$this->controller = $controller;
		$this->newsUserServices = new NewsUserServices($controller);
		$this->excelServices  = new ExcelServices($this);
	}
	
	public function getEnrolledEventByUser($idUser){
			
		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
	
			$enrolled = $qb->select("en")
			->add('from', 'ObjectBundle:Enrolled en')
			->andWhere('en.user = :idUsuario')			
			->setParameter('idUsuario', $idUser)->getQuery ()
			->getResult();
	
			
		return $enrolled;
			
	}
	
	public function getEnrolledForReport($idUser){
		
		$enrolleds = $this->getEnrolledEventByUser($idUser);
		
		
		$arrayEnrolled = $this->getArrayEventsByDistance($enrolleds);
		
		return $arrayEnrolled;
	}
	
	public function getArrayEventsByDistance( $enrolleds){
		
		//$arrayEvent = array();
		
		$arrayEvent = new ArrayCollection();
		
		foreach ($enrolleds as $enrolled){
			
			if($enrolled->getCategory() != null and $enrolled->getTime() != ''){
				
				//Running
				if($enrolled->getEvent()->getSport()->getId() == 9){
					
					//revisamos si esta el deporte y la distancia cargada en el array
					if($arrayEvent->containsKey($enrolled->getEvent()->getSport()->getName().$enrolled->getCategory()->getDistanceFirstRun())){
						
						//obtenemos el objeto del array
						$reportSport = $arrayEvent->get($enrolled->getEvent()->getSport()->getName().$enrolled->getCategory()->getDistanceFirstRun());
						//agregamos los datos en ReportsSport
						$reportSport->getEnrolleds()->add($enrolled);
						//Actualizamos el objeto en el array
						$arrayEvent->set($enrolled->getEvent()->getSport()->getName().$enrolled->getCategory()->getDistanceFirstRun(), $reportSport);
					
					}else{// Si no existe se agrega de nuevo

						$reportSport = new ReportsSport();
						$reportSport->setDistance($enrolled->getCategory()->getDistanceFirstRun());
						$reportSport->setSport($enrolled->getEvent()->getSport()->getName());
						//agregamos los datos en ReportsSport
						$reportSport->getEnrolleds()->add($enrolled);
						//Actualizamos el objeto en el array
						$arrayEvent->set($enrolled->getEvent()->getSport()->getName().$enrolled->getCategory()->getDistanceFirstRun(), $reportSport);
					
					}
				
				}
			}
		}
		
		return $arrayEvent;
		
	}
	
	public function getReportRunning($idUser){
		
		$enrolleds = $this->getEnrolledEventByUserRunnig($idUser);
		
		$arrayEvent = new ArrayCollection();
		
		foreach ($enrolleds as $enrolled){
				
			if($enrolled->getCategory() != null and $enrolled->getTime() != ''){
		
				//Running
				if($enrolled->getEvent()->getSport()->getId() == 9){
						
					//revisamos si esta el deporte y la distancia cargada en el array
					if($arrayEvent->containsKey($enrolled->getEvent()->getSport()->getName().$enrolled->getCategory()->getDistanceFirstRun())){
		
						//obtenemos el objeto del array
						$reportSport = $arrayEvent->get($enrolled->getEvent()->getSport()->getName().$enrolled->getCategory()->getDistanceFirstRun());
						//agregamos los datos en ReportsSport
						$reportSport->getEnrolleds()->add($enrolled);
						//Actualizamos el objeto en el array
						$arrayEvent->set($enrolled->getEvent()->getSport()->getName().$enrolled->getCategory()->getDistanceFirstRun(), $reportSport);
							
					}else{// Si no existe se agrega de nuevo
		
						$reportSport = new ReportsSport();
						$reportSport->setDistance($enrolled->getCategory()->getDistanceFirstRun());
						$reportSport->setSport($enrolled->getEvent()->getSport()->getName());
						//agregamos los datos en ReportsSport
						$reportSport->getEnrolleds()->add($enrolled);
						//Actualizamos el objeto en el array
						$arrayEvent->set($enrolled->getEvent()->getSport()->getName().$enrolled->getCategory()->getDistanceFirstRun(), $reportSport);
							
					}
		
				}
			}
		}
		return $arrayEvent;
	}
	
	public function getEnrolledEventByUserRunnig($idUser){
			
		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
	
		$enrolled = $qb->select("en")
		->add('from', 'ObjectBundle:Enrolled en')
		->innerJoin('en.event','e')
		->andWhere('en.user = :idUsuario')
		->andWhere('e.sport = :idSport')
		->setParameter('idSport', 9)
		->setParameter('idUsuario', $idUser)->getQuery ()
		->getResult();
	
			
		return $enrolled;
			
	}	
	/**
	 *llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll
	 */	
	
	
	/**
	 * Obtiene los proximos eventos a ocurrir
	 * 
	 * @param Paginator $paginator
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function nextEvent($paginator){

		$em = $this->controller->getDoctrine()->getManager();
		

		$qb = $em->createQueryBuilder();
		$query =  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->where('e.startTime > :today')
		->andWhere('e.isActive = :active')
		->setParameter('active', 1)
		->setParameter('today', date("Y-m-d"))
		->orderBy('e.startTime', 'ASC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();

		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
		
		return $paginator;
		
	}
	
	/**
	 * Obtiene los  eventos pasados
	 *
	 * @param Paginator $paginator
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function pastEvent($paginator){
	
		$em = $this->controller->getDoctrine()->getManager();
	
	
		$qb = $em->createQueryBuilder();
		$query =  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->where('e.startTime <= :today')
		->andWhere('e.isActive = :active')
		->setParameter('active', 1)
		->setParameter('today', date("Y-m-d"))
		->orderBy('e.startTime', 'ASC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();
	
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
	
		return $paginator;
	
	}
	
	/**
	 * Obtiene los  eventos proximos por deporte
	 *
	 * @param Paginator $paginator
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function getEventNextBySport($idSport,$paginator){
	
		$em = $this->controller->getDoctrine()->getManager();
	
	
		$qb = $em->createQueryBuilder();
		$query =  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->where('e.startTime > :today')
		->andWhere('e.isActive = :active')
		->andWhere('e.sport = :sport')
		->setParameter('sport', $idSport)
		->setParameter('active', 1)
		->setParameter('today', date("Y-m-d"))
		->orderBy('e.startTime', 'ASC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();
	
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
	
		return $paginator;
	
	}
	

	
	
	public function createPunctuation(Punctuation $puntuation,$idEvent){
		
		$puntuation->setTotal(($puntuation->getLocation()
							  +$puntuation->getCircuit()
							  +$puntuation->getOrganization()
							  +$puntuation->getNutrition()
							  +$puntuation->getPunctuality()
							  +$puntuation->getAssistance()
							  +$puntuation->getKit())/7);
		
		if(!$this->validateEnrolled($idEvent,$this->controller->getUser()->getId())){
		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		 
		$enrolle =  $qb->select("en")
		->add('from', 'ObjectBundle:Enrolled en')
		->innerJoin('en.event','e')
		->innerJoin('en.user','u')
		->where('e.id = :idEvent')
		->andWhere('u.id = :idUser')
		->setParameter('idEvent', $idEvent)
		->setParameter('idUser', $this->controller->getUser()->getId())->getQuery ()
		->getSingleResult();

		
		$enrolle->setPunctuation($puntuation);
		$em->persist($puntuation);
		$em->flush();
		}
		return true;
	}
	
	public function getFriendFromEventByUser(Event $event,User $user){
		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		$idsFriend = array();
		$friends = $user->getFriends();
		foreach ($friends as $friend){
			$idsFriend[] = $friend->getId();
		
		}
		if(count($idsFriend)>0){
			$enrolleds =  $qb->select("en")
			->add('from', 'ObjectBundle:Enrolled en')
			->innerJoin('en.event','e')
			->innerJoin('en.user','u')
			->where('e.id = :idEvent')
			->andWhere('u.id IN (:idUser)')
			->setParameter('idEvent', $event->getId())
			->setParameter('idUser', $idsFriend)->getQuery ()
			->getResult();
			
			$friends = new ArrayCollection();
			
			foreach ($enrolleds as $enrolle){
				$friends->add($enrolle->getUser());
			}
		}
		
		
		return $friends;
	}
	
	public function validateEnrolled($idEvent,$idUser){
		 
		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		try {
	
			$qb->select("en")
			->add('from', 'ObjectBundle:Enrolled en')
			->innerJoin('en.event','e')
			->innerJoin('en.user','u')
			->where('e.id = :idEvent')
			->andWhere('u.id = :idUsuario')
			->setParameter('idEvent', $idEvent)
			->setParameter('idUsuario', $idUser)->getQuery ()
			->getSingleResult();
		} catch (NoResultException $e) {
			return true;
		}
		 
		return false;
		 
	}
	
	public function asigneResultEvent($idClassification,$idEvent,$user){

		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		try {
			//Obtengo la inscripcion
			$enrolled =	$qb->select("en")
			->add('from', 'ObjectBundle:Enrolled en')
			->innerJoin('en.event','e')
			->innerJoin('en.user','u')
			->where('e.id = :idEvent')
			->andWhere('u.id = :idUsuario')
			->setParameter('idEvent', $idEvent)
			->setParameter('idUsuario', $user->getId())->getQuery ()
			->getSingleResult();
			
			
			
		} catch (NoResultException $e) {
			//Se crea la inscripcion si no existia
			$event =  $em->getRepository('ObjectBundle:Event')->find($idEvent);
			$enrolled = new Enrolled();
			$enrolled->setUser($user);
			$enrolled->setEvent($event);
			
		}
		
		
		//Compruebo que solo una ves se le asigne
		if($enrolled->getClassification() == null){
			//Asigno la clasificacion a la inscripcion
			$classification =  $em->getRepository('ObjectBundle:Classification')->find($idClassification);
			$classification->setIsUser(2);
			$enrolled->setClassification($classification);
				
			$em->persist($enrolled);
			$em->flush();
		}
		
		
		
		return true;
		 
	}
	
	/**
	 * Busca resultados del usuario logueado en los resultados cargados.
	 * 
	 * @param User $user
	 * @return ArrayCollection
	 */
	public function searchResult(User $user){
		
		$em = $this->controller->getDoctrine()->getManager();

		$classifications = $em->getRepository("ObjectBundle:Classification")->createQueryBuilder('u')
		->where('u.name LIKE :name')
		->andWhere('u.lastname LIKE :lastname')
		->andWhere('u.isUser != :isUser')
		->setParameter('name', '%'.$user->getName().'%')
		->setParameter('lastname', '%'.$user->getLastname().'%')
		->setParameter('isUser', 2)
		->getQuery()
		->getResult();

		return $classifications;
		
	}
	
	/**
	 * Crea un evento 
	 * 
	 * @param Event $event
	 * @return Event
	 */
	public function createEvent(Event $event){
		
		
		$result = $this->excelServices->importExcelResult($event,$event->getLabelLink());
		
		$event->setClassifications($result);
		$em = $this->controller->getDoctrine()->getManager();
		$event->setStartTime(date("Y-m-d", strtotime($event->getStartTime())));
		
		$em->persist($event);
		$em->flush();
		
		//Si no esta activo no se crea la notificacion
		if($event->getIsActive()){
			$this->newsUserServices->createEvent($event);
		}
		return $event;
		
	}
	
	public function createEnrolled($idEvent,User $user){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		$event = $em->getRepository('ObjectBundle:Event')->find($idEvent);
		
		$enrolled  = new Enrolled();
		if ( $this->validateEnrolled($event->getId(),$user->getId()) ){
			
			$enrolled->setUser($user);
			$enrolled->setEvent($event); 
		
			$user->addRegistration($enrolled);
		
			$em->persist($user);
			$em->flush();
			
			$this->newsUserServices->createEnrolledEvent($enrolled,$event);
			
		}else {
			$enrolled = null;
		}
		
		return $enrolled;
	}
	
	/**
	 * 
	 * Obtiene los eventos del usuario que esta inscripto y que ya ocurrieron.
	 * 
	 * @param User $user
	 * @param Array $paginator contiene los limites de la busqueda para pagina (firstResult,maxResults)
	 * @return ArrayCollection Events
	 */
	public function getEventEnrolledUserPast(User $user,$paginator){
	
		$events = $this->getEventEnrolledUser($user,$paginator,"<=");
	
		return $events;
	}
	
	/**
	 *
	 * Obtiene los eventos del usuario que esta inscripto y que no ocurrieron.
	 *
	 * @param User $user
	 * @param Array $paginator contiene los limites de la busqueda para pagina (firstResult,maxResults)
	 * @return ArrayCollection Events
	 */
	public function getEventEnrolledUserNext(User $user,$paginator){
	
		$events = $this->getEventEnrolledUser($user,$paginator,">");
	
		return $events;
	}
	
	public function getEventEnrolledUser(User $user,$paginator,$time){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		$qb = $em->createQueryBuilder();
		
		$query =  $qb->select("en")
		->add('from', 'ObjectBundle:Enrolled en')
		->innerJoin('en.event','e')
		->innerJoin('en.user','u')
		->where('e.startTime '.$time.' :today')
		->andWhere('u.id <= :idUser')
		->setParameter('today', date("Y-m-d"))
		->setParameter('idUser', $user->getId())
		->orderBy('e.startTime', 'DESC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();
		
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
		
		
		$events = new ArrayCollection();
		
		foreach ($paginator as $en){
			$events->add($en->getEvent());
		
		}
		
		return $events;
	}
	
	
	public function getNewsUserAndFriends($user,$firstResult,$maxResults){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$qb = $em->createQueryBuilder();
	
		$friends = $user->getFriends();
	
		$ids = array();
		foreach($friends as $f) {
			$ids[] = $f->getId();
		}
		$ids[] = $user->getId();
	
		$query =  $qb->select("nu")
		->add('from', 'ObjectBundle:NewsUser nu')
		->andWhere('nu.user IN (:ids)')
		->setParameter('ids', $ids)->orderBy('nu.id', 'DESC')
		->setFirstResult($firstResult)
		->setMaxResults($maxResults)->getQuery ();
			
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
	
		return  $paginator;
	
	}
	
	/**
	 * Busqueda de eventos
	 * 
	 * @param unknown $search
	 * @return unknown
	 */
	public function seachEvent($search)
	{
		$em = $this->controller->getDoctrine()->getManager();
		
		$entities = $em->getRepository("ObjectBundle:Event")->createQueryBuilder('u')
		->innerJoin('u.categories','ca')
		->innerJoin('u.sport','s')
		->orWhere('s.name LIKE :search')
		->orWhere('ca.distanceTotal LIKE :search')
		->orWhere('u.city LIKE :search')
		->orWhere('u.province LIKE :search')
		->orWhere('u.country LIKE :search')
		->orwhere('u.name LIKE :search')
		->andWhere('u.isActive = :active')
		->setParameter('active', 1)
		->setParameter('search', '%'.$search.'%')
		->getQuery()
		->getResult();
		 
		return $entities;
	}
	
	/**
	 * Obtener Clasificacion de evento por id evento
	 *
	 * @param int $idEvent
	 * @return ArrayCollection Classification
	 */
	public function getClassificationByIdEventEvent($firstResult,$maxResults,$idEvent)
	{
		$em = $this->controller->getDoctrine()->getManager();
	
		$query = $em->getRepository("ObjectBundle:Classification")->createQueryBuilder('u')
		->where('u.event = :idEvent')
		->andWhere('u.isUser = :isUser')
		->orderBy('u.overallRank', 'ASC')
		->setParameter('idEvent', $idEvent)
		->setParameter('isUser', 0)
		
		->setFirstResult($firstResult)
		->setMaxResults($maxResults)->getQuery();
			
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
	
			
		return $paginator;
	}
	
	/**
	 * Obtener Clasificacion de evento por id evento
	 *
	 * @param int $idEvent
	 * @return ArrayCollection Classification
	 */
	public function getClassificationByIdEvent($idEvent)
	{
		$em = $this->controller->getDoctrine()->getManager();
	
		$query = $em->getRepository("ObjectBundle:Classification")->createQueryBuilder('u')
		->where('u.event = :idEvent')
		->andWhere('u.isUser = :isUser')
		->orderBy('u.overallRank', 'ASC')
		->setParameter('idEvent', $idEvent)
		->setParameter('isUser', 0)->getQuery()->getResult();
			
		return $query;
	}
	
}
