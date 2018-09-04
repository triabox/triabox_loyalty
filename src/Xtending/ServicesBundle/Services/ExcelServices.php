<?php

namespace Xtending\ServicesBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




use Symfony\Component\Validator\Constraints\Length;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\BrowserKit\Response;
use Doctrine\DBAL\Query\QueryBuilder;
use Amateur\ObjectBundle\Entity\Classification;




class ExcelServices 
{
	protected $controller;
	
	public function __construct($controller)
	{
		$this->controller = $controller;
	}

	/**
	 * @ORM\PostRemove()
	 */
	public function removeFile($nameFile)
	{
		if ($file = $this->controller->get('kernel')->getRootDir()."/../web/".$nameFile) {
			if ($nameFile != '' && file_exists($file) && is_writable($file))
			{
				unlink ( $file );
			}
		}
	}

	/**
	 * @param Event $event
	 * @param String $nameFile 
	 * @param Array $configuration
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function importExcelResultWithConfiguration($event,$nameFile,$configuration){
		$arrayResult = new ArrayCollection();
		if($nameFile != ''){
				
				
			$file = $this->controller->get('kernel')->getRootDir()."/../web/".$nameFile;
			if (!file_exists($file)) {
				exit("No existe el archivo :".$nameFile );
			}
			$phpExcelObject = \PHPExcel_IOFactory::load($file);
			//$phpExcelObject = $this->controller->get('phpexcel')->createPHPExcelObject($file);
	
			foreach ($phpExcelObject->getWorksheetIterator() as $worksheet) {
	
				$count = 0;
				foreach ($worksheet->getRowIterator() as $row) {
						
					if($count != 0){
	
						$cellIterator = $row->getCellIterator();
						$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
							
						$classification = new Classification();
							
						foreach ($cellIterator as $cell) {
	
							if($cell->getColumn() == $configuration[1]){
								$classification->addEvent($event);
								$classification->setOverallRank($cell->getValue());
							}
							if($cell->getColumn() == $configuration[2]){
									
								$classification->setDivRank($cell->getValue());
							}
							if($cell->getColumn() == $configuration[3]){
									
								$classification->setName($cell->getValue());
							}
							if($cell->getColumn() == $configuration[4]){
									
								$classification->setLastname($cell->getValue());
							}
							if($cell->getColumn() == $configuration[5]){
									
								$classification->setCategoryName($cell->getValue());
							}
							if($cell->getColumn() == $configuration[6]){
									
								$classification->setOfficialTime($cell->getValue());
							}
							if($cell->getColumn() == $configuration[7]){
									
								$classification->setNetoTime($cell->getValue());
							}
							if($cell->getColumn() == $configuration[8]){
									
								$classification->setSexo($cell->getValue());
							}
							if($cell->getColumn() == $configuration[9]){
	
								$classification->setBib($cell->getValue());
							}
							if($cell->getColumn() == $configuration[10]){
	
								$classification->setNationality($cell->getValue());
							}
							if($cell->getColumn() == $configuration[11]){
	
								$classification->setSwim($cell->getValue());
							}
							if($cell->getColumn() == $configuration[12]){
	
								$classification->setBike($cell->getValue());
							}
							if($cell->getColumn() == $configuration[13]){
	
								$classification->setRunFirst($cell->getValue());
							}
							if($cell->getColumn() == $configuration[14]){
	
								$classification->setRunLast($cell->getValue());
							}
						}
						$classification->setIsUser("0");
                         ///$classification->setIsCounted("0");
						$arrayResult->add($classification);
					}
					$count = $count +1;
				}
			}
		}
		$this->removeFile($nameFile);
		return $arrayResult;
	}
	
	
	public function importExcelResult($event,$nameFile){
		$arrayResult = new ArrayCollection();
		if($nameFile != ''){
			
			
			$file = $this->controller->get('kernel')->getRootDir()."/../web/".$nameFile;
			if (!file_exists($file)) {
				exit("No existe el archivo :".$nameFile );
			}
			$phpExcelObject = \PHPExcel_IOFactory::load($file);
			//$phpExcelObject = $this->controller->get('phpexcel')->createPHPExcelObject($file);
	
			foreach ($phpExcelObject->getWorksheetIterator() as $worksheet) {
		
				$count = 0;
				foreach ($worksheet->getRowIterator() as $row) {
					
						if($count != 0){
				
							$cellIterator = $row->getCellIterator();
							$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
							
							$classification = new Classification();
							
							foreach ($cellIterator as $cell) {
								
								if($cell->getColumn() == 'A'){
									$classification->addEvent($event);
									$classification->setOverallRank($cell->getValue());
								}
								if($cell->getColumn() == 'B'){
									
									$classification->setDivRank($cell->getValue());
								}
								if($cell->getColumn() == 'C'){
									
									$classification->setName($cell->getValue());
								}
								if($cell->getColumn() == 'D'){
									
									$classification->setLastname($cell->getValue());
								}
								if($cell->getColumn() == 'E'){
									
									$classification->setCategoryName($cell->getValue());
								}
								if($cell->getColumn() == 'F'){
									
									$classification->setOfficialTime($cell->getValue());
								}
								if($cell->getColumn() == 'G'){
									
									$classification->setNetoTime($cell->getValue());
								}
								if($cell->getColumn() == 'H'){
									
									$classification->setSexo($cell->getValue());
								}
								if($cell->getColumn() == 'I'){
										
									$classification->setBib($cell->getValue());
								}
								if($cell->getColumn() == 'J'){
								
									$classification->setNationality($cell->getValue());
								}
								if($cell->getColumn() == 'K'){
								
									$classification->setSwim($cell->getValue());
								}
								if($cell->getColumn() == 'L'){
								
									$classification->setBike($cell->getValue());
								}
								if($cell->getColumn() == 'M'){
								
									$classification->setRunFirst($cell->getValue());
								}
								if($cell->getColumn() == 'N'){
								
									$classification->setRunLast($cell->getValue());
								}
							}
							$classification->setIsUser("0");					
							$arrayResult->add($classification);
						}
						$count = $count +1;
					}
				}
			}
		return $arrayResult;
	}

    public function generarExcel($arrayMap,$nombre)
    {
    	// Obtenemos el servicio de excel
    	$phpExcelObject = $this->controller->get('phpexcel')->createPHPExcelObject();
    	//seteamos el header excel
    	$phpExcelObject = $this->setHeaderExcel($phpExcelObject);
    	//Se cargan todos los datos.
    	$phpExcelObject = $this->setBodyExcel($arrayMap,$phpExcelObject,$nombre);
    	
    	
    	return $this->setFooterExcel($phpExcelObject, $nombre);
    	
    	 
    }
    
    public function setFooterExcel($phpExcelObject,$nombreExcel)
    {
		    
    		$phpExcelObject->setActiveSheetIndex(0);
		    // create the writer
    		$writer = $this->controller->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
		    // create the response
        	$response = $this->controller->get('phpexcel')->createStreamedResponse($writer);
        	// adding headers
        	$response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
		    $response->headers->set('Content-Disposition', 'attachment;filename='.$nombreExcel.'.xlsx');
		    
		    // If you are using a https connection, you have to set those two headers and use sendHeaders() for compatibility with IE <9
		    $response->headers->set('Pragma', 'public');
		    $response->headers->set('Cache-Control', 'maxage=1');
		    
		    return $response;
     }
      
    public function setHeaderExcel($phpExcelObject)
    {
    	$phpExcelObject->getProperties()->setCreator("Xtending SRL")
    	->setLastModifiedBy("Xtending SRL")
    	->setTitle("Office 2005 XLSX Test Document")
    	->setSubject("Office 2005 XLSX Test Document")
    	->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
    	->setKeywords("office 2005 openxml php")
    	->setCategory("Test result file");
    	 
    	return $phpExcelObject;
    
    
    }
    
    public function setBodyExcel($arrayMap,$phpExcelObject,$nombreHoja)
    {
    	
    	$columnas = 0;
    	$filas = 1;
    	$activaSheetIndex = 0;
    	
    	//Le agrego el nombre a la hoja de calculo
    	$phpExcelObject->getActiveSheet()->setTitle($nombreHoja);
    	// seteo la hoja de calculo activa
    	$phpExcelObject->setActiveSheetIndex(0);
    	
    	//Recorremos los valores para setealas en las filas.
    	foreach ($arrayMap as $titulo => $valores) {
    		//reinicia la hoja de calculo
    		$activaSheetIndex = 0;
    		//reinicia fila
    		$filas = 1;
    		
    		$filas++;
    		
    		//Asignamos los datos del titulo
     		foreach ($valores as $key => $val) {
    			
    			//Asigno array ya que no me funciona el de foreach
     			$val = $arrayMap[$titulo][$key];

    			$phpExcelObject->setActiveSheetIndex($activaSheetIndex)
    			->setCellValueByColumnAndRow($columnas, $filas,$val["value"]);
    		
    			if(array_key_exists ( "fontBolt", $val )){
    				$phpExcelObject->setActiveSheetIndex($activaSheetIndex)
    				->getStyleByColumnAndRow($columnas, $filas)->getFont()->setBold($val["fontBolt"]);
    			}
    			
    			if(array_key_exists ( "fill", $val )){
    				$phpExcelObject->setActiveSheetIndex($activaSheetIndex)
    			->getStyleByColumnAndRow($columnas, $filas)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
    			
    			$phpExcelObject->setActiveSheetIndex($activaSheetIndex)
    			->getStyleByColumnAndRow($columnas, $filas)->getFill()->getStartColor()->setARGB($val["fill"]);
    			}
    			
    			
     			
     			
        		$filas++;
        		//Si el valor de las filas supera al maximo permitido por el excel se comienza una nueva hoja de calculo con los datos.
        		if($filas >= 5000){
        			//se activa una nueva hoja de calculo
        			$activaSheetIndex++;    
        			//se imprime en la hoja de calculo nuevamente el titulo
        			$phpExcelObject->setActiveSheetIndex($activaSheetIndex)
        			->setCellValueByColumnAndRow($columnas, 1,$titulo);
        			//Asigno el nombre a la nueva hoja de calculo
        			$phpExcelObject->getActiveSheet()->setTitle($nombreHoja.$activaSheetIndex);

        			
        		}
    		}
    		
    		$columnas++;
    		
		}
		
		return $phpExcelObject;
    
    
    }
   

    
    

   
}
