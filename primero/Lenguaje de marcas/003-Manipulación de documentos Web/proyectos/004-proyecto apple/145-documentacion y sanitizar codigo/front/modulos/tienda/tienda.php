<?php
/**
 * @webblock
 * @author FranHR
 * @description Gestiona la visualización y funcionalidad principal de la tienda
 * incluyendo la gestión de productos y su presentación
 */
include "modulos/bloque/bloque.php";
include "config.php";

if (!isset($_GET['tienda_id'])) {
    echo "<div>Error: No se ha especificado una tienda</div>";
    exit;
}

// Sanitizar entrada
$tienda_id = filter_var($_GET['tienda_id'], FILTER_SANITIZE_NUMBER_INT);

// Obtener información de la tienda
$query = $conexion->prepare("SELECT * FROM tiendas WHERE Identificador = ?");
$query->bind_param("i", $tienda_id);
$query->execute();
$resultado = $query->get_result();
$tienda = $resultado->fetch_assoc();

if (!$tienda) {
    echo "<div>Error: Tienda no encontrada</div>";
    exit;
}

// Manejar los estilos de forma segura
$estilos = !empty($tienda['estilo']) ? json_decode($tienda['estilo'], true) : [];

// Crear el bloque de cabecera de la tienda
$bloqueTienda = new BloqueCompleto(
    $tienda['titulo'],
    $tienda['subtitulo'] ?? '',
    $tienda['descripcion'] ?? '',
    $tienda['imagen'] ?? '',
    $tienda['fondo'] ?? '',
    $estilos
);
echo $bloqueTienda->getBloque();

// Obtener productos asociados a la tienda
$query = "
    SELECT p.* 
    FROM productos p 
    INNER JOIN tiendas_productos tp ON p.Identificador = tp.producto_id 
    WHERE tp.tienda_id = $tienda_id 
    ORDER BY tp.orden ASC";
$resultado = mysqli_query($conexion, $query);

// Crear un array con los productos para el bloque tienda
$productos = [];
while ($producto = mysqli_fetch_assoc($resultado)) {
    $productos[] = [
        'titulo' => $producto['titulo'],
        'subtitulo' => $producto['subtitulo'],    // Cambiado de descripcion a subtitulo
        'descripcion' => $producto['descripcion'], // Añadida la descripción
        'precio' => $producto['precio'],
        'imagen' => isset($producto['imagen']) ? $producto['imagen'] : '',
        'id' => $producto['Identificador']
    ];
}

// Crear el bloque de productos si hay productos
if (!empty($productos)) {
    $bloque = new BloqueTienda(
        'Productos disponibles',
        '',
        json_encode($productos),
        '',
        '',
        $estilos
    );
    echo $bloque->getBloque();
}
?>

<style>
    <?php include "tienda.css"; ?>
</style>

<script>
    <?php include "tienda.js"; ?>
</script>