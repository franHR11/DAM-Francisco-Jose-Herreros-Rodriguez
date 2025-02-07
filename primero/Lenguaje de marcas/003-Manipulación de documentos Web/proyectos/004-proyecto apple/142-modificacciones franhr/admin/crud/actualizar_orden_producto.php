<?php
include "../config/config.php";

$tienda_id = $_POST['tienda_id'];
$producto_id = $_POST['producto_id'];
$orden = $_POST['orden'];

$query = "UPDATE tiendas_productos SET orden = ? WHERE tienda_id = ? AND producto_id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("iii", $orden, $tienda_id, $producto_id);

$response = ['success' => $stmt->execute()];
echo json_encode($response);
?>
