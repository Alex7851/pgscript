<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<script>
	var counter=1;
function addInput(){

	var numberFields=<?php echo $numberFields ?>;
	var marker=document.getElementById('marker');
	var trElem=document.createElement("tr");
	marker.appendChild(trElem);

	for (var i = 1; i < numberFields; i++) {

		var tdElem=document.createElement("td");
		trElem.appendChild(tdElem);
		var inputField = document.createElement("input");
                inputField.type = "text";
                inputField.name = "stringOfValues[" + counter +"][]";
				tdElem.appendChild(inputField);
	}
     counter++;
}

function deleteString() {
	if (document.getElementById('marker').rows.length>2) { document.getElementById('marker').deleteRow(-1);
	counter--;}
}

</script>
	<div class="container">
	<form action="index.php" method="post">
		<?php	$arrOfHeaders=explode(', ', $listOfColumnsWithoutId);
			$jmax=1;
			if (isset($_POST['chbxarray'])) { $stringOfIds=implode(',', $_POST['chbxarray']); $jmax=count($_POST['chbxarray']); }?>
			<div style="display:inline-block">
		<table id="marker"  class="outtable">
			<tr> <?php	for ($i=1; $i<$numberFields; $i++):	?>
					<td style="background: #E6E6E9">
						<label for=""> <?php	echo $arrOfHeaders[$i-1]	?></label>
					</td> 
				<?php	endfor	?>
			</tr>

		<?php	for ($j=0; $j < $jmax; $j++) :	?>
			<tr>
				<?php	for ($i=1; $i<$numberFields; $i++):	?>
					<td style="background: white">
						<input type="text" style="border: 0" name="stringOfValues[<?php echo $j ?>][]" value="<?php	if (isset($_POST['editButton'])) echo  $masOfEditValues[$j][$i-1]; ?>">
					</td>
				<?php	endfor	?> 
			</tr>
		<?php	endfor	?>
		</table>

		<a class="<?php if ($buttonName=="Изменить") {echo "hideButton";} else {echo "likeButton";}?>" onclick="addInput()">+</a>
		<a class="<?php if ($buttonName=="Изменить") {echo "hideButton";} else {echo "likeButton";}?>" onclick="deleteString()">-</a>
</div>
<br>
		<input type="submit" style="text-align: center;" name="addFieldsButton" value="<?php echo $buttonName ?>">
		<input type="hidden" name="tableName" value="<?php	echo $tableName	?>">
		<input type="hidden" name="numberOfIds" value="<?php	echo $jmax	?>">
		<input type="hidden" name="stringOfIds" value="<?php	echo $stringOfIds ?>">
		<input type="hidden" name="numberFields" value="<?php	echo $numberFields	?>">
		<input type="hidden" name="listOfColumnsWithoutId"  value="<?php	echo $listOfColumnsWithoutId ?>">


	</form>
	
	</div>
</body>
</html>