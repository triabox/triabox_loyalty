<?php

namespace Amateur\NewsUserBundle\Services;



use Amateur\ObjectBundle\Entity\NewsUser;
use Amateur\ObjectBundle\Entity\Constant;
use Amateur\ObjectBundle\Entity\User;
use Amateur\ObjectBundle\Entity\Event;	
use Amateur\ObjectBundle\Entity\Enrolled;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Common\Collections\Doctrine\Common\Collections;
use Amateur\ObjectBundle\Entity\Amateur\ObjectBundle\Entity;
use Xtending\ServicesBundle\Services\MailerServices;
/**
 * NewsUser Services.
 *
 * 
 */
class NewsUserServices 
{

	protected $controller;
	
	/**
	 * @var EmailServices : Envia email
	 */
	protected $emailServices;
	
	
	/**
	 *
	 * @param $controller
	 */
	public function __construct($controller)
	{
		$this->controller = $controller;
		$this->emailServices = new MailerServices($controller);
	}
    
	/**
	 * Crea una novedad escrita por el usuario
	 * 
	 * @param NewsUser $newsUser
	 */
	public function createNewsUserMessage(NewsUser $newsUser){	
		$em = $this->controller->getDoctrine()->getManager();
		$newsUser->setType(Constant::TYPE_MAIN_NEWS);
		$newsUser->setUser($this->controller->getUser());
		
		if($newsUser->getActivity()->getDistance() == ''){
			$newsUser = $this->checkWedSite($newsUser);
			$newsUser->setActivity(null);
		}else{
			$newsUser->getActivity()->setNewsUser($newsUser);
		}
		
		$em->persist($newsUser);
		return $em->flush();
	}
	
	private function checkWedSite(NewsUser $newsUser){

		if($this->haveURL($newsUser->getComment())){
			
			$html = $this->file_get_contents_curl($this->getURL($newsUser->getComment()));
			
			//parsing begins here:
			$doc = new \DOMDocument();
			@$doc->loadHTML($html);
			$nodes = $doc->getElementsByTagName('title');
			
			//get and display what you need:
			$title = $nodes->item(0)->nodeValue;
			$description = "";
			$url = "";
			$urlIman = "";
			$metas = $doc->getElementsByTagName('meta');
			
			for ($i = 0; $i < $metas->length; $i++)
			{
				$meta = $metas->item($i);
				if($meta->getAttribute('property') == 'og:image')
					$urlIman = $meta->getAttribute('content');
				if($meta->getAttribute('property') == 'og:title')
					$title = $meta->getAttribute('content');
				if($meta->getAttribute('property') == 'og:description')
					$description = $meta->getAttribute('content');
				if($meta->getAttribute('property') == 'og:url')
					$url = $meta->getAttribute('content');
		
			}
			$newsUser->setUrlImagen($urlIman);
			$newsUser->setUrl($url);
			$newsUser->setTitle($title);
			$newsUser->setDescription($description);
			$newsUser->setType("06");
			$newsUser->setComment($this->findReplaceURL($newsUser->getComment()));
		}else {
			
		}
	
		return $newsUser;
	}
	private function file_get_contents_curl($url)
	{
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	
		$data = curl_exec($ch);
		curl_close($ch);
	
		return $data;
	}
	
	
	
	private function haveURL($text){
	
		// The Regular Expression filter
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	
		// Check if there is a url in the text
		if(preg_match($reg_exUrl, $text, $url)) {
	
			// make the urls hyper links
			return true;
	
		} else {
	
			// if no urls in the text just return the text
			return false;
	
		}
	}
	
	private function getURL($text){
	
		// The Regular Expression filter
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	
		// Check if there is a url in the text
		preg_match($reg_exUrl, $text, $url);
		
		return $url[0];
		
	}
	 
	private function findReplaceURL($text){
	
		// The Regular Expression filter
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	
		// Check if there is a url in the text
		if(preg_match($reg_exUrl, $text, $url)) {
	
			// make the urls hyper links
			return preg_replace($reg_exUrl, "", $text);
	
		} else {
	
			// if no urls in the text just return the text
			return $text;
	
		}
	}
	
