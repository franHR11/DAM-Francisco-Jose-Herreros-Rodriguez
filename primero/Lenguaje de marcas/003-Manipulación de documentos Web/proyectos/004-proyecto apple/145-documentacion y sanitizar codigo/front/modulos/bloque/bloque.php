<?php
/**
 * Módulo de Bloques para Apple Website Clone
 * 
 * Este archivo actúa como el contenedor principal para los diferentes tipos de bloques
 * que componen la página web. Incluye la estructura HTML básica y carga los recursos
 * necesarios (CSS y JavaScript).
 * 
 * @author Francisco José Herreros Rodríguez
 * @version 1.0
 * @package AppleClone
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Módulo de bloques para Apple website clone">
    <title>Bloques - Apple Clone</title>
    <style><?php include "bloque.css"?></style>
</head>
<body>
    <?php include "Classes/Bloque.php"; ?>
    <script defer><?php include "bloque.js"?></script>
</body>
</html>