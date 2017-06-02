<?php
/**
* DataGenerator
*
* @package 		datagenerator.controller.datatypes
* @author 		Rohith
* @since 		Version 1.0
*/
//-----------------------------------------------------------------

	/**
	* Generates Integer values with increment 1
	*
	* @param integer $numberOfRows 						Number of values wants to generate
	* @param integer $columnName 						Name of the column in excel sheet
	*
	* @return Array() 									Array of numbers
	*/
	function function_generateCustomerQuotationData($numberOfRows, $columnName) {
		
		$resultArr = array();
		$resultArr[0][0] = $columnName;

		$col = 1;
		for ($i=0; $i < $numberOfRows; $i++) { 
			
		    $resultArr[0][$col] = getNumber(20000001, 10, $i);
			$col++;
		}

		return 	$resultArr;
	}
	
	/**
	* Generate options appear in UI when datatype selected
	*
	* @return string 									Data type options in HTML format
	*/
	function getCustomerQuotationOptions(){
		return "";
	}
	
?>