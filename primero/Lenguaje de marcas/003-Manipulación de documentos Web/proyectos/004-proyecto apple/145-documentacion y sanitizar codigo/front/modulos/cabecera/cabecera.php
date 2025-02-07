<?php
/**
 * Este archivo genera la cabecera de la página
 * @version 1.0
 */
?>
<header>
    <div class="contenedor">
        <!-- Logo y título -->
        <a href="index.php" id="corporativo">
            <img src="img/logo.svg" alt="Logo PCprogramacion">
            <h1>PCprogramacion</h1>
        </a>
        <!-- Menú principal -->
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
                    <?php include("modulos/tienda/gadget.php"); ?>
                </li>
            </ul>
        </nav>
        <!-- Submenú desplegable -->
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
        </div>
    </div>
</header>
<script>
    <?php include "funciones.js"?>
</script>
<script>
    <?php include "cabecera.js"?>
</script>
<link rel="stylesheet" href="modulos/cabecera/cabecera.css">