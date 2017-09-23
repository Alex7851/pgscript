<?php	
	include_once $_SERVER['DOCUMENT_ROOT'] . "/directorys/fragments/pdo.php";

if (isset($_POST['delete']) and $_POST['delete']=='Удалить') {
	if (!isset($_POST['chbxarray'])) {$message= "Не выбраны строки для удаления!";
 $pathformessage="../workform/mainform.php";
  include $_SERVER['DOCUMENT_ROOT'] . "/directorys/fragments/msg.html";
  exit();}
$tableName=$_POST['transferTableName'];
	$sql="DELETE FROM $tableName WHERE id=:id";
	$s=$pdo->prepare($sql);

	foreach ($_POST['chbxarray'] as $itemId) {

		$s->bindValue(":id", $itemId);
		$s->execute();
	}
}

