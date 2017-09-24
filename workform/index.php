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
	$numberFields=$_POST['numberFields'];
	$listOfColumnsWithoutId=$_POST['listOfColumnsWithoutId'];

include "editform.php";
exit();
	
}

if (isset($_POST['addFieldsButton']) and $_POST['addFieldsButton']=='Добавить') {

$stringOfValues = implode(",", $_POST['stringOfValues']);
$tableName=$_POST['tableName'];
$listOfColumnsWithoutId=$_POST['listOfColumnsWithoutId'];

$sql="INSERT INTO $tableName ($listOfColumnsWithoutId) VALUES
($stringOfValues)";
echo $sql;
$pdo->exec($sql);

}