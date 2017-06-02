<?php
/**
* DataGenerator
*
* @package 		datagenerator.export
* @author 		Rohith
* @since 		Version 1.0
*/
//-----------------------------------------------------------------

require_once '../controller/Constants.php';
require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/IOFactory.php';

/**
* Generate excel file and download from data array
*
* @param Array()() $data 							Data array with all values
*
* @return string 	 								Json in string format
*/
function generateExcel($data){
	
	$objPHPExcel = new PHPExcel();
	
	// Set excel properties
	$objPHPExcel->getProperties()->setCreator("DataGenerator")
					->setLastModifiedBy("Data Generator")
					->setTitle("Data Generator");
	$objPHPExcel->getActiveSheet()->setTitle('Data');

	$objPHPExcel->setActiveSheetIndex(0);
	
	// Adding data to excel cell
	$m = 0;
	foreach( $data as $type ) {
		foreach ($type as $i) {
			$column = Constants::$columns[$m];
			$n = 1;
			foreach( $i as $value ) {
				$objPHPExcel->getActiveSheet()->setCellValue($column.$n, $value);
				$n++;
			}
			$m++;
		}
		
	}
	
	// Clean output buffer if there is anything added before.
	// Removes the space added at the begining while generating excel.
	ob_end_clean();

	// Set output headers
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename='.'data-generator.xlsx');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	// Gives download widow in browser
	$objWriter->save('php://output');
	
}
?>