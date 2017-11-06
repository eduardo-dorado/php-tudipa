<?php

$dsn = 'mysql:host=localhost;dbname=tudipa;charset=utf8mb4';
$db_user = $_COOKIE['userDb'];
$db_pass = $_COOKIE['passDb'];
$opciones = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

try {
	 $db = new PDO($dsn, $db_user, $db_pass, $opciones);

}catch( PDOException $e ){
	header('Location: createDB.php'); exit;
}
?>
