<?php
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>titulo de la pagina</h1>



</main>

<?php
incluirTemplate('footer');
?>








if (!$precio) {
        $errores[] = 'Debes Añadir un Precio';
    }
    if (strlen($descripcion) < 50) {
        $errores[] = 'Debes Añadir una Descripcion y debe tener al menos 50 caracteres';
    }
    if (!$habitaciones) {
        $errores[] = 'Debes Añadir  Habitaciones';
    }
    if (!$wc) {
        $errores[] = 'Debes Añadir Baños';
    }
    if (!$estacionamiento) {
        $errores[] = 'Debes Añadir Estacionamientos';
    }
    if (!$vendedorId) {
        $errores[] = 'Elije un Vendedor';
    }
    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = 'La imagen es obligatoria';
    }

    // VALIDAR POR TAMAÑO LA IMAGEN

    $medida = 100000 * 100;

    if ($imagen['size'] > $medida) {
        $errores[] = 'La Imagen es muy Pesada';
    }