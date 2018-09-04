<?php

namespace Xtending\ServicesBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Xtending\EntityBundle\Entity\FormulariosResultados;
use Xtending\EntityBundle\Entity\LabelCaratulaValor;
use xtending\EntityBundle\Entity\FormulariosDefiniciones;
use Xtending\EntityBundle\Entity\PreguntaValor;

use Symfony\Component\Validator\Constraints\Length;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\BrowserKit\Response;




class ConversorServices 
{
	
	protected $controller;
	
	public function __construct($controller)
	{
		$this->controller = $controller;
	}
	
	public function convertir($valor, $label) {
		
		$valorConvertido = $valor;
		if ($label != null) {
			$unidad = $label->getCriterio()->getUnidadBase();
			
			switch ($unidad) {
				case 1: // 'Fahrenheit'
					$valorConvertido = $this->convertirGrado($valor,$label);
					break;
				case 2: // 'Kilogramos'
					$valorConvertido = $this->convertirPeso($valor,$label);
					break;
				case 3: // 'Kilometros'
					$valorConvertido = $this->convertirDistancia($valor,$label);
					break;
				case 4: // 'Litros'
					$valorConvertido = $this->convertirLiquido($valor,$label);
					break;
			}
		}
		return $valorConvertido;
		
	}
	
    public function convertirGrado($valor, $label)
    {
    	if ($label->getConvertible() != 0) {
    		$valorConvertido = round((($valor * 1.8)+ 32));
    	} else {
    		$valorConvertido = $valor;
    	}
    	
    	return $valorConvertido;
    	 
    }
    
    public function convertirPeso($valor, $label)
    {
    	if ($label->getConvertible() != 0) {
    		$valorConvertido = $valor; //Definir la formula a utilizar
    	} else {
    		$valorConvertido = $valor;
    	}
    	 
    	return $valorConvertido;
    
    }
    
    public function convertirDistancia($valor, $label)
    {
    	if ($label->getConvertible() != 0) {
    		$valorConvertido = $valor; //Definir la formula a utilizar
    	} else {
    		$valorConvertido = $valor;
    	}
    	 
    	return $valorConvertido;
    
    }
    
    public function convertirLiquido($valor, $label)
    {
    	if ($label->getConvertible() != 0) {
    		$valorConvertido = $valor; //Definir la formula a utilizar
    	} else {
    		$valorConvertido = $valor;
    	}
    	 
    	return $valorConvertido;
    
    }
    
       
}
