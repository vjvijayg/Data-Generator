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
	* @param integer $startswith 						Number of values wants to generate
	* @param integer $length 							Number of digits
	* @param integer $i 								index
	*
	* @return string 	 								Number with zeros at the begining
	*/
	function getNumber($startswith, $length, $i){
		$length = 10;

		$var  = $startswith + $i;						// Number to be retured
		$numberOfZeros = $length - strlen($var."");		// Calculate number of zeros to be appended at begining
		$zeroStr = "";
		for ($i=0; $i < $numberOfZeros; $i++) { 
			$zeroStr .= "0";							// Add zeros at start
		}

		$var = $zeroStr . $var;
		return $var;
	}

	/**
	* Generates Integer values with increment 1
	*
	* @param integer $numberOfRows 						Number of values wants to generate
	* @param integer $q1 								Number of rows from Quarter1
	* @param integer $q2 								Number of rows from Quarter2
	* @param integer $q3 								Number of rows from Quarter3
	* @param integer $q4 								Number of rows from Quarter4
	* @param integer $year 								Year
	*
	* @return array() 	 								Array containing dates
	*/
	function generateDateSet($numberOfRows, $q1, $q2, $q3, $q4, $year){

		$dateArray = array();
		$dateArray[] = "Date";							// Column Name
		for($i=0; $i<$q1; $i++){
			$dateArray[] = generateDate(1, $year);
		}
		for($i=0; $i<$q2; $i++){
			$dateArray[] = generateDate(2, $year);
		}
		for($i=0; $i<$q3; $i++){
			$dateArray[] = generateDate(3, $year);
		}
		for($i=0; $i<$q4; $i++){
			$dateArray[] = generateDate(4, $year);
		}

		return $dateArray;
	}

	/**
	* Generates Integer values with increment 1
	*
	* @param integer $quarter 							Quarter
	* @param integer $year 								Year
	*
	* @return date 	 									Date in current quarter
	*/
	function generateDate($quarter, $year){
		$month = 0;
		if ($quarter == 1) $month = mt_rand(1,3);
		else if ($quarter == 2) $month = mt_rand(4,6);
		else if ($quarter == 3) $month = mt_rand(7,9);
		else if ($quarter == 4) $month = mt_rand(10,12);

		$date = randomDate($month, $year);

		return $date;
	}

	/**
	* Generates Integer values with increment 1
	*
	* @param integer $month 							Month
	* @param integer $year 								Year
	*
	* @return date 	 									Date in current month
	*/
	function randomDate($month, $year){
		$date = mt_rand(1,30);
		if ($month == 2) {								// February will have max of 28 days
			$date = mt_rand(1,28);
		}else if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
			$date = mt_rand(1,31);
		}
		

		$result = "";
		if ($month<10) $result = $result."0".$month;	// Add zero at start of month if month < 10
		else $result = $result."".$month;

		$result = $result."-";
				
		if ($date < 10) $result = $result."0".$date;	// Add zero at start of day if day < 10
		else $result = $result."".$date;

		$result = $result."-";

		$result = $result."".$year;


		return $result;
	}
	


?>