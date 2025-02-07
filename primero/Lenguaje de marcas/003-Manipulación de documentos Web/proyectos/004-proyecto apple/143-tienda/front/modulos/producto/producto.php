<main>
    <?php
    include_once "modulos/bloque/bloque.php";
    include_once "config.php";

    if (!isset($_GET['prod'])) {
        echo "<div>Error: No se ha especificado un producto</div>";
        exit;
    }

    $producto_id = (int)$_GET['prod'];

    // Obtener información del producto
    $query = "SELECT p.*, c.nombre as categoria_nombre 
              FROM productos p 
              LEFT JOIN categorias c ON p.categorias_nombre = c.Identificador 
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
            <div class="producto-imagen">
                <?php if (!empty($producto['imagen'])): ?>
                    <img src="../static/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['titulo']); ?>">
                <?php else: ?>
                    <div class="imagen-placeholder">Imagen no disponible</div>
                <?php endif; ?>
            </div>
            
            <div class="producto-info">
                <h1 class="producto-titulo"><?php echo htmlspecialchars($producto['titulo']); ?></h1>
                <div class="producto-categoria"><?php echo htmlspecialchars($producto['categoria_nombre']); ?></div>
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

        <div class="producto-descripcion">
            <h2>Descripción del producto</h2>
            <div class="descripcion-contenido">
                <?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?>
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
        }
    }
    ?>
</main>

<style>
    .producto-detalle {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .producto-principal {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 40px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 30px;
    }

    .producto-imagen {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f8f8;
        border-radius: 8px;
        padding: 20px;
    }

    .producto-imagen img {
        max-width: 100%;
        height: auto;
        object-fit: contain;
    }

    .producto-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .producto-titulo {
        font-size: 32px;
        font-weight: 600;
        margin: 0 0 10px 0;
        color: #1d1d1f;
    }

    .producto-categoria {
        font-size: 16px;
        color: #666;
        margin-bottom: 20px;
    }

    .producto-precio {
        font-size: 28px;
        font-weight: 600;
        color: #0071e3;
        margin-bottom: 30px;
    }

    .producto-acciones {
        margin-top: 20px;
    }

    .boton-comprar {
        background-color: #0071e3;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
        max-width: 300px;
    }

    .boton-comprar:hover {
        background-color: #0077ed;
    }

    .producto-descripcion {
        background: white;
        border-radius: 10px;
        padding: 30px;
        margin-top: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .producto-descripcion h2 {
        font-size: 24px;
        color: #1d1d1f;
        margin-bottom: 20px;
    }

    .descripcion-contenido {
        line-height: 1.6;
        color: #333;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .producto-principal {
            grid-template-columns: 1fr;
        }

        .producto-titulo {
            font-size: 24px;
        }

        .producto-precio {
            font-size: 24px;
        }
    }
</style>

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