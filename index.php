<?php 
/**
* DataGenerator
*
* @package 		datagenerator
* @author 		Rohith
* @since 		Version 1.0
*/
//-----------------------------------------------------------------

require_once 'controller/Constants.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="jquery/jquery1.9.1.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<form name="indexForm" id="indexForm" method="POST">
		<h2 class="pageHeader">DATA GENERATOR</h2>
		<div class="contentContainer">
			<div style="margin-bottom: 30px;">
				<input type="button" id="addNewColumn" value="Add New" style="float: right;"></input>
				Number of rows : <input type="text" id="numberOfRows" value="10"></input>	
			</div>
			<div style="padding: 10px 20px; color: rgb(255, 255, 255); background: rgb(34, 34, 34) none repeat scroll 0px 0px;">
				Data :
				<input type="radio" name="dataRelate" class="dataRelate" id="customer" value="1" checked="checked"><label for="customer">Customer</label>
				<input type="radio" name="dataRelate" class="dataRelate" id="vendor" value="2"><label for="vendor">Vendor</label>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Year : <select id="yearSelect"></select>
			</div>
			<table id="rowsContainer">
				<thead>
					<th style="width: 50px;">Order</th>
					<th style="width: 350px;">Column title</th>
					<th style="width: 250px;">Data type</th>
					<th style="width: 50px;"><input type="button" value="Del" id="deleteRows" style="width: 50px; padding-left: 0px; padding-right: 0px;"></input></th>
				</thead>
				<tbody></tbody>
			</table>
			
			<br>
			<hr>
			Export Format : 
			<input type="radio" name="outputFormat" id="excel" value="excel" checked="checked"><label for="excel">Excel </label>
			<input type="radio" name="outputFormat" id="csv" value="csv"><label for="csv">CSV </label>
			<input type="radio" name="outputFormat" id="json" value="json"><label for="json">JSON </label>
			<br>
			<input type="hidden" id="parameters" name="parameters"></input>
			<input type="submit" value="GENERATE" name="generate" onclick="return generateData();" style="margin-top: 10px;" />
			<input type="hidden" value="Options" onclick="getOptions()" />
			
		</div>
	</form>
	<?php
		$dataTypesArray = Constants::$datatypes;
	?>

	<script type="text/javascript">
		
		var columnCount = 1;		// Table order number
		var dataTypesArray= <?php echo json_encode($dataTypesArray); ?>; // All data types read from php code

		// Data types as options
		var options = "";
		for (var i = 0; i < dataTypesArray.length; i++) {
			options += "<option>" + dataTypesArray[i] + "</option>";
		}

		$(document).ready(function(){
			/* Add years as options */
			var year = 2000;
			var curYear = parseInt(new Date().getFullYear());
			var yearOptions = "";
			for (var i = year; i <= curYear; i++) {
				if (i<curYear) {
					yearOptions += "<option>"+i+"</option>";	
				}else{
					yearOptions += "<option selected='selected'>"+i+"</option>";
				}
				
			}
			$("#yearSelect").append(yearOptions);

			/*Add first row in table*/
			function addFirstRow(){
				var column = "<tr>"
							+ "<td>" + columnCount + "</td>"
							+ "<td><input type='text' class='columnName'></td>"
							+ "<td><select class='dataType'>"+ options +"</select></td>"
							+ "<td><input type='checkbox' class='rowCheckbox'></td>"
						+ "</tr>";
				$("#rowsContainer tbody").append(column);
				columnCount++;
			}

			/*Add new row in table when Add New button clicked*/
			function addRow(){
				var column = "<tr>"
							+ "<td>" + columnCount + "</td>"
							+ "<td><input type='text' class='columnName'></td>"
							+ "<td><select class='dataType'>"+ options +"</select></td>"
							+ "<td><input type='checkbox' class='rowCheckbox'></td>"
						+ "</tr>";
				$("#rowsContainer tbody").append(column);
				columnCount++;
			}

			/*Add click listener to the Add New button*/
			$("#addNewColumn").click(function(){
				addRow();
			});

			/*Add first row in table when page loads*/
			addFirstRow();

			/*Delete selected rows from table when delete button click*/
			$("#deleteRows").click(function(){
				$(".rowCheckbox:checked").each(function(){
					$(this).closest("tr").remove();
					columnCount--;
				});

				var i=0;
				$("#rowsContainer tbody td:first-child").each(function(){
					$(this).text(++i);
				});
			});

			/*Remove Red color of input when focus in*/
			$(document).on('focus',".columnName",function(){
				$(this).css("background-color","#FFF");
			});

		});

		/*Get all column names of data types*/
		function getColumnNames(){
			var columnNames = new Array();
			$(".columnName").each(function(){
				columnNames.push($(this).val());
			});
			return columnNames;
		}

		/*Get data types selected*/
		function getDataTypes(){
			var dataTepes = new Array();
			$(".dataType").each(function(){
				dataTepes.push($(this).find("option:selected").text());
			});
			return dataTepes;
		}
		
		/*Generate data*/
		function generateData(){
			var status = true;

			/*Validate all input values*/
			$(".columnName").each(function(){
				var cName = $(this).val();
				if (cName.length == 0) {
					$(this).css("background-color","#f00");
					status = false;
				}else{
					$(this).css("background-color","#fff");
				}
			});
			if (!status) {
				return status;
			}

			/*Make parameters*/
			var columnNames = getColumnNames();
			var addDataTypes = getDataTypes();
			var numberOfRows = $("#numberOfRows").val();
			var exportType = $("input[name=outputFormat]:checked").val();
			var dataRelate = $("input[name=dataRelate]:checked").val();
			var year = $("#yearSelect option:selected").text();
			var data = {
				    	"columnNames" : columnNames,
				    	"addDataTypes" : addDataTypes,
				    	"numberOfRows" : numberOfRows,
				    	"exportType" : exportType,
				    	"dataRelate" : dataRelate,
				    	"year": year
				    };

			$("#parameters").val(JSON.stringify(data));

			document.forms["indexForm"].action = "controller/GenerateData.php";
			return true;
		}
	</script>
</body>
</html>