<?php
use App\Propiedad;

// Consultar propiedades destacadas
$propiedades = Propiedad::getDestacados();

// Si no hay propiedades destacadas, mostrar las primeras 6 propiedades
if (empty($propiedades)) {
    $propiedades = Propiedad::get(6);
}
?>

<div class="contenedor-anuncios-destacados">
    <?php foreach($propiedades as $propiedad): ?>
    <div class="anuncio">
        <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio imagen" />

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p class="descripcion-anuncio"><?php echo substr($propiedad->descripcion, 0, 100) . '...'; ?></p>
            <p class="precio"><?php echo $propiedad->precio; ?> €</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc" />
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" />
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" />
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>
        </div>
    </div>
    <?php endforeach; ?> 
</div> 