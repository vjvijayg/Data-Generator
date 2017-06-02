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
	* @param integer $year 								Year in which vendor data needed
	*
	* @return Array[][][] 								Array of customer data
	*/
	function function_getVendorData($numberOfRows, $year) {

		// Number of rows to be generated quarter wise.
		$q1 = intval(mt_rand(10,14)/100 * $numberOfRows);
		$q2 = intval(mt_rand(41,45)/100 * $numberOfRows);
		$q3 = intval(mt_rand(29,33)/100 * $numberOfRows);
		$q4 = $numberOfRows - $q1 - $q2 - $q3;

		// Array of dates with all quarters numbers in given year
		$dateArray = generateDateSet($numberOfRows, $q1, $q2, $q3, $q4, $year);

		// Fetch vendor data from database
		$sql = "select vendor, name, city, countrycode from vendor";
		$result = DBHandler::getInstance()->getConnection()->query($sql);
		
		$arr = array();
		while($row = mysqli_fetch_array($result))
		{
		    $arr[] = array($row[0],$row[1],$row[2],$row[3]);
		}

		// Column names for vendor data
		$vendorArr = array();
		$vendorArr[0][0] = "Vendor";
		$vendorArr[1][0] = "Vendor Name";
		$vendorArr[2][0] = "Vendor City";
		$vendorArr[3][0] = "Vendor Country Code";

		$col = 1;
		for ($i=0; $i < $numberOfRows; $i++) { 
			$row = $arr[mt_rand(0,sizeof($arr)-1)];	

		    $vendorArr[0][$col] = $row[0];
			$vendorArr[1][$col] = $row[1];
			$vendorArr[2][$col] = $row[2];
			$vendorArr[3][$col] = $row[3];
			$col++;
		}

		// Column names for Product data
		$productArr = array();
		$productArr[0][0] = "Product";
		$productArr[1][0] = "Product Name";
		$productArr[2][0] = "Product Code";

		
		// Get product data based on quarter
		$productArr = generateVendorProductData(1, $q1, $productArr);
		$productArr = generateVendorProductData(2, $q2, $productArr);
		$productArr = generateVendorProductData(3, $q3, $productArr);
		$productArr = generateVendorProductData(4, $q4, $productArr);




		$resultArr = array();
		$resultArr[0] = $dateArray;
		$resultArr[1] = $vendorArr[0];
		$resultArr[2] = $vendorArr[1];
		$resultArr[3] = $vendorArr[2];
		$resultArr[4] = $vendorArr[3];
		$resultArr[5] = $productArr[0];
		$resultArr[6] = $productArr[1];
		$resultArr[7] = $productArr[2];


		return 	$resultArr;
	}

	/**
	* Generates Integer values with increment 1
	*
	* @param integer $quarter 						Quarter
	* @param integer $numberOfRows 					Number of values wants to generate
	* @param integer $resultArr 					Reference of array, where all quarters data stored
	*
	* @return resultArr[][][] 						Array of product data for that quarter
	*/
	function generateVendorProductData($quarter, $numberOfRows, $resultArr){

		$rw = 0;		// Raw material
		$sfg = 0;		// Semi-finished goods

		// Number of rows of products according to quarter wise
		if ($quarter == 1) {
			$rw = intval(mt_rand(30,40)/100 * $numberOfRows);
			$sfg = $numberOfRows - $rw;
		} else if ($quarter == 2) {
			$rw = intval(mt_rand(30,40)/100 * $numberOfRows);
			$sfg = $numberOfRows - $rw;
		} else if ($quarter == 3) {
			$rw = intval(mt_rand(30,40)/100 * $numberOfRows);
			$sfg = $numberOfRows - $rw;
		} else if ($quarter == 4) {
			$rw = intval(mt_rand(30,40)/100 * $numberOfRows);
			$sfg = $numberOfRows - $rw;
		}


		// Fetch Raw material data from data base
		$sql = "select product, name, code from product where type='RW'";
		$result = DBHandler::getInstance()->getConnection()->query($sql);
		$productRW = array();
		while($row = mysqli_fetch_array($result)){
		    $productRW[] = array($row[0],$row[1],$row[2]);
		}

		// Fetch Semi-finished goods data from data base
		$sql = "select product, name, code from product where type='SFG'";
		$result = DBHandler::getInstance()->getConnection()->query($sql);
		$productSFG = array();
		while($row = mysqli_fetch_array($result)){
		    $productSFG[] = array($row[0],$row[1],$row[2]);
		}

		// Add product data according to number of rows for each product type
		for ($i=0; $i < $rw; $i++) { 
			$row = $productRW[mt_rand(0,sizeof($productRW)-1)];	

		    $resultArr[0][] = $row[0];
			$resultArr[1][] = $row[1];
			$resultArr[2][] = $row[2];
		}
		for ($i=0; $i < $sfg; $i++) { 
			$row = $productSFG[mt_rand(0,sizeof($productSFG)-1)];	

		    $resultArr[0][] = $row[0];
			$resultArr[1][] = $row[1];
			$resultArr[2][] = $row[2];
		}
		

		return $resultArr;
	}


	
?>