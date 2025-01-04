<?php
include "inc/registro.php";  // Primero registro.php
include "inc/errores.php";
include "modulos/cabecera/cabecera.php";
include "modulos/bloque/bloque.php";
include "config.php";

$tienda_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM tiendas WHERE Identificador = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $tienda_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($tienda = $resultado->fetch_assoc()) {
    $bloqueTienda = new BloqueTienda(
        $tienda['titulo'],
        $tienda['subtitulo'],
        $tienda['descripcion'],
        $tienda['imagen'],
        $tienda['fondo'],
        json_decode($tienda['estilo'], true),
        $tienda['Identificador']
    );
    echo $bloqueTienda->getBloque();
}

include "modulos/pie/pie.php";
?>
