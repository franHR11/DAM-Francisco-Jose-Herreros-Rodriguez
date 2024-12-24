<header>
	<div class="contenedor">
		<a href="index.php"><img src="img/logo.svg"></a>
		<nav>
			<ul>
				<template id="elementomenu">
					<li>
						<a href=""></a>
					</li>
				</template>
				<li>
					<a href="blog.php">Blog</a>
				</li>
				<li>
					<a href="contacto.php">Contacto</a>
				</li>
				<li>
					<?php
					 include("modulos/tienda/gadget.php"); 
					 ?>
				</li>
			</ul>
		</nav>
		<div id="supermenu">
			<div class="columna">
				<h3 id="categoria">Cabecera</h3>
				<ul id="productos">
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
				</ul>
			</div>
			<div class="columna">
				<h3>Cabecera</h3>
				<ul>
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
				</ul>
			</div>
			<div class="columna">
				<h3>Cabecera</h3>
				<ul>
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
					<li>Elemento</li>
				</ul>
			</div>
		</div>
	</div>
</header>
<script>
	<?php include "funciones.js"?>
</script>
<script>
	<?php include "cabecera.js"?>
</script>
<style>
	<?php include "cabecera.css"?>
</style>