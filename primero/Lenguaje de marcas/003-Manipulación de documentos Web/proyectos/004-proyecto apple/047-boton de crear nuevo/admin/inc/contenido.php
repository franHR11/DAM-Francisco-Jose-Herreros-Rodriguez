<?php

// Este archivo carga el contenido interno de la tabla

include "error.php";	

	
include "config.php";


$peticion = "SELECT * FROM ".$_GET['tabla'];		// Selecciono todo de una tabla dinámica
$resultado = $conexion->query($peticion);			// Ejecuto la petición contra la base de datos

while ($fila = $resultado->fetch_assoc()) {		// Para cada resultado obtenido
	echo "<tr>";											// Comienzo una fila de tabla
	foreach($fila as $clave=>$valor){				// Para cada uno de los campos
		if(strlen($valor) < 300){						// Si el campo es menor que 300 caracteres
  			echo "<td>".$valor."</td>";				// Pongo el valor en una columna
  		}else{												// En caso contrario
  			echo "<td>
  			<img src='data:image/png;base64,".base64_encode($valor)."'>
  			</td>";											// Cargo los datos como imagen y no como texto
  		}
  	}
  echo "</tr>";											// Cierro la fila html
}


$conexion->close();										// Cierro la conexión de base de datos
?>