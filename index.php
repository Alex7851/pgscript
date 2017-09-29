<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
	<div class="container">
		<?php	
		include $_SERVER['DOCUMENT_ROOT'] . "/directorys/fragments/pdo.php";
		// Запрос имен таблиц в базе
		$sql="SELECT table_name FROM information_schema.tables 
			  WHERE table_schema='public'";
		$s=$pdo->query($sql);
		$u=$s->fetchAll(PDO::FETCH_COLUMN, 0);?>

		<form action="workform/mainform.php" method="post">
			<select name="select" size="1">
			<?php	foreach ($u as $item):	?>
		   	 <option  value="<?php	echo $item ?>"><?php	echo $item	?></option>
			<?php	endforeach	?>
		    </select>
			<input type="submit" value="Перейти">
		</form>
	</div>
</body>
</html>