<?php

namespace Amateur\UserBundle\Services;



use Amateur\ObjectBundle\Entity\User;
use Amateur\ObjectBundle\Entity\Constant;
use Amateur\ObjectBundle\Entity\Event;	
use Amateur\ObjectBundle\Entity\Enrolled;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Common\Collections\Doctrine\Common\Collections;
use Amateur\ObjectBundle\Entity\Amateur\ObjectBundle\Entity;
use Xtending\ServicesBundle\Services\GeolocationServices;
use Assetic\Cache\ArrayCache;
/**
 * NewsUser Services.
 *
 * 
 */
class PointServices 
{

	protected $controller;
	
	protected $geolocationServices;
	
	/**
	 *
	 * @param $controller
	 */
	public function __construct($controller)
	{
		$this->controller = $controller;
		$this->geolocationServices = new GeolocationServices($controller);
	}
            
                
        public function updatePointUser(User $user){
            
            $this->updatePointUserForEvent($user);

        }
        
        /**
	 * Calcula todos los puntos de los eventos que participa el usuario.
         * 
	 */
        public function updatePointUserForEvent(User $user){
            
            
           //cuenta los puntos por inscripcion a eventos
            $this->createPointForEnrolled($user);
            
            //cuenta los puentos por los resultados obtenidos
            $this->createPointForClassification($user);
        }
        
        /**
	 * Se crear puntos por evento que participo, 
         * si cargo el usuario el resultado a mano o si esta cargado oficial.
	 */
        private function createPointForEnrolled($user){
            
            
            $em = $this->controller->getDoctrine()->getManager();
            
            $enrolleds = $this->getEnrolledUserNotCounted($user);
            
            foreach ($enrolleds as $enrolled){
                
                if($enrolled->getClassification() != null or $enrolled->getTime() != "" ){
                
                    $point = $this->createPoint(2,01,$enrolled->getEvent()->getStartTime(),
                            "1",$enrolled->getEvent(),$user,"Participo en el evento:");
                    
                    $enrolled->setIsCounted("1");
                    $em->persist($point);
                    $em->persist($enrolled);
                    $em->flush();
                
                
                }
                
            }
            
        }
        /**
	 * Se crear los puntos por los los resultados cargado en el sistema,
         * Segun el puesto se toman los 10 participates por detra y se suman los segundos por detras de el, cada segundo es un punto.
	 */
        private function createPointForClassification($user){
            
            $em = $this->controller->getDoctrine()->getManager();
            
            $classifications = $this->getClassificationUserNotCounted($user);
            
            foreach ($classifications as $classification){
                    
                    $points = $this->calculatePointsFromClassification($classification,$user);
                    
                    $point = $this->createPoint($points,02,$classification->getEvent()->getStartTime(),
                            "1",$classification->getEvent(),$user,"Por los segundos sacados a los 5 participantes llegados despues de que finalizaste:");
                    
                    $classification->setIsCounted("1");
                    $em->persist($point);
                    $em->persist($classification);
                    $em->flush();
                
            }
            
            
        }
        /**
	 * 
         * Calcula los puntos del usuario con los 10 participantes por detras el usuario.
	 */
        private function calculatePointsFromClassification($classification,$user){
            
                    $classifications = $this->getClassificationBehindUser($classification,$user);
                    $points = 0;
                    $cant = 0;
                    foreach ($classifications as $classification2){
//                     $classification2 = new \Amateur\ObjectBundle\Entity\Classification();
                        
//                        $logger = $this->controller->get('logger');
//    $logger->info('YO SEGUNDOS '.$cant ." :". $classification->getSecondsNetoTime());
//    $logger->error('ELLOS SEGUNDOS'.$cant ." :".$classification2->getSecondsNetoTime() );
                        
                        if($classification2->getSecondsNetoTime() >= $classification->getSecondsNetoTime() and $cant < 5){
                            
                            $temporal_point =  $classification2->getSecondsNetoTime() - $classification->getSecondsNetoTime();
                            $points = $points + $temporal_point;
                            $cant = $cant +1;
                        }
                    }
                    
                    return $points;
        }
        
