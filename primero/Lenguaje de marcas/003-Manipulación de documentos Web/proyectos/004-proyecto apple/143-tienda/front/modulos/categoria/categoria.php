<!-- Listado de bloques en la página de categoría -->
<main>
    <?php
    include "modulos/bloque/bloque.php";											// Incluyo los bloques
    include "config.php";																					// Conexión a la base de datos
	
		$peticion = "
		SELECT bc.*, bc.imagen as imagen, bc.fondo as fondo, bc.titulo as titulo
		FROM bloquescategorias bc
		WHERE categorias_nombre = ".$_GET['cat']."
		;";																					// Creo una petición
		//echo el peticion;
		$resultado = mysqli_query($conexion, $peticion);						// Ejecuto la petición contra el servidor
																								// Creo un array vacio
		while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){		// Para cada uno de los resultados
			 // Eliminamos el var_dump y solo mantenemos los logs si son necesarios para debug
			error_log('DEBUG categoria.php - Datos del bloque:');
			error_log('Título: ' . $fila['titulo']);
			error_log('Imagen: ' . $fila['imagen']);
			error_log('Fondo: ' . $fila['fondo']);
			
			$estilo = $fila['estilo'] ? json_decode($fila['estilo'], true) : null;  // Mover esta línea aquí arriba
			
			if($fila['tipobloque_tipo'] == "1"){									// Si el bloque es de tipo 1
				$bloque = new BloqueCompleto(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Asegurarnos que este campo llega correctamente
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
			}else if($fila['tipobloque_tipo'] == "7"){							// Nuevo bloque tipo tienda
				$bloque = new BloqueTienda(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    
					$fila['fondo'],     
					$estilo  
					);																		
    			echo $bloque->getBloque();											
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