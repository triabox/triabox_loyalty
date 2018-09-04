<?php

namespace Amateur\NewsUserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Amateur\ObjectBundle\Entity\NewsUser;
use Amateur\NewsUserBundle\Form\NewsUserType;
use Amateur\ObjectBundle\Entity\Positive;
use Doctrine\ORM\NoResultException;
use Amateur\NewsUserBundle\Services\NewsUserServices;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Common\Collections\ArrayCollection;
use Amateur\ObjectBundle\Entity\Amateur\ObjectBundle\Entity;


/**
 * NewsUser controller.
 *
 * @Route("/news")
 */
class NewsUserController extends Controller
{
	
	protected $newsUserServices;
	
	public function __construct()
	{
		$this->newsUserServices = new NewsUserServices($this);
	
	}
	
    /**
     * Redireccionar al template NewsUser pagina principal
     * 
     * @Route("/", name="newsuser")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {

       $entity = new NewsUser();
       $form   = $this->createForm(new NewsUserType(), $entity);
       $formComment   = $this->createForm(new NewsUserType(), $entity);
        return array(
        		'firstResult'=> 0,
        		'entity' => $entity,
        		'form'   => $form->createView(),
        		'formComment'   => $formComment->createView(),
        );
    }
    
   
   
    /**
     * Lists all Novedades principales del usuario y de sus amigos de acuerdo a la cantidad enviada
     * @param int $firstResult desden don de leo el resultado
     * @param int $maxResults  Cantidad maxima de resultados listado.
     * 
     * @Route("/{firstResult}/{maxResults}/more", name="more_news_user")
     * @Method("GET")
     * @Template("NewsUserBundle:NewsUser:new.html.twig")
     */
    public function getMoreNewsUserAction($firstResult , $maxResults)
    {
        if($this->getUser() != null){
    	$paginator =  $this->newsUserServices->getNewsUserAndFriends($this->getUser(), $firstResult, $maxResults);
        }else{
        $paginator =  $this->newsUserServices->getNewsPublic( $firstResult, $maxResults);    
        }
    	$entity = new NewsUser();
    	$form   = $this->createForm(new NewsUserType(), $entity);
    
    	return array(
    			'firstResult'=> $firstResult+$maxResults,
    			'entities' => $paginator,
    			'entity' => $entity,
    			'form'   => $form->createView(),
    	);
    }
    
    
    /**
     * Lists all Novedades principales del usuario 
     * @param int $firstResult desden don de leo el resultado
     * @param int $maxResults  Cantidad maxima de resultados listado.
     * @Route("/{firstResult}/{maxResults}/{userId}/profile", name="news_user")
     * @Method("GET")
     * @Template("NewsUserBundle:NewsUser:newsProfile.html.twig")
     */
    public function getNewsUserAction($firstResult , $maxResults,$userId)
    {
    
    	$paginator =  $this->newsUserServices->getNewsUser($userId, $firstResult, $maxResults);
    
    	$entity = new NewsUser();
    	$form   = $this->createForm(new NewsUserType(), $entity);
    
    	return array(
    			'firstResult'=> $firstResult+$maxResults,
    			'userId'=> $userId,
    			'entities' => $paginator,
    			'entity' => $entity,
    			'form'   => $form->createView(),
    	);
    }
    /**
     * Creates a new NewsUser entity.
     *
     * @Route("/", name="newsuser_create")
     * @Method("POST")
     * @Template("NewsUserBundle:NewsUser:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new NewsUser();
        
        $form = $this->createForm(new NewsUserType(), $entity);
        $form->bind($request);
        
        
        if ($form->isValid()) {
        	$this->newsUserServices->createNewsUserMessage($entity);
        }

        return $this->redirect($this->generateUrl('newsuser'));
    }

    /**
     * Displays a form to create a new NewsUser entity.
     *
     * @Route("/new", name="newsuser_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NewsUser();
        $form   = $this->createForm(new NewsUserType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a NewsUser entity.
     *
     * @Route("/{id}", name="newsuser_show")
     * @Method("GET")
     * @Template("NewsUserBundle:NewsUser:newShare.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ObjectBundle:NewsUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing NewsUser entity.
     *
     * @Route("/{id}/edit", name="newsuser_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ObjectBundle:NewsUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsUser entity.');
        }

        $editForm = $this->createForm(new NewsUserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing NewsUser entity.
     *
     * @Route("/{id}", name="newsuser_update")
     * @Method("PUT")
     * @Template("NewsUserBundle:NewsUser:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ObjectBundle:NewsUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NewsUserType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsuser_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a NewsUser entity.
     *
     * @Route("/{id}", name="newsuser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ObjectBundle:NewsUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NewsUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newsuser'));
    }

    /**
     * Creates a form to delete a NewsUser entity by id.
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
    
    /**
     * Creates a likes for NewsUser .
     *
     * @Route("/{idNews}/likeCreate", name="like_create")
     * @Method("GET")
    * @Template("NewsUserBundle:NewsUser:footerNews.html.twig")
     */
    public function likeCreateAction($idNews)
    {
    	$entity  = new Positive();
    	$em = $this->getDoctrine()->getManager();
    	$newsUser = $em->getRepository('ObjectBundle:NewsUser')->find($idNews);
    	if($this->validateLike($idNews)){

    		$entity->setNewsUser($newsUser);
    		$entity->setUserId($this->getUser()->getId());
  
    		$em->persist($entity);
    		$em->flush();
    	}
    		return array( 
    				'entity'=> $newsUser,
    			
    		);
    }
    
