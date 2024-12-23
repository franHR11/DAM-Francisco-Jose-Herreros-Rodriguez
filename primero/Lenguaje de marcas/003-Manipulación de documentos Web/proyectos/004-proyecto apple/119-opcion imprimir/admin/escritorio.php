<?php include "utilidades/error.php"?>
<!doctype html>
<html>
    <head>
        <link rel="Stylesheet" href="estilo/escritorio.css">
    </head>
    <body>
        <header><h1>PCprogramacion | Administracion</h1></header>
        <main>
            <nav>
                <ul>
                    <li class='menu-section-title'>TABLAS</li>
                    <?php include "inc/menu.php"?>
                    <li class='menu-section-title'>DOCUMENTOS</li>
                    <?php include "inc/listadodocumentos.php"?>
                    <li class='menu-section-title'>ENLACES PERSONALIZADOS</li>
                    <?php include "inc/enlacespersonalizados.php"?>
                </ul>
            </nav>
            <section>
                <?php 
                include "inc/tabla.php";
                include "inc/formulario.php";   
                include "inc/documento.php";
                include "inc/documentos.php";
                ?>
            </section>
        </main>
        <script src="js/codigo.js"></script>
    </body>
</html>

