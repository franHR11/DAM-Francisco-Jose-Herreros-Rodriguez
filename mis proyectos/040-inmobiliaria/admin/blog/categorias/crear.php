<?php
require '../../../includes/app.php';

estaAutenticado();

// Importar Clases
use App\BlogCategory;

// Inicializar categoría y errores
$categoria = new BlogCategory;
$errores = BlogCategory::getErrores();

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una nueva instancia con los datos del POST
    $categoria = new BlogCategory($_POST['categoria'] ?? []); // Asumiendo que los inputs están en un array 'categoria'

    // Validar
    $errores = $categoria->validar();

    // Si no hay errores, guardar
    if (empty($errores)) {
        $resultado = $categoria->guardar();

        if ($resultado) {
            // Redireccionar con mensaje de éxito
            header('Location: ' . url('/admin/blog/categorias/index.php?resultado=1'));
            exit; // Es importante salir después de redirigir
        }
    }
}

// TEMPLATES
incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Crear Nueva Categoría de Blog</h1>
    
    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario formulario-categoria" method="POST">
        <fieldset>
            <legend>Información de la Categoría</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="categoria[nombre]" placeholder="Nombre de la categoría" value="<?php echo sanitizar($categoria->nombre); ?>">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="categoria[descripcion]" placeholder="Descripción breve de la categoría"><?php echo sanitizar($categoria->descripcion); ?></textarea>
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Categoría" class="boton boton-verde">
        </div>
    </form>

    <div class="alinear-derecha">
        <a href="<?php echo url('/admin/blog/categorias/index.php'); ?>" class="boton boton-verde">Volver</a>
    </div>
</main>

<?php
incluirTemplate('footer');
?> 