<main>
	<?php
		//echo "El producto que vas a vender tiene el id:".$_GET['prod']."<br>";
	?>
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
	</div>
</main>
<script>
	<?php include "tienda.js"?>
</script>
<style>
	<?php include "tienda.css"?>
</style>