<?php 
/**
 * Página genérica
 * 
 * @description Template para páginas estáticas del sitio
 * @requires inc/errores.php - Manejo de errores
 * @requires inc/registro.php - Funcionalidad de registro
 * @requires inc/cabeza.php - Header HTML común
 * @requires modulos/cabecera/cabecera.php - Navegación superior
 * @requires modulos/pagina/pagina.php - Contenido de la página
 * @requires modulos/piedepagina/piedepagina.php - Footer común
 * @requires modulos/modal/modal.php - Ventanas modales
 * @author Francisco José Herreros Rodríguez
 */

include "inc/errores.php"; 
include "inc/registro.php";
?>
<!doctype html>
<html lang="es">
<html>
	<head>
		<?php include "inc/cabeza.php"; ?>
	</head>
	<body>
		<?php include "modulos/cabecera/cabecera.php"; ?>
		<?php include "modulos/pagina/pagina.php"; ?>
		<?php include "modulos/piedepagina/piedepagina.php"; ?>
		<?php include "modulos/modal/modal.php"; ?>
	</body>
</html>









