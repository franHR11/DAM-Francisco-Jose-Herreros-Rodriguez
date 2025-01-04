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
        <!-- Incluir el editor una sola vez aquí -->
        <link rel="stylesheet" href="snow/jocarsa-snow.css">
        <script src="snow/jocarsa-snow.js"></script>
        <style>
            .table-responsive {
                overflow-x: auto;
            }
            
            .table td {
                max-width: 100px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                position: relative;
            }

            .table td:hover {
                overflow: visible;
                white-space: normal;
                min-width: 200px;
                z-index: 1;
            }

            .table td:hover::after {
                content: attr(title);
                position: absolute;
                left: 0;
                top: 0;
                background: white;
                padding: 5px;
                border: 1px solid #ddd;
                box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
                border-radius: 4px;
                min-width: 200px;
                max-width: 400px;
                word-wrap: break-word;
                z-index: 2;
            }
        </style>
        <script>
        let editorsInitialized = false;
        
        window.addEventListener('load', function() {
            if (!editorsInitialized) {
                document.querySelectorAll('textarea.snow-editor').forEach(textarea => {
                    if (!textarea.closest('.jocarsa-snow-editor-container')) {
                        jocarsaSnow.createEditor(textarea);
                    }
                });
                editorsInitialized = true;
            }
        });
        </script>
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

