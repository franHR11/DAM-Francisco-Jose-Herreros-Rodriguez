<?php

	// Este archivo carga las cabeceras de la tabla

	include "error.php";										// Importo la configuración de eeror									
		
	include "config.php";									// importo la conexión a base de datos

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
