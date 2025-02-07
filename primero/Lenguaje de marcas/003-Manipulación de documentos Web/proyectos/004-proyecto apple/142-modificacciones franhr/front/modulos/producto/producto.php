<main>
    <?php
    include "modulos/bloque/bloque.php";
    include "config.php";
    
    // Primero obtener la información del producto
    $producto_id = intval($_GET['prod']);
    $query_producto = "SELECT * FROM productos WHERE Identificador = " . $producto_id;
    $resultado_producto = mysqli_query($conexion, $query_producto);
    
    if($producto = mysqli_fetch_assoc($resultado_producto)) {
        // Mostrar la información del producto
        echo '<div class="producto-detalle">';
        echo '<h1>' . htmlspecialchars($producto['titulo']) . '</h1>';
        echo '<h2>' . htmlspecialchars($producto['subtitulo']) . '</h2>';
        
        if (!empty($producto['imagen'])) {
            echo '<div class="producto-imagen">';
            echo '<img src="../static/' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['titulo']) . '">';
            echo '</div>';
        }
        
        echo '<div class="producto-descripcion">';
        echo '<p>' . nl2br(htmlspecialchars($producto['descripcion'])) . '</p>';
        echo '</div>';
        
        if (!empty($producto['precio'])) {
            echo '<div class="producto-compra">';
            echo '<div class="producto-precio">' . number_format($producto['precio'], 2) . ' €</div>';
            echo '<button class="boton-comprar" onclick="agregarAlCarrito(' . $producto_id . ')">Añadir al carrito</button>';
            echo '</div>';
        }
        echo '</div>';
    }

    // Luego obtener los bloques asociados al producto
    $peticion = "
    SELECT bp.*, bp.imagen as imagen, bp.fondo as fondo 
    FROM bloquesproductos bp
    WHERE productos_titulo = " . $producto_id;

    $resultado = mysqli_query($conexion, $peticion);						// Ejecuto la petición contra el servidor
																								// Creo un array vacio
		while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){		// Para cada uno de los resultados
			$estilo = $fila['estilo'] ? json_decode($fila['estilo'], true) : null;  // Mover esta línea aquí arriba
			
			if($fila['tipobloque_tipo'] == "1"){
				$bloque = new BloqueCompleto(
					$fila['titulo'], 
					$fila['subtitulo'], 
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Agregamos el fondo
					$estilo  // Añadir los estilos aquí
				);
    			echo $bloque->getBloque();
			}else if($fila['tipobloque_tipo'] == "2"){
					$bloque = new BloqueCaja(
					$fila['titulo'], 
					$fila['subtitulo'],
					$fila['texto'],
					$fila['imagen'],    // Agregamos la imagen
					$fila['fondo'],     // Agregamos el fondo
					$estilo
				);
				echo $bloque->getBloque();
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
    			echo $bloque->getBloque($fila['texto']);											// Lanzo el html del bloque
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
		} // Cierre del while
    ?>
</main>
<script>
    function agregarAlCarrito(productoId) {
        const producto = {
            id: productoId,
            nombre: document.querySelector('.producto-detalle h1').textContent,
            precio: parseFloat(document.querySelector('.producto-precio').textContent),
            imagen: document.querySelector('.producto-imagen img')?.src || ''
        };

        let carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
        carrito.push(producto);
        localStorage.setItem('carrito', JSON.stringify(carrito));
        
        if(typeof actualizarContadorCarrito === 'function') {
            actualizarContadorCarrito();
        }
        
        alert('Producto añadido al carrito');
    }
</script>
<style>
    <?php include "producto.css"; ?>
</style>