	/**
	 *
	 * Crea un commentario de una novedad
	 *
	 * @param Event $event
	 * @return NewsUser
	 */
	public function createCommentNewsUser(NewsUser $newUser,NewsUser $newUserComment){
	
		
		
		$newUserComment->setType(Constant::TYPE_NEW_COMMENT);
		$newUserComment->setNewsPath(Constant::NOTIFICATION_NOT_VIEW);
		$newUserComment->setUser($this->controller->getUser());
		
		$newUser->addNewsUsers($newUserComment);
		$em = $this->controller->getDoctrine()->getManager();
		$em->persist($newUserComment);
		$em->flush();
		
		return $newUserComment ;
	
	}
	
	/**
	 *
	 * Crea una novedad por la carga de resultados de un evento
	 *
	 * @param Event $event
	 * @return NewsUser
	 */
	public function newEventResult(Event $event){
	
		$newsUser = new NewsUser();
		$newsUser->setComment(Constant::COMMENT_CREATE_EVENT_RESULT);
		$newsUser->setType(Constant::TYPE_CREATE_EVENT);
		$newsUser->setNewsPath(Constant::NOTIFICATION_NOT_VIEW);
		$newsUser->setUser($this->controller->getUser());
		$newsUser->setEvent($event);
	
		$em = $this->controller->getDoctrine()->getManager();
		$em->persist($newsUser);
		return $em->flush();
	
	}
	
	/**
	 * 
	 * Crea una novedad por la creacion de un evento.
	 * 
	 * @param Event $event
	 * @return NewsUser
	 */
	public function createEvent(Event $event){
	
		$newsUser = new NewsUser();
		$newsUser->setComment(Constant::COMMENT_CREATE_EVENT);
		$newsUser->setType(Constant::TYPE_CREATE_EVENT);
		$newsUser->setNewsPath(Constant::NOTIFICATION_NOT_VIEW);
		$newsUser->setUser($this->controller->getUser());
		$newsUser->setEvent($event);
		
		$em = $this->controller->getDoctrine()->getManager();
		$em->persist($newsUser);
		return $em->flush();
		
	}
	
	/**
	 *
	 * Crea compartir eventos notificacion
	 *
	 * @param Event $event
	 * @return NewsUser
	 */
	public function createSearchEvent(Event $event){
	
		$newsUser = new NewsUser();
		$newsUser->setComment(Constant::COMMENT_SEARCH_EVENT.$event->getName());
		$newsUser->setType(Constant::TYPE_SEARCH_EVENT);
		$newsUser->setNewsPath(Constant::NOTIFICATION_NOT_VIEW);
		$newsUser->setUser($this->controller->getUser());
		$newsUser->setEvent($event);
	
		$em = $this->controller->getDoctrine()->getManager();
		$em->persist($newsUser);
		$em->flush();
		
		return $newsUser;
	
	}
	
	/**
	 * Crea una novedad por la participacion de un usuario a un evento
	 * 
	 * @param Enrolled $enrolled
	 * @return NewsUser
	 */
	public function createEnrolledEvent(Enrolled $enrolled,Event $event){
		
		$newsUser = new NewsUser();
		$newsUser->setComment(Constant::COMMENT_ENROLLED_EVENT);
		$newsUser->setType(Constant::TYPE_ENROLLED_EVENT);
		$newsUser->setNewsPath(Constant::NOTIFICATION_NOT_VIEW);
		$newsUser->setUser($this->controller->getUser());
		$newsUser->setEnrolled($enrolled);
		$newsUser->setEvent($event);
		
		$em = $this->controller->getDoctrine()->getManager();
		$em->persist($newsUser);
		return $em->flush();
	
	}
	
