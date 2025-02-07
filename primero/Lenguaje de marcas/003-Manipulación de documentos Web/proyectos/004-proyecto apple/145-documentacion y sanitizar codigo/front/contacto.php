<?php
/**
 * Página de contacto
 * 
 * @description Formulario de contacto y información de la empresa
 * @requires inc/registro.php - Funcionalidad de registro (debe cargarse primero)
 * @requires inc/errores.php - Manejo de errores
 * @requires inc/cabeza.php - Header HTML común
 * @requires modulos/cabecera/cabecera.php - Navegación superior
 * @requires modulos/contacto/contacto.php - Formulario de contacto
 * @requires modulos/piedepagina/piedepagina.php - Footer común
 * @requires modulos/modal/modal.php - Ventanas modales
 * @author Francisco José Herreros Rodríguez
 */

include "inc/registro.php";  // Primero registro.php
include "inc/errores.php";   // Luego errores.php
 ?>
<!doctype html>
<html lang="es">
<html>
    <head>
        <?php include "inc/cabeza.php"; ?>
    </head>
    <body>
        <?php include "modulos/cabecera/cabecera.php"; ?>
        <?php include "modulos/contacto/contacto.php"; ?>
        <?php include "modulos/piedepagina/piedepagina.php"; ?>
        <?php include "modulos/modal/modal.php"; ?>
    </body>
</html>