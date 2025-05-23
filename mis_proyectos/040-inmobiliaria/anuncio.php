<?php


$id = $_GET["id"];
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

if(!$id){
  header("Location: /");
}
require 'includes/app.php';
//  CONEXION BASE DE DATOS

$db = conectarDB();
// CONSULTAR BASE DE datos
$query = "SELECT * FROM propiedades WHERE id = {$id}";

// OBTENER LOS RESULTADOS
$resultado = mysqli_query($db, $query);

if($resultado->num_rows ===0){
header("Location: /");
}

$propiedad = mysqli_fetch_assoc($resultado);




incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
  <h1><?php echo $propiedad['titulo']; ?></h1>

  <img src="imagenes/<?php echo $propiedad['imagen']; ?>" loading="lazy" alt="imagen de la propiedad">
  <div class="resumen-propiedad">

    <p class="precio"><?php echo $propiedad['precio']; ?> €</p>
    <ul class="iconos-caracteristicas">
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc" />
        <p><?php echo $propiedad['wc']; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" />
        <p><?php echo $propiedad['estacionamiento']; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" />
        <p><?php echo $propiedad['habitaciones']; ?></p>
      </li>
    </ul>
    <div class="propiedad-descripcion">
      <?php echo $propiedad['descripcion']; ?>
    </div>

  </div>
</main>

<?php
mysqli_close($db);
incluirTemplate('footer');
?>
