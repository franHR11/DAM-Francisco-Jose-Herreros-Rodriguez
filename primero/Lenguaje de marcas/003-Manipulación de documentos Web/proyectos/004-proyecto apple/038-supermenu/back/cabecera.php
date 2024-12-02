<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$conexion = mysqli_connect(
		"localhost", 
		"proyectoapple", 
		"proyectoapple", 
		"proyectoapple"
	);																						// Me conecto a la base de datos
	$peticion = "SELECT * FROM categorias;";										// Creo una petición
	$resultado = mysqli_query($conexion, $peticion);						// Ejecuto la petición contra el servidor
	$json = [];																			// Creo un array vacio
	while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){		// Para cada uno de los resultados
		$json[] = $fila;																// Hago un push al array
	}
	header('Content-Type: application/json');									// El documento va a ser json
   echo json_encode($json);														// SAco el resultado en formato compatible con json
?>