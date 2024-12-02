<?php

	include "error.php";	
	
	
	include "config.php";

	$peticion = "
		SELECT * FROM usuarios
		WHERE 
		email = '".$_POST['email']."'
		AND
		contrasena = '".$_POST['contrasena']."'
		";
	$resultado = $conexion->query($peticion);

	if ($fila = $resultado->fetch_assoc()) {
	  echo '<a href="escritorio.php">Pulsa y vamos al escritorio</a>';
	}else{
		echo "Intento de acceso incorrecto";
	}

?>
