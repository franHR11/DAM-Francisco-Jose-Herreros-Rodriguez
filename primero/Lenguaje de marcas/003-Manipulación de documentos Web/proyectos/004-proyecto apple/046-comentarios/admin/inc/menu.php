<?php

/* 
	Este archivo carga las entradas del menu de la izquierda
	Este archivo genera elementos de lista que tienen un hipervinculo	
*/


include "error.php";	

	
include "config.php";


$peticion = "SHOW TABLES in proyectoapple";			// Quiero todas las tablas de la base de datos
$resultado = $conexion->query($peticion);				// Ejecuto la petición contra la base de datos

while ($fila = $resultado->fetch_assoc()) {			// Para cada uno de los resultados
	echo "
		<li>
			<a href='?tabla=".$fila['Tables_in_proyectoapple']."'>
				".$fila['Tables_in_proyectoapple']."
			</a>
		</li>
	";																// Pongo un elemento nuevo del menu
}