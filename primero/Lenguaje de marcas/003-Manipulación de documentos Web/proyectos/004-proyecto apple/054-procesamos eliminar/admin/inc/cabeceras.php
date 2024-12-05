<?php

	// Este archivo carga las cabeceras de la tabla

	include "error.php";										// Importo la configuración de eeror									
		
	include "config.php";									// importo la conexión a base de datos

	$peticion = "SHOW COLUMNS FROM ".$_GET['tabla'];	// Quiero todas las columnas de una tabla
	$resultado = $conexion->query($peticion);				// Ejecuto la consulta contra la base de datos

	while ($fila = $resultado->fetch_assoc()) {			// Para cada resultado obtenido
	  echo "<td>".$fila['Field']."</td>";					// Creo una columna de la tabla
	}
	echo "
	<td>
		
	</td>"; 
	$conexion->close();											// Cierro la base de datos
?>
