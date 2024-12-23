<?php
	session_start();										// Inicio una sesión PHP
	
	include "config/config.php";								// Cargo los datos de conexión

	$peticion = "
		SELECT * FROM usuarios
		WHERE 
		email = '".$_POST['email']."'
		AND
		contrasena = '".$_POST['contrasena']."'
		";														// Pregunto a la base de datos si hay un usuario y contraseña que coincidan
	$resultado = $conexion->query($peticion);		// LAnzo la petición a la base de datos

	if ($fila = $resultado->fetch_assoc()) {		// Si es cierto que hay al menos un usuario
	  /*echo '
	  	<a href="escritorio.php">
	  		Pulsa y vamos al escritorio
	  	</a>';*/
	  	$_SESSION['login'] = true;
	  	echo '<meta http-equiv="refresh" content="0; url=escritorio.php">';												// Permiteme ir al escritorio
	}else{													// En caso contrario
		echo "Intento de acceso incorrecto";		// Dime que el intento es incorrecto
	}

?>
