<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
$servidor = "localhost";
$usuario = "proyectoapple";
$contrasena = "proyectoapple";
$base = "proyectoapple";

$conexion = new mysqli($servidor, $usuario, $contrasena, $base);

$peticion = "SHOW COLUMNS FROM destacados";
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
  echo "<td>".$fila['Field']."</td>";
}


$conexion->close();
?>
