<?php

include "error.php";	

	
include "config.php";


$peticion = "SHOW COLUMNS FROM ".$_GET['tabla'];
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
  echo "<td>".$fila['Field']."</td>";
}


$conexion->close();
?>