    private function validateLike($idNews){
    	
    	 
    	$em = $this->getDoctrine()->getManager();
    	$qb = $em->createQueryBuilder();
    	try {
    		$qb->select("en")
    	->add('from', 'ObjectBundle:Positive en')
    	->innerJoin('en.newsUser','e')
    	->where('e.id = :idNewsUser')
    	->andWhere('en.userId = :idUser')
    	->setParameter('idNewsUser', $idNews)
    	->setParameter('idUser', $this->getUser()->getId())->getQuery ()
    	->getSingleResult();
    	} catch (NoResultException $e) {
    		return true;
    	} 

    	return false;
    }
    /**
     * Notificaciones de Eventos
     *
     * @Route("/notification/event", name="notification_event")
     * @Method("GET")
     * @Template("NewsUserBundle:NewsUser:notificationEvent.html.twig")
     */
    public function notificationEventAction(){
    	
    	$notifications = $this->newsUserServices->getNotificationEvent($this->getUser());
    	
    	return array(
    			'notifications'=> $notifications,
    			 
    	);
    }
    
    /**
     * Notificaciones de Eventos
     *
     * @Route("/notification/friend", name="notification_friend")
     * @Method("GET")
     * @Template("NewsUserBundle:NewsUser:notificationFriend.html.twig")
     */
    public function notificationFriendAction(){
    
    	$notifications = $this->newsUserServices->getNotificationFriend($this->getUser());
    	$notviews = $this->newsUserServices->getNotificationFriendNotView($this->getUser());

    	return array(
    			'notifications' => $notifications,
    			'notificationsNotViews' => count($notviews),
    	);
    	 
    }
    

    /**
     * Notificaciones eventos marcar como vistar
     *
     * @Route("/notification/event/view", name="marck_view_notification_event")
     * @Method("GET")
     * @Template("NewsUserBundle:NewsUser:notification.html.twig")
     */
    public function markViewNotificationEventAction(){
    
    	$this->newsUserServices->markViewNotificationEvent($this->getUser());
    	 
    	return array(
    			'tipe'=> 'event',
    	);
    
    }
    
    /**
     * Notificaciones friend marcar como vistar
     *
     * @Route("/notification/friend/view", name="marck_view_notification_friend")
     * @Method("GET")
     * @Template("NewsUserBundle:NewsUser:notification.html.twig")
     */
    public function markViewNotificationFriendAction(){
    
    	$this->newsUserServices->markViewNotificationFriend($this->getUser());
    
    	return array(
    			'tipe'=> 'friend',
    	);
    
    }
    
    
    /**
     * Lists all Friends's USer entities.
     *
     * @Route("/friends/ajax", name="friends_ajax")
     * @Method("GET")
     * @Template("UserBundle:User:list_users.html.twig")
     */
    public function lisfriendsNotificationAction()
    {
    
    	$entities = $this->getUser()->getFriendsUser();
    	 
    	return array(
    			'entities' => $entities,
    			'type' => 'friends',
    			 
    	);
    }
    
    /**
     * Notificaciones de Eventos
     *
     * @Route("list/notification/friend", name="list_notification_friend")
     * @Method("GET")
     * @Template("UserBundle:User:users.html.twig")
     */
    public function listNotificationFriendAction(){
    
    	$notifications = $this->newsUserServices->getNotificationFriend($this->getUser());
    	
    	$entities = new ArrayCollection();
    	foreach($notifications as $news) {
    		$entities->add($news->getFriend());
    	}
    	
    	return array(
    			'entities'=> $entities,
    			'type'=> '',
    			'tipe'=> 'notificaciones',
    	);
    
    }
    
    /**
     * Notificaciones Recomendar Eventos
     *
     * @Route("notification/search/{idEvent}/event", name="notification_search_event")
     * @Method("GET")
      * @Template("NewsUserBundle:NewsUser:newsEventCreate.html.twig")
     */
    public function createSearchEventAjaxAction($idEvent){
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$event = $em->getRepository('ObjectBundle:Event')->find($idEvent);
    	
    	$entity = $this->newsUserServices->createSearchEvent($event);
    	
    	 
    	return array(
    			'entity'=> $entity,
    	);
    
    }
    
    
    /**
     * Agrega un comentario a una novedad
     *
     * @Route("/notification/create/newsUser", name="create_comment_newsUser")
     * @Method("POST")
     * @Template("NewsUserBundle:NewsUser:listComment.html.twig")
     */
    public function createCommentNewsUserAjaxAction(Request $request){
    	     	 
    	$em = $this->getDoctrine()->getManager();
    	
    	$newsUser = $em->getRepository('ObjectBundle:NewsUser')->find($this->getRequest()->get("newUser"));

    	$newsUserComent = new NewsUser();
    	$newsUserComent->setComment($this->getRequest()->get("comment"));
    
    	
    	 $this->newsUserServices->createCommentNewsUser($newsUser,$newsUserComent);

    	return array(
    			'entities'=> $newsUser->getNewsUsers(),
    			
    	);
    
    }
    
    
    /**
     * Lists all Novedades principales del usuario y de sus amigos de acuerdo a la cantidad enviada
     * @param int $firstResult desden don de leo el resultado
     * @param int $maxResults  Cantidad maxima de resultados listado.
     * @Route("/{idNews}/{firstResult}/{maxResults}/more", name="comments_news_user")
     * @Method("GET")
     * @Template("NewsUserBundle:NewsUser:listComment.html.twig")
     */
    public function getCommentNewsUserAction($idNews,$firstResult , $maxResults)
    {
    
    	$paginator =  $this->newsUserServices->getCommentNews($idNews,$firstResult,$maxResults);
    
    	
    
    	return array(
    			'firstResult'=> $firstResult+$maxResults,
    			'entities' => $paginator,
    			
    			'idNews'   => $idNews,
    	);
    }
    
    
    
    
    
}
 