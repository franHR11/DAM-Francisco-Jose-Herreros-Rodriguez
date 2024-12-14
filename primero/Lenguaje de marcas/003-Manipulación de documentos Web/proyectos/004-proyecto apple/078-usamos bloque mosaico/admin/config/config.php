<?php

	$servidor = "localhost";				// Defino el servidor
	$usuario = "proyectoapple";			// Defino el usuario con permiso
	$contrasena = "proyectoapple";		// Defino la contraseña de ese usuario
	$base = "proyectoapple";				// Defino la base de datos

	$conexion = new mysqli(
		$servidor, 
		$usuario, 
		$contrasena, 
		$base
	);												// Creo una conexión de tipo MySQL

?>
