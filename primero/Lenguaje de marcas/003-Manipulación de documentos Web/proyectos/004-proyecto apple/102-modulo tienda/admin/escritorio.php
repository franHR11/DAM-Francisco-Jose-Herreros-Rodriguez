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
                    <?php include "inc/menu.php"?>
                </ul>
            </nav>
            <section>
                <?php 
                if(isset($_GET['enlace'])) {
                    echo '<iframe src="'.htmlspecialchars($_GET['enlace']).'" 
                          style="width:100%; height:100%; border:none;"></iframe>';
                } else {
                    include "inc/tabla.php";
                    include "inc/formulario.php";
                }
                ?>
            </section>
        </main>
        <script src="js/codigo.js"></script>
    </body>
</html>

