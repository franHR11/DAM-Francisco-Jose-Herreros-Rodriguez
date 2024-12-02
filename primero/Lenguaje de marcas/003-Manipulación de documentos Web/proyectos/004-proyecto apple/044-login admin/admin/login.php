<?php

	echo "Si estas viendo esto es que vamos a hacer login<br>";
	
	$servidor = "localhost";
	$usuario = "proyectoapple";
	$contrasena = "proyectoapple";
	$base = "proyectoapple";

	$conexion = new mysqli($servidor, $usuario, $contrasena, $base);

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
