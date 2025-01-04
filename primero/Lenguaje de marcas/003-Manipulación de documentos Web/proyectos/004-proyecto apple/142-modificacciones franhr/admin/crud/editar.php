<?php
include "../utilidades/error.php";
include "../config/config.php";

// Función auxiliar para manejar valores nulos de manera segura
function safeHtmlSpecialChars($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Verificar si es una tienda
if ($_GET['tabla'] == 'tiendas') {
    $tienda_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($tienda_id <= 0) {
        die("ID de tienda inválido");
    }
    
    // Obtener información de la tienda
    $query = "SELECT * FROM tiendas WHERE Identificador = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $tienda_id);
    $stmt->execute();
    $tienda = $stmt->get_result()->fetch_assoc();

    if (!$tienda) {
        die("Tienda no encontrada");
    }

    // Obtener productos de la tienda
    $query_productos = "SELECT p.*, tp.orden 
                       FROM productos p 
                       INNER JOIN tiendas_productos tp ON p.Identificador = tp.producto_id 
                       WHERE tp.tienda_id = ? 
                       ORDER BY tp.orden";
    $stmt = $conexion->prepare($query_productos);
    $stmt->bind_param("i", $tienda_id);
    $stmt->execute();
    $productos_tienda = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Obtener productos disponibles
    $query_disponibles = "SELECT * FROM productos WHERE Identificador NOT IN 
                         (SELECT producto_id FROM tiendas_productos WHERE tienda_id = ?)";
    $stmt = $conexion->prepare($query_disponibles);
    $stmt->bind_param("i", $tienda_id);
    $stmt->execute();
    $productos_disponibles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    ?>
    <div class="editar-tienda">
        <h2>Editar Tienda: <?php echo safeHtmlSpecialChars($tienda['titulo']); ?></h2>
        
        <!-- Formulario principal -->
        <form method="post" action="actualizar.php" enctype="multipart/form-data">
            <input type="hidden" name="tabla" value="tiendas">
            <input type="hidden" name="id" value="<?php echo $tienda_id; ?>">
            
            <div class="campo">
                <label>Título:</label>
                <input type="text" name="titulo" value="<?php echo safeHtmlSpecialChars($tienda['titulo']); ?>" required>
            </div>
            
            <div class="campo">
                <label>Subtítulo:</label>
                <input type="text" name="subtitulo" value="<?php echo safeHtmlSpecialChars($tienda['subtitulo']); ?>">
            </div>
            
            <div class="campo">
                <label>Descripción:</label>
                <textarea name="descripcion"><?php echo safeHtmlSpecialChars($tienda['descripcion']); ?></textarea>
            </div>

            <button type="submit">Actualizar Tienda</button>
        </form>

        <!-- Sección de productos -->
        <div class="productos-tienda">
            <h3>Productos en la tienda</h3>
            <div class="productos-actuales">
                <?php foreach ($productos_tienda as $producto): ?>
                    <div class="producto-item" data-id="<?php echo $producto['Identificador']; ?>">
                        <?php if (!empty($producto['imagen'])): ?>
                            <img src="../../static/<?php echo safeHtmlSpecialChars($producto['imagen']); ?>" alt="">
                        <?php endif; ?>
                        <span><?php echo safeHtmlSpecialChars($producto['titulo']); ?></span>
                        <input type="number" value="<?php echo $producto['orden']; ?>" 
                               onchange="actualizarOrden(<?php echo $producto['Identificador']; ?>, this.value)">
                        <button onclick="quitarProducto(<?php echo $producto['Identificador']; ?>)">Quitar</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3>Productos disponibles</h3>
            <div class="productos-disponibles">
                <?php foreach ($productos_disponibles as $producto): ?>
                    <div class="producto-item">
                        <?php if (!empty($producto['imagen'])): ?>
                            <img src="../../static/<?php echo safeHtmlSpecialChars($producto['imagen']); ?>" alt="">
                        <?php endif; ?>
                        <span><?php echo safeHtmlSpecialChars($producto['titulo']); ?></span>
                        <button onclick="agregarProducto(<?php echo $producto['Identificador']; ?>)">Agregar</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <style>
    .editar-tienda {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
    }
    .campo {
        margin-bottom: 15px;
    }
    .campo label {
        display: block;
        margin-bottom: 5px;
    }
    .campo input, .campo textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .producto-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 5px;
        border-radius: 4px;
    }
    .producto-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
    .producto-item button {
        margin-left: auto;
    }
    </style>

    <script>
    function actualizarOrden(productoId, nuevoOrden) {
        fetch('actualizar_orden.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `tienda_id=<?php echo $tienda_id; ?>&producto_id=${productoId}&orden=${nuevoOrden}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Orden actualizado');
            }
        });
    }

    function quitarProducto(productoId) {
        if (confirm('¿Estás seguro de querer quitar este producto?')) {
            fetch('quitar_producto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `tienda_id=<?php echo $tienda_id; ?>&producto_id=${productoId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
    }

    function agregarProducto(productoId) {
        fetch('agregar_producto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `tienda_id=<?php echo $tienda_id; ?>&producto_id=${productoId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
    </script>
    <?php
    return;
}

// ... resto del código existente ...
?>