	/**
	 * Crea una notificacion la carga de resultados de un evento.
	 *
	 * @param User $user
	 * @return NewsUser
	 */
	public function createResultEvent(Event $event){
		
		$newsUser = new NewsUser();
		$newsUser->setComment(Constant::COMMENT_NEW_RESULT_EVENT);
		$newsUser->setType(Constant::TYPE_NEW_RESULT_EVENT);
		$newsUser->setNewsPath(Constant::NOTIFICATION_NOT_VIEW);
		$newsUser->setUser($this->controller->getUser());
		$newsUser->setEvent($event);
		
		$em = $this->controller->getDoctrine()->getManager();
		$em->persist($newsUser);
		return $em->flush();
	
	}
	

	/**
	 * Crea una notificacion por la invitacion de un amigo.
	 * 
	 * @param User $user
	 * @return NewsUser
	 */
	 public function createFriendPending(User $user,User $userFriend){
	
	 	
	 	$entities = $this->getFriendPending($userFriend,$user);
	 	
	 	$responde = null;
	 	
	 	if($entities == null){
		$newsUser = new NewsUser();
		$newsUser->setComment(Constant::COMMENT_PENDING_FRIEND);
		$newsUser->setType(Constant::TYPE_PENDING_FRIEND);
		$newsUser->setNewsPath(Constant::NOTIFICATION_NOT_VIEW);
		$newsUser->setUser($userFriend);
		$newsUser->setFriend($user);
	
		$em = $this->controller->getDoctrine()->getManager();
		$em->persist($newsUser);
		
		$responde = $em->flush(); 
	 	}
		
		return  $responde;
	
	}
	
	public function sendFriendRequest(User $user,User $userFriend){
		
		$response = $this->emailServices->sendEmailRequestUser($user,$userFriend);
		
		return $response;
	}
	
	public function confirmFriendRequest(User $user,User $userFriend){
	
		$response = $this->emailServices->confirmFriend($user,$userFriend);
	
		return $response;
	}
	
	
	
	
	/**
	 * 
	 * Elimina las solicitudes de amitad de un usuario a otro
	 * 
	 * @param User $user
	 * @param User $userFriend
	 */
	public function deleteFriendPending(User $user,User $userFriend){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		$entities = $this->getFriendPending($user,$userFriend);
		
		foreach($entities as $news) {
    		$em->remove($news);
			$em->flush();
    	}
		
	}
	
	/**
	 * 
	 * Obtiene las notificaciones de solicitud de de un usuario a otro.
	 * 
	 * @param User $user
	 * @param User $userFriend
	 */
	public function getFriendPending(User $user,User $userFriend){
		
		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		
		
		$entities =  $qb->select("nu")
		->add('from', 'ObjectBundle:NewsUser nu')
		->innerJoin('nu.user','u')
		->innerJoin('nu.friend','f')
		->andWhere('f.id = :idf')
		->andWhere('u.id = :id')
		->setParameter('idf', $userFriend->getId())
		->setParameter('id', $user->getId())->getQuery ()
		->execute();
		
		return $entities;
		
	}
	
