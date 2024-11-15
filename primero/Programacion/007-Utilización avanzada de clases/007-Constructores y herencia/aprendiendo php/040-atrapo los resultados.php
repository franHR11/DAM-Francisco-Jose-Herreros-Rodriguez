<?php
	$conexion = mysqli_connect(
		"localhost", 
		"examenprogramacion", 
		"examenprogramacion", 
		"examenprogramacion"
	);
	$peticion = "SELECT * FROM capitulos;";
	$resultado = mysqli_query($conexion, $peticion);
	while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
		var_dump($fila);
	}
?>