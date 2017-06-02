<?php
/**
* DataGenerator
*
* @package 		datagenerator.controller
* @author 		Rohith
* @since 		Version 1.0
*/
//-----------------------------------------------------------------

	
	/**
	* Generates Integer values with increment 1
	*
	* @param integer $numberOfRows 						Number of values wants to generate
	* @param integer $startswith 						Starting number
	* @param integer $length 							Number of digits in number
	* @param integer $columnName 						Name of the column in excel sheet
	*
	* @return Array 									Array of numbers
	*/
	function function_getIncrementValues($numberOfRows, $startswith, $length, $columnName) {
		
		$resultArr = array();
		$resultArr[0][0] = $columnName;

		$col = 1;
		for ($i=0; $i < $numberOfRows; $i++) { 
			
		    $resultArr[0][$col] = getNumber($startswith, $length, $i);
			$col++;
		}

		return 	$resultArr;
	}
	
	/**
	* Generate options appear in UI when datatype selected
	*
	* @return string 									Data type options in HTML format
	*/
	function getIncrementOptionsHtml(){

		$str = "<label style='font-size:10px;'>Start with </label><input type='text' name='startswith' value='1000'><br><label style='font-size:10px;'>Length </label><input type='text' name='length' value='10'>";
		return $str;
	}


?>