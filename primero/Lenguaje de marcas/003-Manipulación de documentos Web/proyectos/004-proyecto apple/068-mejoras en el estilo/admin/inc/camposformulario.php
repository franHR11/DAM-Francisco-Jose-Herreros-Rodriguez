<?php

	// Este archivo carga las cabeceras de la tabla

	include "utilidades/error.php";                           // Incluyo los mensajes de error
include "config/config.php";                          // Traigo la conexión a la base de datos

	$peticion = "SHOW COLUMNS FROM ".$_GET['formulario'];	// Quiero todas las columnas de una tabla
	$resultado = $conexion->query($peticion);				// Ejecuto la consulta contra la base de datos

	while ($fila = $resultado->fetch_assoc()) {			// Para cada resultado obtenido
	  echo "<input ";
	  if($fila['Field'] == "Identificador"){
	  	echo " type='hidden' ";
	  }else if(str_contains($fila['Field'],"imagen")){
	  	echo " type='file' ";
	  }else{
	  	echo " type='text' ";
	  }
	  echo "
	  name='".$fila['Field']."' 
	  placeholder='".$fila['Field']."' 
	  
	  >";	// Creo una columna de la tabla
	}

	$conexion->close();											// Cierro la base de datos
?>

