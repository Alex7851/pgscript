<?php	

	include_once $_SERVER['DOCUMENT_ROOT'] . "/directorys/fragments/pdo.php";
 
// БЛОК УДАЛЕНИЯ
// _________________________________________________________________________________________________	
if (isset($_POST['delete'])) {
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
	
	$tableName=$_POST['transferTableName'];
	$numberFields=$_POST['numberFields'];
	$listOfColumnsWithoutId=$_POST['listOfColumnsWithoutId'];
	$buttonName='Добавить';
	include "editform.php";
	exit();
}

// Из формы редактирования
if (isset($_POST['addFieldsButton']) and $_POST['addFieldsButton']=='Добавить') {
print_r($_POST['stringOfValues']);
$_POST['numberOfIds']= count($_POST['stringOfValues']);

	for ($j=0; $j < $_POST['numberOfIds']; $j++) {
		for ($i=0; $i<$_POST['numberFields']-1; $i++) {
			$masOfValues[$j][$i]="'" . $_POST['stringOfValues'][$j][$i] . "'"	;
		}
	}


$tableName=$_POST['tableName'];
	$listOfColumnsWithoutId=$_POST['listOfColumnsWithoutId'];


for ($j=0; $j < $_POST['numberOfIds']; $j++) { 
		$stringOfValues = implode(", ", $masOfValues[$j]);
		
		
	 $sql="INSERT INTO $tableName ($listOfColumnsWithoutId) VALUES
	($stringOfValues)";
	$pdo->exec($sql);
	
	}




	

	
	$_POST['select']=$tableName;
	include 'mainform.php'; exit();
}

// БЛОК РЕДАКТИРОВАНИЯ
// _________________________________________________________________________________________________	

 // Из формы просмотра
if (isset($_POST['editButton'])) {
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
			$masOfValues[$j][$i]="'" . $_POST['stringOfValues'][$j][$i] . "'"	;
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
	 
	$pdo->exec($sql);
	}

	
	
	

	
	$_POST['select']=$tableName;
	include 'mainform.php'; exit();
}