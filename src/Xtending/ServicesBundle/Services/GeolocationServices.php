<?php

namespace Xtending\ServicesBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Common\Collections\ArrayCollection;



class GeolocationServices 
{
	protected $controller;
	
	
	/**
	 *
	 * @param $controller
	 */
	public function __construct($controller)
	{
		$this->controller = $controller;
	}
	
	/**
	 * 
	 * Calcular perimetro de geolocalizacion de busqueda
	 * 
	 * @param unknown $lat
	 * @param unknown $lng
	 * @param number $distance
	 * @param number $earthRadius
	 * @return multitype:NULL 
	 */
	function getBoundaries($lat, $lng, $distance = 1, $earthRadius = 6371)
	{
		$return = array();
		 
		// Los angulos para cada dirección
		$cardinalCoords = array('north' => '0',
				'south' => '180',
				'east' => '90',
				'west' => '270');
		$rLat = deg2rad($lat);
		$rLng = deg2rad($lng);
		$rAngDist = $distance/$earthRadius;
		foreach ($cardinalCoords as $name => $angle)
		{
			$rAngle = deg2rad($angle);
			$rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
			$rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));
			$return[$name] = array('lat' => (float) rad2deg($rLatB),
					'lng' => (float) rad2deg($rLonB));
		}
		return array('min_lat'  => $return['south']['lat'],
				'max_lat' => $return['north']['lat'],
				'min_lng' => $return['west']['lng'],
				'max_lng' => $return['east']['lng']);
	}
	
	function getIdObjetAroundDistance($lat,$lng,$distance){
		
		$result = new ArrayCollection();
		
		$em = $this->controller->getDoctrine ()->getManager ();
		
		$box = $this->getBoundaries($lat, $lng, $distance);
		
		$sql = 'SELECT *, (6371 * ACOS( 
                                            SIN(RADIANS(latitude)) 
                                            * SIN(RADIANS(' . $lat . ')) 
                                            + COS(RADIANS(longitude - ' . $lng . ')) 
                                            * COS(RADIANS(latitude)) 
                                            * COS(RADIANS(' . $lat . '))
                                            )
                               ) AS distance
                     FROM event	
                     WHERE (latitude BETWEEN ' . $box['min_lat']. ' AND ' . $box['max_lat'] . ')
                     AND (longitude BETWEEN ' . $box['min_lng']. ' AND ' . $box['max_lng']. ')
                     HAVING distance  < ' . $distance . '                                       
                     ORDER BY distance ASC ';
		
		$conn = $em->getConnection();
		
		$result = $conn->query($sql)->fetchAll();
		
		
		
		return $result;
		
	}
	
}