<?php
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Contacto</h1>

  <img
    src="build/img/destacada3.webp"
    loading="lazy"
    alt="imagen contacto" />
  <h2>Llene el formulario de contacto</h2>

  <form action="" class="formulario">
    <fieldset>
      <legend>Informacion Personal</legend>
      <label for="nombre">Nombre</label>
      <input type="text" placeholder="Tu Nombre" id="nombre" />

      <label for="email">E-mail</label>
      <input type="email" placeholder="Email" id="email" />

      <label for="telefono">Teléfono</label>
      <input type="tel" placeholder="Telefono" id="telefono" />

      <label for="mensaje">Mensaje:</label>
      <textarea id="mensaje"></textarea>
    </fieldset>

    <fieldset>
      <legend>Imformacion Sobre la Propiedad</legend>
      <label for="opciones">Vende o compra</label>
      <select id="opciones">
        <option value="" disabled selected>-- Seleccione --</option>
        <option value="compra">Compra</option>
        <option value="vende">Vende</option>
      </select>

      <label for="presupuesto">Precio o Presupuesto</label>
      <input
        type="number"
        placeholder="Precio o Presupuesto"
        id="presupuesto" />
    </fieldset>

    <fieldset>
      <legend>Contacto</legend>
      <p>Como desea ser contactado</p>
      <div class="forma-contacto">
        <label for="contactar-telefono">Teléfono</label>
        <input
          name="contacto"
          type="radio"
          value="telefono"
          id="contactar-telefono" />

        <label for="contactar-email">E-mail</label>
        <input
          name="contacto"
          type="radio"
          value="email"
          id="contactar-email" />
      </div>

      <p>Si eligió teléfono, elija la fecha y la hora</p>

      <label for="fecha">Fecha</label>
      <input type="date" id="fecha" />

      <label for="hora">Hora</label>
      <input type="time" id="hora" min="09:00" max="21:00" />
    </fieldset>

    <input type="submit" value="Enviar" class="boton-verde" />
  </form>
</main>

<?php
incluirTemplate('footer');
?>

