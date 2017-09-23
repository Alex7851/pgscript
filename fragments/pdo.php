<?php	
try
{
	$pdo = new PDO("pgsql:dbname=bd1;host=127.0.0.1 port=5432", 'alex'); 
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("SET CLIENT_ENCODING TO 'UTF8'");
}
 catch (PDOException $e) 
{
  $message= "Невозможно подключиться к серверу баз данных: " . $e->getMessage();
  include "fragments/msg.html";
  exit();	
}
