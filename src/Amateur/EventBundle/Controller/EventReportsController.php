<?php

namespace Amateur\EventBundle\Controller;

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
use Amateur\ObjectBundle\Entity\Amateur\ObjectBundle\Entity;
use Amateur\EventBundle\Form\EnrolledType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\Doctrine\Common\Collections;
use Amateur\ObjectBundle\Entity\User;
use Amateur\EventBundle\Services\EventReportsServices;



/**
 * Event controller.
 *
 */
class EventReportsController extends Controller
{
	
	
	protected $eventRepostsServices;
	
	protected $excelServices;
	
	public function __construct()
	{
		$this->eventRepostsServices = new EventReportsServices($this);
		$this->excelServices = new ExcelServices($this);
	
		
	}
	
	public function generateReportUserRunningAction($userId){
		
		$arrayEnrolled = $this->eventRepostsServices->getReportRunning($userId);
		
		
		return $this->render('EventBundle:EventReports:EventReports.html.twig', array(
				'arrayEnrolled' => $arrayEnrolled,
				'firstResult' => 0,
				'tipe' => "all"
		));
		
	}
   
        
}
