<main>

	<div class="contenedor">
		<div id="datosproductoactual">
			<h3>Nuevo producto en el carrito</h3>
			<h4 id="nombreproducto">Nombre del producto</h4>
			<p id="descripcion">Descripcion del producto</p>
			<p id="precio">Precio del producto</p>
			<button id="confirmar">Confirmar</button>
		</div>
		<div id="carrito">
			
		</div>
		<div id="total"></div>
		<button id="procesarpedido">Procesar pedido</button>
		<div id="datoscliente">
			<h3>Datos del cliente para la compra</h3>
			<input  id="nombrecliente" type="text" name="nombre" placeholder="Nombre del cliente">
			<input id="apellidoscliente"  type="text" name="apellidos" placeholder="Apellidos del cliente">
			<input id="emailcliente" type="email" name="email" placeholder="Email del cliente">
			<button id="enviardatos">Enviar</button>
		</div>
	</div>
</main>
<script>
	<?php include "tienda.js"?>
</script>
<style>
	<?php include "tienda.css"?>
</style>