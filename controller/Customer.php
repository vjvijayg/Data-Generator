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
	* @param integer $year 								Year in which customer data needed
	*
	* @return Array[][][] 								Array of customer data
	*/
	function function_getCustomerData($numberOfRows, $year) {
		
		// Number of rows to be generated quarter wise.
		$q1 = intval(mt_rand(10,14)/100 * $numberOfRows);
		$q2 = intval(mt_rand(41,45)/100 * $numberOfRows);
		$q3 = intval(mt_rand(29,33)/100 * $numberOfRows);
		$q4 = $numberOfRows - $q1 - $q2 - $q3;

		// Array of dates with all quarters numbers in given year
		$dateArray = generateDateSet($numberOfRows, $q1, $q2, $q3, $q4, $year);

		// Fetch customer data from database
		$sql = "SELECT customerid, postalcode, city, name, countrycode FROM customer";
		$result = DBHandler::getInstance()->getConnection()->query($sql);
		
		$customer_raw_array = array();
		while($row = mysqli_fetch_array($result))
		{
		    $customer_raw_array[] = array($row[0],$row[1],$row[2],$row[3],$row[4]);
		}

		// Column names for customer data
		$customerArr = array();
		$customerArr[0][0] = "Customer";
		$customerArr[1][0] = "Postal Code";
		$customerArr[2][0] = "Customer City";
		$customerArr[3][0] = "Customer Name";
		$customerArr[4][0] = "Customer Country Code";

		$col = 1;
		for ($i=0; $i < $numberOfRows; $i++) { 
			$row = $customer_raw_array[mt_rand(0,sizeof($customer_raw_array)-1)];	# Pick random customer from data

		    $customerArr[0][$col] = $row[0];
			$customerArr[1][$col] = $row[1];
			$customerArr[2][$col] = $row[2];
			$customerArr[3][$col] = $row[3];
			$customerArr[4][$col] = $row[4];
			$col++;
		}


		// Column names for Product data
		$productArr = array();
		$productArr[0][0] = "Product";
		$productArr[1][0] = "Product Name";
		$productArr[2][0] = "Product Code";

		// Get product data based on quarter
		$productArr = generateCustomerProductData(1, $q1, $productArr);
		$productArr = generateCustomerProductData(2, $q2, $productArr);
		$productArr = generateCustomerProductData(3, $q3, $productArr);
		$productArr = generateCustomerProductData(4, $q4, $productArr);


		$resultArr = array();
		$resultArr[0] = $dateArray;
		$resultArr[1] = $customerArr[0];
		$resultArr[2] = $customerArr[1];
		$resultArr[3] = $customerArr[2];
		$resultArr[4] = $customerArr[3];
		$resultArr[5] = $customerArr[4];
		$resultArr[6] = $productArr[0];
		$resultArr[7] = $productArr[1];
		$resultArr[8] = $productArr[2];


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
	function generateCustomerProductData($quarter, $numberOfRows, $resultArr){

		$tb = 0;		// Touring bikes
		$orb = 0;		// Off road bikes
		$tg = 0;		// Trading goods

		// Number of rows of products according to quarter wise
		if ($quarter == 1) {
			$tb = intval(mt_rand(30,40)/100 * $numberOfRows);
			$orb = intval(mt_rand(20,30)/100 * $numberOfRows);
			$tg = $numberOfRows - $tb - $orb;
		} else if ($quarter == 2) {
			$tb = intval(mt_rand(30,35)/100 * $numberOfRows);
			$orb = intval(mt_rand(40,45)/100 * $numberOfRows);
			$tg = $numberOfRows - $tb - $orb;
		} else if ($quarter == 3) {
			$tb = intval(mt_rand(20,25)/100 * $numberOfRows);
			$orb = intval(mt_rand(40,45)/100 * $numberOfRows);
			$tg = $numberOfRows - $tb - $orb;
		} else if ($quarter == 4) {
			$tb = intval(mt_rand(35,40)/100 * $numberOfRows);
			$orb = intval(mt_rand(25,30)/100 * $numberOfRows);
			$tg = $numberOfRows - $tb - $orb;
		}

		// Fetch touring bikes data from data base
		$sql = "SELECT product, name, code FROM product WHERE type='TB'";
		$result = DBHandler::getInstance()->getConnection()->query($sql);
		$productTB = array();
		while($row = mysqli_fetch_array($result)){
		    $productTB[] = array($row[0],$row[1],$row[2]);
		}

		// Fetch Off road bikes data from data base
		$sql = "SELECT product, name, code FROM product WHERE type='ORB'";
		$result = DBHandler::getInstance()->getConnection()->query($sql);
		$productORB = array();
		while($row = mysqli_fetch_array($result)){
		    $productORB[] = array($row[0],$row[1],$row[2]);
		}

		// Fetch Trading goods bikes data from data base
		$sql = "SELECT product, name, code FROM product WHERE type='TG'";
		$result = DBHandler::getInstance()->getConnection()->query($sql);
		$productTG = array();
		while($row = mysqli_fetch_array($result)){
		    $productTG[] = array($row[0],$row[1],$row[2]);
		}


		// Add product data according to number of rows for each product type
		for ($i=0; $i < $tb; $i++) { 
			$row = $productTB[mt_rand(0,sizeof($productTB)-1)];	

		    $resultArr[0][] = $row[0];
			$resultArr[1][] = $row[1];
			$resultArr[2][] = $row[2];
		}
		for ($i=0; $i < $orb; $i++) { 
			$row = $productORB[mt_rand(0,sizeof($productORB)-1)];	

		    $resultArr[0][] = $row[0];
			$resultArr[1][] = $row[1];
			$resultArr[2][] = $row[2];
		}
		for ($i=0; $i < $tg; $i++) { 
			$row = $productTG[mt_rand(0,sizeof($productTG)-1)];	

		    $resultArr[0][] = $row[0];
			$resultArr[1][] = $row[1];
			$resultArr[2][] = $row[2];
		}


		return $resultArr;
	}


	
?>