<!-- Listado de bloques en la página de categoría -->
<main>
    <?php
    include "modulos/bloque/bloque.php";											// Incluyo los bloques
    include "config.php";																					// Conexión a la base de datos
	
		$peticion = "
		SELECT bc.*, bc.imagen as imagen, bc.fondo as fondo 
		FROM bloquescategorias bc
		WHERE categorias_nombre = ".$_GET['cat']."
		;";																					// Creo una petición
		//echo $peticion;
		$resultado = mysqli_query($conexion, $peticion);						// Ejecuto la petición contra el servidor
																								// Creo un array vacio
		while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){		// Para cada uno de los resultados
			$estilo = $fila['estilo'] ? json_decode($fila['estilo'], true) : null;  // Mover esta línea aquí arriba
			
			if($fila['tipobloque_tipo'] == "1"){									// Si el bloque es de tipo 1
				$bloque = new BloqueCompleto(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Agregamos el fondo
					$estilo  // Añadir los estilos aquí
					);																			// Creo una nueva instancia
    			echo $bloque->getBloque();												// Lanzo el html del bloque
			}else if($fila['tipobloque_tipo'] == "2"){
				// BloqueCaja ya tiene los estilos
				$bloque = new BloqueCaja(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Agregamos el fondo
					$estilo
				);
				echo $bloque->getBloque();												// Lanzo el html del bloque
			}else if($fila['tipobloque_tipo'] == "3"){							// Si el bloque es de tipo 2
				$bloque = new BloqueMosaico(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Agregamos el fondo
					["uno","dos","tres","cuatro"],
					$estilo  // Añadir los estilos aquí
					);																		// Creo una nueva instancia
    			echo $bloque->getBloque();											// Lanzo el html del bloque
			}else if($fila['tipobloque_tipo'] == "4"){							// Si el bloque es de tipo 2
				$bloque = new BloqueCajaYoutube(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Agregamos el fondo
					$estilo  // Añadir los estilos aquí
					);																		// Creo una nueva instancia
    			echo $bloque->getBloque();											// Lanzo el html del bloque
			}
			else if($fila['tipobloque_tipo'] == "5"){							// Si el bloque es de tipo 2
				$bloque = new BloqueCajaDosColumnas(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Agregamos el fondo
					$estilo  // Añadir los estilos aquí
					);																		// Creo una nueva instancia
    				
    			echo $bloque->getBloque();											// Lanzo el html del bloque
			}else if($fila['tipobloque_tipo'] == "6"){							// Si el bloque es de tipo 2
				$bloque = new BloqueCajaPasaFotos(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Agregamos el fondo
					$estilo  // Añadir los estilos aquí
					);																		// Creo una nueva instancia
    				
    			echo $bloque->getBloque();											// Lanzo el html del bloque
			}
		 }
																		
		

    
    ?>
</main>
<script>
    <?php include "categoria.js"; ?>
</script>
<style>
    <?php 
    	include "categoria.css"; 
    	?>
</style>