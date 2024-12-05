<?php

// Este archivo carga el contenido interno de la tabla

include "error.php";									// Cargo la configuración de errores
	
include "config.php";								// Cargo la conexión a la base de datos

$peticion = "SELECT * FROM ".$_GET['tabla'];		// Selecciono todo de una tabla dinámica
$resultado = $conexion->query($peticion);			// Ejecuto la petición contra la base de datos

while ($fila = $resultado->fetch_assoc()) {		// Para cada resultado obtenido
	$identificador = "";									// Creo una variable llamada identificador
	echo "<tr>";											// Comienzo una fila de tabla
	foreach($fila as $clave=>$valor){				// Para cada uno de los campos
		if($clave == "Identificador"){				// Si la clave es Identificador
			$identificador = $valor;					// A la variable identificador le pongo valor
		}
		if(strlen($valor) < 300){						// Si el campo es menor que 300 caracteres
  			echo "<td>".$valor."</td>";				// Pongo el valor en una columna
  		}else{												// En caso contrario
  			echo "<td>
  			<img src='data:image/png;base64,".base64_encode($valor)."'>
  			</td>";											// Cargo los datos como imagen y no como texto
  		}
  	}
  	echo "
	<td>
		<a href='eliminar.php?tabla=".$_GET['tabla']."&Identificador=".$identificador."'>
			<button class='eliminar'>
				X
			</button>
		</a>
	</td>";													// Creo un boton de eliminar con los datos correcto
  echo "</tr>";											// Cierro la fila html
}


$conexion->close();										// Cierro la conexión de base de datos
?>
