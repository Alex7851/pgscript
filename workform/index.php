<?php	

	include_once $_SERVER['DOCUMENT_ROOT'] . "/directorys/fragments/pdo.php";
 
// БЛОК УДАЛЕНИЯ
// _________________________________________________________________________________________________	
if (isset($_POST['delete'])) {


	if (!isset($_POST['chbxarray'])) {
		$message="Не выбрано ни одного элемента для удаления";
		$pathformessage="mainform.php";
		include "../fragments/msg.html";
		exit();
	}

	$tableName=$_POST['transferTableName'];

	$sql="DELETE FROM $tableName WHERE id=:id";
	$s=$pdo->prepare($sql);
	foreach ($_POST['chbxarray'] as $itemId) {
		$s->bindValue(":id", $itemId);
		$s->execute();
	}
	$_POST['select']=$tableName;
	include 'mainform.php'; exit();
}

// БЛОК ДОБАВЛЕНИЯ
// _________________________________________________________________________________________________	

 // Из формы просмотра
if (isset($_POST['addButton'])) {

	if (isset($_POST['chbxarray'])) {
			$message="Для добавления новых строк снимите выделение с существующей строки.";
			$pathformessage="mainform.php";
			include "../fragments/msg.html";
			exit();
	}

	$tableName=$_POST['transferTableName'];
	$numberFields=$_POST['numberFields'];
	$listOfColumnsWithoutId=$_POST['listOfColumnsWithoutId'];
	$buttonName='Добавить';
	include "editform.php";
	exit();
}

// Из формы редактирования
if (isset($_POST['addFieldsButton']) and $_POST['addFieldsButton']=='Добавить') {
	$_POST['numberOfIds']= count($_POST['stringOfValues']);

	for ($j=0; $j < $_POST['numberOfIds']; $j++) {
		for ($i=0; $i<$_POST['numberFields']-1; $i++) {
			$st = preg_replace ("/[^a-zA-ZА-Яа-я0-9\s]/u","",$_POST['stringOfValues'][$j][$i]);
			$masOfValues[$j][$i]="'" . $st . "'"	;
		}
	}


	$tableName=$_POST['tableName'];
	$listOfColumnsWithoutId=$_POST['listOfColumnsWithoutId'];


	for ($j=0; $j < $_POST['numberOfIds']; $j++) { 
		
		$stringOfValues = implode(", ", $masOfValues[$j]);
		$sql="INSERT INTO $tableName ($listOfColumnsWithoutId) VALUES ($stringOfValues)";
		
		try {
			$pdo->exec($sql);
		} catch (Exception $e) {
			$message="В процессе добавления новых строк произошла ошибка. Убедитесь что вводимые данные соответствуют присвоенным их типам";
			$pathformessage="mainform.php";
			include "../fragments/msg.html";
			exit();
		}
		
	}

	$_POST['select']=$tableName;
	include 'mainform.php'; exit();
}

// БЛОК РЕДАКТИРОВАНИЯ
// _________________________________________________________________________________________________	

 // Из формы просмотра
if (isset($_POST['editButton'])) {

	if (!isset($_POST['chbxarray'])) {
			$message="Не выбрано ни одного элемента для редактирования.";
			$pathformessage="mainform.php";
			include "../fragments/msg.html";
			exit();
	}

	$tableName=$_POST['transferTableName'];
	$numberFields=$_POST['numberFields'];
	$listOfColumnsWithoutId=$_POST['listOfColumnsWithoutId'];

	$sql="SELECT $listOfColumnsWithoutId FROM $tableName WHERE id=:id";
	$s=$pdo->prepare($sql);
	foreach ($_POST['chbxarray'] as $item) {
		$s->bindValue(':id', $item);
		$s->execute();
		$masOfEditValues[]=$s->fetch();
	}
	
	$buttonName='Изменить';
	include "editform.php";
	exit();
}

// Из формы редактирования
if (isset($_POST['addFieldsButton']) and $_POST['addFieldsButton']=='Изменить') {

	for ($j=0; $j < $_POST['numberOfIds']; $j++) {
		for ($i=0; $i<$_POST['numberFields']-1; $i++) {
			$st = preg_replace ("/[^a-zA-ZА-Яа-я0-9\s]/u","",$_POST['stringOfValues'][$j][$i]);
			$masOfValues[$j][$i]="'" . $st . "'"	;
			
		}
	}
 
	$tableName=$_POST['tableName'];
	$listOfColumnsWithoutId=$_POST['listOfColumnsWithoutId'];
	$masOfIds= explode(',', $_POST['stringOfIds']);

	for ($j=0; $j < $_POST['numberOfIds']; $j++) { 
		$stringOfValues = implode(", ", $masOfValues[$j]);
		$idForEdit=$masOfIds[$j];

		$sql="UPDATE $tableName SET ($listOfColumnsWithoutId) = ($stringOfValues)
	  WHERE id=$idForEdit";

	 try {
	 		$pdo->exec($sql);
	 } catch (Exception $e) {
	 	$message="В процессе редактирования таблицы произошла ошибка. Убедитесь что все данные соответствуют присвоенным их типам";
			$pathformessage="mainform.php";
			include "../fragments/msg.html";
			exit();
	 }

	}

	$_POST['select']=$tableName;
	include 'mainform.php'; exit();
}