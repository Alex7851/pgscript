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
		<?php	$arrOfHeaders=explode(', ', $listOfColumnsWithoutId)	?>
		<table class="outtable">
			<?php	for ($i=1; $i<$numberFields; $i++):	?>
				<tr>
					<td>
						<label for=""> <?php	echo $arrOfHeaders[$i-1]	?></label>
					</td>
					<td>
						<input type="text" name="stringOfValues[]" value="<?php	if (isset($_POST['editButton']) and $_POST['editButton']=='Редактировать') echo $masOfEditValues[0][$i-1]; ?>">
					</td>
				</tr>
			<?php	endfor	?>
		</table>
		<input type="submit" name="addFieldsButton" value="<?php echo $buttonName ?>">
		<input type="hidden" name="tableName" value="<?php	echo $tableName	?>">
		<input type="hidden" name="idForEdit" value="<?php	if (isset($id))  echo $id	?>">
		<input type="hidden" name="listOfColumnsWithoutId"  value="<?php	echo $listOfColumnsWithoutId ?>">


	</form>
	</div>
</body>
</html>