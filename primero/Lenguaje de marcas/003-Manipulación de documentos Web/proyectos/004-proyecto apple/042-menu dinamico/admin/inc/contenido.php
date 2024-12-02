<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
$servidor = "localhost";
$usuario = "proyectoapple";
$contrasena = "proyectoapple";
$base = "proyectoapple";

$conexion = new mysqli($servidor, $usuario, $contrasena, $base);

$peticion = "SELECT * FROM destacados";
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
	echo "<tr>";
	foreach($fila as $clave=>$valor){
		if(strlen($valor) < 300){
  			echo "<td>".$valor."</td>";
  		}else{
  			echo "<td><img src='data:image/png;base64,".base64_encode($valor)."'></td>";
  		}
  	}
  echo "</tr>";
}


$conexion->close();
?>
