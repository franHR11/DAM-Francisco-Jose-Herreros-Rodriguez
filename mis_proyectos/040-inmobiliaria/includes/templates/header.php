<?php
if(!isset($_SESSION)){
  session_start();
}

$auth = $_SESSION["login"] ?? false;

// Obtener configuración del sitio
use App\SiteConfig; // Asegurar que el namespace está disponible
$config = SiteConfig::find(1); // Cargar configuración ID 1

// Determinar si estamos en admin para ajustar las rutas
$rutaBase = '';
if (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) {
  // Estamos en alguna parte del admin
  if (strpos($_SERVER['SCRIPT_NAME'], '/admin/propiedades/ver-todas/') !== false || 
      strpos($_SERVER['SCRIPT_NAME'], '/admin/vendedores/ver-todos/') !== false ||
      strpos($_SERVER['SCRIPT_NAME'], '/admin/categorias/ver-todas/') !== false ||
      strpos($_SERVER['SCRIPT_NAME'], '/admin/blog/ver-todas/') !== false ||
      strpos($_SERVER['SCRIPT_NAME'], '/admin/blog/categorias/') !== false) {
    // Estamos en subcarpetas de nivel 3
    $rutaBase = '../../../';
  } elseif (strpos($_SERVER['SCRIPT_NAME'], '/admin/propiedades/') !== false || 
            strpos($_SERVER['SCRIPT_NAME'], '/admin/vendedores/') !== false ||
            strpos($_SERVER['SCRIPT_NAME'], '/admin/categorias/') !== false ||
            strpos($_SERVER['SCRIPT_NAME'], '/admin/blog/') !== false ||
            strpos($_SERVER['SCRIPT_NAME'], '/admin/mensajes/') !== false ||
            strpos($_SERVER['SCRIPT_NAME'], '/admin/configuracion/') !== false) {
    // Estamos en admin/[carpeta]/ (nivel 2)
    $rutaBase = '../../';
  } else {
    // Estamos en admin/ (primer nivel)
    $rutaBase = '../';
  }
}

?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo sanitizar(obtenerPropiedad($config, 'site_name', 'Inmobiliaria')); ?> <?php echo isset($pageTitle) ? ' - ' . sanitizar($pageTitle) : ''; ?></title>
    <meta name="description" content="<?php echo sanitizar(obtenerPropiedad($config, 'meta_description', '')); ?>">
    <link rel="stylesheet" href="<?php echo $rutaBase; ?>build/css/app.css" />

    <?php
    // Comprobamos si estamos en la página inicial y existe una imagen de cabecera
    $headerImagen = obtenerPropiedad($config, 'header_image_filename');
    if ($inicio && !empty($headerImagen)): 
    ?>
    <style>
      .header.inicio {
        background-image: url('<?php echo $rutaBase; ?>imagenes/config/<?php echo sanitizar($headerImagen); ?>') !important;
        background-size: cover;
        background-position: center center;
      }
      /* Comentario para depuración */
      /* Ruta imagen cabecera: <?php echo $rutaBase; ?>imagenes/config/<?php echo sanitizar($headerImagen); ?> */
    </style>
    <?php endif; ?>

  </head>
  <body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
      <div class="contenedor contenido-header">
        <div class="barra">
          <a href="<?php echo $rutaBase; ?>index.php">
            <?php 
            $logoImagen = obtenerPropiedad($config, 'logo_filename');
            if (!empty($logoImagen)): 
            ?>
              <img src="<?php echo $rutaBase; ?>imagenes/config/<?php echo sanitizar($logoImagen); ?>" alt="Logotipo <?php echo sanitizar(obtenerPropiedad($config, 'site_name', 'Inmobiliaria')); ?>" />
              <!-- Ruta logo: <?php echo $rutaBase; ?>imagenes/config/<?php echo sanitizar($logoImagen); ?> -->
            <?php else: ?>
              <img src="<?php echo $rutaBase; ?>build/img/logo.svg" alt="Logotipo por defecto" />
            <?php endif; ?>
          </a>



          <div class="mobile-menu">

            <img src="<?php echo $rutaBase; ?>build/img/barras.svg" alt="icono menu responsive">
          </div>


          <div class="derecha">
<img src="<?php echo $rutaBase; ?>build/img/dark-mode.svg" alt="modo oscuro" class="dark-mode-boton">
            <nav class="navegacion">
              <a href="<?php echo $rutaBase; ?>nosotros.php">Nosotros</a>
              <a href="<?php echo $rutaBase; ?>anuncios.php">Anuncios</a>
              <a href="<?php echo $rutaBase; ?>blog.php">Blog</a>
              <a href="<?php echo $rutaBase; ?>contacto.php">Contacto</a>
              <?php if($auth) : ?>
                <a href="<?php echo $rutaBase; ?>cerrar-sesion.php">Cerrar Sesion</a>
              <?php endif; ?>
              <?php if(!$auth) : ?>
                <a href="<?php echo $rutaBase; ?>login.php">Iniciar Sesion</a>
              <?php endif; ?>
              <?php if($auth) : ?>
                <a href="<?php echo $rutaBase; ?>admin/index.php">Admin</a>
              <?php endif; ?>
                
              
            </nav>
          </div>
        </div>

<?php
  if($inicio){
    echo '<h1>Venta de Casas y Apartamentos Exclusivos de Lujo</h1>';
    
  }
?>


      </div>
    </header>