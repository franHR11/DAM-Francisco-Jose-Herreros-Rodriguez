<?php
require 'includes/app.php';

use App\BlogEntry;

// Validar el ID
$id = isset($_GET['id']) ? $_GET['id'] : null;
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /');
    exit;
}

// Obtener la entrada
$entrada = BlogEntry::find($id);

if (!$entrada) {
    header('Location: /');
    exit;
}

// Obtener autor si existe
$autor = '';
if ($entrada->autor_id) {
    $db = conectarDB();
    $query = "SELECT nombre FROM usuarios WHERE id = {$entrada->autor_id}";
    $resultado = mysqli_query($db, $query);
    $autorData = mysqli_fetch_assoc($resultado);
    if ($autorData) {
        $autor = $autorData['nombre'];
    }
    mysqli_close($db);
}

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado entrada-completa">
  <h1><?php echo $entrada->titulo; ?></h1>

  <?php if($entrada->imagen): ?>
    <img class="imagen-entrada" src="imagenes/<?php echo $entrada->imagen; ?>" loading="lazy" alt="Imagen de la entrada">
  <?php else: ?>
    <img class="imagen-entrada" src="build/img/destacada2.webp" loading="lazy" alt="Imagen por defecto">
  <?php endif; ?>

  <div class="meta-entrada">
    <p>Escrito el: <span><?php echo date('d/m/Y', strtotime($entrada->creado)); ?></span>
    <?php if($autor): ?>
      por: <span><?php echo $autor; ?></span>
    <?php endif; ?>
    </p>
    <p>Categoría: 
      <?php
        $db = conectarDB();
        $query = "SELECT nombre FROM blog_categories WHERE id = {$entrada->categoria_id}";
        $resultado = mysqli_query($db, $query);
        $categoria = mysqli_fetch_assoc($resultado);
        echo $categoria ? '<span>' . $categoria['nombre'] . '</span>' : '<span>Sin categoría</span>';
        mysqli_close($db);
      ?>
    </p>
  </div>

  <div class="contenido-entrada">
    <?php echo $entrada->contenido; ?>
  </div>
</main>

<?php
incluirTemplate('footer');
?>

