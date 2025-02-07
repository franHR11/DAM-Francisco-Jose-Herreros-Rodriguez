<?php
/**
 * Plantilla principal del blog
 * 
 * Este archivo contiene la estructura HTML base del blog, incluyendo:
 * - Contenedor principal para las entradas
 * - Modal para mostrar artículos completos
 * - Plantilla para las entradas del blog
 * - Inclusión de archivos JS y CSS necesarios
 * 
 * @author Francisco José Herreros Rodríguez
 * @version 1.0.0
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <main id="blog"></main>

    <div id="contienemodalpersonalizado">
        <div id="modalpersonalizado"></div>
    </div>

    <template id="plantillaentrada">
        <article>
            <div class="imagen-contenedor">
                <img src="" alt="">
            </div>
            <div class="texto">
                <h4></h4>
                <time></time>
                <h5 class="categoriablog"></h5>
                <div class="contenido-preview"></div>
                <button class="ver-articulo">Ver artículo</button>
            </div>
        </article>
    </template>

    <script>
        <?php include "blog.js"?>
    </script>
    <style>
        <?php include "blog.css"?>
    </style>
</body>
</html>