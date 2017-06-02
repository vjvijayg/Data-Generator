<?php
/**
* DataGenerator
*
* @package 		datagenerator.controller
* @author 		Rohith
* @since 		Version 1.0
*/
//-----------------------------------------------------------------

	require_once(realpath($_SERVER["DOCUMENT_ROOT"])  . '/datagenerator/database/DBHandler.php');
	require_once 'Constants.php';
	require_once('datatypes/Utility.php');
	require_once 'AutoIncrement.php';

	
	// Get parameters passed in post request from UI
	$parameters = json_decode($_POST['parameters']);

	$columnNames = $parameters->columnNames;
	$addDataTypes = $parameters->addDataTypes;
	$numberOfRows = $parameters->numberOfRows;
	$exportType = $parameters->exportType;
	$dataRelate = $parameters->dataRelate;
	$year = $parameters->year;

	// Output data array
	$result = array();

	if ($dataRelate == 1) {
		require_once 'Customer.php';
		$result[] = function_getCustomerData($numberOfRows, $year);	
	}else{
		require_once 'Vendor.php';
		$result[] = function_getVendorData($numberOfRows, $year);	
	}

	// If user selects any data types
	if (sizeof($addDataTypes) > 0) {
		for ($i=0; $i < sizeof($addDataTypes); $i++) { 
			$optinsArrObj = $options[$i];

			switch ($addDataTypes[$i]) {

				case Constants::$datatypes[0]:
					$result[] = function_getIncrementValues($numberOfRows,1,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[1]:
					$result[] = function_getIncrementValues($numberOfRows,10000001,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[2]:
					$result[] = function_getIncrementValues($numberOfRows,20000001,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[3]:
					$result[] = function_getIncrementValues($numberOfRows,1,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[4]:
					$result[] = function_getIncrementValues($numberOfRows,80000001,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[5]:
					$result[] = function_getIncrementValues($numberOfRows,90000001,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[6]:
					$result[] = function_getIncrementValues($numberOfRows,1400000001,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[7]:
					$result[] = function_getIncrementValues($numberOfRows,10000000,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[8]:
					$result[] = function_getIncrementValues($numberOfRows,6000000000,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[9]:
					$result[] = function_getIncrementValues($numberOfRows,4500000001,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[10]:
					$result[] = function_getIncrementValues($numberOfRows,5000000001,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[11]:
					$result[] = function_getIncrementValues($numberOfRows,5105600101,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[12]:
					$result[] = function_getIncrementValues($numberOfRows,1500000001,10, $columnNames[$i]);
					break;
				case Constants::$datatypes[13]:
					$result[] = function_getIncrementValues($numberOfRows,5000000011,10, $columnNames[$i]);
					break;
				default:
					# code...
					break;
			}
		}
	}

	if ($exportType == "excel") {
		require_once '../export/excel.php';			// Import file only if required
		generateExcel($result);
	}elseif ($exportType == "csv") {
		require_once '../export/csv.php';
		generateCSV($result);
	}elseif ($exportType == "json") {
		require_once '../export/json.php';
		generateJson($result);
	}
	
?>