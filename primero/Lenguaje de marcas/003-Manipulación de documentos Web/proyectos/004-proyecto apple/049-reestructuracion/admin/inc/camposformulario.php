<?php

	// Este archivo carga las cabeceras de la tabla

	include "error.php";										// Importo la configuración de eeror									
		
	include "config.php";									// importo la conexión a base de datos

	$peticion = "SHOW COLUMNS FROM ".$_GET['formulario'];	// Quiero todas las columnas de una tabla
	$resultado = $conexion->query($peticion);				// Ejecuto la consulta contra la base de datos

	while ($fila = $resultado->fetch_assoc()) {			// Para cada resultado obtenido
	  echo "<input 
	  name='".$fila['Field']."' 
	  placeholder='".$fila['Field']."' 
	  type='text'
	  >";	// Creo una columna de la tabla
	}

	$conexion->close();											// Cierro la base de datos
?>