        /**
	 * 
         * Obtiene los 10 resultados de los usuarios que llegaron detras del usuario
	 */
        public function getClassificationBehindUser($classification,$user){
         
            $em = $this->controller->getDoctrine()->getManager();
            if($classification->getExtraData() == null){//Se normaliza las clasificaciones
               $this->normalizeClassificationEvent($classification->getEvent()->getId());
            }
            
            
            $classifications = $em->getRepository("ObjectBundle:Classification")->createQueryBuilder('u')
//		->innerJoin('u.enrolled','en')
                ->where('u.event = :idEvent')
                ->andWhere('u.overallRank BETWEEN :first AND :last')
                 ->andWhere('u.extraData = :extraData')
//                ->andWhere('en.user = :idUser')
		->orderBy('u.overallRank', 'ASC')
		->setParameter('idEvent', $classification->getEvent()->getId())
//                ->setParameter('idUser', $user->getId())
                ->setParameter('extraData', $classification->getExtraData())
                ->setParameter('first', $classification->getOverallRank()+1)
                ->setParameter('last', $classification->getOverallRank()+30)
                
		->getQuery()->getResult();
            
            return $classifications;
//            $classifications = $em->getRepository("ObjectBundle:Classification")
//                ->createQueryBuilder('u')
//                ->where('u.event = :idEvent')
//                ->andWhere('u.overallRank BETWEEN :first AND :last')
//                ->orderBy('u.netoTime', 'ASC') 
//		->setParameter('idEvent', 274)
//                ->setParameter('first', 1)
//                ->setParameter('last', 20)
//                ->setMaxResults(10)
//		->getQuery()->getResult();
    	
            
        }

        /**
	 * Obtiene los eventos que participo el usuario que no fueron contados para los puntos
	 */
        private function getEnrolledUserNotCounted(User $user){
                
                $em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		 
		$enrolle =  $qb->select("en")
		->add('from', 'ObjectBundle:Enrolled en')
		->innerJoin('en.user','u')
		->where('en.isCounted = :isCounted')
		->AndWhere('u.id = :idUser')
		->setParameter('isCounted', 0)
		->setParameter('idUser', $user->getId())->getQuery ()
		->execute();
                
                return $enrolle;
        }
        
        /**
	 * Obtiene los resultados del usuario que no fueron contabilizados
	 */
        private function getClassificationUserNotCounted(User $user){
                
                $em = $this->controller->getDoctrine()->getManager();
		
		 
		$classifications = $em->getRepository("ObjectBundle:Classification")
                ->createQueryBuilder('u')
                ->innerJoin('u.enrolled','e')
//		->where('u.isCounted = :isCounted')
		->where('e.user = :idUser')
//		->setParameter('isCounted', 0)
		->setParameter('idUser', $user->getId())
		->getQuery()->getResult();
                
                return $classifications;
        }
        
        
        

        private function createPoint($cant,$code,$date,$isDefeated,$event,$user,$description){
                    
                    $point = new \Amateur\ObjectBundle\Entity\Point();
                    $point->setCant($cant);
                    $point->setCode($code);
                    $point->setDate($date);
                    $point->setDescription($description);
                    $point->setEvent($event);
                    $point->setIsDefeated($isDefeated);
                    $point->setUser($user);
                    
                    return $point;
        }
        
        private function normalizeClassificationEvent($idEvent){
                
                $em = $this->controller->getDoctrine()->getManager();
        
                $classifications = $em->getRepository("ObjectBundle:Classification")
                ->createQueryBuilder('u')
                ->where('u.event = :idEvent')
                ->setParameter('idEvent', $idEvent)
		->getQuery()->getResult();
    	
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
                
        }
            
        /**
	 * Obtener los puntos de un usuario
	 */
        public function getPointsUser(User $user){
                
                $em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		 
		$points =  $qb->select("en")
		->add('from', 'ObjectBundle:Point p')
		->innerJoin('en.user','u')
		->where('u.id = :idUser')
		->setParameter('idUser', $user->getId())->getQuery ()
		->execute();
                
                return $points;
        }
        
        public function getCantPointsUser(User $user){
                
                $em = $this->controller->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		 
		$points =  $qb->select('count(p.cant)')
		->add('from', 'ObjectBundle:Point p')
		->innerJoin('p.user','u')
		->where('u.id = :idUser')
		->setParameter('idUser', $user->getId())->getQuery ()
		->getSingleScalarResult();
                
                return $points;
        }
}
