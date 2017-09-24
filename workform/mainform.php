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
	<?php		include_once $_SERVER['DOCUMENT_ROOT'] . "/directorys/fragments/pdo.php";

	$sql="SELECT column_name 
	FROM INFORMATION_SCHEMA.COLUMNS 
	WHERE table_name = :tableName";

	$s=$pdo->prepare($sql);
	$s->bindValue(':tableName', $_POST['select']);
	$s->execute();
	$resultcolumn=$s->fetchAll(PDO::FETCH_COLUMN, 0);
	$listOfColumns="";
	$listOfColumnsWithoutId="";

	foreach ($resultcolumn as $item) {
			$listOfColumns=$listOfColumns . $item .', ';
	}
	foreach ($resultcolumn as $item) {
		if ($item<>'id')
			$listOfColumnsWithoutId=$listOfColumnsWithoutId . $item .', ';
	}
	 $listOfColumns= substr($listOfColumns, 0, -2);
	 $listOfColumnsWithoutId= substr($listOfColumnsWithoutId, 0, -2);
	    $tableName=$_POST['select'];
		$sql="SELECT $listOfColumns FROM $tableName";
		$s=$pdo->query($sql);
		$u=$s->fetchAll(); ?>
<form action="index.php" method="post">
	<table class="outtable">
		<?php	foreach ($u as $item) : 
		?>
		
		
		<tr>
			<?php	foreach ($resultcolumn as $item2) :
				$columnName=$item2;
				?>
				<td><?php	echo $item[$columnName]	?></td>
			<?php	 endforeach	?> <td><input type="checkbox" name="chbxarray[]" value="<?php	echo $item['id']	?>"></td>
		</tr>
		<?php	endforeach	?>
	</table>
	<input type="hidden" name="transferTableName" value="<?php	echo $tableName	?>">
	<input type="submit" name="delete" value="Удалить">
	<a href="..">Вернуться</a>

</form>

<form action="index.php" method="post">
	<input type="submit" name="addButton" value="Добавить">
	<input type="hidden" name="transferTableName" value="<?php	echo $tableName	?>">
	<input type="hidden" name="numberFields" value="<?php	echo count($resultcolumn)	?>">
	<input type="hidden" name="listOfColumnsWithoutId" value="<?php	echo $listOfColumnsWithoutId	?>">

</form>
</body>
</html>