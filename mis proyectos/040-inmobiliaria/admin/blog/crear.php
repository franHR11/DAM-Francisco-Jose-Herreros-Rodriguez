<?php
require '../../includes/app.php';

estaAutenticado();

// Importar clases
use App\BlogEntry;
use App\BlogCategory;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

// Obtener categorías de blog
$categorias = BlogCategory::all();

// Crear objeto de entrada
$entrada = new BlogEntry();

// Arreglo con mensajes de errores
$errores = BlogEntry::getErrores();

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una nueva instancia
    $entrada = new BlogEntry($_POST);
    
    // Generar un nombre único para la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Setear la imagen
    if ($_FILES['imagen']['tmp_name']) {
        $imagen = $_FILES['imagen']['tmp_name'];
        
        // Crear instancia del administrador de imágenes con driver GD
        $manager = new Image(Driver::class);
        // Realizar un resize a la imagen (en v3 se usa cover en lugar de fit)
        $image = $manager->read($imagen)->cover(800, 600);
        $entrada->setImagen($nombreImagen);
    }
    
    // Validar
    $errores = $entrada->validar();

    // Revisar que el array de errores esté vacío
    if (empty($errores)) {
        // Crear carpeta de imágenes
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        // Guardar la imagen en el servidor
        if (isset($_FILES['imagen']['tmp_name']) && $_FILES['imagen']['tmp_name']) {
            if (isset($image)) {
                // Guardar la imagen procesada con Intervention
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            } else {
                // Si por alguna razón no se procesó con Intervention, usar move_uploaded_file
                move_uploaded_file($_FILES['imagen']['tmp_name'], CARPETA_IMAGENES . $nombreImagen);
            }
        }

        // Guardar en la base de datos
        $resultado = $entrada->guardar();

        if ($resultado) {
            // Redireccionar al usuario
            header('Location: index.php?resultado=1');
        }
    }
}

// TEMPLATES
incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<!-- Enlace a los estilos de SunEditor -->
<link href="<?php echo url('/node_modules/suneditor/dist/css/suneditor.min.css'); ?>" rel="stylesheet">

<main class="contenedor seccion">
    <h1>Crear Nueva Entrada de Blog</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título de la entrada" value="<?php echo sanitizar($entrada->titulo); ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="categoria_id">Categoría:</label>
            <select name="categoria_id" id="categoria_id">
                <option value="" disabled selected>-- Seleccionar --</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria->id; ?>" <?php echo $entrada->categoria_id == $categoria->id ? 'selected' : ''; ?>>
                        <?php echo $categoria->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="destacado">¿Destacar en inicio?</label>
            <select name="destacado" id="destacado">
                <option value="0" <?php echo $entrada->destacado === '0' ? 'selected' : ''; ?>>No</option>
                <option value="1" <?php echo $entrada->destacado === '1' ? 'selected' : ''; ?>>Sí</option>
            </select>
        </fieldset>

        <fieldset>
            <legend>Contenido</legend>
            <label for="contenido">Contenido del artículo:</label>
            <textarea id="contenido" name="contenido" class="sun-editor" placeholder="Contenido del artículo"><?php echo sanitizar($entrada->contenido); ?></textarea>
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Entrada" class="boton boton-verde">
        </div>
    </form>

    <div class="alinear-derecha">
        <a href="<?php echo url('/admin/blog/index.php'); ?>" class="boton boton-verde">Volver</a>
    </div>
</main>

<!-- SunEditor scripts -->
<script src="<?php echo url('/node_modules/suneditor/dist/suneditor.min.js'); ?>"></script>
<!-- Incluir soporte de idiomas -->
<script>
    // Crear variable global para los idiomas
    var SUNEDITOR_LANG = {};
</script>
<!-- Archivo de idioma español para SunEditor -->
<script src="<?php echo url('/node_modules/suneditor/src/lang/es.js'); ?>"></script>
<!-- Configuración personalizada para SunEditor -->
<script src="<?php echo url('/build/js/suneditor-config.js'); ?>"></script>

<?php
incluirTemplate('footer');
?> 