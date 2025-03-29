<?php
require '../../includes/app.php';

estaAutenticado();

// Importar clases
use App\BlogEntry;
use App\BlogCategory;
use Intervention\Image\ImageManagerStatic as Image;

// Validar el ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
    exit;
}

// Obtener la entrada a editar
$entrada = BlogEntry::find($id);

if (!$entrada) {
    header('Location: index.php');
    exit;
}

// Obtener categorías de blog
$categorias = BlogCategory::all();

// Arreglo con mensajes de errores
$errores = BlogEntry::getErrores();

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores
    $args = $_POST;
    
    // Guardar la imagen anterior antes de actualizar
    $imagen_anterior = $entrada->imagen;
    
    // Asignar los nuevos valores al objeto
    $entrada->titulo = $args['titulo'] ?? $entrada->titulo;
    $entrada->contenido = $args['contenido'] ?? $entrada->contenido;
    $entrada->categoria_id = $args['categoria_id'] ?? $entrada->categoria_id;
    $entrada->destacado = $args['destacado'] ?? $entrada->destacado;
    
    // Validación
    $errores = $entrada->validar();
    
    // Subida de archivos
    if ($_FILES['imagen']['tmp_name']) {
        // Generar un nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
        // Verificar que la clase Image está disponible
        if (class_exists('Intervention\Image\ImageManagerStatic')) {
            // Realizar un resize a la imagen con intervención
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
            $entrada->setImagen($nombreImagen);
        } else {
            // Si no existe la clase, simplemente almacenar el nombre
            $entrada->setImagen($nombreImagen);
        }
    }
    
    // Revisar que el array de errores esté vacío
    if (empty($errores)) {
        // Si hay una nueva imagen
        if ($_FILES['imagen']['tmp_name']) {
            // Crear carpeta de imágenes si no existe
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            
            // Guardar la imagen en el servidor
            if (isset($image) && class_exists('Intervention\Image\ImageManagerStatic')) {
                // Si tenemos intervención image, lo usamos
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            } else {
                // Si no, usamos move_uploaded_file
                move_uploaded_file($_FILES['imagen']['tmp_name'], CARPETA_IMAGENES . $nombreImagen);
            }
            
            // Eliminar imagen anterior (si existe)
            if ($imagen_anterior && file_exists(CARPETA_IMAGENES . $imagen_anterior)) {
                unlink(CARPETA_IMAGENES . $imagen_anterior);
            }
        } else {
            // Mantener la imagen anterior
            $entrada->imagen = $imagen_anterior;
        }
        
        // Guardar en la base de datos (actualizar)
        $resultado = $entrada->actualizar();
        
        if ($resultado) {
            // Redireccionar al usuario
            header('Location: index.php?resultado=2');
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
    <h1>Actualizar Entrada de Blog</h1>

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
            
            <?php if ($entrada->imagen): ?>
                <div class="imagen-actualizar">
                    <img src="<?php echo img_url($entrada->imagen); ?>" alt="Imagen de la entrada">
                </div>
            <?php endif; ?>

            <label for="categoria_id">Categoría:</label>
            <select name="categoria_id" id="categoria_id">
                <option value="" disabled>-- Seleccionar --</option>
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
            <textarea id="contenido" name="contenido" placeholder="Contenido del artículo"><?php echo sanitizar($entrada->contenido); ?></textarea>
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Actualizar Entrada" class="boton boton-verde">
        </div>
    </form>

    <div class="alinear-derecha">
        <a href="<?php echo url('/admin/blog/index.php'); ?>" class="boton boton-verde">Volver</a>
    </div>
</main>

<!-- SunEditor scripts -->
<script src="<?php echo url('/node_modules/suneditor/dist/suneditor.min.js'); ?>"></script>
<script src="<?php echo url('/build/js/suneditor-config.js'); ?>"></script>

<?php
incluirTemplate('footer');
?> 