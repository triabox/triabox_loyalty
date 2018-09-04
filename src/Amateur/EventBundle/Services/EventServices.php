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
use Doctrine\ORM\Query\AST\Join;
use Amateur\ObjectBundle\Entity\EventPath;
use Doctrine\Common\Collections\Collection;
use Xtending\ServicesBundle\Services\GeolocationServices;
use ZendPdf\Resource\Font\Simple\Standard\ZapfDingbats;





/**
 * @author jonatan
 *
 */
class EventServices 
{

	protected $controller;
	
	protected $newsUserServices;
	
	protected $excelServices;
	
	protected $geolocationServices;
	
	/**
	 * 
	 * @param $controller
	 */
	public function __construct($controller)
	{
		$this->controller = $controller;
		$this->newsUserServices = new NewsUserServices($controller);
		$this->excelServices  = new ExcelServices($controller);
		$this->geolocationServices = new GeolocationServices($controller);
	}
	
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
	 * Obtiene los eventos que tienen los resultados cargados.
	 *
	 * @param Paginator $paginator
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function lastResultEvent($paginator){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		
		$qb = $em->createQueryBuilder();
		$query =  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->innerJoin('e.classifications','c')
		->orderBy('e.startTime', 'DESC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();
	
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
	
		return $paginator;
	
	}
	
	/**
	 * Obtiene los eventos que no tienen cargados los resultados.
	 *
	 * @param Paginator $paginator
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function lastEventWithOutResultEvent($paginator){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$qb2 = $em->createQueryBuilder();
		$qb = $em->createQueryBuilder();
		$querySub =  $qb2->select("e")
		->add('from', 'ObjectBundle:Event e')
		->innerJoin('e.classifications','c');
		
		$query = $qb->select("ev")->from('ObjectBundle:Event','ev')
				->where($qb->expr()
				->notIn('ev.id',$querySub->getDQL()))
				->andWhere('ev.startTime < :today')
				->andWhere('ev.isActive = :active')
				->setParameters(array(
								'active' => 1,
								'today' => date("Y-m-d"),))
								
						->setFirstResult($paginator['firstResult'])
						->setMaxResults($paginator['maxResults'])
						->orderBy('ev.startTime', 'DESC')
				->getQuery();
		
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
	
		return $paginator;
	
	}
	
	/**
	 * Obtiene los  eventos que ocurren en el dia
	 *
	 * @return ArrayCollection
	 */
	public function getToDayEvents(){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$qb = $em->createQueryBuilder();
		
		$events =  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->where('e.startTime = :today')
		->andWhere('e.isActive = :active')
		->andWhere('e.isTop = :isTop')
		->setParameter('active', 1)
		->setParameter('isTop', 1)
		->setParameter('today', date("Y-m-d"))
		->orderBy('e.startTime', 'ASC')->getQuery ()->getResult();
	
		return $events;
	
	}
	
	/**
	 * Obtiene todos los usuarios online de un evento
	 */
	public function getAllUserOnlineEvent($idEvent){
		$em = $this->controller->getDoctrine()->getManager();
		
		$qb = $em->createQueryBuilder();
		
		$eventsPath =  $qb->select("e")
		->add('from', 'ObjectBundle:EventPath e')
		->where('e.event = :eventId')
		->andwhere('e.idPath != :idPath')
		->andWhere('e.idPath != :idPath2')
		->groupBy('e.idPath')
		->setParameter('eventId', $idEvent)
		->setParameter('idPath2', "route" )
		->setParameter('idPath', "k" ) //todo: FEOOO CAMBIAR
		->getQuery ()->getResult();
		
		return $eventsPath;
		
	}
	
	/**
	 * 
	 * Obtiene todos los usuarios online de los eventos que ocurren en el dia
	 * @return ArrayCollection
	 */
	public function getAllUserOnlineToday(){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		$qb = $em->createQueryBuilder();
		
		$eventsPath =  $qb->select("e")
		->add('from', 'ObjectBundle:EventPath e')
		->innerJoin('en.event','ev')
		->where('en.startTime = :today')
		->andWhere('e.idPath != :idPath')
		->andWhere('e.idPath != :idPath2')
		->groupBy('e.idPath')
		->setParameter('today', date("Y-m-d"))
		->setParameter('idPath2', "route" )
		->setParameter('idPath', "k" ) //todo: FEOOO CAMBIAR
		->getQuery ()->getResult();
		
		return $eventsPath;
	}
	
	/**
	 * Obtiene los  eventos que ocurren en el dia
	 *
	 * @return ArrayCollection
	 */
	public function getPointsEvent($idEvent,$name){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$qb = $em->createQueryBuilder();
	
		$eventsPath =  $qb->select("e")
		->add('from', 'ObjectBundle:EventPath e')
		->where('e.event = :eventId')
		->andWhere('e.idPath = :idPath')->
		orderBy('e.time', 'ASC')
		->orderBy('e.id', 'ASC')
		->setParameter('eventId', $idEvent)
		->setParameter('idPath', $name)->getQuery ()->getResult();
	
		return $eventsPath;
	
	}
	
	/**
	 * Obtiene los la unicacion del corredor en un entrenamiento
	 *
	 * @return ArrayCollection
	 */
	public function getPointsTraining($idTraining,$name){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$qb = $em->createQueryBuilder();
	
		$eventsPath =  $qb->select("e")
		->add('from', 'ObjectBundle:EventPath e')
		->where('e.training = :idTraining')
		->andWhere('e.idPath = :idPath')->
		orderBy('e.time', 'ASC')
		->orderBy('e.id', 'ASC')
		->setParameter('idTraining', $idTraining)
		->setParameter('idPath', $name)->getQuery ()->getResult();
	
		return $eventsPath;
	
	}
	
	/**
	 * Obtiene el ultimo puento del camino online
	 *
	 * @return ArrayCollection
	 */
	public function getLastPointEvent($idEvent,$name){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$qb = $em->createQueryBuilder();
	
		$eventsPath =  $qb->select("e")
		->add('from', 'ObjectBundle:EventPath e')
		->where('e.event = :eventId')
		->andWhere('e.idPath = :idPath')
		->setParameter('eventId', $idEvent)
		->setParameter('idPath', $name)
		->setMaxResults(1)->
		orderBy('e.time', 'DESC')->
		
		getQuery ()->getResult();
		
		if(!empty($eventsPath)){
			$eventPath = $eventsPath[0];
		}else{$eventPath = null;}
		
	
		return $eventPath;
	
	}
	
	/**
	 * Obtiene el ultimo puento del camino online de un entrenamiento
	 *
	 * @return ArrayCollection
	 */
	public function getLastPointTraining($idTraining,$name){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$qb = $em->createQueryBuilder();
	
		$eventsPath =  $qb->select("e")
		->add('from', 'ObjectBundle:EventPath e')
		->where('e.training = :idTraining')
		->andWhere('e.idPath = :idPath')
		->setParameter('idTraining', $idTraining)
		->setParameter('idPath', $name)
		->setMaxResults(1)->
		orderBy('e.time', 'DESC')->
	
		getQuery ()->getResult();
	
		if(!empty($eventsPath)){
			$eventPath = $eventsPath[0];
		}else{$eventPath = null;}
	
	
		return $eventPath;
	
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
	public function getEventNextBySport($idSport,$paginator,$log,$lat,$isTop){
	
		$em = $this->controller->getDoctrine()->getManager();
		
		if($log != 'n'){
			//Filtra por distancia si el usuario acepta la distancia o si tiene la distancia configurada
		$ids = $this->geolocationServices->getIdObjetAroundDistance($lat,$log, 200,'event');
		}
		$qb = $em->createQueryBuilder();
		  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->where('e.startTime > :today')
		->andWhere('e.isActive = :active')
		->andWhere('e.sport = :sport');
		
		if($log != 'n'){
		$qb->andWhere('e.id IN (:ids)')
		->setParameter('ids', $ids)->orderBy('e.startTime', 'ASC');
		}
		if($isTop){
			$qb->andWhere('e.isTop = :isTop')
			->setParameter('isTop', 1);
		}
		
		$query = $qb->setParameter('sport', $idSport)
		->setParameter('active', 1)
		->setParameter('today', date("Y-m-d"))
		->orderBy('e.startTime', 'ASC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();
	
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
		
		if($log != 'n'){
		$paginator = $this->addDistance($paginator,$ids,$isTop);
		}
		return  $paginator;
		
	
	}
	
	public function addDistance($paginator,$distances,$isTop){
		
		$eventos = new ArrayCollection();
		
		foreach ($paginator as $event) {
			$key = array_search($event->getId(), array_column($distances, 'id'));
			$event->setDistanceMe($distances[$key]["distance"]);
			$eventos->add($event);
		}
		
		if($isTop){
			$iterator = $eventos->getIterator();
			$iterator->uasort(function ($a, $b) {
				return ($a->getDistanceMe() < $b->getDistanceMe()) ? -1 : 1;
			});
				$eventos = new ArrayCollection(iterator_to_array($iterator));
		}
		return $eventos;
		
	}
	

	
	
	public function createPunctuation(Punctuation $puntuation,$idEvent){
		
		$puntuation->setTotal(($puntuation->getLocation()
							  +$puntuation->getCircuit()
							  +$puntuation->getOrganization()
							  +$puntuation->getNutrition()
							  +$puntuation->getPunctuality()
							  +$puntuation->getAssistance()
							  +$puntuation->getKit())/7);
		
		$em = $this->controller->getDoctrine()->getManager();
		
		if($this->validateEnrolled($idEvent,$this->controller->getUser()->getId())){//valida inscripcion evento
			$event = new Event();
				
			$event = $em->getRepository('ObjectBundle:Event')->find($idEvent);
				
			$enrolle = $this->createEnrolled($idEvent,"",$event->getCategories()->first()->getId(), $this->controller->getUser());
		
		}else {
			$enrolle = $this->getEnrolledByEventAndCurrentUser($idEvent);
		}		
		$enrolle->setPunctuation($puntuation);
		$em->persist($puntuation);
		$em->flush();
		return true;
	}
	
	/**
	 * 
	 * Busca si el usuario esta inscripto, si ya esta inscripto devuelve la inscripcion, 
	 * en el caso de no estar inscripto devuelve una nueva inscripcion
	 * 
	 * @param interge $idEvent 
	 * @return Enrolled
	 */
	function getEnrrolledByUserEvent($idEvent,$user){
		
		$enrolle = new Enrolled();
		
		if(!$this->validateEnrolled($idEvent,$user->getId())){//valida inscripcion evento
			
			$enrolle = $this->getEnrolledByEventAndCurrentUser($idEvent);
		
		}
		
		return $enrolle;
	}
	
	/**
	 * 
	 * Obtener Inscripcion por Id
	 * 
	 * @param Integer $id
	 * @return Enrrolled
	 */
	public function getEnrolledById($id){
		$em = $this->controller->getDoctrine()->getManager();
		
		
		$enrolled =  $em->getRepository('ObjectBundle:Enrolled')->find($id);
		
		return $enrolled;
		
	}
	
	
	/**
	 * Obtiene la inscripcion por un id de evento y el usuario actual
	 * 
	 * @param unknown $idEvent
	 * @return unknown
	 */
	public function getEnrolledByEventAndCurrentUser($idEvent){
		
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
		
		return  $enrolle;
		
		
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
	
	
	/**
	 * Devuelve todos los inscriptos a un evento
	 * 
	 * @param Integer $idEvent
	 * @return ArrayCollection Inscriptos
	 */
	public function getAllEnrolledToEvent($idEvent){
		
		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		
		$enrolleds =  $qb->select("en")
		->add('from', 'ObjectBundle:Enrolled en')
		->innerJoin('en.event','e')
		->where('e.id = :idEvent')
		->setParameter('idEvent', $idEvent)
		->getQuery()
		->getResult();
		
		
		return  $enrolleds;
	}
	
	/**
	 * Valida si el usuario esta inscripto al evento
	 * 
	 * @param Integer $idEvent id Evento
	 * @param Integer $idUser id Usuario
	 * @return boolean
	 */
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
			$classification->setEnrolled($enrolled);
			$em->persist($classification);
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
		->setParameter('name', '%'.$user->getName().'%'.$user->getLastname())
		->setParameter('lastname', '%'.$user->getLastname().'%')
		->setParameter('isUser', 2)
		->getQuery()
		->getResult();

		return $classifications;
		
	}

	/**
	 * Busca resultados por nombre, apellido o codigo
	 * 
	 * @param string $search
	 * @param int $idEvent
	 * @return ArrayCollection 
	 */
	public function searchResultByNameAndBib($search,$idEvent){
	
		$em = $this->controller->getDoctrine()->getManager();
	
	
                        
                $query = $em->getRepository("ObjectBundle:Classification")->createQueryBuilder('u')
		->innerJoin('u.event','e')
		->where('u.name LIKE :search')
		->orWhere('u.lastname LIKE :search')
		->orWhere('u.bib LIKE :search')
		->andWhere('e.id = :idEvent')
		->orderBy('e.startTime', 'DESC')
		->setParameter('search', '%'.$search.'%')
		->setParameter('idEvent', $idEvent)
		->getQuery();
		
                $classifications = $query->getResult();
	
		return $classifications;
	
	}
        
        /**
	 * Busca resultados en todoso los eventos por nombre o apellido que no estan asignados a un usuario
	 * 
	 * @param string $search
	 * @return ArrayCollection 
	 */
	public function searchAllResultByName($search){            
        
		$array = explode(chr(32),$search);

		$em = $this->controller->getDoctrine()->getManager();
	
                $query = $em->getRepository("ObjectBundle:Classification")->createQueryBuilder('u')
		->innerJoin('u.event','e')       
		->where('u.name LIKE :name')
                ->andWhere('u.isUser != :isUser')
                ->setParameter('isUser', 2)
                ->setParameter('name', '%'.$array[0].'%');
                if(!empty($array[1])){
		$query->andWhere('u.lastname LIKE :lastname')
		->setParameter('lastname', '%'.$array[1].'%');
		
                }
                $query->orderBy('e.startTime', 'DESC');
                $classifications = $query->getQuery()->getResult();
	
		return $classifications;
	
	}
	/**
	 * Crea un evento 
	 * 
	 * @param Event $event
	 * @return Event
	 */
	public function createEvent(Event $event){
		
		
		$this->excelServices->removeFile($event->getLabelLink());
		$event->setLabelLink("");
		
		
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
	
	public function createEnrolled($idEvent,$tiempo,$distancia,User $user){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		$event = $em->getRepository('ObjectBundle:Event')->find($idEvent);
		$category = $em->getRepository('ObjectBundle:Category')->find($distancia);
		
		$enrolled = $this->getEnrrolledByUserEvent($idEvent,$user);
		$idEnrolled = $enrolled->getId();
		$enrolled->setUser($user);
		$enrolled->setEvent($event);
		$enrolled->setObjetive($tiempo);
		$enrolled->setCategory($category);
		$user->addRegistration($enrolled);
			
		$em->persist($user);
		$em->flush();
		
		if ( $idEnrolled == "" ){//Si ya esta creado no se envia nuevamente la notificacion
			$this->newsUserServices->createEnrolledEvent($enrolled,$event);
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
	
	/**
	 * 
	 * Devuelve las inscripciones del usuario segun $time antes o despues de hoy
	 * 
	 * @param User $user
	 * @param Paginator $paginator
	 * @param > o < $time
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function getEnrrolledUser(User $user,$paginator,$time){
		
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
		
		return $paginator;
		
	}
	
	public function getEventEnrolledUser(User $user,$paginator,$time){
		
		$paginator = $this->getEnrrolledUser($user, $paginator, $time);
		
		
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
	
	public function getEventosRio($search,$fecha,$mayor){
	
		$em = $this->controller->getDoctrine()->getManager();
		
		$entities = $em->getRepository("ObjectBundle:Event")->createQueryBuilder('u')
		
		->where('u.name LIKE :search')
		->orWhere('u.city LIKE :search')
		->orWhere('u.province LIKE :search')
		->orWhere('u.country LIKE :search')
		
		->andWhere('u.isActive = :active')
		->andwhere('u.startTime '.$mayor.' :today')
		->setParameter('today', $fecha)
		->setParameter('active', 1)
		->setParameter('search', '%'.$search.'%')
		->orderBy('u.startTime', 'ASC')
		
		
		->getQuery()
		->getResult();
			
		return $entities;
		
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
		->orderBy('u.startTime', 'DESC')
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
// 		->andWhere('u.isUser = :isUser')
                ->orderBy('u.netoTime', 'ASC') 
		->orderBy('u.overallRank', 'ASC')
		->setParameter('idEvent', $idEvent)
// 		->setParameter('isUser', 0)
		
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
	
	public function calculateDistanceForPathEvent($eventPaths){
		
		$distance = 0;
		if(!empty($eventPaths)){
			$eventPath1 = $eventPaths[0];
			
			foreach($eventPaths as $eventPath) {
				
				$distance = $distance + $this->calculateDistanceBetweenPoint($eventPath1->getLatitude(), $eventPath1->getLatitude(),
						 $eventPath->getLatitude(), $eventPath->getLatitude(), "K");
				
				
				$eventPath1 = $eventPath;
			}
		}
		return $distance;
		
	}
	
	
	
	/**
	 * Calculo los intervalos cada un kilometro de un usuario que participo o participa en un evento
	 * 
	 * @param ArrayCollection $eventPaths Contiene los puntos recorridos por el usuario.
	 * @return Ambigous <multitype:, string>
	 */
	public function calculateStatisticsForPathEvent($eventPaths){
	
		$statistics = array();
		$distance = 0;
		$cant = 1;
	
		$eventPath1 = $eventPaths[0];
		$eventPathFirst = $eventPaths[0]; 
		foreach($eventPaths as $eventPath) {
				
			$distance = $distance + $this->calculateDistanceBetweenPoint($eventPath1->getLatitude(), $eventPath1->getLatitude(),
					$eventPath->getLatitude(), $eventPath->getLatitude(), "K");
			
			if($distance >= $cant){
				$statistics[$cant]['interval'] = $cant;
				$statistics[$cant]['distancia'] = 1;
				$statistics[$cant]['distanciaAcumulado'] = round($distance,2);
				$statistics[$cant]['time'] = gmdate("i:s",$this->
				calculateTimeMinuteBetweeDate(strtotime($eventPathFirst->getTime()), 
						strtotime($eventPath->getTime()))/1);
				
				$eventPathFirst = $eventPath;
				$cant = $cant +1;
			}
				
			$eventPath1 = $eventPath;
		}
		if(!empty($eventPaths)){
			
			$statistics[$cant]['interval'] = $cant;
			$statistics[$cant]['distancia'] = 1;
			$statistics[$cant]['distanciaAcumulado'] = round($distance,2);
			$statistics[$cant]['time'] = gmdate("i:s",$this->
				calculateTimeMinuteBetweeDate(strtotime($eventPathFirst->getTime()),
						strtotime(end($eventPaths)->getTime()))/1);
		}
		
	
		return $statistics;
	
	}
	
	/**
	 * @param Timestamp $older
	 * @param Timestamp $newer
	 * @return number
	 */
	public function calculateTimeMinuteBetweeDate($older,$newer){
		
		$s =  $newer - $older;
	
		
		return $s; 
		
	}
	
	
	public function calculateDistanceBetweenPoint($lat1, $lon1, $lat2, $lon2, $unit){
		
		$radius = 6378.137; // earth mean radius defined by WGS84
		$dlon = $lon1 - $lon2;
		$distance = acos( sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($dlon))) * $radius;
		
		if ($unit == "K") {
			return ($distance);
		} else if ($unit == "M") {
			return ($distance * 0.621371192);
		} else if ($unit == "N") {
			return ($distance * 0.539956803);
		} else {
			return 0;
		}
		
		
	}
	
	public function getEventAroundMy(User $user,$paginator){
		
		$ids = $this->geolocationServices->getIdObjetAroundDistance($user->getLatitude(), $user->getLongitude(), 50,'event');

		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		
		$query =  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->where('e.startTime > :today')
		->andWhere('e.isActive = :active')
		->andWhere('e.id IN (:ids)')
		->setParameter('active', 1)
		->setParameter('today', date("Y-m-d"))
		->setParameter('ids', $ids)->orderBy('e.startTime', 'ASC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();
		
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
		
		$c = count($paginator);
		$c = 0;
		$eventos = new ArrayCollection(); 
// 		$event = new Event();
		foreach ($paginator as $event) {
			$event->setDistanceMe($ids[$c]['diatance']);
			$eventos->add($event);
			$c = $c +1;
		}
		
		return  $eventos;
	}
	
	/**
	 * Obtiene los proximos eventos a ocurrir
	 *
	 * @param Paginator $paginator
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function listEventByOrganizer($paginator,$organizerId){
	
		$em = $this->controller->getDoctrine()->getManager();
	
	
		$qb = $em->createQueryBuilder();
		$query =  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->andWhere('e.organizer = :organizer')
		->setParameter('organizer', $organizerId)
		->orderBy('e.startTime', 'DESC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();
	
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
	
		return $paginator;
	
	}
	
	public function listTrainingByIdMobile($idMobile,$paginator){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		
		$qb = $em->createQueryBuilder();
		$query =  $qb->select("e")
		->add('from', 'ObjectBundle:Training e')
		->andWhere('e.idMobile = :idMobile')
		->andWhere('e.isFinish = :isFinish')
		->setParameter('isFinish', 1)
		->setParameter('idMobile', $idMobile)
		->orderBy('e.id', 'DESC')
		->setFirstResult($paginator['firstResult'])
		->setMaxResults($paginator['maxResults'])->getQuery ();
		
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
		
		return $paginator;
		
	}
	
	/**
	 * 
	 * Trae las entradas disponibles para un evento, segun la fecha. 
	 * 
	 * @param Integer $idEvent
	 * @return ArrayCollection Entries
	 */
	public function getEntryValidByEvent($idEvent){
	
		$em = $this->controller->getDoctrine()->getManager();
	
	
		$qb = $em->createQueryBuilder();
		$entries =  $qb->select("e")
		->add('from', 'ObjectBundle:Entry e')
		->where('e.event = :idEvent')
		->andWhere('e.cant > :cant')
		->andWhere('e.start <= :today')
		->andWhere('e.end >= :today')
		->setParameter('today', date("Y-m-d"))
		->setParameter('cant', 0)
		->setParameter('idEvent', $idEvent)->getQuery()->getResult();
		
		return $entries;
	
	}
}
