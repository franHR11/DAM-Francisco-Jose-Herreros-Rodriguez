<?php

	// Este archivo inserta los campos que vienen del formulario

	include "error.php";								// Incluyo los mensajes de error
	
	include "config.php";							// Traigo la conexión a la base de datos
	
	$peticion = "
	INSERT INTO 
	".$_GET['tabla']." 
	VALUES(";											// Arranco una peticion
	
	foreach($_POST as $clave => $valor){		// Para cada uno de los campos del formulario
		if($clave == "Identificador"){			// Si el campo es el identificador
			$peticion .= "NULL,";					// Pon NULL
		}else{											// Pero si es cualquier otro tipo de campo
			$peticion .= "'".$valor."',";			// Ponme el valor del campo
		}
	}
	$peticion = substr($peticion, 0, -1);		// Le quito la ultima coma a la cadena
	$peticion .= ")									
	";														// Cierro la peticion SQL
	echo $peticion;									// Lanzo la peticion
	$resultado = $conexion->query($peticion);	// Ejecuto la peticion

?>
   <meta http-equiv="refresh" content="5; url=escritorio.php">
