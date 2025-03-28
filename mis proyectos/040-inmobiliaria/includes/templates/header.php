<?php
if(!isset($_SESSION)){
  session_start();
}

$auth = $_SESSION["login"] ?? false;

?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inmobiliaria</title>
    <link rel="stylesheet" href="/build/css/app.css" />
  </head>
  <body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
      <div class="contenedor contenido-header">
        <div class="barra">
          <a href="/">
            <img src="/build/img/logo.svg" alt="Logotipo Inmobiliaria" />
          </a>



          <div class="mobile-menu">

            <img src="/build/img/barras.svg" alt="icono menu responsive">
          </div>


          <div class="derecha">
<img src="/build/img/dark-mode.svg" alt="modo oscuro" class="dark-mode-boton">
            <nav class="navegacion">
              <a href="nosotros.php">Nosotros</a>
              <a href="anuncios.php">Anuncios</a>
              <a href="blog.php">Blog</a>
              <a href="contacto.php">Contacto</a>
              <?php if($auth) : ?>
                <a href="cerrar-sesion.php">Cerrar Sesion</a>
              <?php endif; ?>
              <?php if(!$auth) : ?>
                <a href="login.php">Iniciar Sesion</a>
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