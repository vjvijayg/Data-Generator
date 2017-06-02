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

/**
* Generate json string from data array
*
* @param Array()() $data 							Data array with all values
*
* @return string 	 								Json in string format
*/
function generateJson($data){

	// Invert the array to easyly fetch key and values to reiterate
	$dataArr = array();
	foreach( $data as $type ) {
		foreach ($type as $i) {
			$dataArr[] = $i;
		}
		
	}

	// Extract all keys from dataArr
	$keyArr = array();
	$i = 0;
	foreach ($dataArr as $arr) {
		$i = 0;
		foreach ($arr as $value) {
			if ($i == 0) {
				$keyArr[] = $value;
			}
			$i++;	
		}
	}

	// Extract all values from dataArr
	$valuesArr = array();
	for($j=0; $j<sizeof($dataArr[0]); $j++){
		for($i=0; $i<sizeof($dataArr); $i++){
			
			if ($j!=0) {
				$valuesArr[$j-1][$i] = $dataArr[$i][$j];
			}
			
		}	
	}

	// Map each values to corresponding key to form json key,value pair
	$resultArr = array();
	$i = 0;
	foreach ($valuesArr as $arr) {
		$i = 0;
		$tempArr = array();
		foreach ($arr as $value) {
			$tempArr[$keyArr[$i]] = $value;
			$i++;	
		}
		$resultArr[] = $tempArr;
	}

	// Convert array in string and return. Convert string into json in UI
	$str = json_encode($resultArr);
	$str = str_replace('\\', '', $str);

	// Set output header
	header('Content-Disposition: attachment; filename='.'data-generator.json');
	header('Content-Type: text/json'); 
	header('Content-Length: ' . strlen($str));
	header('Connection: close');


	echo $str;
	
}
?>
