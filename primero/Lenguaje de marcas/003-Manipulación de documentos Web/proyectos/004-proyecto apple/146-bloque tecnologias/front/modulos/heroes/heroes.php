<?php
/**
 * @webblock Heroes
 * @author FranHR
 * @description Módulo que muestra héroes/productos destacados con imagen de fondo, título, 
 * texto y hasta dos botones de llamada a la acción
 */
?>
<section id="heroes">
    <template id="plantillaheroe">
        <article class="heroe" data-style="">
            <div class="product-image"></div>
            <div class="content">
                <h3></h3>
                <h4></h4>
                <a href="#" id="enlace1"><button id="boton1"></button></a>
                <a href="#" id="enlace2"><button id="boton2"></button></a>
            </div>
        </article>
    </template>
</section>

<script><?php include "heroes.js"?></script>
<style><?php include "heroes.css"?></style>