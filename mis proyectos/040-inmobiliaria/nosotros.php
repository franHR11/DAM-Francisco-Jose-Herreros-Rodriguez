<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Conoce sobre Nosotros</h1>

  <div class="contenido-nosotros">

    <div class="imagen">
      <img src="build/img/nosotros.webp" loading="lazy" alt=" imagen sobre nosotros">
    </div>
    <div class="texto-nosotros">
      <blockquote>25 años de experiencia</blockquote>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab perferendis praesentium quae dolore maiores! Rerum
        enim quis, aliquid eos laudantium earum vitae repudiandae, in hic id at reiciendis. Facere, tempore.Lorem ipsum
        dolor sit amet consectetur adipisicing elit. Ab perferendis praesentium quae dolore maiores!Lorem ipsum dolor
        sit amet consectetur adipisicing elit. Ab perferendis praesentium quae dolore maiores!</p>
      <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed quas natus magnam necessitatibus cum libero
        magni, blanditiis vitae impedit, deserunt beatae illum ipsa reiciendis distinctio architecto soluta illo odit!
        Ipsum.</p>
    </div>
  </div>

  <section class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <div class="iconos-nosotros">
      <div class="icono">
        <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
        <h3>Seguridad</h3>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat
          veniam distinctio unde vero doloribus porro at soluta delectus, est
          adipisci, blanditiis necessitatibus debitis rerum voluptates.
          Eligendi necessitatibus voluptatum corrupti eos!
        </p>
      </div>

      <div class="icono">
        <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy" />
        <h3>Precio</h3>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat
          veniam distinctio unde vero doloribus porro at soluta delectus, est
          adipisci, blanditiis necessitatibus debitis rerum voluptates.
          Eligendi necessitatibus voluptatum corrupti eos!
        </p>
      </div>

      <div class="icono">
        <img src="build/img/icono3.svg" alt="Icono Tienpo" loading="lazy" />
        <h3>Tiempo</h3>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat
          veniam distinctio unde vero doloribus porro at soluta delectus, est
          adipisci, blanditiis necessitatibus debitis rerum voluptates.
          Eligendi necessitatibus voluptatum corrupti eos!
        </p>
      </div>
    </div>
  </section>

</main>

<?php
incluirTemplate('footer');
?>

