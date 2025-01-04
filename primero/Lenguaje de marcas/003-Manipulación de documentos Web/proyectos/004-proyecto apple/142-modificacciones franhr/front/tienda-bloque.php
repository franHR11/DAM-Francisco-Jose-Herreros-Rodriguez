<?php
include "modulos/cabecera/cabecera.php";
include "modulos/bloque/bloque.php";
include "config.php";

// Obtener el ID del bloque tienda desde la URL
$bloque_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener la información del bloque tienda
$query = "SELECT * FROM bloquesproductos WHERE Identificador = ? AND tipobloque_tipo = '7'";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $bloque_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($bloque = $resultado->fetch_assoc()) {
    // Crear y mostrar el bloque tienda
    $bloqueTienda = new BloqueTienda(
        $bloque['titulo'],
        $bloque['subtitulo'],
        $bloque['texto'],
        $bloque['imagen'],
        $bloque['fondo'],
        json_decode($bloque['estilo'], true)
    );
    echo $bloqueTienda->getBloque();
} else {
    echo "<div class='error'>Bloque tienda no encontrado</div>";
}

include "modulos/pie/pie.php";
?>

<style>
    main {
        margin-top: 44px;
        padding: 20px;
    }
    .error {
        text-align: center;
        padding: 20px;
        color: red;
    }
</style>
