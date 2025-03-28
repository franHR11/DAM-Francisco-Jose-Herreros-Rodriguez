<?php
// Determinar si estamos en admin para ajustar las rutas si no está definida la variable
if(!isset($rutaBase)) {
  $rutaBase = '';
  if (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) {
    // Estamos en alguna parte del admin
    if (strpos($_SERVER['SCRIPT_NAME'], '/admin/propiedades/') !== false) {
      // Estamos en admin/propiedades/
      $rutaBase = '../../';
    } else {
      // Estamos en admin/ (primer nivel)
      $rutaBase = '../';
    }
  }
}
?>
<footer class="footer seccion">
      <div class="contendor contenedor-footer">
        <nav class="navegacion">
          <a href="<?php echo $rutaBase; ?>nosotros.php">Nosotros</a>
          <a href="<?php echo $rutaBase; ?>anuncios.php">Anuncios</a>
          <a href="<?php echo $rutaBase; ?>blog.php">Blog</a>
          <a href="<?php echo $rutaBase; ?>contacto.php">Contacto</a>
        </nav>
      </div>

      <p class="copyright">Todos los derechos reservados <?php echo date ( 'Y');  ?> &copy;</p>
    </footer> 
    <script src="<?php echo $rutaBase; ?>build/js/bundle.min.js"></script>
    </body>

</html>