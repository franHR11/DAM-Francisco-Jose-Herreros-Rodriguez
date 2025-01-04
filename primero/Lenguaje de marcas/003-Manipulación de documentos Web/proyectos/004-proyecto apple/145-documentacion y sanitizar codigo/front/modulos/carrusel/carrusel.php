<?php
/**
 * @webblock Carrusel de Productos
 * @description Módulo de presentación que incluye:
 * - Carrusel principal con llamadas a la acción
 * - Carrusel secundario de productos
 * - Sistema de navegación por puntos
 * @version 1.0.0
 * @package AppleStore
 */
?>
<section id="carrusel">
	<div class="contenedor">
		<div id="carrusel1" class="animado1">
			<template id="plantillacarrusel1">
				<article>
					<div class="contenido-carrusel">
						<a class="enlace"><button class="boton">Call to action</button></a>
						<h3></h3>
						<p></p>
					</div>
				</article>
			</template>
		</div>
		<div id="botonera">
			<div class="punto"></div>
			<div class="punto"></div>
			<div class="punto"></div>
			<div class="punto"></div>
			<div class="punto"></div>
			<div class="punto"></div>
			<div class="punto"></div>
			<div class="punto"></div>
		</div>
		<div id="carrusel2" class="animado2">
			<template id="plantillacarrusel2">
				<a class="enlace-carrusel2">
					<article>
						<p></p>
					</article>
				</a>
			</template>
		</div>
	</div>
</section>

<script>
	<?php include "carrusel.js"?>
</script>
<style>
	<?php include "carrusel.css"?>
</style>
