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
	<a href="..">Вернуться</a><?php		include_once $_SERVER['DOCUMENT_ROOT'] . "/directorys/fragments/pdo.php";
	// Шаг пагинации
	$limit=5;
	// Получение наменования таблицы в случае щелчка по пагинатору
	if (!isset($_POST['select'])) $_POST['select']=$_GET['select'];
	// Получение списка полей таблицы
	$sql="SELECT column_name 
	FROM INFORMATION_SCHEMA.COLUMNS 
	WHERE table_name = :tableName";

	$s=$pdo->prepare($sql);
	$s->bindValue(':tableName', $_POST['select']);
	$s->execute();
	$resultcolumn=$s->fetchAll(PDO::FETCH_COLUMN, 0);

	$listOfColumns="";
	$listOfColumnsWithoutId="";

	// Получение количества записей в таблице для пагинатора

	$tableName=$_POST['select'];
	$s=$pdo->query("SELECT count(*) FROM $tableName");
	$u=$s->fetch();
	$maxOffset=$u[0];
	// В случае загрузки этой формы не по щелчку пагинатора
	if (!isset($offset)) $offset=0;
	
	// Обработка загрузки формы при щелчку по пагинатору
	if (isset($_GET['forward'])) {
		$offset=$_GET['offset'];
		if ($offset<($maxOffset-$limit)) $offset=$offset+ $limit;
	}

	if (isset($_GET['backward'])) {
		$offset=$_GET['offset'];
		$offset=$offset - $limit;
		if ($offset<0) $offset=0;
	}

	// Получение списка полей таблицы в т.ч. без id

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

	 // Запрос вывода полей для таблицы
	$sql="SELECT $listOfColumns FROM $tableName ORDER BY id LIMIT $limit OFFSET $offset";
	$s=$pdo->query($sql);
	$u=$s->fetchAll(); ?>

	<div class="container">
		<form action="index.php" method="post">
			<table class="outtable">
				<tr>
					<?php	foreach ($resultcolumn as $item2) :?>
						<th><?php echo $item2 ?></th>
					<?php	endforeach	?>
						<th></th>
				</tr>

				<?php	foreach ($u as $item) : ?>
				<tr>
					<?php	foreach ($resultcolumn as $item2) :
						$columnName=$item2; ?>
						<td><?php	echo $item[$columnName]	?></td>
					<?php	 endforeach	?>
					<td><input type="checkbox" name="chbxarray[]" value="<?php	echo $item['id']	?>"></td>
				</tr>
				<?php	endforeach	?>
			</table>
			<div>
				<a href="mainform.php?select=<?php echo $tableName ?>&backward&offset=<?php echo $offset ?>">Назад</a> 
				<a href="mainform.php?select=<?php echo $tableName ?>&forward&offset=<?php echo $offset ?>">Вперед</a>
			</div>

			<input type="hidden" name="transferTableName" value="<?php	echo $tableName	?>">
			<input type="hidden" name="numberFields" value="<?php	echo count($resultcolumn)	?>">
			<input type="hidden" name="listOfColumnsWithoutId" value="<?php	echo $listOfColumnsWithoutId	?>">
			<input type="submit" class="marginx"	name="editButton" value="Редактировать">
			<input type="submit" class="marginx"	name="delete" value="Удалить">
		</form>

		<form action="index.php" method="post">
			<input type="submit" name="addButton" value="Добавить">
			<input type="hidden" name="transferTableName" value="<?php	echo $tableName	?>">
			<input type="hidden" name="numberFields" value="<?php	echo count($resultcolumn)	?>">
			<input type="hidden" name="listOfColumnsWithoutId" value="<?php	echo $listOfColumnsWithoutId	?>">

		</form>
	</div>
</body>
</html>