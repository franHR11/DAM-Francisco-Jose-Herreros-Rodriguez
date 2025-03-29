<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;



estaAutenticado();

// Base de datos

$db = conectarDB();

// consultar para obtener los vendedores

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// arrego mensaje de errores

$errores = Propiedad::getErrores();

// Variables con valores por defecto
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
$destacado = false;
$categoria_id = '';


// ejecuta el codigo despues de que el usuario envia el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar los valores enviados
    $titulo = $_POST['titulo'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $habitaciones = $_POST['habitaciones'] ?? '';
    $wc = $_POST['wc'] ?? '';
    $estacionamiento = $_POST['estacionamiento'] ?? '';
    $vendedorId = $_POST['vendedorId'] ?? '';
    $destacado = isset($_POST['destacado']) && $_POST['destacado'] === '1';
    $categoria_id = $_POST['categoria_id'] ?? '';

    $propiedad = new Propiedad($_POST);

    // generar un nombre unico para la Imagen

    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

    if($_FILES['imagen']['tmp_name']){
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);
        $propiedad->setImagen($nombreImagen);
    }


    $errores = $propiedad->validar();

    // revisar que el arreglo de errores este vacio

    if (empty($errores)) {

        // Subida de archivos
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir($CARPETA_IMAGENES );
        }

        // guarda la imagen en el servidor

        $imagen->save(CARPETA_IMAGENES . $nombreImagen);

        $resultado = $propiedad->guardar();
        if ($resultado) {
            // redireccionar al usuario
            header("Location: ../?resultado=1");
            exit;
        }
    }
}

$nombrePagina = 'crear propiedades';
incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<!-- Enlace a los estilos de SunEditor -->
<link href="../../node_modules/suneditor/dist/css/suneditor.min.css" rel="stylesheet">

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="../" class="boton boton-verde">Volver</a>
    <?php
    foreach ($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>




    <?php endforeach; ?>




    <form action="crear.php" class="formulario" method="POST" enctype="multipart/form-data">

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
                <input type="checkbox" id="destacado" name="destacado" value="1" <?php echo $destacado ? 'checked' : ''; ?>>
            </div>
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId">
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

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>


</main>

<!-- SunEditor scripts -->
<script src="../../node_modules/suneditor/dist/suneditor.min.js"></script>
<script src="../../build/js/suneditor-config.js"></script>

<?php
incluirTemplate('footer');
?>