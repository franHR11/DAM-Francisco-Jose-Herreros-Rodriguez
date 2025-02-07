<?php
/**
 * Página de categoría de productos
 * 
 * @description Muestra productos filtrados por categoría
 * @requires inc/errores.php - Manejo de errores
 * @requires inc/registro.php - Funcionalidad de registro
 * @requires inc/cabeza.php - Header HTML común
 * @requires modulos/cabecera/cabecera.php - Navegación superior
 * @requires modulos/categoria/categoria.php - Lista de productos por categoría
 * @requires modulos/piedepagina/piedepagina.php - Footer común
 * @param GET['id'] ID de la categoría a mostrar
 * @author Francisco José Herreros Rodríguez
 */


 include "inc/errores.php"; 
include "inc/registro.php";  // Primero registro.php
 ?>
<!doctype html>
<html lang="es">
<html>
	<head>
		<?php include "inc/cabeza.php"; ?>
	</head>
	<body>
		<?php include "modulos/cabecera/cabecera.php"; ?>
		<?php include "modulos/categoria/categoria.php"; ?>
		<?php include "modulos/piedepagina/piedepagina.php"; ?>
	</body>
</html>