	/**
	 * 
	 * Obtiene las notificaciones de los eventos.
	 * 
	 * @param User $user
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getNotificationEvent($user){
		
		$types = array();
		$types[] = Constant::TYPE_CREATE_EVENT;
		$types[] = Constant::TYPE_ENROLLED_EVENT;
		$types[] = Constant::TYPE_SEARCH_EVENT;
		
		$view = array();
		$view[] = Constant::NOTIFICATION_NOT_VIEW;
		$view[] = Constant::NOTIFICATION_NOT_VIEW;
		
		$newsUser = $this->getNewsUserByType($types,$user,$view);
		
		return $newsUser;
	}
	
	/**
	 * 
	 * Obtener las notificaciones de amigos pendientes
	 * 
	 * @param User $user
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getNotificationFriend($user){
		
		$types = array();
		$types[] = Constant::TYPE_PENDING_FRIEND;
		
		
		$view = array();
		$view[] = Constant::NOTIFICATION_NOT_VIEW;
		$view[] = Constant::NOTIFICATION_VIEW;
		
		
		$newsUser = $this->getNewsUserByType($types,$user,$view);
		
		return $newsUser;
	}
	
	/**
	 *
	 * Obtener las notificaciones de amigos pendientes
	 *
	 * @param User $user
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getNotificationFriendNotView($user){
	
		$types = array();
		$types[] = Constant::TYPE_PENDING_FRIEND;
	
	
		$view = array();
		$view[] = Constant::NOTIFICATION_NOT_VIEW;
	
	
		$newsUser = $this->getNewsUserByType($types,$user,$view);
		return $newsUser;
	}
	
	/**
	 * Marca las novedades de los eventos de las usuarios como vistas.
	 * 
	 * @param User $user
	 * @return boolean
	 */
	public function markViewNotificationEvent($user){
		
		$types = array();
		$types[] = Constant::TYPE_CREATE_EVENT;
		$types[] = Constant::TYPE_ENROLLED_EVENT;
		
		$view = array();
		$view[] = Constant::NOTIFICATION_NOT_VIEW;
		
		$newsUser = $this->getNewsUserByType($types,$user,$view);
		
		$this->setNewsView($newsUser);
		
		return true;
		
	}
	
	/**
	 * Marca las novedades de peticion de amistad de las usuarios como vistas.
	 *
	 * @param User $user
	 * @return boolean
	 */
	public function markViewNotificationFriend($user){
	
		$types = array();
		$types[] = Constant::TYPE_PENDING_FRIEND;

	
		$view = array();
		$view[] = Constant::NOTIFICATION_NOT_VIEW;
		
	
		$newsUser = $this->getNewsUserByType($types,$user,$view);
	
		$this->setNewsView($newsUser);
	
		return true;
	
	}
	
