<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

estaAutenticado();

// validar que el id sea valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../');
}

// Base de datos
$db = conectarDB();

// Obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = {$id}";
$resultado = mysqli_query($db, $consulta);
$propiedadData = mysqli_fetch_assoc($resultado);

// Verificar que la propiedad exista
if (!$propiedadData) {
    header('Location: ../');
}

// consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// arreglo mensaje de errores
$errores = [];

// Inicializar variables con los valores de la base de datos
$titulo = $propiedadData["titulo"];
$precio = $propiedadData["precio"];
$descripcion = $propiedadData["descripcion"];
$habitaciones = $propiedadData["habitaciones"];
$wc = $propiedadData["wc"];
$estacionamiento = $propiedadData["estacionamiento"];
$vendedorId = $propiedadData["vendedorId"];
$imagenPropiedad = $propiedadData["imagen"];
$destacado = $propiedadData["destacado"];
$categoria_id = $propiedadData["categoria_id"];

// ejecuta el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
    $destacado = isset($_POST['destacado']) ? 1 : 0;
    $categoria_id = $_POST['categoria_id'] ?? '';
    $creado = date('Y/m/d');

    // ASIGNAR FILES HACIA UNA VARIABLE
    $imagen = $_FILES['imagen'];

    // Validar
    if (!$titulo) {
        $errores[] = 'Debes Añadir un Titulo';
    }
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

    // VALIDAR POR TAMAÑO LA IMAGEN
    $medida = 100000 * 100;
    if ($imagen['size'] > $medida) {
        $errores[] = 'La Imagen es muy Pesada';
    }

    $nombreImagen = '';

    // revisar que el arreglo de errores este vacio
    if (empty($errores)) {
        // crear $carpetaImagenes
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Subida de archivos
        if ($imagen['name']) {
            // Eliminar imagen anterior
            if (file_exists($carpetaImagenes . $propiedadData['imagen'])) {
                unlink($carpetaImagenes . $propiedadData['imagen']);
            }

            // Generar un nombre unico para la Imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
            // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedadData['imagen'];
        }

        // Construir la consulta SQL
        // Manejar correctamente el valor NULL para categoria_id
        if (empty($categoria_id)) {
            $categoria_id_sql = "NULL"; // Sin comillas en la consulta SQL
        } else {
            $categoria_id_sql = intval($categoria_id);
        }
        
        $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = {$precio}, imagen = '{$nombreImagen}', 
                  descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, 
                  estacionamiento = {$estacionamiento}, vendedorId = {$vendedorId},
                  destacado = {$destacado}, categoria_id = " . $categoria_id_sql . " WHERE id = {$id}";

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            // Redireccionar al usuario
            header("Location: ../?resultado=2");
            exit;
        } else {
            // Si hay un error en la consulta, mostrarlo
            $errores[] = "Error al actualizar: " . mysqli_error($db);
        }
    }
}

incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<!-- Enlace a los estilos de SunEditor -->
<link href="../../node_modules/suneditor/dist/css/suneditor.min.css" rel="stylesheet">

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="../" class="boton boton-verde">Volver</a>
    <?php
    foreach ($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>


    <form class="formulario" method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php
            echo $titulo; ?>">


            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php
            echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/webp">
            <img src="../../imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-actualizar">



            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php
            echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Numero Habitaciones:</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" value="<?php
            echo $habitaciones; ?>">

            <label for="wc">Numero Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" value="<?php
            echo $wc; ?>">

            <label for="estacionamiento">Numero Estacionamientos:</label>
            <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" value="<?php
            echo $estacionamiento; ?>">
            
            <div class="checkbox-destacado">
                <label for="destacado">¿Mostrar en la página principal?</label>
                <input type="checkbox" id="destacado" name="destacado" value="1" <?php echo $destacado == 1 ? 'checked' : ''; ?>>
            </div>
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId" value="<?php
            echo $vendedorId; ?>">
                <option value="">-- Seleccione --</option>
                <?php
                while ($vendedor = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php
                    echo $vendedorId === $vendedor['id'] ? 'selected' : '';
                    ?> value="<?php
                     echo $vendedor['id'];
                     ?>"><?php
                     echo $vendedor['nombre'] . " " . $vendedor['apellido'];
                     ?></option>
                    <?php
                endwhile;
                ?>
            </select>
        </fieldset>
        
        <fieldset>
            <legend>Categoría</legend>
            <?php
            $consulta_categorias = "SELECT * FROM categorias";
            $resultado_categorias = mysqli_query($db, $consulta_categorias);
            ?>
            
            <select name="categoria_id">
                <option value="">-- Seleccione --</option>
                <?php while ($categoria = mysqli_fetch_assoc($resultado_categorias)): ?>
                    <option <?php echo $categoria_id == $categoria['id'] ? 'selected' : ''; ?> 
                            value="<?php echo $categoria['id']; ?>">
                        <?php echo $categoria['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>


</main>

<!-- SunEditor scripts -->
<script src="../../node_modules/suneditor/dist/suneditor.min.js"></script>
<script src="../../build/js/suneditor-config.js"></script>

<?php
incluirTemplate('footer');
?>