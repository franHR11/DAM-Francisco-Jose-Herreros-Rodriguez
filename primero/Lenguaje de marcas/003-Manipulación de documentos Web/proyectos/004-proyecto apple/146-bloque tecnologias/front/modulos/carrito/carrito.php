<?php
/**
 * @webblock Carrito de Compras
 * @description Módulo principal del carrito de compras que gestiona:
 * - Visualización de productos seleccionados
 * - Formulario de datos del cliente
 * - Proceso de compra
 * @version 1.0.0
 * @package AppleStore
 * @requires productosrelacionados.php
 */
?>
<main>
	<div class="contenedor" id="tienda">
		<section id="compra">
		<div id="datosproductoactual">
			<h3>Productos en el Carrito</h3>
			<div id="mensajeConfirmacion" style="display: none;" class="mensaje-exito">
				Pedido procesado correctamente
			</div>
		</div>
		<div id="carrito"></div>
		<div id="total"></div>
		<button id="procesarpedido">Procesar pedido</button>
		<div id="datoscliente">
			<h3>Datos del cliente para la compra</h3>
			<input  id="nombrecliente" type="text" name="nombre" placeholder="Nombre del cliente">
			<input id="apellidoscliente"  type="text" name="apellidos" placeholder="Apellidos del cliente">
			<input id="emailcliente" type="email" name="email" placeholder="Email del cliente">
			<button id="enviardatos">Enviar</button>
		</div>
		</section>
		<?php
			include "modulos/productosrelacionados/productosrelacionados.php";
		?>
	</div>
</main>
<script>
	<?php include "carrito.js"?>
</script>
<style>
	<?php include "carrito.css"?>
</style>