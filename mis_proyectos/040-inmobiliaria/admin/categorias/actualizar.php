<?php
require '../../includes/app.php';

use App\Categoria;

estaAutenticado();

// Validar que el ID sea válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../');
    exit;
}

// Obtener los datos de la categoría
$categoria = Categoria::find($id);

if (!$categoria) {
    header('Location: ../');
    exit;
}

// Arreglo con mensajes de errores
$errores = Categoria::getErrores();

// Inicializar variables
$nombre = $categoria->nombre;

// Ejecuta el código después de que el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores
    $args = $_POST;
    
    // Sincronizar objeto en memoria
    $categoria->sincronizar($args);
    
    // Validar
    $errores = $categoria->validar();

    // Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        // Guardar los cambios
        $resultado = $categoria->actualizar();

        if ($resultado) {
            // Redireccionar al usuario
            header("Location: ../?resultado=2&tipo=categoria");
            exit;
        }
    }
}

incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Actualizar Categoría</h1>
    <a href="../" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario formulario-categoria" method="POST">
        <fieldset>
            <legend>Información de la Categoría</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre de la Categoría" value="<?php echo $nombre; ?>">
        </fieldset>

        <input type="submit" value="Actualizar Categoría" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?> 