<?php
	$conexion = mysqli_connect(
	"localhost", 
	"examenprogramacion", 
	"examenprogramacion", 
	"examenprogramacion"
	);
	$peticion = "SELECT * FROM capitulos;";
	$resultado = mysqli_query($conexion, $peticion);
	
?>