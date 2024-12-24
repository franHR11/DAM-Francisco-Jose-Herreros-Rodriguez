<head>
    <?php 
        include "inc/errores.php"; 
        include "inc/cabeza.php"; 
    ?>
</head>

<?php

if(isset($_GET['prod'])){
    echo '
    <a href="tienda.php?prod='.$_GET['prod'].'">
   <button class="icono_boton" aria-label="Añadir al carrito">
            <span class="iconify" data-icon="mdi:cart" data-width="24" data-height="24" style="color: white;"></span>
    </button>
    </a>
    ';
}
?>
<style>
    <?php include "tienda.css"?>
</style>