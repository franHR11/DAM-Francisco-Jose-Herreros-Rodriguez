<?php
require '../../../includes/app.php';

use App\BlogCategory; // Cambiar a BlogCategory

estaAutenticado();

// Validar que el ID sea válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../'); // Mantener la redirección al listado de categorias de blog?
    exit;
}

// Obtener los datos de la categoría de blog
$categoria = BlogCategory::find($id);

if (!$categoria) {
    header('Location: ../'); // Mantener la redirección al listado de categorias de blog?
    exit;
}

// Arreglo con mensajes de errores
$errores = BlogCategory::getErrores();

// Inicializar variables desde el objeto
$nombre = $categoria->nombre;
$descripcion = $categoria->descripcion;

// Ejecuta el código después de que el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores directamente al objeto
    $categoria->nombre = $_POST['nombre'] ?? '';
    $categoria->descripcion = $_POST['descripcion'] ?? '';
    
    // Validar
    $errores = $categoria->validar();

    // Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        // Guardar los cambios
        $resultado = $categoria->guardar(); // guardar() debería manejar la actualización

        if ($resultado) {
            // Redireccionar al usuario al listado de categorías de blog
            header("Location: ../?resultado=2"); // Usar ../ que debería ser admin/blog/categorias/index.php
            exit;
        }
    } else {
        // Si hay errores, los valores ya están asignados al objeto para repoblar el formulario
        // (No es necesario reasignar $nombre y $descripcion aquí si el formulario usa $categoria->...)
        // $nombre = $args['nombre'] ?? $categoria->nombre;
        // $descripcion = $args['descripcion'] ?? $categoria->descripcion;
    }
}

incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Actualizar Categoría de Blog</h1>
    <a href="../" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <!-- Usar un formulario que podría incluir nombre y descripción -->
    <form class="formulario" method="POST">
        <?php include 'formulario.php'; // Asegurarse que este formulario usa $categoria->nombre y $categoria->descripcion ?>
        <input type="submit" value="Actualizar Categoría" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?> 