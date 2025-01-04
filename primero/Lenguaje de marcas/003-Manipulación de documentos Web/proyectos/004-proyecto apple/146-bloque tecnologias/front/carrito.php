<?php
/**
 * Página del carrito de compras
 * 
 * @description Gestiona el carrito de compras del usuario
 * @requires inc/errores.php - Manejo de errores
 * @requires inc/registro.php - Funcionalidad de registro
 * @requires inc/cabeza.php - Header HTML común
 * @requires modulos/cabecera/cabecera.php - Navegación superior
 * @requires modulos/carrito/carrito.php - Funcionalidad del carrito
 * @requires modulos/piedepagina/piedepagina.php - Footer común
 * @uses SESSION - Para almacenar los items del carrito
 * @author Francisco José Herreros Rodríguez
 */

include "inc/errores.php";
include "inc/registro.php";
?>
<!doctype html>
<html lang="es">
<head>
    <?php include "inc/cabeza.php"; ?>
</head>
<body>
    <?php include "modulos/cabecera/cabecera.php"; ?>
    <?php include "modulos/carrito/carrito.php"; ?>
    <?php include "modulos/piedepagina/piedepagina.php"; ?>
</body>
</html>
