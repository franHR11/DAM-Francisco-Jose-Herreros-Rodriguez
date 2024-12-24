<?php

// Este archivo inserta los campos que vienen del formulario


include "config/config.php";                          // Traigo la conexión a la base de datos

$peticion = "
	UPDATE ".$_GET['tabla']."
	SET ".$_GET['columna']." = '".$_GET['contenido']."'
	WHERE Identificador = ".$_GET['identificador']."
"; 

$resultado = $conexion->query($peticion);

?>

