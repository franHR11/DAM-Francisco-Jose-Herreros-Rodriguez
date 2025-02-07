<?php
/**
 * Página del blog
 * 
 * @description Muestra entradas y artículos del blog
 * @requires inc/errores.php - Manejo de errores
 * @requires inc/cabeza.php - Header HTML común
 * @requires modulos/cabecera/cabecera.php - Navegación superior
 * @requires modulos/blog/blog.php - Contenido del blog
 * @requires modulos/piedepagina/piedepagina.php - Footer común
 * @requires modulos/modal/modal.php - Ventanas modales genéricas
 * @requires modulos/modalpersonalizado/modalpersonalizado.php - Modales específicos
 * @author Francisco José Herreros Rodríguez
 */
include "inc/errores.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "inc/cabeza.php"; ?>
</head>
<body>
    <?php include "modulos/cabecera/cabecera.php"; ?>
    <?php include "modulos/blog/blog.php"; ?>
    <?php include "modulos/piedepagina/piedepagina.php"; ?>
    <?php include "modulos/modal/modal.php"; ?>
    <?php include "modulos/modalpersonalizado/modalpersonalizado.php"; ?>
</body>
</html>


