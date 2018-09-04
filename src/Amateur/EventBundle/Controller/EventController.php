<?php

namespace Amateur\EventBundle\Controller;

use TodoPago\Sdk; 

//importo archivo con SDK

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Amateur\ObjectBundle\Entity\Event;
use Amateur\EventBundle\Form\EventType;
use Xtending\ServicesBundle\Services\ExcelServices;

use Doctrine\Common\Collections\ArrayCollection;
use Amateur\ObjectBundle\Entity\Enrolled;
use Amateur\ObjectBundle\Entity\Punctuation;
use Amateur\EventBundle\Form\PunctuationType;
use Amateur\EventBundle\Services\EventServices;
use Amateur\UserBundle\Services\UserServices;
use Amateur\EventBundle\Form\EnrolledType;
use Symfony\Component\HttpFoundation\Response;
use Amateur\ObjectBundle\Entity\User;
use Amateur\ObjectBundle\Entity\EventPath;
use Amateur\UserBundle\Form\UserType;
use Xtending\ServicesBundle\Services\MailerServices;
use Amateur\ObjectBundle\Entity\Amateur\ObjectBundle\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Amateur\ObjectBundle\Entity\Classification;
use Amateur\NewsUserBundle\Services\NewsUserServices;
use Amateur\EventBundle\Services\PaymentServices;
use Amateur\ObjectBundle\Entity\Payment;
use Amateur\ObjectBundle\Entity\Entry;
use Amateur\ObjectBundle\Entity\Training;




/**
 * EventController
 * 
 * 
 * 
 * @author jonatan
 *
 */
class EventController extends Controller
{
	
	
	/**
	 * @var EventServices : Contiene todas las funcionalidades de los Eventos.
	 */
	protected $eventServices;
	
	/**
	 * @var ExcelServices : Contiene todas las funcionalidades para exportar a Excel.
	 */
	protected $excelServices;
	
        /**
	 * @var ExcelServices : Contiene todas las funcionalidades de los usuarios.
	 */
    protected $userServices;
    /**
	 * @var EmailServices : Envia email
	 */
	protected $emailServices;
	
	
	/**
	 * @var NewsUserServices
	 */
	protected $newsUserServices;
	
	
	/**
	 * @var NewsUserServices
	 */
	protected $paymentServices;
	
	
	public function __construct()
	{
		$this->eventServices = new EventServices($this);
		$this->excelServices = new ExcelServices($this);
		$this->emailServices = new MailerServices($this);
        $this->userServices  = new UserServices($this);
        $this->newsUserServices  = new NewsUserServices($this);
        $this->paymentServices = new PaymentServices($this);
        
		
	}
   
