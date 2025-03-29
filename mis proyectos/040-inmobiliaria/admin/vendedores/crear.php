<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

// Base de datos
$db = conectarDB();

// Array de mensajes de errores
$errores = Vendedor::getErrores();

// Variables para mantener los valores del formulario
$nombre = '';
$apellido = '';
$telefono = '';

// Ejecuta el código después de que el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guardar los valores enviados para mantenerlos en el formulario si hay error
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    
    // Crear una nueva instancia de Vendedor
    $vendedor = new Vendedor($_POST);
    
    // Validar los datos
    $errores = $vendedor->validar();

    // Revisar que el array de errores esté vacío
    if (empty($errores)) {
        // Guardar en la base de datos
        $resultado = $vendedor->guardar();
        
        if ($resultado) {
            // Redireccionar al usuario
            header("Location: ../?resultado=1&tipo=vendedor");
            exit;
        }
    }
}

$nombrePagina = 'crear vendedor';
incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="../" class="boton boton-verde">Volver</a>
    
    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="crear.php" class="formulario" method="POST">
        <fieldset>
            <legend>Información General</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre Vendedor" value="<?php echo $nombre; ?>">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="Apellido Vendedor" value="<?php echo $apellido; ?>">

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Teléfono Vendedor" value="<?php echo $telefono; ?>">
        </fieldset>

        <input type="submit" value="Crear Vendedor" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?> 