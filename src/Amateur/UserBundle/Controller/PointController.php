<?php

namespace Amateur\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Amateur\ObjectBundle\Entity\User;
use Amateur\UserBundle\Form\UserType;
use Amateur\EventBundle\Services\EventServices;
use Amateur\NewsUserBundle\Services\NewsUserServices;
use Amateur\UserBundle\Services\UserServices;
use Amateur\EventBundle\Services\EventReportsServices;
use Symfony\Component\HttpFoundation\Response;
use Xtending\ServicesBundle\Services\MailerServices;
use Amateur\ObjectBundle\Entity\ActivityLogUsers;
use Amateur\ObjectBundle\Entity\Organizer;
use Amateur\ObjectBundle\Entity\Amateur\ObjectBundle\Entity;
use Amateur\UserBundle\Form\OrganizerType;
use Amateur\UserBundle\Form\Amateur\UserBundle\Form;
use Amateur\ObjectBundle\Entity\UserConfiguration;
use Amateur\UserBundle\Services\PointServices;




/**
 * Point controller.
 *
 * @Route("/point")
 */
class PointController extends Controller
{
    
        /**
	 * @var PointServices : Contiene todas las funcionalidades los puntos
	 */
	protected $pointServices;
	
	public function __construct()
	{
		$this->pointServices = new PointServices($this);
	
	}

    
     /**
     * Actualiza todos los puntos del usuario logueado.
     *
     * @Route("/update", name="update_point")
     * @Method("GET")
     * @Template("")
     */
    public function updatePoinsUserAction()
    {
    	$this->pointServices->updatePointUser($this->getUser());
    	
    	return new Response("OK");
    }
    
     
     /**
     * Actualiza todos los puntos del usuario logueado.
     *
     * @Route("/cant/point", name="cant_point")
     * @Method("GET")
     * @Template("")
     */
    public function getCantPointsUserAction()
    {
    	$cant = $this->pointServices->getCantPointsUser($this->getUser());
    	
        return new Response($cant);
    }
    
     /**
     * Actualiza todos los puntos del usuario logueado.
     *
     * @Route("/{inicial}/list", name="update_point_list")
     * @Method("GET")
     * @Template("EventBundle:Event:seachResult.html.twig")
     */
    public function listAction($inicial)
    {
        
        $em = $this->getDoctrine()->getManager();
        
    	$classifications = $em->getRepository("ObjectBundle:Classification")
                ->createQueryBuilder('u')
//                ->where('u.extraData = :idEvent')
                ->where('u.event = :idEvent')
                ->setParameter('idEvent', 188)
//                ->setFirstResult($inicial)
		->setMaxResults(1000)
		->getQuery()->getResult();
    	
  
        //cambiar clasificacion
        
        
                $classifications2 = new \Doctrine\Common\Collections\ArrayCollection();
        
            
        
                foreach ($classifications as $classification){
                    $ok = 0;
                    if(strpos(strtolower(substr($classification->getCategoryName(), 0, 4)),"k") ){
                        $classification->setExtraData(trim(substr($classification->getCategoryName(), 0, 3)));   

                        $em->persist($classification);

$ok = 1;

                    }
                    
                    if(mb_stristr($classification->getCategoryName(),"olimpico") ){
                        $classification->setExtraData("Olimpico");   

                        $em->persist($classification);

$ok = 1;

                    }
                    
                    if(mb_stristr($classification->getCategoryName(),"sprint") ){
                        $classification->setExtraData("Sprint");   

                        $em->persist($classification);


$ok = 1;
                    }
                    
                    if(mb_stristr($classification->getCategoryName(),"short") ){
                        $classification->setExtraData("Short");   

                        $em->persist($classification);

$ok = 1;
                    }
                    
                   if(mb_stristr($classification->getCategoryName(),"ironman") ){
   $classification->setExtraData("Ironman");   

                        $em->persist($classification);

$ok = 1;
                    }
                    
                    if($ok == 0){
                        
                        if($classification->getEvent()->getCategories()->first() != null){
                        $classification->setExtraData($classification->getEvent()->getCategories()->first()->getName());   
                        }else{
                            $classification->setExtraData($classification->getEvent()->getSport()->getName());   
                        }
                        $em->persist($classification);
                        
                    }
                    $em->flush();
                }
                
               // 
        
        return array(
    			'classifications' => $classifications2,
    	);
    }
}
