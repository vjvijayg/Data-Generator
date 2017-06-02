<?php
/**
* DataGenerator
*
* @package     datagenerator.export
* @author      Rohith
* @since       Version 1.0
*/
//-----------------------------------------------------------------

require_once '../controller/Constants.php';
require_once '../Classes/PHPExcel.php';

/**
* Generate CSV file and download from data array
*
* @param Array()() $data                     Data array with all values
*
* @return string                             Json in string format
*/
function generateCSV($data){

   $objPHPExcel = new PHPExcel();
   
   // Set excel properties
   $objPHPExcel->getProperties()->setCreator("DataGenerator")
               ->setLastModifiedBy("Data Generator")
               ->setTitle("Data Generator");
   $objPHPExcel->getActiveSheet()->setTitle('Data');

   $objPHPExcel->setActiveSheetIndex(0);

   $rowLength = 0;
   foreach( $data as $type ) {
      $rowLength = $rowLength + sizeof($type);
   }

   // Adding data to excel cell
   $m = 0;
   foreach( $data as $type ) {
      foreach ($type as $i) {
         $column = Constants::$columns[0];
         $n = 1;
         foreach( $i as $value ) {
            $existingVal = $objPHPExcel->getActiveSheet()->getCell($column.$n)->getValue(); //Set Column heading
            if ($m < $rowLength-1) {   // Add ',' in between values
               $objPHPExcel->getActiveSheet()->setCellValue($column.$n, $existingVal.'"'.$value.'",');   
            }else{
               $objPHPExcel->getActiveSheet()->setCellValue($column.$n, $existingVal.'"'.$value.'"');
            }
            
            $n++;
         }
         $m++;
      }
   }

   // Write excel data into output object
   $objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
   $objWriter->setDelimiter(',');
   $objWriter->setLineEnding("\r\n");
   $objWriter->setSheetIndex(0);

   // Set headers
   header('Content-type: text/csv');
   header('Content-Disposition: attachment;filename='.'data-generator.csv');
   header('Cache-Control: max-age=0');

   // Gives download widow in browser
   $objWriter->save('php://output');
   exit();

}

?>