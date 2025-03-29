<?php
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

// Validar que el ID sea válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../');
}

// Obtener los datos del vendedor
$vendedor = Vendedor::find($id);

// Array de mensajes de errores
$errores = Vendedor::getErrores();

// Ejecuta el código después de que el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores
    $args = $_POST;
    
    // Sincronizar objeto en memoria con lo que el usuario escribió
    $vendedor->sincronizar($args);

    // Validación
    $errores = $vendedor->validar();

    if (empty($errores)) {
        // Guardar los cambios
        $resultado = $vendedor->actualizar();

        if ($resultado) {
            // Redireccionar al usuario
            header('Location: ../?resultado=2&tipo=vendedor');
        }
    }
}

incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="../" class="boton boton-verde">Volver</a>

    <?php
    foreach ($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST">

        <fieldset>
            <legend>Información General</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre Vendedor" value="<?php
            echo $vendedor->nombre; ?>">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="Apellido Vendedor" value="<?php
            echo $vendedor->apellido; ?>">

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Teléfono Vendedor" value="<?php
            echo $vendedor->telefono; ?>">
        </fieldset>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">

    </form>
</main>

<?php
incluirTemplate('footer');
?> 