    /**
     * Lista todos todos los eventos del sistema.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

//         $entities = $em->getRepository('ObjectBundle:Event')->findAll();
        $qb = $em->createQueryBuilder();
        $entities =  $qb->select("e")
        ->add('from', 'ObjectBundle:Event e')
        ->andWhere('e.isActive = :active')
        ->setParameter('active', 0)
      	 ->orderBy('e.startTime', 'DESC')->getQuery ()
        ->execute();
        

        return $this->render('EventBundle:Event:index.html.twig', array(
            'entities' => $entities,
        	'firstResult' => 0,
        	'tipe' => "all"
        ));
    }

    
  
    
    
    
    /**
     * Lista los proximos eventos a ocurrir para ajax
     *
     */
    public function nextEventAllAjaxAction($firstResult,$maxResults,$view)
    {
    	
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	$entities = $this->eventServices->nextEvent($paginator);
    	
    	return $this->render('EventBundle:'.$this->getView($view).':listEvent.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "next_all"
    	));
    }
    
    /**
     * Depiendode desde donde viene muestra una vista grande o una chica
     * 
     * @param String $view
     * @return string
     */
    private function getView($view){
    	if('mini' == $view){
    		return "EventMini";
    	}
    	return "Event";
    }
    
    /**
     * Lista los proximos eventos a ocurrir para ajax
     *
     */
    public function nextEventAllRssAction($firstResult,$maxResults)
    {
    	 
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	$entities = $this->eventServices->nextEvent($paginator);
    
    	return $this->render('EventBundle:Event:listEvent.xml.twig', array(
    			'entities' => $entities,
    	));
    }
    
    /**
     * Lista los ultimos eventos que se cargaron los resultados
     *
     */
    public function lastResultEventAction($firstResult,$maxResults)
    {
    	 
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	$entities = $this->eventServices->lastResultEvent($paginator);
    
    	return $this->render('EventBundle:EventMini:listEvent.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "next_all"
    	));
    }
        
    /**
     * Lista los ultimos eventos que no se cargaron los eventos
     *
     */
    public function lastEventWithOutResultEventAction($firstResult,$maxResults)
    {
    
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	$entities = $this->eventServices->lastEventWithOutResultEvent($paginator);
    
    	return $this->render('EventBundle:Help:listEventWithAjax.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "show",
    			'action' => "event_without_result"
    	));
    }
    
    /**
     * Lista los proximos eventos a ocurrir minimo
     *
     */
    public function nextEventReduceAction($firstResult,$maxResults)
    {
    	 
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	$entities = $this->eventServices->nextEvent($paginator);
    
    	return $this->render('EventBundle:Event:listEventPublic.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "next_all"
    	));
    }
    
    /**
     * Lista los proximos eventos a ocurrir minimo por eventos
     *
     */
    public function nextEventBySportReduceAction($idSport,$firstResult,$maxResults,$lat,$log)
    {
    
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	
    	if( $this->getUser() != null and $this->getUser()->getLatitude() != ''){
    		$lat = $this->getUser()->getLatitude();
    		$log = $this->getUser()->getLongitude();
    	}

    	$entities = $this->eventServices->getEventNextBySport($idSport,$paginator,$log,$lat,false);
    
    	return $this->render('EventBundle:Event:listEventPublic.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "next_all",
    			'idSport'=> $idSport
    	));
    }
    
    /**
     * Lista los proximos eventos a ocurrir mini view
     *
     */
    public function nextEventBySportMiniAction($idSport,$firstResult,$maxResults,$lat,$log)
    {
    
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	 
    	if( $this->getUser() != null and $this->getUser()->getLatitude() != ''){
    		$lat = $this->getUser()->getLatitude();
    		$log = $this->getUser()->getLongitude();
    	}
    
    	$entities = $this->eventServices->getEventNextBySport($idSport,$paginator,$log,$lat,false);
    
    	return $this->render('EventBundle:EventMini:listEvent.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "next_all",
    			'idSport'=> $idSport
    	));
    }
	
    /**
     * Lista los proximos eventos a ocurrir minimo por eventos
     *
     */
    public function nextEventBySportReduceTopAction($idSport,$firstResult,$maxResults,$lat,$log)
    {
    
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	 
    	if( $this->getUser() != null and $this->getUser()->getLatitude() != ''){
    		$lat = $this->getUser()->getLatitude();
    		$log = $this->getUser()->getLongitude();
    	}
    
    	$entities = $this->eventServices->getEventNextBySport($idSport,$paginator,$log,$lat,true);
    
    	return $this->render('EventBundle:Event:listEventPublic.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "next_all",
    			'idSport'=> $idSport
    	));
    }
    
    
    /**
     * Obtener eventos del dia.
     */
    public function getToDayEventsAction(){
    
    	$entities = $this->eventServices->getToDayEvents();
    	
    	return $this->render('EventBundle:Event:listEventPublicApp.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => 0,
    			'tipe' => "run",
    			'idSport' => 0
    	));
    	
    }
    
    public function getRioEventNextAction(){
    	
    	$events = $this->eventServices->getEventosRio("de janeiro",date("Y-m-d"),">=");
    	
    	return $this->render('EventBundle:Event:listEventPublic.html.twig', array(
    			'entities' => $events,
    			'firstResult' => 0,
    			'tipe' => "next_all",
    			'idSport'=> 9
    	));
    }
    
    public function getRioEventToDayAction(){
    	 
    	$events = $this->eventServices->getEventosRio("de janeiro",date("Y-m-d")," = ");
    	 
    	return $this->render('EventBundle:Event:listEventPublic.html.twig', array(
    			'entities' => $events,
    			'firstResult' => 0,
    			'tipe' => "next_all",
    			'idSport'=> 9
    	));
    }
    
    /**
     * Lista los proximos eventos a ocurrir minimo por eventos
     *
     */
    public function searchEventReduceAction($search)
    {
    	$events = $this->eventServices->seachEvent($search);
    	
    	return $this->render('EventBundle:Event:searchEventPublic.html.twig', array(
    			'entities' => $events,
    			'firstResult' => 1,
    			'tipe' => "nono",
    			'idSport'=> 10
    	));
    }
    /**
     * 
     * Lista los proximos eventos a ocurrir
     *
     */
    public function listNexEventAction()
    {

    	return $this->render('EventBundle:Event:listNextEvent.html.twig', array(
    			'tipe' => "next_all"
    	));
    }
    
    /**
     * Lista los eventos que se inscribio el usuario y que ya ocurrieron.
     *
     */
    public function listEventPastAction()
    {
		
    	return $this->render('UserBundle:UserResult:listResultUser.html.twig', array(
    			'user' => $this->getUser(),
    	));
    }
    
    /**
     * Lista los eventos que se inscribio el usuario y que ya ocurrieron.
     *
     */
    public function listEventPastAjaxAction($firstResult,$maxResults)
    {
    
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	$events = new ArrayCollection();
    
    	$events = $this->eventServices->getEventEnrolledUserPast($this->getUser(),$paginator);
    
    	return $this->render('EventBundle:Event:listEvent.html.twig', array(
    			'entities' => $events,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "past"
    	));
    }
    
    /**
     * Lists all Event que se inscribio el usuario y que ya ocurrieron
     *
     */
    public function listEventNextAction()
    {
    
    	return $this->render('EventBundle:Event:index.html.twig', array(
    			'tipe' => "next",
    	));
    }
    
    /**
     * Lists all Event que se inscribio el usuario y que ya ocurrieron
     *
     */
    public function listEventNextAjaxAction($firstResult , $maxResults)
    {
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
		$events = new ArrayCollection();
		
		$events = $this->eventServices->getEventEnrolledUserNext($this->getUser(),$paginator);
    
    
    	return $this->render('EventBundle:Event:listEvent.html.twig', array(
    			'entities' => $events,
    			'firstResult' => $firstResult+$maxResults,
    			'tipe' => "next",
    	));
    }
    /**
     * Creates a new Event entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Event();
        $form = $this->createForm(new EventType(), $entity);
        $form->bind($request);
		
       
        if ($form->isValid()) {
        	
        	//Si el usuario es organizador se agrega el organizador al evento.
           	if($this->getUser()->getOrganizer() != null){
           		$entity->setOrganizer($this->getUser()->getOrganizer());
           	}
        	
        	$entity = $this->eventServices->createEvent($entity);

            return $this->redirect($this->generateUrl('event_show', array('id' => $entity->getId())));
        }

        return $this->render('EventBundle:Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
   
    /**
     * Crear un punto geolozalizado de un un usuario participando en un evento.
     * 
     * @param interger $latitude
     * @param interger $longitude
     * @param timestamp $time
     * @param User $user ID identificador del usuario
     * @param int $idEvent ID Event
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createEventPointAction($latitude, $longitude, $time,$user,$idEvent,$idTraining)
    {
    	
    	$em = $this->getDoctrine()->getManager();
    	$entities = $em->getRepository('ObjectBundle:Event')->find($idEvent);
    	$training = $em->getRepository('ObjectBundle:Training')->find($idTraining);
    	
    	$entity  = new EventPath();
    	$entity->setLatitude($latitude);
    	$entity->setLongitude($longitude);
    	$entity->setTime($time);
    	$entity->setEvent($entities);
    	$entity->setIdPath($user);
    	$entity->setTraining($training);
    
    	
    	$em->persist($entity);
    	$em->flush();
    	return new Response();
    }
    
    
    /**
     * Redirecciona a la pagina para agregar el identificador del usuario en un evento para un seguimiento Online
     * 
     * @param int $idEvent ID evento
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function generateIdOnlineAction($idEvent){
    	
    	
    	return $this->render('EventBundle:Event:eventOnlineGenerateId.html.twig', array(
    			'idEvent' =>  $idEvent,
    	));
    	
    }
    
    /**
     * Muestra la vista del corredor, crea el primer punto de geololacizacion donde esta el eventos geolozalizado
     *
     * @param string $name
     * @param id del evento $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function onlineEventUserAction($name,$id)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$entity = $em->getRepository('ObjectBundle:Event')->find($id);
    
    	$entities = $this->eventServices->getPointsEvent($id,$name);
    	 
    	if ($entities == null){//Crear el primer punto con la posicion del evento
    		$eventPath  = new EventPath();
    		$eventPath->setLatitude($entity->getLatitude());
    		$eventPath->setLongitude($entity->getLongitude());
    		$eventPath->setTime(0);
    		$eventPath->setEvent($entity);
    		$eventPath->setIdPath($name);
    		$em->persist($eventPath);
    		$em->flush();
    	}
    	return $this->render('EventBundle:EventOnline:onlineShow.html.twig', array(
    			'entities' => $entities,
    			'entity'   => $entity,
    			'name' => $name,
    			'idEvent' => $id,
    	));
    }
    
    public function listTrainingByIdMobileAction($idMobile){
    	
    	$paginator = array();
    	$paginator['firstResult'] = 0;
    	$paginator['maxResults'] = 20;
    	
    	$entities = $this->eventServices->listTrainingByIdMobile($idMobile,$paginator);
    	
    	return $this->render('EventBundle:EventMini:listTraining.html.twig', array(
    			'entities' => $entities,
    			'idMobile' => $idMobile
    	));
    	
    }
    
    
   
    /**
     * Muestra la pagina de seguimiento online con los datos del mapa
     * 
     * @param string $name Identificador del usuario en la carrera
     * @param int $idEvent ID evento
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEventMapAction($name,$idEvent)
    {
    	
    	$entities = $this->eventServices->getPointsEvent($idEvent,$name);
    	$em = $this->getDoctrine()->getManager();
    	$route = $this->eventServices->getPointsEvent($idEvent,"route");//en duro el nombre de la ruta
    	$kilometre = $this->eventServices->getPointsEvent($idEvent,"k");//kilometros.
    	$entity = $em->getRepository('ObjectBundle:Event')->find($idEvent);
    	
    	return $this->render('EventBundle:EventOnline:onlineTrackingWeb.html.twig', array(
    			'entities' => $entities,
    			'route' => $route,
    			'kilometre' => $kilometre,
    			'name' => $name,
    			'entity' => $entity,
    			'idEvent' => $idEvent,
    	));
    }
    
    /**
     * Muestra la pagina de seguimiento online con los datos del mapa de un entrenamiento
     *
     * @param string $name Identificador del usuario en la carrera
     * @param int $idEvent ID evento
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showTrainingMapAction($name,$idTraining)
    {
    	 
    	$entities = $this->eventServices->getPointsTraining($idTraining,$name);
    	$em = $this->getDoctrine()->getManager();
//     	$route = $this->eventServices->getPointsEvent($idEvent,"route");//en duro el nombre de la ruta
//     	$kilometre = $this->eventServices->getPointsEvent($idEvent,"k");//kilometros.
    	$entity = $em->getRepository('ObjectBundle:Training')->find($idTraining);
    	 
    	return $this->render('EventBundle:EventOnline:onlineTrackingWebTraining.html.twig', array(
    			'entities' => $entities,
    			'idTraining' => $idTraining,
    			'name' => $name,
    			'entity' => $entity,
    			
    	));
    }
    
    /**
     * Muestra la el Mapa de seguimiento Online de un usuario //Medio feo pero va.
     *
     * @param string $name Identificador del usuario en la carrera
     * @param int $idEvent ID evento
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEventMapAppAction($name,$idEvent)
    {
    	 
    	$entities = $this->eventServices->getPointsEvent($idEvent,$name);
    	$em = $this->getDoctrine()->getManager();
    	$route = $this->eventServices->getPointsEvent($idEvent,"route");//en duro el nombre de la ruta
    	$kilometre = $this->eventServices->getPointsEvent($idEvent,"k");//kilometros.
    	$entity = $em->getRepository('ObjectBundle:Event')->find($idEvent);
    	 
    	return $this->render('EventBundle:EventOnline:onlineTrackingMap.html.twig', array(
    			'entities' => $entities,
    			'route' => $route,
    			'kilometre' => $kilometre,
    			'name' => $name,
    			'entity' => $entity,
    			'idEvent' => $idEvent,
    	));
    }
    
   	public function listUserOnlineEventAction($idEvent){
   		
   		$entities = $this->eventServices->getAllUserOnlineEvent($idEvent);
   		
   		return $this->render('EventBundle:EventOnline:userOnline.html.twig', array(
   				'entities' => $entities,
   				
   		));
   	}
   	
   	public function listUserOnlineTodayAction(){
   		 
   		$entities = $this->eventServices->getAllUserOnlineToday();
   		 
   		return $this->render('EventBundle:EventOnline:userOnline.html.twig', array(
   				'entities' => $entities,
   					
   		));
   	}
    
    /**
     * Muestra la pagina para configurar el circuito del evento
     *
     * @param string $name Identificador del usuario en la carrera
     * @param int $idEvent ID evento
     */
    public function configEventRouteAction($idEvent)
    {
    	 
    	$entities = $this->eventServices->getPointsEvent($idEvent,"route");//en duro el nombre de la ruta
    	$kilometre = $this->eventServices->getPointsEvent($idEvent,"k");//kilometros.
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ObjectBundle:Event')->find($idEvent);
    	 
    	return $this->render('EventBundle:EventOnline:routeEvent.html.twig', array(
    			'entities' => $entities,
    			'kilometre' => $kilometre,
    			'name' => "route",
    			'entity' => $entity,
    			'idEvent' => $idEvent,
    	));
    }
   
    /**
     * 
     *  Calculo los intervalos cada un kilometro de un usuario que participo o esta participando en un evento
     * 
     * @param string $name Identificador del usuario en la carrera
     * @param int $idEvent ID evento
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getIntervalEventOnlineAction($name,$idEvent)
    {
    	 
    	$entities = $this->eventServices->getPointsEvent($idEvent,$name);
    	
    	$statistics =  $this->eventServices->calculateStatisticsForPathEvent($entities);
    	
    	return $this->render('EventBundle:EventOnline:interval.html.twig', array(
    			'statistics' => $statistics,
    			
    	));
    }
    
    /**
     * Devuelve las estadisticas del evento online segun el nombre del usuario y del id del evento
     * 
     * @param string $name Identificador del usuario en la carrera
     * @param int $idEvent ID evento
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getEstadisticasEventOnlineAction($name,$idEvent)
    {
    	 
    	$entities = $this->eventServices->getPointsEvent($idEvent,$name);
    
    	$distancia =  $this->eventServices->calculateDistanceForPathEvent($entities);
    	
    	if(!empty($entities)){
    	
    		$time = $this->eventServices->calculateTimeMinuteBetweeDate(($entities[0]->getTime()), (end($entities)->getTime()));
	    	if($distancia != 0){
	    		$promedio = gmdate("i:s",$time/$distancia);
	    	}else{
	    		$promedio = gmdate("i:s",$time);
	    	}
    	}else{
    		
    	$time = 0; $promedio = 0;
    	
    	}
    	
    	
    	return $this->render('EventBundle:EventOnline:distance.html.twig', array(
    			'distancia' => round($distancia,2),
    			'time' => gmdate("H:i:s", $time),
    			'promedio' => $promedio
    	));
    }
    
    
	/**
	 * Devuelve el ultimo punto de un recorrido
	 * 
	 * @param string $name Identificador del usuario en la carrera
     * @param int $idEvent ID evento
     * @return \Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function getLastPointEventAction($idEvent,$name){
		
		$entity = $this->eventServices->getLastPointEvent($idEvent, $name);
		
		return new JsonResponse([
				'success' => true,
				'long'    => $entity->getLongitude(),
				'lant' => $entity->getLatitude(),
		]);
	}
	
	/**
	 * Devuelve el ultimo punto de un entrenamiento
	 *
	 * @param string $name Identificador del usuario en la carrera
	 * @param int $idEvent ID evento
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function getLastPointTrainingAction($idTraining,$name){
	
		$entity = $this->eventServices->getLastPointTraining($idTraining, $name);
	
		return new JsonResponse([
				'success' => true,
				'long'    => $entity->getLongitude(),
				'lant' => $entity->getLatitude(),
		]);
	}
	
    
    /**
     * Creates a new Punctuation for Event entity.
     *
     */
    public function createPunctuationAction(Request $request,$idEvent)
    {
    	$entity  = new Punctuation();
    	$form = $this->createForm(new PunctuationType(), $entity);
    	$form->bind($request);
    
    	$this->eventServices->createPunctuation($entity,$idEvent);
 
    	return $this->redirect($this->generateUrl('event_show', array('id' => $idEvent)));
    	
    }

    /**
     * Displays a form to create a new Event entity.
     *
     */
    public function newAction()
    {
        $entity = new Event();
        $form   = $this->createForm(new EventType(), $entity);

        return $this->render('EventBundle:Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('ObjectBundle:Event')->find($id);
        
        $deleteForm = $this->createDeleteForm($id);
 
        
        $punctuation = new Punctuation();
		
        $punctuationForm  = $this->createForm(new PunctuationType(), $punctuation);
        
        $friends = new ArrayCollection();
        
        if($this->getUser() != null){
        	$friends =$this->eventServices->getFriendFromEventByUser($entity, $this->getUser());
        }
        return $this->render('EventBundle:Event:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        	'form' => $punctuationForm->createView(),
        	'tipe' => "show",
        	'friends' => $friends,
        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ObjectBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $editForm = $this->createForm(new EventType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
		
        
        return $this->render('EventBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
   
    /**
     * Edits an existing Event entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ObjectBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EventType(), $entity);
        $editForm->bind($request);
        
        
        $result = $this->excelServices->importExcelResult($entity,$entity->getLabelLink());
        $entity->setClassifications($result);
        $this->excelServices->removeFile($entity->getLabelLink());
        $entity->setLabelLink("");
        
        $entity->setStartTime(date("Y-m-d", strtotime($entity->getStartTime())));
//         $entity = new Event();
        $entries = $entity->getEntries();
        foreach ($entries as $entrie){
//         	$entrie = new Entry();
        	$entrie->setStart(date("Y-m-d", strtotime($entrie->getStart())));
        	$entrie->setEnd(date("Y-m-d", strtotime($entrie->getEnd())));
        
        }
        $entity->setEntries($entries);
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            

            return $this->redirect($this->generateUrl('event_show', array('id' => $id)));
        }
        
        return $this->render('EventBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Event entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ObjectBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('event'));
    }

    /**
     * Creates a form to delete a Event entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    
   
    
    public function asigneResultEventAction($idClassification,$idEvent){
    	
    	$this->eventServices->asigneResultEvent($idClassification, $idEvent, $this->getUser());
    	
    	return $this->redirect($this->generateUrl('event_show', array('id' => $idEvent)));
    	
    }
    
    public function searchResultAction(){
    	
    	$classifications = $this->eventServices->searchResult($this->getUser());
    	
    	return $this->render('EventBundle:Event:seachResult.html.twig', array(
    			'classifications' => $classifications,
    	));
    	
    }
    
    public function notificationResultAction(){
    	 
    	$classifications = $this->eventServices->searchResult($this->getUser());
    	 
    	return $this->render('EventBundle:Result:result_notification.html.twig', array(
    			'classifications' => $classifications,
    	));
    	 
    }
    
    /**
     * Obtiene las classificaciones de un evento paginados
     * 
     * @param  $firstResult primer registro
     * @param  $maxResults maxima cantidad de  
     * @param  $idEvent id evento
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getClassificationByIdEventAction($tipe,$firstResult,$maxResults,$idEvent){
    	
    	$classifications = $this->eventServices->getClassificationByIdEventEvent($firstResult,$maxResults,$idEvent);
    	
    	if($tipe == 'next'){
    		$firstResultPre = $firstResult-$maxResults;
    		$firstResult = $firstResult+$maxResults;
    	}else {
    		
    		$firstResultPre = $firstResult-$maxResults;
    		$firstResult = $firstResult+$maxResults;
    		
    	}
    	
    	
    	
    	return $this->render('EventBundle:Event:listClassification.html.twig', array(
    			'classifications' => $classifications,
    			'idEvent' => $idEvent,
    			'firstResult' => $firstResult,
    			'firstResultPre' => $firstResultPre,
    	));
    	
    }
    
    /**
     * Redirige a la una pagina de administracion de resultados de un evento
     *
     */
    public function adminResultAction($id)
    {
    
    	$em = $this->getDoctrine()->getManager();
    
    	$entity = $em->getRepository('ObjectBundle:Event')->find($id);
    	$editForm = $this->createForm(new EventType(), $entity);
    	
    	
    
    	return $this->render('EventBundle:Result:adminResult.html.twig', array(
    			'classifications'      => null,
    			'entity'      => $entity,
    			'configuration' => null,
    			'form'   => $editForm->createView(),
    
    	));
    }
    
    /**
     * Muestra la vista previa de la configuracion de carga de los resultados y carga los resultados en el evento.
     *
     */
    public function preViewResultAction(Request $request,$id)
    {

    	$em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ObjectBundle:Event')->find($id);
        $editForm = $this->createForm(new EventType(), $entity);
        $editForm->bind($request);
        
        $configuration = $this->getConfigurationExcel($request);
        $result = $this->excelServices->importExcelResultWithConfiguration($entity,$entity->getLabelLink(),$configuration);
        $entity->setClassifications($result);
        
        if($request->request->get('action') != 'view'){
        	
        	$entity2 = $em->getRepository('ObjectBundle:Event')->find($id);
        	$entity2->setLabelLink("");
            $entity2->setClassifications($result);
        	$em->persist($entity2);
        	$em->flush();
        	$this->newsUserServices->newEventResult($entity2);
        	return $this->redirect($this->generateUrl('event_show', array('id' => $id)));	
        }
    	
    
    	return $this->render('EventBundle:Result:adminResult.html.twig', array(
    			'classifications'      => $result,
    			'entity'      => $entity,
    			'configuration' => $configuration,
    			'form'   => $editForm->createView(),

    	));
    }
    
    /**
     * Obtiene la configuracion de lectura del excel cargado.
     * 
     * @param Request $request
     * @return multitype:\Symfony\Component\HttpFoundation\mixed 
     */
    private function getConfigurationExcel(Request $request){
    	
    	$key = "position_";
    	
	    $configuration = array();
	    for ($i = 1; $i <= 14; $i++) {
	    	$configuration[$i] = $request->request->get($key.$i);
	    }
	    
	    return $configuration;
    	
    }
    
    public function enviarEmailEventoAction()
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$entities = $em->getRepository('ObjectBundle:Event')->findAll();
//    	$qb = $em->createQueryBuilder();
//    	$entities =  $qb->select("e")
//		->add('from', 'ObjectBundle:Event e')
//		->where('e.startTime > :today')
//		->andWhere('e.isActive = :active')
//		->setParameter('active', 1)
//		->setParameter('today', date("Y-m-d"))
//		->orderBy('e.startTime', 'ASC') 
//		->setMaxResults(20)->getQuery ()->execute();
    
    	$response = $this->emailServices->enviarEmailEventos(':email:nextEvent.html.twig', $entities);
    	
//        return $this->render(':email:nextEvent.html.twig', array(
//    			'entities' => $entities,
//    			
//    	));
    
    	return new Response($response);
    }
    
    public function enviarEmailNextEventAllUserAction(){
        
        $em = $this->getDoctrine()->getManager();
    
    	//$entities = $em->getRepository('ObjectBundle:Event')->findAll();
    	$qb = $em->createQueryBuilder();
    	$entities =  $qb->select("e")
		->add('from', 'ObjectBundle:Event e')
		->where('e.startTime > :today')
		->andWhere('e.isActive = :active')
		->setParameter('active', 1)
		->setParameter('today', date("Y-m-d"))
		->orderBy('e.startTime', 'ASC')
		->setMaxResults(20)->getQuery ()->execute();
        $users = $em->getRepository('ObjectBundle:User')->findAll();
//        $qb = $em->createQueryBuilder();
//        $users =  $qb->select("u")
//		->add('from', 'ObjectBundle:User u')
//		->where('u.name = :nombre')
//		->setParameter('nombre', "Jonatan")
//		->setMaxResults(4)->getQuery ()->execute();
//    	
        $response = $this->emailServices->enviarEmailEventosToUsers(':email:nextEvent.html.twig', $entities,$users,"TriaBox - Proximos Eventos");
    	
    
    	return new Response($response);
        
        
    }
    
     public function enviarLastResultAllUserAction(){
        
        $em = $this->getDoctrine()->getManager();
        
        $paginator = array();
    	$paginator['firstResult'] = 0;
    	$paginator['maxResults'] = 20;
    	$entities = $this->eventServices->lastResultEvent($paginator);
        
       // $users = $em->getRepository('ObjectBundle:User')->findAll();
    	$qb = $em->createQueryBuilder();
        $users =  $qb->select("u")
		->add('from', 'ObjectBundle:User u')
		->where('u.name = :nombre')
		->setParameter('nombre', "Jonatan")
		->setMaxResults(4)->getQuery ()->execute();
    	
        $response = $this->emailServices->enviarEmailEventosToUsers(':email:nextEvent.html.twig', $entities,$users,"TriaBox - Nuevos Resultados");

           
        return new Response($response);
     }
    
    
    
    /**
     * Obtiene los eventos cercanos al usuario logueado.
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function eventAroundMyAction(){
    	
    	$paginator = array();
    	$paginator['firstResult'] = 0;
    	$paginator['maxResults'] = 30;
    	
    	$tipe = "all";
    	$entities = new ArrayCollection();
    	
    	if($this->getUser()->getLongitude() == ''){
    		$tipe = "NOT_DIRECCION";
    	}else{
    		$entities = $this->eventServices->getEventAroundMy($this->getUser(),$paginator);
    	}

    	
 
    	return $this->render('EventBundle:Event:index.html.twig', array(
    			'entities' => $entities,
    			'firstResult' => 0,
    			'tipe' => $tipe
    	));
    }

    /**
     * Lista los proximos eventos a ocurrir para ajax
     *
     */
    public function listEventByOrganizerAction($firstResult,$maxResults,$organizer)
    {
    	 
    	$paginator = array();
    	$paginator['firstResult'] = $firstResult;
    	$paginator['maxResults'] = $maxResults;
    	$entities = $this->eventServices->listEventByOrganizer($paginator,$organizer);
    	
    	//Maneja la paginacion de la pagina
    	$url_more = $this->generateUrl('event_by_organizer',array('firstResult' => $firstResult+$maxResults,
    					'maxResults' => $maxResults,'organizer' => $organizer)); 
    	
    	//URL que permite recargar la pagina.
    	$url_reload = $this->generateUrl('event_by_organizer',array('firstResult' => 0,
    			'maxResults' => $maxResults,'organizer' => $organizer));
    	
    	//Si es la primera vez o se recarga se carga la pagina completa con header
    	$page = 'EventBundle:Event:listEventBigComplete.html.twig';
   		
    	//Si no es la primera vez no se carga el header nuevamente
    	if($firstResult != '0'){$page = 'EventBundle:Event:listEventBig.html.twig';}
   		
    
    	return $this->render($page, array(
    			'entities' => $entities,
    			'firstResult' => $firstResult+$maxResults,
    			'title' => 'Eventos Organizados',
    			'url_more' => $url_more,
    			'url_reload' => $url_reload,
    			'tipe' => "next_all"
    	));
    }
    
    

    public function showClassificationAction($idClassification)
    {
    
    	$em = $this->getDoctrine()->getManager();
    	 
    	$classification = $em->getRepository('ObjectBundle:Classification')->find($idClassification);
    	$user = new User();
    	
    	$user->setName($classification->getName());
    	$user->setLastname($classification->getLastname());
    	
    	//Maneja la paginacion de la pagina
    	$url = $this->generateUrl('event_show_classification',array('idClassification' => $classification->getId()));
    	 
   
    	 

    	return $this->render('UserBundle:UserResult:showEnrolled.html.twig', array(
    			'enrolled' => null,
    			'user'   => $user,
    			'classification' => $classification,
    			'event' => $classification->getEvent(),
    			'url'  => $url,
    	));
    }
    
    public function getClassificationAction($idClassification){
    
        
    	$em = $this->getDoctrine()->getManager();
    	 
        
        $classification = $em->getRepository('ObjectBundle:Classification')->find($idClassification);
        
        return $this->render('UserBundle:User:showResultUser.html.twig', array(
    			'classification' => $classification,
    	));
    }
    
    public function compareResultClassificationAction($idClassification1,$idClassification2){
    
        
    	$em = $this->getDoctrine()->getManager();
    
        $classification1 = $em->getRepository('ObjectBundle:Classification')->find($idClassification1);
        
        $classification2 = $em->getRepository('ObjectBundle:Classification')->find($idClassification2);
        
        return $this->render('UserBundle:User:showResultUser.html.twig', array(
    			'classification1' => $classification1,
                        'classification2' => $classification2,

    	));
    }
    
    
    public function searchResultByNameAndBibAction($search,$idEvent){

    $classifications = $this->eventServices->searchResultByNameAndBib($search, $idEvent);
    	
    
    return $this->render('EventBundle:Event:listClassification.html.twig', array(
    		'classifications' => $classifications,
    		'idEvent' => $idEvent,
    		'firstResult' => 0,
    		'firstResultPre' => 1000,
    ));}
    
      	 
   	 function createTrainingAction($idMobile,$idEvent){
   	 	
   	 	$em = $this->getDoctrine()->getManager();
   	 	$entity = new Training();
   	 	
   	 	if($idEvent != 0){ //si es un evento se pone el nombre del evento
   	 		$event = $em->getRepository('ObjectBundle:Event')->find($idEvent);
   	 		$entity->setName($event->getName()." ".date("Y-m-d"));
   	 	}else{
   	 		$entity->setName("Entrenamiento ".date("Y-m-d"));
   	 	}
   	 	
   	 	$entity->setIdMobile($idMobile);
   	 	$entity->setIsFinish(0);
   	 	$entity->setStartTime(date("Y-m-d"));
   	 	
   	 	$entity->setStartHs(date("H:i:s"));
   	 	
//    	 	$timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
//    	 	echo gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
   	 	 
   	 	$em->persist($entity);
   	 	$em->flush();
   	 	return new Response($entity->getId());
   	 	
   	 	
   	 }
    
   	 /**
   	  * @param unknown $id
   	  * @param unknown $distance
   	  * @param unknown $speed
   	  * @param unknown $time
   	  * @return \Symfony\Component\HttpFoundation\Response
   	  */
   	 function finalizeTrainingAction($id,$distance,$speed,$time){
   	 
   	 	$em = $this->getDoctrine()->getManager();
   	 	$entity = $em->getRepository('ObjectBundle:Training')->find($id);
   	 	
   	 	$entity->setIsFinish(1);
   	 	$entity->setDistance($distance);
   	 	$entity->setSpeed($speed);
   	 	$entity->setTime($time);
   	 	$em->persist($entity);
   	 	$em->flush();
   	 	return new Response("OK");
   	 }
   	 
   	 /**
   	  * @param unknown $id
   	  * @param unknown $distance
   	  * @param unknown $speed
   	  * @param unknown $time
   	  * @return \Symfony\Component\HttpFoundation\Response
   	  */
   	 function updateTrainingAction($id,$distance,$speed,$time){
   	 	 
   	 	$em = $this->getDoctrine()->getManager();
   	 	$entity = $em->getRepository('ObjectBundle:Training')->find($id);
   	 
   	 	$entity->setDistance($distance);
   	 	$entity->setSpeed($speed);
   	 	$entity->setTime($time);
   	 	$em->persist($entity);
   	 	$em->flush();
   	 	return new Response("OK");
   	 }
   	 
   	 /**
   	  * Deletes a Training entity.
   	  *
   	  */
   	 public function deleteTrainingAction($idTraining)
   	 {
   	 	$em = $this->getDoctrine()->getManager();
   	 	$entity = $em->getRepository('ObjectBundle:Training')->find($idTraining);
   	 
   	 	$em->remove($entity);
   	 	$em->flush();
   	 	
   	 	return new Response("OK");
   	 }
   	 
   	 /**
   	  *   --------------------------------- Funciones de Pago ------------------------------ 
   	  */
   	 
   	 
   	 
   	 /**
   	  * Inscripcion un evento para eventos no destacados.
   	  *
   	  */
   	 
   	 public function getAllEnrolledToEventAction($idEvent){
   	 	
   	 	$entities = $this->eventServices->getAllEnrolledToEvent($idEvent);
   	 	
   	 	return $this->render("EventBundle:Enrolled:listEventEnrolled.html.twig", array(
   	 			'entities' => $entities,
   	 			 
   	 	));
   	 }
   	 
   	 
   	 /**
   	  * * Inscripcion un evento para eventos no destacados.
   	  * 
   	  * @param Integer $idEvent
   	  * @return \Symfony\Component\HttpFoundation\Response
   	  */
   	 public function newEnrolledBasicAction($idEvent){
   	 	
   	 	$em = $this->getDoctrine()->getManager();
   	 	$event = $em->getRepository('ObjectBundle:Event')->find($idEvent);
   	 	$entity = $this->eventServices->getEnrrolledByUserEvent($idEvent,$this->getUser());
   	 	 
   	 	$form   = $this->createForm(new EnrolledType($event,$this), $entity);
   	 	$formUser   = $this->createForm(new UserType(), $this->getUser());
   	 	
   	 	return $this->render("EventBundle:Enrolled:newEnrolled.html.twig", array(
   	 			'entity' => $entity,
   	 			'event' =>  $event,
   	 			'form'   => $form->createView(),
   	 			'formUser'   => $formUser->createView(),
   	 			 
   	 	));
   	 }
   	 
   	 public function newEnrolledAction($idEvent)
   	 {
   	 	$em = $this->getDoctrine()->getManager();
   	 	$event = $em->getRepository('ObjectBundle:Event')->find($idEvent);
   	 	$entity = $this->eventServices->getEnrrolledByUserEvent($idEvent,$this->getUser());
   	 
   	 	$form   = $this->createForm(new EnrolledType($event,$this), $entity);
   	 	$formUser   = $this->createForm(new UserType(), $this->getUser());
   	 	
   	 	$view = "EventBundle:Enrolled:newEnrolledWithPayment.html.twig";
   	 	if($entity->getPayment() != null and $entity->getPayment()->getState() == "01"){
   	 		$view = "EventBundle:Enrolled:formulario.html.twig";
   	 	}
   	 	
   	 	return $this->render($view, array(
   	 			'entity' => $entity,
   	 			'event' =>  $event,
   	 			'form'   => $form->createView(),
   	 			'formUser'   => $formUser->createView(),
   	 			 
   	 	));
   	 }
   	 
   	 public function showEnrolledAction($id){
   	 	
   	 	$entity = $this->eventServices->getEnrolledById($id);
   	 	$event = $entity->getEvent();
   	 	
   	 	 
   	 	$form   = $this->createForm(new EnrolledType($event,$this), $entity);
   	 	$formUser   = $this->createForm(new UserType(), $this->getUser());
   	 	
   	 	return $this->render("EventBundle:Enrolled:formulario.html.twig", array(
   	 			'entity' => $entity,
   	 			'event' =>  $event,
   	 			'form'   => $form->createView(),
   	 			'formUser'   => $formUser->createView(),
   	 			 
   	 	));
   	 }
   	 
   	 
   	 /**
   	  * Edits an existing Event entity.
   	  *
   	  */
   	 public function updateEnrolledAction(Request $request, $id)
   	 {
   	 	$em = $this->getDoctrine()->getManager();
   	 
   	 	$entity = $em->getRepository('ObjectBundle:Enrolled')->find($id);
   	 
   	 	$editForm = $this->createForm(new EnrolledType($entity->getEvent(),$this), $entity);
   	 	$editForm->bind($request);
   	 
   	 
   	 	$em->persist($entity);
   	 	$em->flush();
   	 
   	 
   	 	return $this->redirect($this->generateUrl('event_past'));
   	 }
   	 
   	 
   	 public function confirmPaymentAction($idPayment){
   	 	 
   	 	$payment = $this->paymentServices->confirmPayment($idPayment);
   	 	 
   	 	return $this->redirect($this->generateUrl('event_show', array('id' => $payment->getEnrolled()->getEvent()->getId())));;
   	 	 
   	 }
   	 
   	  
   	 /**
   	  * Confirma el pago del evento
   	  *
   	  */
   	 public function addPaymentAction($entry,$idEvent)
   	 {
   	 
   	 	$payment = $this->paymentServices->createPayment($entry,$idEvent);
   	 
   	 	return new Response($payment->getId());
   	 }
   	 
   	 /**
   	  * Gestiona el pago con todo pago
   	  *
   	  * @param integer $idPayment
   	  * @return \Symfony\Component\HttpFoundation\RedirectResponse
   	  */
   	 public function todoPagoAction($idPayment){
   	 
   	 	 
   	 	$payment = $this->paymentServices->getPaymentById($idPayment);
   	 	$entry = $payment->getEntry();
   	 	$user = $payment->getEnrolled()->getUser();
   	 	$event = $payment->getEnrolled()->getEvent();
   	 
   	 	 
   	 	//común a todas los métodos
   	 	$http_header = array('Authorization'=>'TODOPAGO 3237ab5793134e49a1e245f53ad8f9e5',
   	 			'user_agent' => 'PHPSoapClient');
   	 	 
   	 	//datos constantes del proveedor
   	 	define('CURRENCYCODE', 032);
   	 	define('MERCHANT', 15883);
   	 	define('ENCODINGMETHOD', 'XML');
   	 	define('SECURITY', '0129b065cfb744718166913eba827a2f');
   	 	 
   	 	//id de la operacion
   	 	$operationid = $payment->getId();
   	 	$monto = $this->redondear_dos_decimal($this->calculateProfit($entry->getAmount()));
   	 	//opciones para el método sendAuthorizeRequest (datos propios del comercio)
   	 	$optionsSAR_comercio = array (
   	 			'Security'=> SECURITY,
   	 			'EncodingMethod'=>ENCODINGMETHOD,
   	 			'Merchant'=>MERCHANT,
   	 			'URL_OK'=>"http://".$_SERVER['SERVER_NAME'].$this->generateUrl('todopago_confirm', array('idPayment' => $idPayment)),
   	 			'URL_ERROR'=>"http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].str_replace ($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']))."/error.php?operationid=$operationid"
   	 	);
   	 	 
   	 	// + opciones para el método sendAuthorizeRequest (datos propios de la operación)
   	 	$optionsSAR_operacion = array (
   	 			'MERCHANT'=> MERCHANT,
   	 			'OPERATIONID'=>"50",//Id Enrolled
   	 			'CURRENCYCODE'=> 032,//fijo
   	 			'AMOUNT'=>$monto, //Monto
   	 			//Datos ejemplos CS7
   	 			'CSBTCITY'=> "Buenos Aires",//Addres
   	 			'CSSTCITY'=> "Buenos Aires",//Addres
   	 			 
   	 			'CSBTCOUNTRY'=> "AR",//fijo
   	 			'CSSTCOUNTRY'=> "AR",
   	 			 
   	 			'CSBTEMAIL'=> $user->getEmail(),//"todopago@hotmail.com",//email inscripto
   	 			'CSSTEMAIL'=> $user->getEmail(),//email inscripto
   	 			 
   	 			'CSBTFIRSTNAME'=> $user->getName(),//nombre
   	 			'CSSTFIRSTNAME'=> $user->getName(),
   	 			 
   	 			'CSBTLASTNAME'=> $user->getLastname(),//Apellido
   	 			'CSSTLASTNAME'=> $user->getLastname(),
   	 			 
   	 			'CSBTPHONENUMBER'=> $user->getPhoneNumber(),//Numero de telefono
   	 			'CSSTPHONENUMBER'=> $user->getPhoneNumber(),
   	 			 
   	 			'CSBTPOSTALCODE'=> " 1010",//EN DURO
   	 			'CSSTPOSTALCODE'=> " 1010",
   	 			 
   	 			'CSBTSTATE'=> "B",//eN DURO
   	 			'CSSTSTATE'=> "B",
   	 			 
   	 			'CSBTSTREET1'=> $user->getStreet(),//CALLE
   	 			'CSSTSTREET1'=> $user->getStreet(),
   	 			 
   	 			'CSBTCUSTOMERID'=> $user->getId(),//Id Usuario
   	 			'CSBTIPADDRESS'=> "192.0.0.4",//En duro
   	 			'CSPTCURRENCY'=> "ARS",//En duro
   	 			'CSPTGRANDTOTALAMOUNT'=> $monto,//Total montoCSPTGRANDTOTALAMOUNT
   	 			'CSMDD7'=> "",
   	 			'CSMDD8'=> "Y",
   	 			'CSMDD9'=> "",
   	 			'CSMDD10'=> "",
   	 			'CSMDD11'=> "",
   	 			'CSMDD12'=> "",
   	 			'CSMDD13'=> "",
   	 			'CSMDD14'=> "",
   	 			'CSMDD15'=> "",
   	 			'CSMDD16'=> "",
   	 			'CSITPRODUCTCODE'=> $event->getId()."#".$event->getName(),//ID evento
   	 			'CSITPRODUCTDESCRIPTION'=> $event->getName()."#".$entry->getName(),//Nombre de la entrada
   	 			'CSITPRODUCTNAME'=> "Inscripcion #".$entry->getName(),//Nombre del evento
   	 			'CSITPRODUCTSKU'=> $entry->getId()." #".$entry->getName(),//Nombre+entrada
   	 			'CSITTOTALAMOUNT'=> $monto."#".$monto,//Monto
   	 			'CSITQUANTITY'=> "1#1",//en duro
   	 			'CSITUNITPRICE'=> $monto."#".$monto//Monto
   	 	);
   	 
   	 
   	 	 
   	 	 
   	 	//creo instancia de la clase TodoPago
   	 	$connector = new Sdk($http_header, "test");
   	 	 
   	 	$rta = $connector->sendAuthorizeRequest($optionsSAR_comercio, $optionsSAR_operacion);
   	 	if($rta['StatusCode'] != -1) {
   	 		var_dump($rta);
   	 	} else {
   	 		setcookie('RequestKey',$rta["RequestKey"],  time() + (86400 * 30), "/");
   	 		header("Location: ".$rta["URL_Request"]);
   	 	}
   	 	 
   	 	return $this->redirect($rta["URL_Request"]);
   	 }
   	  
   	 function redondear_dos_decimal($valor) {
   	 	$float_redondeado=round($valor * 100) / 100;
   	 	return number_format($float_redondeado, 2, '.', '');
   	 }
   	  
   	 function calculateProfit($price){
   	 	return $price*1.01;
   	 }
   	  
}
