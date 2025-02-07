<?php
include "../config/config.php";

$tienda_id = $_POST['tienda_id'];
$producto_id = $_POST['producto_id'];

$query = "DELETE FROM tiendas_productos WHERE tienda_id = ? AND producto_id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $tienda_id, $producto_id);

$response = ['success' => $stmt->execute()];
echo json_encode($response);
?>
