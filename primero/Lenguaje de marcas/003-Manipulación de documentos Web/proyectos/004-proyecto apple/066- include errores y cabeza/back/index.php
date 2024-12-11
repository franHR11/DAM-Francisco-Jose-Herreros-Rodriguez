<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
																					// Me conecto a la base de datos
header('Content-Type: application/json');		

	function pideAlgo($tabla){
		$conexion = mysqli_connect(
			"localhost", 
			"proyectoapple", 
			"proyectoapple", 
			"proyectoapple"
		);		
	
		$peticion = "SELECT * FROM ".$tabla.";";										// Creo una petición
		
		$resultado = mysqli_query($conexion, $peticion);						// Ejecuto la petición contra el servidor
		$json = [];																			// Creo un array vacio
		while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){		// Para cada uno de los resultados
			foreach ($fila as $key => $value) {										// Repasamos los campos uno a uno
		     if (is_string($value) && strlen($value) > 300) { 				// Supongamos que los BLOB son largos
		         $fila[$key] = base64_encode($value);							// Codificalo como base64
		     }
		 }
			$json[] = $fila;																// Hago un push al array
		}
										// El documento va a ser json
		return json_encode($json);														// SAco el resultado en formato compatible con json
	}
	
	
	echo pideAlgo($_GET['tabla']);
	
	
?>
	
	

