<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: index.html");
}
 include "utilidades/error.php"
 ?>
<!doctype html>
<html>
    <head>
        <link rel="Stylesheet" href="estilo/escritorio.css">
        <link rel="icon" href="../admin/img/logo.svg" type="image/svg+xml">
    </head>
    <body>
        <header><h1><img src="../admin/img/logo.svg" id="logo">PCprogramacion | Administracion</h1>
        <a href="logout.php">⛔</a>
    </header>
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

