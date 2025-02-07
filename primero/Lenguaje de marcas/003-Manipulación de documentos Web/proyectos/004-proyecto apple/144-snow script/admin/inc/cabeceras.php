<?php

	// Este archivo carga las cabeceras de la tabla

	include "utilidades/error.php";                           // Incluyo los mensajes de error
	include "config/config.php";                          // Traigo la conexión a la base de datos

	$peticion = "SHOW COLUMNS FROM ".$_GET['tabla'];	// Quiero todas las columnas de una tabla
	$resultado = $conexion->query($peticion);				// Ejecuto la consulta contra la base de datos

	// Cabeceras con clase sortable
	while ($fila = $resultado->fetch_assoc()) {			// Para cada resultado obtenido
	  echo "<td class='sortable' data-column='".$fila['Field']."'>".$fila['Field']."</td>";					// Creo una columna de la tabla
	}
	echo "<td>X</td>"; 

	// Agregar fila de filtros
	echo "</tr><tr class='filter-row'>";
	$resultado->data_seek(0);
	while ($fila = $resultado->fetch_assoc()) {
	  echo "<td><input type='text' class='column-filter' data-column='".$fila['Field']."' placeholder='Filtrar...'></td>";
	}
	echo "<td></td>";

	$conexion->close();											// Cierro la base de datos
?>

