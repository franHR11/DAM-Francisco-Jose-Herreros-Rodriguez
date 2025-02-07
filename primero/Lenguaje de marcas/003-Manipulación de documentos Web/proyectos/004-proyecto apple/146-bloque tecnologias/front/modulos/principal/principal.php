<?php
/**
 * @webblock Principal
 * @author FranHR
 * @description Módulo principal que actúa como contenedor y gestiona la inclusión
 * de los submódulos de la página: oferta, heroes, destacados, carrusel y descargo.
 * Este archivo orquesta la estructura principal del contenido de la página.
 */
?>
<main>
    <?php include "modulos/oferta/oferta.php" ?>
    <?php include "modulos/heroes/heroes.php" ?>
    <?php include "modulos/destacados/destacados.php" ?>
    <?php include "modulos/carrusel/carrusel.php" ?>
    <?php include "modulos/tecnologias/tecnologias.php"; ?>
    <?php include "modulos/descargo/descargo.php" ?>
</main>
