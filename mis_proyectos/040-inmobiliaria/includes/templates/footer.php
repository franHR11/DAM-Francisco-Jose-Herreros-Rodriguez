<?php
use App\SiteConfig;

// Cargar configuración del sitio si aún no existe
if (!isset($config)) {
    $config = SiteConfig::find(1);
}

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
      <div class="contenedor contenedor-footer">
        <nav class="navegacion">
          <a href="<?php echo $rutaBase; ?>nosotros.php">Nosotros</a>
          <a href="<?php echo $rutaBase; ?>anuncios.php">Anuncios</a>
          <a href="<?php echo $rutaBase; ?>blog.php">Blog</a>
          <a href="<?php echo $rutaBase; ?>contacto.php">Contacto</a>
        </nav>
        
        <?php if (isset($config)): ?>
        <div class="info-empresa">
            <div class="columna-datos">
                <h4><?php echo sanitizar($config->company_name ?? 'Empresa Inmobiliaria'); ?></h4>
                <p><?php echo sanitizar($config->address ?? 'Dirección no especificada'); ?></p>
                <p><?php echo sanitizar($config->city ?? 'Ciudad no especificada'); ?>, <?php echo sanitizar($config->zip_code ?? 'CP no especificado'); ?></p>
            </div>
            <div class="columna-horario">
                <h5>Horario</h5>
                <p><?php echo sanitizar($config->opening_hours ?? 'Horario no disponible'); ?></p>
                <?php if (property_exists($config, 'closing_hours') && !empty($config->closing_hours)): ?>
                    <p><?php echo sanitizar($config->closing_hours); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
      </div>

      <p class="copyright">Todos los derechos reservados <?php echo date ( 'Y');  ?> &copy;</p>
    </footer> 
    <script src="<?php echo $rutaBase; ?>build/js/bundle.min.js"></script>
    </body>

</html>