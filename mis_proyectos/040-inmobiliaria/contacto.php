<?php
require 'includes/app.php';
incluirTemplate('header');

use App\Contacto;

$mensaje = null;
$contacto = new Contacto();

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contacto = new Contacto($_POST);
    
    $errores = $contacto->validar();

    if (empty($errores)) {
        if ($contacto->guardar()) {
            // Mensaje de éxito
            $mensaje = "Mensaje enviado correctamente. Nos pondremos en contacto contigo pronto.";
            // Reset del objeto contacto para limpiar el formulario
            $contacto = new Contacto();
        } else {
            $errores = ['Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo.'];
        }
    }
}
?>

<main class="contenedor seccion">
  <h1>Contacto</h1>

  <img
    src="build/img/destacada3.webp"
    loading="lazy"
    alt="imagen contacto" />
  <h2>Llene el formulario de contacto</h2>

  <?php if ($mensaje): ?>
    <p class="alerta exito"><?php echo $mensaje; ?></p>
  <?php endif; ?>

  <?php foreach($errores ?? [] as $error): ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form method="POST" action="" class="formulario">
    <fieldset>
      <legend>Información Personal</legend>
      <label for="nombre">Nombre</label>
      <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre" value="<?php echo sanitizar($contacto->nombre); ?>" />

      <label for="email">E-mail</label>
      <input type="email" placeholder="Email" id="email" name="email" value="<?php echo sanitizar($contacto->email); ?>" />

      <label for="telefono">Teléfono</label>
      <input type="tel" placeholder="Teléfono" id="telefono" name="telefono" value="<?php echo sanitizar($contacto->telefono); ?>" />

      <label for="mensaje">Mensaje:</label>
      <textarea id="mensaje" name="mensaje"><?php echo sanitizar($contacto->mensaje); ?></textarea>
    </fieldset>

    <fieldset>
      <legend>Información Sobre la Propiedad</legend>
      <label for="tipo">Vende o compra</label>
      <select id="tipo" name="tipo">
        <option value="" disabled <?php echo !$contacto->tipo ? 'selected' : ''; ?>>-- Seleccione --</option>
        <option value="compra" <?php echo $contacto->tipo === 'compra' ? 'selected' : ''; ?>>Compra</option>
        <option value="vende" <?php echo $contacto->tipo === 'vende' ? 'selected' : ''; ?>>Vende</option>
      </select>

      <label for="presupuesto">Precio o Presupuesto</label>
      <input
        type="number"
        placeholder="Precio o Presupuesto"
        id="presupuesto"
        name="presupuesto"
        value="<?php echo sanitizar($contacto->presupuesto); ?>" />
    </fieldset>

    <fieldset>
      <legend>Contacto</legend>
      <p>Cómo desea ser contactado</p>
      <div class="forma-contacto">
        <label for="contactar-telefono">Teléfono</label>
        <input
          name="contacto_via"
          type="radio"
          value="telefono"
          id="contactar-telefono"
          <?php echo $contacto->contacto_via === 'telefono' ? 'checked' : ''; ?> />

        <label for="contactar-email">E-mail</label>
        <input
          name="contacto_via"
          type="radio"
          value="email"
          id="contactar-email"
          <?php echo $contacto->contacto_via === 'email' ? 'checked' : ''; ?> />
      </div>

      <div id="contacto-telefono" <?php echo $contacto->contacto_via !== 'telefono' ? 'style="display: none;"' : ''; ?>>
        <p>Si eligió teléfono, elija la fecha y la hora</p>

        <label for="fecha_contacto">Fecha</label>
        <input type="date" id="fecha_contacto" name="fecha_contacto" value="<?php echo sanitizar($contacto->fecha_contacto); ?>" />

        <label for="hora_contacto">Hora</label>
        <input type="time" id="hora_contacto" name="hora_contacto" min="09:00" max="21:00" value="<?php echo sanitizar($contacto->hora_contacto); ?>" />
      </div>
    </fieldset>

    <input type="submit" value="Enviar" class="boton-verde" />
  </form>
</main>

<script>
  // Mostrar/ocultar campos de fecha y hora según la opción de contacto
  document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('input[name="contacto_via"]');
    const contactoTelefono = document.getElementById('contacto-telefono');
    
    radios.forEach(radio => {
      radio.addEventListener('change', function() {
        if (this.value === 'telefono') {
          contactoTelefono.style.display = 'block';
        } else {
          contactoTelefono.style.display = 'none';
        }
      });
    });
  });
</script>

<?php
incluirTemplate('footer');
?>

