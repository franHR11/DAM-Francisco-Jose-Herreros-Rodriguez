<?php
// Determinar si estamos en admin para ajustar las rutas si no está definida la variable
if(!isset($rutaBase)) {
  $rutaBase = '';
  if (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) {
    // Estamos en alguna parte del admin
    if (strpos($_SERVER['SCRIPT_NAME'], '/admin/propiedades/ver-todas/') !== false || 
        strpos($_SERVER['SCRIPT_NAME'], '/admin/vendedores/ver-todos/') !== false ||
        strpos($_SERVER['SCRIPT_NAME'], '/admin/categorias/ver-todas/') !== false) {
      // Estamos en subcarpetas de nivel 3 (admin/propiedades/ver-todas/ o admin/vendedores/ver-todos/)
      $rutaBase = '../../../';
    } elseif (strpos($_SERVER['SCRIPT_NAME'], '/admin/propiedades/') !== false || 
              strpos($_SERVER['SCRIPT_NAME'], '/admin/vendedores/') !== false ||
              strpos($_SERVER['SCRIPT_NAME'], '/admin/categorias/') !== false ||
              strpos($_SERVER['SCRIPT_NAME'], '/admin/blog/') !== false) {
      // Estamos en admin/propiedades/ o admin/vendedores/ o admin/blog/
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