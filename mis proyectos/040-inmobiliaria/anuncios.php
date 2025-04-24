<?php
require 'includes/app.php';
use App\Propiedad;
use App\Categoria;

// Inicializar conexión a la base de datos
$db = conectarDB();

// Configurar paginación
$propiedades_por_pagina = 14;
$pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
if ($pagina_actual < 1) $pagina_actual = 1;
$offset = ($pagina_actual - 1) * $propiedades_por_pagina;

// Inicializar variables para búsqueda y filtrado
$termino_busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$categoria_id = isset($_GET['categoria']) ? (int) $_GET['categoria'] : '';

// Cargar categorías para el filtro
$categorias = Categoria::all();

// Determinar qué propiedades mostrar basado en búsqueda y filtro
if (!empty($termino_busqueda)) {
    // Búsqueda por término
    $propiedades = Propiedad::buscar($termino_busqueda, $propiedades_por_pagina, $offset);
    $total_propiedades = Propiedad::countBusqueda($termino_busqueda);
} elseif (!empty($categoria_id)) {
    // Filtrado por categoría
    $propiedades = Propiedad::getPorCategoria($categoria_id, $propiedades_por_pagina, $offset);
    $total_propiedades = Propiedad::countPorCategoria($categoria_id);
} else {
    // Sin filtros, mostrar todas las propiedades paginadas
    $propiedades = Propiedad::paginar($propiedades_por_pagina, $offset);
    $total_propiedades = Propiedad::count();
}

// Calcular total de páginas
$total_paginas = ceil($total_propiedades / $propiedades_por_pagina);

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Casas y Apartamentos en Venta</h1>

  <!-- Sección de búsqueda y filtros -->
  <div class="filtros-busqueda">
    <!-- Buscador -->
    <form class="formulario-busqueda">
      <div class="campo">
        <label for="busqueda">Buscar:</label>
        <input type="text" id="busqueda" name="busqueda" placeholder="Buscar por título o descripción" value="<?php echo $termino_busqueda; ?>">
      </div>
      <div class="botones-busqueda">
        <input type="submit" class="boton boton-verde" value="Buscar">
        <?php if(!empty($termino_busqueda) || !empty($categoria_id)): ?>
          <a href="anuncios.php" class="boton boton-rojo">Limpiar</a>
        <?php endif; ?>
      </div>
    </form>

    <!-- Filtro por categorías -->
    <div class="filtros-categorias">
      <h3>Categorías</h3>
      <ul class="lista-categorias">
        <li><a href="anuncios.php" class="<?php echo empty($categoria_id) ? 'activo' : ''; ?>">Todas</a></li>
        <?php foreach($categorias as $categoria): ?>
        <li>
          <a href="anuncios.php?categoria=<?php echo $categoria->id; ?>" 
             class="<?php echo $categoria_id == $categoria->id ? 'activo' : ''; ?>">
            <?php echo $categoria->nombre; ?>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- Resultados de la búsqueda -->
  <?php if(empty($propiedades)): ?>
    <div class="alerta">No se encontraron propiedades con los criterios de búsqueda.</div>
  <?php else: ?>
    <div class="contenedor-anuncios">
      <?php foreach($propiedades as $propiedad): ?>
      <div class="anuncio">
        <picture>
          <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">
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
  <?php endif; ?>

  <!-- Paginación -->
  <?php if ($total_paginas > 1): ?>
  <div class="paginacion">
    <ul class="paginador">
      <?php if ($pagina_actual > 1): ?>
        <li>
          <a href="anuncios.php?pagina=<?php echo $pagina_actual - 1; ?><?php echo !empty($termino_busqueda) ? '&busqueda=' . urlencode($termino_busqueda) : ''; ?><?php echo !empty($categoria_id) ? '&categoria=' . $categoria_id : ''; ?>" class="boton">&laquo; Anterior</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
        <li class="<?php echo $i === $pagina_actual ? 'actual' : ''; ?>">
          <a href="anuncios.php?pagina=<?php echo $i; ?><?php echo !empty($termino_busqueda) ? '&busqueda=' . urlencode($termino_busqueda) : ''; ?><?php echo !empty($categoria_id) ? '&categoria=' . $categoria_id : ''; ?>" class="boton"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($pagina_actual < $total_paginas): ?>
        <li>
          <a href="anuncios.php?pagina=<?php echo $pagina_actual + 1; ?><?php echo !empty($termino_busqueda) ? '&busqueda=' . urlencode($termino_busqueda) : ''; ?><?php echo !empty($categoria_id) ? '&categoria=' . $categoria_id : ''; ?>" class="boton">Siguiente &raquo;</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
  <?php endif; ?>
</main>

<?php
incluirTemplate('footer');
?>

