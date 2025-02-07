<?php

// Este archivo inserta los campos que vienen del formulario

include "../utilidades/error.php";                           // Incluyo los mensajes de error
include "../config/config.php";                          // Traigo la conexión a la base de datos

$tabla = $_GET['tabla'];
$identificador = $_GET['Identificador'];

// Validación básica
if(empty($tabla) || empty($identificador)) {
    die("Error: Parámetros inválidos");
}

$peticion = "DELETE FROM " . $tabla . " WHERE Identificador = " . $identificador;
$resultado = $conexion->query($peticion);

// Redirigir a la página anterior con la tabla específica
header("Location: ../escritorio.php?tabla=" . $tabla);
exit();
?>

