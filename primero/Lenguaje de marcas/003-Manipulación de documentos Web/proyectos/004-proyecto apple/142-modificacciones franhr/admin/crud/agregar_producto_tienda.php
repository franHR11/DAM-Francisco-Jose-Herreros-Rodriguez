<?php
include "../config/config.php";

$tienda_id = $_POST['tienda_id'];
$producto_id = $_POST['producto_id'];

// Obtener el último orden para esta tienda
$query = "SELECT MAX(orden) as max_orden FROM tiendas_productos WHERE tienda_id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $tienda_id);
$stmt->execute();
$resultado = $stmt->get_result()->fetch_assoc();
$nuevo_orden = ($resultado['max_orden'] !== null) ? $resultado['max_orden'] + 1 : 0;

// Insertar el nuevo producto
$query = "INSERT INTO tiendas_productos (tienda_id, producto_id, orden) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param("iii", $tienda_id, $producto_id, $nuevo_orden);

$response = ['success' => $stmt->execute()];
echo json_encode($response);
?>
