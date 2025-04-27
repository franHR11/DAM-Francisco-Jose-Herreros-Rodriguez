<?php
require 'includes/app.php';

use App\BlogEntry;
use App\Propiedad;

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
    $total_propiedades_a_mostrar = 6;
    $propiedades_destacadas = Propiedad::getDestacados($total_propiedades_a_mostrar);
    
    $num_destacadas = count($propiedades_destacadas);
    $propiedades_finales = $propiedades_destacadas; // Empezar con las destacadas

    if ($num_destacadas < $total_propiedades_a_mostrar) {
        $faltantes = $total_propiedades_a_mostrar - $num_destacadas;
        
        // Obtener IDs de las destacadas para excluirlas
        $ids_destacadas = [];
        foreach ($propiedades_destacadas as $propiedad) {
            $ids_destacadas[] = $propiedad->id;
        }
        
        // Obtener propiedades recientes no destacadas
        $propiedades_recientes = Propiedad::getRecientesNoDestacados($faltantes, $ids_destacadas);
        
        // Combinar arrays
        $propiedades_finales = array_merge($propiedades_destacadas, $propiedades_recientes);
    }
  ?>

  <div class="contenedor-anuncios-destacados">
    <?php foreach($propiedades_finales as $propiedad): ?>
    <div class="anuncios">
      <picture>
        <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio imagen">
      </picture>

      <div class="contenido-anuncio">
        <h3><?php echo $propiedad->titulo; ?></h3>
        <p class="descripcion-anuncio">
          <?php 
            // Quitar etiquetas HTML y limitar a 100 caracteres
            $descripcion_limpia = strip_tags($propiedad->descripcion);
            echo substr($descripcion_limpia, 0, 100) . '...'; 
          ?>
        </p>
        <p class="precio"><?php echo $propiedad->precio; ?> €</p>
        <ul class="iconos-caracteristicas">
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
            <p><?php echo $propiedad->wc; ?></p>
          </li>
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
            <p><?php echo $propiedad->estacionamiento; ?></p>
          </li>
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
            <p><?php echo $propiedad->habitaciones; ?></p>
          </li>
        </ul>
        <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

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
              <img src="imagenes/<?php echo $entrada->imagen; ?>" loading="lazy" alt="Imagen del blog" />
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
                  // Mostrar extracto limpio eliminando etiquetas HTML
                  $contenido_limpio = strip_tags($entrada->contenido);
                  $extracto = substr($contenido_limpio, 0, 150);
                  echo $extracto . (strlen($contenido_limpio) > 150 ? '...' : '');
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


