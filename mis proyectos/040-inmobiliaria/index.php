<?php
require 'includes/app.php';

use App\BlogEntry;

// Importar la conexión
$db = conectarDB();

// Consultar
$consulta = "SELECT * FROM propiedades LIMIT 3";

// Obtener resultado
$resultado = mysqli_query($db, $consulta);

// Obtener entradas destacadas del blog
$entradasBlog = BlogEntry::destacados(2);

$inicio = true;
incluirTemplate('header', $inicio);
?>

<main class="contenedor seccion">
  <h1>Más Sobre Nosotros</h1>

  <div class="iconos-nosotros">
    <div class="icono">
      <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
      <h3>Seguridad</h3>
      <p>
        Seleccionamos meticulosamente cada una de nuestras propiedades en
        barrios seguros y con excelentes servicios.
      </p>
    </div>

    <div class="icono">
      <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy" />
      <h3>Precio</h3>
      <p>
        Ofrecemos propiedades a precios competitivos, ajustados al mercado
        actual y su valor real.
      </p>
    </div>

    <div class="icono">
      <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy" />
      <h3>Tiempo</h3>
      <p>
        Trabajamos con rapidez y eficiencia, respetando siempre tu tiempo y
        necesidades.
      </p>
    </div>
  </div>
</main>

<section class="seccion contenedor">
  <h2>Casas y Departamentos en Venta</h2>

  <?php 
    $limite = 3;
    include 'includes/templates/anuncios.php';
  ?>

  <div class="alinear-derecha">
    <a href="anuncios.php" class="boton-verde">Ver Todas</a>
  </div>
</section>

<section class="imagen-contacto">
  <h2>Encuentra la casa de tus sueños</h2>
  <p>
    Llena el formulario de contacto y un asesor se pondra en contacto
    contigo
  </p>
  <a href="contacto.php" class="boton-amarillo">Contactanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
  <section class="blog">
    <h3>Nuestro Blog</h3>

    <?php if(!empty($entradasBlog)): ?>
      <?php foreach($entradasBlog as $entrada): ?>
        <article class="entrada-blog">
          <div class="imagen">
            <?php if($entrada->imagen): ?>
              <img src="/imagenes/<?php echo $entrada->imagen; ?>" loading="lazy" alt="Imagen del blog" />
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
                  // Obtener autor si existe
                  if($entrada->autor_id) {
                    $query = "SELECT nombre FROM usuarios WHERE id = {$entrada->autor_id}";
                    $resultado = mysqli_query($db, $query);
                    $autor = mysqli_fetch_assoc($resultado);
                    if($autor) {
                      echo "por: <span>{$autor['nombre']}</span>";
                    }
                  }
                ?>
              </p>
              <p>
                <?php
                  // Mostrar extracto o generar uno del contenido
                  $extracto = substr(strip_tags($entrada->contenido), 0, 150);
                  echo $extracto . (strlen(strip_tags($entrada->contenido)) > 150 ? '...' : '');
                ?>
              </p>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    <?php else: ?>
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
  </section>

  <section class="testimoniales">
    <h3>Testimoniales</h3>
    <div class="testimonial">
      <blockquote>
        El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas
        mis espectativas.
      </blockquote>
      <p>- Francisco José</p>
    </div>
  </section>
</div>

<?php
incluirTemplate('footer');
?>


