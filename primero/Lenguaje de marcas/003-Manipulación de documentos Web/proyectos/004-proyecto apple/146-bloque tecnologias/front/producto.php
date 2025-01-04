<?php
/**
 * Página de detalle de producto
 * 
 * @description Muestra información detallada de un producto específico
 * @requires inc/errores.php - Manejo de errores
 * @requires inc/registro.php - Funcionalidad de registro
 * @requires inc/cabeza.php - Header HTML común
 * @requires modulos/cabecera/cabecera.php - Navegación superior
 * @requires modulos/producto/producto.php - Detalles del producto
 * @requires modulos/piedepagina/piedepagina.php - Footer común
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
		<?php include "modulos/producto/producto.php"; ?>
		<?php include "modulos/piedepagina/piedepagina.php"; ?>
	</body>
</html>
