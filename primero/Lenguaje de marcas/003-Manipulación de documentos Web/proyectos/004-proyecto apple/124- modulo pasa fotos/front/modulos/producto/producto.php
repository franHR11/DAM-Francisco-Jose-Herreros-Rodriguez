<main>
    <?php
    include "modulos/bloque/bloque.php";
    
    $conexion = mysqli_connect(
			"localhost", 
			"proyectoapple", 
			"proyectoapple", 
			"proyectoapple"
		);		
	
		$peticion = "
		SELECT * 
		FROM bloquesproductos
		WHERE productos_titulo = ".$_GET['prod']."
		;";																					// Creo una petición
		//echo $peticion;
		$resultado = mysqli_query($conexion, $peticion);						// Ejecuto la petición contra el servidor
																								// Creo un array vacio
		while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){		// Para cada uno de los resultados
			$estilo = $fila['estilo'] ? json_decode($fila['estilo'], true) : null;  // Mover esta línea aquí arriba
			
			if($fila['tipobloque_tipo'] == "1"){
				$bloque = new BloqueCompleto(
					$fila['titulo'], 
					$fila['subtitulo'], 
					$fila['texto'],
					'',
					$fila['fondo'],
					$estilo  // Añadir los estilos aquí
				);
    			echo $bloque->getBloque();
			}else if($fila['tipobloque_tipo'] == "2"){
				$estilo = $fila['estilo'] ? json_decode($fila['estilo'], true) : null;
				$bloque = new BloqueCaja(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					'',
					$fila['fondo'],
					$estilo
				);
				echo $bloque->getBloque();
			}else if($fila['tipobloque_tipo'] == "3"){							// Si el bloque es de tipo 2
				$bloque = new BloqueMosaico(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					"",
					"",
					["uno","dos","tres","cuatro"],
					$estilo  // Añadir los estilos aquí
					
					);																		// Creo una nueva instancia
    			echo $bloque->getBloque();											// Lanzo el html del bloque
			}else if($fila['tipobloque_tipo'] == "4"){							// Si el bloque es de tipo 2
				$bloque = new BloqueCajaYoutube(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					"",
					"",
					["uno","dos","tres","cuatro"],
					$estilo  // Añadir los estilos aquí
					
					);																		// Creo una nueva instancia
    			echo $bloque->getBloque($fila['texto']);											// Lanzo el html del bloque
			}
			else if($fila['tipobloque_tipo'] == "5"){							// Si el bloque es de tipo 2
				$bloque = new BloqueCajaDosColumnas(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					"",
					"",
					$estilo  // Añadir los estilos aquí
					
					);																		// Creo una nueva instancia
    				
    			echo $bloque->getBloque();											// Lanzo el html del bloque
			}else if($fila['tipobloque_tipo'] == "6"){							// Si el bloque es de tipo 2
				$bloque = new BloqueCajaPasaFotos(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					"",
					"",
					$estilo  // Añadir los estilos aquí
					
					);																		// Creo una nueva instancia
    				
    			echo $bloque->getBloque();											// Lanzo el html del bloque
			}
		 }
    ?>
</main>
<script>
    <?php include "producto.js"; ?>
</script>
<style>
    <?php 
    	include "producto.css"; 
    	?>
</style>