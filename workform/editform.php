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
<input type="text" name="stringOfValues[]">
<?php	endfor	?>
<input type="submit" name="addFieldsButton" value="Добавить">
<input type="hidden" name="tableName" value="<?php	echo $tableName	?>">
<input type="hidden" name="listOfColumnsWithoutId" value="<?php	echo $listOfColumnsWithoutId	?>">


</form>
</body>
</html>