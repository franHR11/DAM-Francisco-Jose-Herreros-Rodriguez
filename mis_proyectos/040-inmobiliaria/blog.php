<?php
require 'includes/app.php';
incluirTemplate('header');

use App\BlogEntry;
use App\BlogCategory;

// Obtener entradas del blog
$entradas = BlogEntry::all();

// Obtener categorías
$categorias = BlogCategory::all();
?>

<main class="contenedor seccion contenido-centrado">
  <h1>Nuestro Blog</h1>

  <div class="blog-contenedor">
    <div class="blog-main">
      <?php if(!empty($entradas)): ?>
        <!-- Mostrar entradas de la base de datos -->
        <?php foreach($entradas as $entrada): ?>
          <article class="entrada-blog">
            <div class="imagen">
              <?php if($entrada->imagen): ?>
                <img src="imagenes/<?php echo $entrada->imagen; ?>" loading="lazy" alt="Imagen de <?php echo $entrada->titulo; ?>" />
              <?php else: ?>
                <img src="build/img/blog1.webp" loading="lazy" alt="Imagen blog" />
              <?php endif; ?>
            </div>

            <div class="texto-entrada">
              <a href="entrada.php?id=<?php echo $entrada->id; ?>">
                <h4><?php echo $entrada->titulo; ?></h4>
                <p class="informacion-meta">
                  Escrito el: <span><?php echo date('d/m/Y', strtotime($entrada->creado)); ?></span> 
                  <?php 
                    // Obtener nombre de categoría
                    if($entrada->categoria_id) {
                      $db = conectarDB();
                      $query = "SELECT nombre FROM blog_categories WHERE id = {$entrada->categoria_id}";
                      $resultado = mysqli_query($db, $query);
                      $categoria = mysqli_fetch_assoc($resultado);
                      if($categoria) {
                        echo " | Categoría: <span>{$categoria['nombre']}</span>";
                      }
                    }
                  ?>
                </p>
                <p>
                  <?php 
                    // Mostrar extracto o generar uno del contenido
                    $extracto = substr(strip_tags($entrada->contenido), 0, 200);
                    echo $extracto . (strlen(strip_tags($entrada->contenido)) > 200 ? '...' : '');
                  ?>
                </p>
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Mostrar entradas estáticas si no hay entradas en la base de datos -->
        <article class="entrada-blog">
          <div class="imagen">
            <img src="build/img/blog1.webp" loading="lazy" alt="Imagen blog" />
          </div>

          <div class="texto-entrada">
            <a href="entrada.php">
              <h4>Terraza en el techo de tu casa</h4>
              <p class="informacion-meta">
                Escrito el: <span>24/03/2025</span> por: <span>FranHR</span>
              </p>
              <p>
                Consejos para contruir tu terraza en el techo de tu casa con los
                mejores materiales y ahorrando dinero
              </p>
            </a>
          </div>
        </article>

        <article class="entrada-blog">
          <div class="imagen">
            <img src="build/img/blog2.webp" loading="lazy" alt="Imagen blog" />
          </div>

          <div class="texto-entrada">
            <a href="entrada.php">
              <h4>Guia para la decoración de tu hogar</h4>
              <p class="informacion-meta">
                Escrito el: <span>24/03/2025</span> por: <span>FranHR</span>
              </p>
              <p>
                Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu
                espacio
              </p>
            </a>
          </div>
        </article>
      <?php endif; ?>
    </div>

    <?php if(!empty($categorias)): ?>
    <div class="blog-sidebar">
      <h3>Categorías</h3>
      <ul class="categorias-blog">
        <?php foreach($categorias as $categoria): ?>
          <li>
            <a href="blog.php?categoria=<?php echo $categoria->id; ?>">
              <?php echo $categoria->nombre; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>
  </div>
</main>

<?php
incluirTemplate('footer');
?>

