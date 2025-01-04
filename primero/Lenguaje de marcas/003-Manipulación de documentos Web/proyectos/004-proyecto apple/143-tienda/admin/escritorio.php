<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: index.html");
}
include "inc/calculapagina.php";
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
                if(isset($_GET['editar'])) {
                    include "inc/editar_form.php";
                } else {
                    include "inc/tabla.php";
                    include "inc/formulario.php";   
                    include "inc/documento.php";
                    include "inc/documentos.php";
                    if(isset($_GET['seccion']) && $_GET['seccion'] == 'imagenes') {
                        include "inc/gestor_imagenes.php";
                    }
                    if(isset($_GET['seccion']) && $_GET['seccion'] == 'info') {
                        include "inc/info.php";
                    }
                }
                ?>
            </section>
        </main>
        <script src="js/codigo.js"></script>
        <script src="js/table-sort-filter.js"></script>
    </body>
</html>

