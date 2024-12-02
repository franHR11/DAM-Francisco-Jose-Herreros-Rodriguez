<?php

include "error.php";	

	
include "config.php";


$peticion = "SHOW TABLES in proyectoapple";
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
echo "<li><a href='?tabla=".$fila['Tables_in_proyectoapple']."'>".$fila['Tables_in_proyectoapple']."</a></li>";
    
}


$conexion->close();
?>
