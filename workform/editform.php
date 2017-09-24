<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>

<form action="index.php" method="post">
	
<?php	for ($i=1; $i<$numberFields; $i++):	?>
<input type="text" name="stringOfValues[]" value="<?php	if (isset($_POST['editButton']) and $_POST['editButton']=='Редактировать') {
	echo $masOfEditValues[0][$i-1];
}	?>">
<?php	endfor	?>
<input type="submit" name="addFieldsButton" value="<?php echo $buttonName ?>">
<input type="hidden" name="tableName" value="<?php	echo $tableName	?>">
<input type="hidden" name="idForEdit" value="<?php	if (isset($id))  echo $id	?>">
<input type="hidden" name="listOfColumnsWithoutId"  value="<?php	echo $listOfColumnsWithoutId ?>">


</form>
</body>
</html>