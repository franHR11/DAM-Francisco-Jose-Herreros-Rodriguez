<?php
/**
 * Página principal del sitio
 * 
 * @description Página de inicio que muestra el contenido principal
 * @requires inc/registro.php - Funcionalidad de registro (debe cargarse primero)
 * @requires inc/errores.php - Manejo de errores
 * @requires inc/cabeza.php - Header HTML común
 * @requires modulos/cabecera/cabecera.php - Navegación superior
 * @requires modulos/principal/principal.php - Contenido de la página principal
 * @requires modulos/piedepagina/piedepagina.php - Footer común
 * @requires modulos/modal/modal.php - Ventanas modales
 * @version 1.0
 * @author Francisco José Herreros Rodríguez
 */
include "inc/registro.php";  // Primero registro.php
include "inc/errores.php"; 
?>
<!doctype html>
<html lang="es">
<html>
	<head>
		<?php include "inc/cabeza.php"; ?>
	</head>
	<body>
		<?php include "modulos/cabecera/cabecera.php"; ?>
		<?php include "modulos/principal/principal.php"; ?>
		<?php include "modulos/piedepagina/piedepagina.php"; ?>
		<?php include "modulos/modal/modal.php"; ?>
		
	</body>
</html>









