<?php
/**
 * Módulo de Producto - Página de detalle de producto
 * 
 * Este archivo maneja la visualización detallada de un producto individual.
 * Funcionalidades principales:
 * - Muestra información detallada del producto (título, subtítulo, precio, imagen)
 * - Permite añadir productos al carrito
 * - Muestra la descripción completa del producto
 * - Enlaza con la tienda relacionada
 * - Gestiona bloques de contenido dinámico asociados al producto
 * 
 * @author Francisco José Herreros Rodríguez
 * @version 1.0
 */
?>

<main>
    <!-- Añadir esto justo después de la etiqueta main -->
    <link rel="stylesheet" href="modulos/producto/producto.css">
    
    <?php
    include_once "modulos/bloque/bloque.php";
    include_once "config.php";

    if (!isset($_GET['prod'])) {
        echo "<div>Error: No se ha especificado un producto</div>";
        exit;
    }

    $producto_id = (int)$_GET['prod'];

    // Modificar la consulta para obtener también la información de la tienda
    $query = "SELECT p.*, t.titulo as tienda_nombre, t.Identificador as tienda_id
              FROM productos p 
              LEFT JOIN tiendas_productos tp ON p.Identificador = tp.producto_id
              LEFT JOIN tiendas t ON tp.tienda_id = t.Identificador
              WHERE p.Identificador = $producto_id";
    $resultado = mysqli_query($conexion, $query);
    $producto = mysqli_fetch_assoc($resultado);

    if (!$producto) {
        echo "<div>Error: Producto no encontrado</div>";
        exit;
    }

    // En lugar de usar BloqueCompleto, creamos nuestro propio HTML estructurado
    ?>
    <div class="producto-detalle">
        <div class="producto-principal">
            <div class="producto-columna-izquierda">
                <div class="producto-imagen">
                    <?php if (!empty($producto['imagen'])): ?>
                        <img src="../static/<?php echo htmlspecialchars($producto['imagen']); ?>" 
                             alt="<?php echo htmlspecialchars($producto['titulo']); ?>"
                             loading="lazy">
                    <?php else: ?>
                        <div class="imagen-placeholder">
                            <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#86868b">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="producto-columna-derecha">
                <div class="producto-info">
                    <h1 class="producto-titulo"><?php echo htmlspecialchars($producto['titulo']); ?></h1>
                    <h4 class="producto-subtitulo"><?php echo htmlspecialchars($producto['subtitulo']); ?></h4>
                    <?php if (!empty($producto['tienda_nombre'])): ?>
                        <div class="producto-tienda">
                            <a href="tienda.php?tienda_id=<?php echo $producto['tienda_id']; ?>">
                                Ver en <?php echo htmlspecialchars($producto['tienda_nombre']); ?> →
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="producto-precio"><?php echo number_format($producto['precio'], 2); ?>€</div>
                    <div class="producto-acciones">
                        <button class="boton-comprar" onclick="agregarAlCarrito({
                            id: <?php echo $producto['Identificador']; ?>,
                            nombre: '<?php echo addslashes($producto['titulo']); ?>',
                            precio: <?php echo $producto['precio']; ?>,
                            imagen: '<?php echo addslashes($producto['imagen'] ?? ''); ?>'
                        })">Añadir al carrito</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="producto-descripcion">
            <h2>Descripción del producto</h2>
            <div class="descripcion-contenido">
                <?php 
                // Cambiar htmlspecialchars por html_entity_decode para mostrar el HTML formateado
                echo html_entity_decode($producto['descripcion']); 
                ?>
            </div>
        </div>
    </div>

    <?php
    // Obtener los bloques asociados al producto
    $query = "SELECT * FROM bloquesproductos WHERE productos_titulo = $producto_id ORDER BY Identificador ASC";
    $resultado = mysqli_query($conexion, $query);

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $estilo = $fila['estilo'] ? json_decode($fila['estilo'], true) : null;
        
        switch($fila['tipobloque_tipo']) {
            case 1: // Bloque Completo
                $bloque = new BloqueCompleto(
                    $fila['titulo'],
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    $estilo
                );
                echo $bloque->getBloque();
                break;
                
            case 2: // Bloque Caja
                $bloque = new BloqueCaja(
                    $fila['titulo'],
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    $estilo
                );
                echo $bloque->getBloque();
                break;
                
            case 3: // Bloque Mosaico
                $bloque = new BloqueMosaico(
                    $fila['titulo'], 
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    ["uno","dos","tres","cuatro"],
                    $estilo
                );
                echo $bloque->getBloque();
                break;

            case 4: // Bloque Caja Youtube
                $bloque = new BloqueCajaYoutube(
                    $fila['titulo'], 
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    $estilo
                );
                echo $bloque->getBloque($fila['texto']);
                break;

            case 5: // Bloque Caja Dos Columnas
                $bloque = new BloqueCajaDosColumnas(
                    $fila['titulo'], 
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    $estilo
                );
                echo $bloque->getBloque();
                break;

            case 6: // Bloque Caja Pasa Fotos
                $bloque = new BloqueCajaPasaFotos(
                    $fila['titulo'], 
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    $estilo
                );
                echo $bloque->getBloque();
                break;

            case 7: // Bloque Tienda
                $bloque = new BloqueTienda(
                    $fila['titulo'], 
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    $estilo
                );
                echo $bloque->getBloque();
                break;

            case 8: // Bloque Texto Completo
                $bloque = new BloqueTextoCompleto(
                    $fila['titulo'], 
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    $estilo
                );
                echo $bloque->getBloque();
                break;

            case 9: // Bloque Fondo y Título
                $bloque = new BloqueFondoYTitulo(
                    $fila['titulo'], 
                    $fila['subtitulo'],
                    $fila['texto'],
                    $fila['imagen'],
                    $fila['fondo'],
                    $estilo
                );
                echo $bloque->getBloque();
                break;
        }
    }
    ?>
</main>

<script>
function agregarAlCarrito(producto) {
    // Recuperar el carrito actual del localStorage
    let carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
    
    // Añadir el producto al carrito
    carrito.push({
        id: producto.id,
        nombre: producto.nombre,
        precio: producto.precio,
        imagen: producto.imagen,
        cantidad: 1
    });
    
    // Guardar el carrito actualizado
    localStorage.setItem('carrito', JSON.stringify(carrito));
    
    // Actualizar el contador del carrito si existe la función
    if(typeof actualizarContadorCarrito === 'function') {
        actualizarContadorCarrito();
    }
    
    // Mostrar mensaje de confirmación
    alert('Producto añadido al carrito');
}
</script>