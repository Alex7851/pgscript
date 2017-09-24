<?php	
	include_once $_SERVER['DOCUMENT_ROOT'] . "/directorys/fragments/pdo.php";

if (isset($_POST['delete']) and $_POST['delete']=='Удалить') {
	$tableName=$_POST['transferTableName'];
	

	$sql="DELETE FROM $tableName WHERE id=:id";
	$s=$pdo->prepare($sql);

	foreach ($_POST['chbxarray'] as $itemId) {

		$s->bindValue(":id", $itemId);
		$s->execute();
	}
}

if (isset($_POST['addButton']) and $_POST['addButton']=='Добавить') {
	$tableName=$_POST['transferTableName'];
	

	
}