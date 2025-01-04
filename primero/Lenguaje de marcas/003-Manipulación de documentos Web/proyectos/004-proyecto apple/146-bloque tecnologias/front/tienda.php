<?php
/**
 * Página de tienda principal
 * 
 * @description Muestra el catálogo completo de productos disponibles
 * @requires inc/errores.php - Manejo de errores
 * @requires inc/registro.php - Funcionalidad de registro
 * @requires inc/cabeza.php - Header HTML común
 * @requires modulos/cabecera/cabecera.php - Navegación superior
 * @requires modulos/tienda/tienda.php - Contenido principal de la tienda
 * @requires modulos/piedepagina/piedepagina.php - Footer común
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
    <?php include "modulos/tienda/tienda.php"; ?>
    <?php include "modulos/piedepagina/piedepagina.php"; ?>
</body>
</html>
