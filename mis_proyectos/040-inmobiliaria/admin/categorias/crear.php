<?php
require '../../includes/app.php';

use App\Categoria;

estaAutenticado();

// Base de datos
$db = conectarDB();

// Errores
$errores = Categoria::getErrores();

// Inicializar variables
$nombre = '';

// Ejecuta el código después de que el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una nueva instancia
    $categoria = new Categoria($_POST);

    // Validar
    $errores = $categoria->validar();

    // Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        // Guardar en la base de datos
        $resultado = $categoria->guardar();

        if ($resultado) {
            // Redireccionar al usuario
            header("Location: ../?resultado=1&tipo=categoria");
            exit;
        }
    } else {
        // Mantener los valores si hay errores
        $nombre = $categoria->nombre;
    }
}

incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Crear Categoría</h1>
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

        <input type="submit" value="Crear Categoría" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?> 