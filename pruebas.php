<?php
require_once ('conexion.php');
require_once ('funcionesDB.php');
require_once ('funciones.php');
//require_once ('funciones3.php');
//migrar();
$usuarios = traerDeDB($db);
var_dump($usuarios);
echo "<br>";
migrar($db);
$usuarios = traerDeDB($db);
var_dump($usuarios);

//foreach ($usuarios as $key => $value) {
//  echo "<br>";
//  echo "id :". $value['id'];
//  echo "<br>";
//  echo "nombre :".$value['nombre'];
//  echo "<br>";
//  echo "apellido :".$value['apellido'];
//  echo "<br>";
//  echo "email :".$value['email'];
//  echo "<br>";
//  echo "usuario :".$value['usuario'];
//  echo "<br>";
//  echo "clave :".$value['clave'];
//  echo "<br>";
//}



 ?>
