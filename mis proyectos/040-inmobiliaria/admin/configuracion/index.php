<?php
require '../../includes/app.php';

use App\SiteConfig;
// Eliminamos la importación de Intervention Image
// use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

// Comprobar si el servidor sirve correctamente SVG
$rutaSvgDeEjemplo = __DIR__ . '/../../imagenes/config/9320660273824f7a1689ca287e985a5d.svg';
if (file_exists($rutaSvgDeEjemplo)) {
    // Esta salida solo aparecerá en desarrollo, para depuración
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $svgMimeType = $finfo->file($rutaSvgDeEjemplo);
    
    if ($svgMimeType !== 'image/svg+xml') {
        // Si esto ocurre, el servidor no reconoce SVG correctamente
        $errores[] = "AVISO: El servidor está identificando los archivos SVG como '$svgMimeType' en lugar de 'image/svg+xml'";
    }
}

// Definir la ruta de las imágenes de configuración
$directorioBase = __DIR__ . '/../../imagenes/config/'; // Ruta relativa a este archivo
define('CARPETA_IMAGENES_CONFIG', $directorioBase);

// Para depuración
$crearDirectorio = !is_dir(CARPETA_IMAGENES_CONFIG);
if ($crearDirectorio) {
    $resultado = mkdir(CARPETA_IMAGENES_CONFIG, 0755, true);
    // Si hay problemas creando el directorio, mostrar un error
    if (!$resultado) {
        $errores[] = "Error: No se pudo crear el directorio " . CARPETA_IMAGENES_CONFIG . ". Verifica los permisos de escritura.";
    }
}

// Intentar cargar la configuración existente (siempre ID 1)
$config = SiteConfig::find(1);

// Si no existe la fila 1 (primera vez), crear una instancia vacía
if (!$config) {
    $config = new SiteConfig(['id' => 1]);
    // Opcional: podríamos insertar aquí la fila 1 si la creación de la tabla no lo hizo
}

// Arreglo con mensajes de errores
$errores = SiteConfig::getErrores();

// Ejecutar el código después de que el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Cargar configuración actual para obtener nombres de archivos viejos si existen
    // $config ya debería estar cargado desde antes del if.
    if (!$config) $config = new SiteConfig(['id' => 1]); // Por si acaso

    // Sincronizar el objeto $config con los datos del POST
    $config->sincronizar($_POST);

    // Validación (ahora valida los datos sincronizados)
    $errores = $config->validar();

    // Variables para nombres de archivo viejos (usar las propiedades del objeto sincronizado)
    $logoViejo = $config->logo_filename ?? '';
    $headerViejo = $config->header_image_filename ?? '';

    // Variables para almacenar información de las nuevas imágenes
    $nombreImagenLogo = $logoViejo; // Nombre final a guardar (inicialmente el viejo)
    $rutaTemporalLogo = null;
    
    $nombreImagenHeader = $headerViejo; // Nombre final a guardar (inicialmente el viejo)
    $rutaTemporalHeader = null;

    // --- Manejo de subida de Logo ---
    if (isset($_FILES['logo']) && $_FILES['logo']['tmp_name']) {
        $logoFile = $_FILES['logo'];
        $extensionLogo = strtolower(pathinfo($logoFile['name'], PATHINFO_EXTENSION));
        
        // Verificamos formatos aceptados (jpg, png, gif, svg)
        if (in_array($extensionLogo, ['jpg', 'jpeg', 'png', 'gif', 'svg'])) {
            $nombreImagenLogo = md5(uniqid(rand(), true)) . "." . $extensionLogo;
            $rutaTemporalLogo = $logoFile['tmp_name'];
            // Ya no llamamos a $config->setLogo aquí, el nombre se asignará al objeto $config más adelante si la subida es exitosa.
        } else {
            $errores[] = "Formato de logo no válido (solo JPG, PNG, GIF, SVG).";
            $nombreImagenLogo = $logoViejo; // Revertir al viejo si el formato es inválido
            // No necesitamos $config->setLogo($logoViejo); aquí, la sincronización inicial ya mantuvo el valor viejo.
        }
    } else {
        // Si no se subió archivo, no hacemos nada aquí. $config ya tiene el valor viejo por la sincronización.
    }

    // --- Manejo de subida de Header Image ---
    if (isset($_FILES['header_image']) && $_FILES['header_image']['tmp_name']) {
        $headerImageFile = $_FILES['header_image'];
        $extensionHeader = strtolower(pathinfo($headerImageFile['name'], PATHINFO_EXTENSION));

        // Verificamos formatos aceptados (jpg, png, gif, svg)
        if (in_array($extensionHeader, ['jpg', 'jpeg', 'png', 'gif', 'svg'])) {
            $nombreImagenHeader = md5(uniqid(rand(), true)) . "." . $extensionHeader;
            $rutaTemporalHeader = $headerImageFile['tmp_name'];
            // Ya no llamamos a $config->setHeaderImage aquí.
        } else {
            $errores[] = "Formato de imagen de cabecera no válido (solo JPG, PNG, GIF, SVG).";
            $nombreImagenHeader = $headerViejo;
            // No necesitamos $config->setHeaderImage($headerViejo); aquí.
        }
    } else {
        // Si no se subió archivo, no hacemos nada aquí.
    }

    // Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        // Crear carpeta si no existe
        if (!is_dir(CARPETA_IMAGENES_CONFIG)) {
            mkdir(CARPETA_IMAGENES_CONFIG, 0755, true);
        }

        // ASIGNAR NOMBRES DE ARCHIVO AL OBJETO ANTES DE GUARDAR
        // Solo si se generó un nombre nuevo (lo que implica subida válida)
        if ($nombreImagenLogo !== $logoViejo) {
            $config->logo_filename = $nombreImagenLogo;
        }
        if ($nombreImagenHeader !== $headerViejo) {
            $config->header_image_filename = $nombreImagenHeader;
        }

        // Guardar las imágenes NUEVAS en el servidor
        $logoGuardado = true;
        $headerGuardado = true;

        // Guardar Logo si se subió nuevo
        if ($rutaTemporalLogo && $nombreImagenLogo !== $logoViejo) {
            $logoGuardado = move_uploaded_file($rutaTemporalLogo, CARPETA_IMAGENES_CONFIG . $nombreImagenLogo);
            if (!$logoGuardado) {
                $errores[] = "Error al guardar el logo. Ruta: " . CARPETA_IMAGENES_CONFIG . $nombreImagenLogo;
            }
        }

        // Guardar Header Image si se subió nueva
        if ($rutaTemporalHeader && $nombreImagenHeader !== $headerViejo) {
            $headerGuardado = move_uploaded_file($rutaTemporalHeader, CARPETA_IMAGENES_CONFIG . $nombreImagenHeader);
            if (!$headerGuardado) {
                $errores[] = "Error al guardar la imagen de cabecera. Ruta: " . CARPETA_IMAGENES_CONFIG . $nombreImagenHeader;
            }
        }
        
        // Si las imágenes se guardaron correctamente, proceder a guardar en BD y eliminar viejas
        if($logoGuardado && $headerGuardado) {
            
            // DEBUG: Verificar el contenido de los atributos antes de guardar
            if (empty($config->atributos())) {
                $errores[] = "Error: No hay datos para guardar. Verifica que todos los campos necesarios estén completos.";
            } else {
                // Guardar la configuración en la base de datos
                $resultado = $config->guardar(); 

                if ($resultado) {
                    // Éxito al guardar en BD, ahora eliminar imágenes viejas si eran diferentes
                    if ($rutaTemporalLogo && $logoViejo && $logoViejo !== $nombreImagenLogo && file_exists(CARPETA_IMAGENES_CONFIG . $logoViejo)) {
                        unlink(CARPETA_IMAGENES_CONFIG . $logoViejo);
                    }
                    if ($rutaTemporalHeader && $headerViejo && $headerViejo !== $nombreImagenHeader && file_exists(CARPETA_IMAGENES_CONFIG . $headerViejo)) {
                        unlink(CARPETA_IMAGENES_CONFIG . $headerViejo);
                    }

                    // Redireccionar con mensaje de éxito
                    header("Location: ./index.php?resultado=1");
                    exit;
                }
            }
        } else {
            $errores[] = "Error al guardar una de las imágenes nuevas en el servidor.";
            // NO necesitamos revertir $config->setLogo/setHeaderImage aquí porque 
            // los nombres solo se asignaron justo antes del if(empty($errores))
            // y si llegamos aquí, no se intentará el ->guardar() de todas formas.
        }
    }
}

incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<style>
    .imagen-small {
        max-width: 300px;
        max-height: 100px;
        object-fit: contain;
        margin: 10px 0;
        border: 1px solid #e1e1e1;
        padding: 5px;
    }
    /* Estilos mejorados para SVG */
    .imagen-small[src$=".svg"] {
        background-color: #f9f9f9;
        background-image: linear-gradient(45deg, #e1e1e1 25%, transparent 25%, transparent 75%, #e1e1e1 75%, #e1e1e1),
                          linear-gradient(45deg, #e1e1e1 25%, transparent 25%, transparent 75%, #e1e1e1 75%, #e1e1e1);
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
        padding: 10px;
        min-height: 60px;
        width: 100%;
        max-width: 300px;
    }
    .imagen-thumbnail {
        max-width: 300px;
        max-height: 300px;
        object-fit: cover;
        margin: 10px 0;
        border: 1px solid #e1e1e1;
        padding: 5px;
    }
    /* Estilos mejorados para SVG de cabecera */
    .imagen-thumbnail[src$=".svg"] {
        background-color: #f9f9f9;
        background-image: linear-gradient(45deg, #e1e1e1 25%, transparent 25%, transparent 75%, #e1e1e1 75%, #e1e1e1),
                          linear-gradient(45deg, #e1e1e1 25%, transparent 25%, transparent 75%, #e1e1e1 75%, #e1e1e1);
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
        padding: 10px;
        min-height: 150px;
        width: 100%;
    }
    .imagen-actual {
        margin-bottom: 15px;
    }
    .imagen-actual p {
        margin-bottom: 5px;
        font-weight: bold;
    }
    .help-text {
        color: #666;
        font-size: 0.8rem;
        margin-top: 0;
    }
</style>

<main class="contenedor seccion">
    <h1>Configuración General del Sitio</h1>

    <?php if(isset($_GET['resultado']) && $_GET['resultado'] == 1): ?>
        <p class="alerta exito">Configuración actualizada correctamente</p>
    <?php endif; ?>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include 'formulario.php'; ?>
        <input type="submit" value="Guardar Configuración" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?> 