	private function setNewsView($newsUser){
			

		$em = $this->controller->getDoctrine()->getManager();
		
		foreach($newsUser as $news) {
				
			$news->setNewsPath(Constant::NOTIFICATION_VIEW);
			$em->persist($news);
			$em->flush();
		}
		
	}	
	/**
	 * 
	 * Obtiene las novedades del usuario vistas o no vistas de acuerdo al parametro $view
	 * 
	 * @param array $types
	 * @param User $user
	 * @return ArrayCollection
	 */
	private function getNewsUserByType($types,$user,$view){
		
		$em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		
		
		
		$entities =  $qb->select("nu")
		->add('from', 'ObjectBundle:NewsUser nu')
		->innerJoin('nu.user','u')
		->andWhere('nu.newsPath in (:view)')
		->andWhere('u.id = :id')
		->andWhere('nu.type in (:types)')
		->setParameter('types', $types)
		->setParameter('view', $view)
		->setParameter('id', $user->getId())
		->orderBy('nu.id', 'DESC')->getQuery ()
		->execute();
		
		return $entities;
		
	}
	/**
	 * 
	 * Obtiene las noticias publicas.
	 * 
	 * @param User $user usuario logueado
	 * @param int $firstResult primer resultado
	 * @param int $maxResults cantidad de resultados
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function getNewsPublic($firstResult,$maxResults){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		$qb = $em->createQueryBuilder();
		
		$types = array();
		$types[] = Constant::TYPE_CREATE_EVENT;
		$types[] = Constant::TYPE_MAIN_NEWS;
		$types[] = Constant::TYPE_ENROLLED_EVENT;
		$types[] = Constant::TYPE_SEARCH_EVENT;
		$types[] = Constant::TYPE_NEW_RESULT_EVENT;
		$types[] = Constant::TYPE_NEW_COMMENT;
		
		
		
		$query =  $qb->select("nu")
		->add('from', 'ObjectBundle:NewsUser nu')
                ->innerJoin('nu.user','u')
                ->innerJoin('u.userConfiguration','uc')
		->andWhere('uc.shareWith = :shareWith')
		->andWhere('nu.type in (:types)')
		->setParameter('types', $types)
		->setParameter('shareWith', "1")->orderBy('nu.id', 'DESC')
		->setFirstResult($firstResult)
		->setMaxResults($maxResults)->getQuery ();
		 
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
		
		return  $paginator;
		
	}
        
        
	/**
	 * 
	 * Obtiene las noticias del usuario y de los amigos.
	 * 
	 * @param User $user usuario logueado
	 * @param int $firstResult primer resultado
	 * @param int $maxResults cantidad de resultados
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function getNewsUserAndFriends($user,$firstResult,$maxResults){
		
		$em = $this->controller->getDoctrine()->getManager();
		
		$qb = $em->createQueryBuilder();
		
		
		$friends = $user->getFriendsAndFolloweUser();
		$types = array();
		$types[] = Constant::TYPE_CREATE_EVENT;
		$types[] = Constant::TYPE_MAIN_NEWS;
		$types[] = Constant::TYPE_ENROLLED_EVENT;
		$types[] = Constant::TYPE_SEARCH_EVENT;
		$types[] = Constant::TYPE_NEW_RESULT_EVENT;
		$types[] = Constant::TYPE_NEW_COMMENT;
		$ids = array();
		
		foreach($friends as $f) {
			$ids[] = $f->getId();
		}
		$ids[] = $user->getId();
		
		$query =  $qb->select("nu")
		->add('from', 'ObjectBundle:NewsUser nu')
		->andWhere('nu.user IN (:ids)')
		->andWhere('nu.type in (:types)')
		->setParameter('types', $types)
		->setParameter('ids', $ids)->orderBy('nu.id', 'DESC')
		->setFirstResult($firstResult)
		->setMaxResults($maxResults)->getQuery ();
		 
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
		
		return  $paginator;
		
	}
	
	/**
	 *
	 * Obtiene las noticias del usuario 
	 *
	 * @param User $user usuario logueado
	 * @param int $firstResult primer resultado
	 * @param int $maxResults cantidad de resultados
	 * @param array $types tipo de noticias que quiero traer de la base
	 * @return \Doctrine\ORM\Tools\Pagination\Paginator
	 */
	public function getNewsUser($userId,$firstResult,$maxResults,$types = null){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$qb = $em->createQueryBuilder();
		if($types == null){
		$types = array();//Tipos de noticias que trae de la base
		$types[] = Constant::TYPE_CREATE_EVENT;
		$types[] = Constant::TYPE_MAIN_NEWS;
		$types[] = Constant::TYPE_ENROLLED_EVENT;
		$types[] = Constant::TYPE_SEARCH_EVENT;
		$types[] = Constant::TYPE_NEW_RESULT_EVENT;
		$types[] = Constant::TYPE_NEW_COMMENT;
		}
		
		
		
		$query =  $qb->select("nu")
		->add('from', 'ObjectBundle:NewsUser nu')
		->andWhere('nu.user  = :ids')
		->andWhere('nu.type in (:types)')
		->setParameter('types', $types)
		->setParameter('ids', $userId)->orderBy('nu.id', 'DESC')
		->setFirstResult($firstResult)
		->setMaxResults($maxResults)->getQuery ();
			
		$paginator = new Paginator($query, $fetchJoinCollectio  = true);
	
		return  $paginator;
	
	}
	
	public function getCommentNews($idNews,$firstResult,$maxResults){
	
		$em = $this->controller->getDoctrine()->getManager();
	
		$newsUser = new NewsUser();
		$newsUser = $em->getRepository('ObjectBundle:NewsUser')->find($idNews);
// 		$query = $qb->select("nu")
// 		->add('from', 'ObjectBundle:NewsUser nu')
// 		->andWhere('nu.id = :ids')
// 		->setParameter('ids', $idNews)->orderBy('nu.id', 'DESC')
// 		->setFirstResult($firstResult)
// 		->setMaxResults($maxResults)->getQuery ()
// 		->execute();
// 		;
			
		//$paginator = new Paginator($query, $fetchJoinCollectio  = true);
		
		return  $newsUser->getNewsUsers();
	
	}
}
