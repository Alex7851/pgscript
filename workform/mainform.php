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

	$sql="SELECT column_name, column_default, data_type 
	FROM INFORMATION_SCHEMA.COLUMNS 
	WHERE table_name = :tableName";

	$s=$pdo->prepare($sql);
	$s->bindValue(':tableName', $_POST['select']);
	$s->execute();
	$resultcolumn=$s->fetchAll();
	$listOfColumns="";

	foreach ($resultcolumn as $item) {
		
			$listOfColumns=$listOfColumns . $item['column_name'] .', ';
		
	}

	 $listOfColumns= substr($listOfColumns, 0, -2);
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
				$columnName=$item2['column_name'];
				if ($columnName<>'id') :
				?>
				<td><?php	echo $item[$columnName]	?></td>
			<?php	endif; endforeach	?> <td><input type="checkbox" name="chbxarray[]" value="<?php	echo $item['id']	?>"></td>
		</tr>
		<?php	endforeach	?>
	</table>
	<input type="hidden" name="transferTableName" value="<?php	echo $tableName	?>">
	<input type="submit" name="delete" value="Удалить">
	<a href="..">Вернуться</a>

</form>
<?php	PRINT_R($resultcolumn['column_name'])	?>
<form action="index.php" method="post">
	<input type="submit" name="addButton" value="Добавить">
	<input type="hidden" name="transferTableName" value="<?php	echo $tableName	?>">
</form>
</body>
</html>