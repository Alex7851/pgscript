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
	<div class="container">
	<form action="index.php" method="post">
		<?php	$arrOfHeaders=explode(', ', $listOfColumnsWithoutId);
			$stringOfIds=implode(',', $_POST['chbxarray']) ?>
		<table class="outtable">
			<tr> <?php	for ($i=1; $i<$numberFields; $i++):	?>
					<td style="background: #E6E6E9">
						<label for=""> <?php	echo $arrOfHeaders[$i-1]	?></label>
					</td> 
				<?php	endfor	?>
			</tr>
		<?php	for ($j=0; $j < count($_POST['chbxarray']); $j++) :	?>
			<tr style="padding: 0; margin: 0">
				<?php	for ($i=1; $i<$numberFields; $i++):	?>
					<td style="padding: 0; margin: 0; background: white">
						<input type="text" style="border: 0" name="stringOfValues[<?php echo $j ?>][]" value="<?php	if (isset($_POST['editButton']) and $_POST['editButton']=='Редактировать') echo  $masOfEditValues[$j][$i-1]; ?>">
					</td>
				<?php	endfor	?> 
			</tr>
		<?php	endfor	?>
		</table>
		<input type="submit" name="addFieldsButton" value="<?php echo $buttonName ?>">
		<input type="hidden" name="tableName" value="<?php	echo $tableName	?>">
		<input type="hidden" name="numberOfIds" value="<?php	echo count($_POST['chbxarray'])	?>">
		<input type="hidden" name="stringOfIds" value="<?php	echo $stringOfIds ?>">
		<input type="hidden" name="numberFields" value="<?php	echo $numberFields	?>">
		<input type="hidden" name="listOfColumnsWithoutId"  value="<?php	echo $listOfColumnsWithoutId ?>">


	</form>
	</div>
</body>
</html>