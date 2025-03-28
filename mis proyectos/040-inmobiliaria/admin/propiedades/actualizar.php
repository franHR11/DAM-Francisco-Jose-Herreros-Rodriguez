<?php
require '../../includes/funciones.php';

$auth = estaAutenticado();
if(!$auth){
    header('location: ../../');
}
// echo"<pre>";
// var_dump($_GET);
// echo "</pre>";


// validar que el id sea valido

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if ($id === false) {
    header('Location: ../');
}

// Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

// consultar para obtener las propiedades

$consulta = "SELECT * FROM propiedades WHERE id = {$id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

// consultar para obtener los vendedores

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// arrego mensaje de errores
$errores = [];

$titulo = $propiedad["titulo"];
$precio = $propiedad["precio"];
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$vendedorId = $propiedad["vendedorId"];
$imagenPropiedad = $propiedad["imagen"];


// ejecuta el codigo despues de que el usuario envia el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo'<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    // echo'<pre>';
    // var_dump($_FILES);
    // echo '</pre>';



    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    // ASIGNAR FILES HACIA UNA VARIABLE

    $imagen = $_FILES['imagen'];





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

    // echo'<pre>';
    // var_dump($errores);
    //echo '</pre>';

    // revisar que el arreglo de errores este vacio

    if (empty($errores)) {

        // crear $carpetaImagenes
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes, );
        }

        // // Subida de archivos
        if ($imagen['name']) {

            unlink($carpetaImagenes . $propiedad['imagen']);

            // // generar un nombre unico para la Imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
            // // Subir la imagen 
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        }else{
            $nombreImagen = $propiedad['imagen'];
        }


        // insertar en la base de datos

        $query = " UPDATE propiedades SET titulo = '{$titulo}',Precio = {$precio}, imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedorId = {$vendedorId} WHERE id= {$id}";

        // echo $query;


        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            // redireccionar al usuario
            header("Location:../../admin?resultado=2");
        }
    }
}


incluirTemplate('header');
?>

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
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor" value="<?php
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

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>


</main>

<?php
incluirTemplate('footer');
?>