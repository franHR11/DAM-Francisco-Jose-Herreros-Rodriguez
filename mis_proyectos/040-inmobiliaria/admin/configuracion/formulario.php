<?php
// Asumiendo que $config (objeto SiteConfig) y $errores están disponibles desde index.php
?>
<fieldset>
    <legend>Información General</legend>

    <label for="site_name">Nombre del Sitio:</label>
    <input type="text" id="site_name" name="site_name" placeholder="Nombre del Sitio" value="<?php echo sanitizar($config->site_name); ?>">

    <label for="meta_description">Meta Descripción:</label>
    <textarea id="meta_description" name="meta_description" placeholder="Descripción del sitio para SEO"><?php echo sanitizar($config->meta_description); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la Empresa</legend>

    <label for="company_name">Nombre Empresa:</label>
    <input type="text" id="company_name" name="company_name" placeholder="Nombre de la Empresa" value="<?php echo sanitizar($config->company_name ?? ''); ?>">
    
    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" placeholder="Dirección completa" value="<?php echo sanitizar($config->address ?? ''); ?>">

    <label for="city">Ciudad:</label>
    <input type="text" id="city" name="city" placeholder="Ciudad" value="<?php echo sanitizar($config->city ?? ''); ?>">

    <label for="zip_code">Código Postal:</label>
    <input type="text" id="zip_code" name="zip_code" placeholder="Código Postal" value="<?php echo sanitizar($config->zip_code ?? ''); ?>">

    <label for="opening_hours">Horario Apertura:</label>
    <input type="text" id="opening_hours" name="opening_hours" placeholder="Ej: Lunes a Viernes 9:00 - 18:00" value="<?php echo sanitizar($config->opening_hours ?? ''); ?>">
    
    <label for="closing_hours">Horario Cierre:</label>
    <input type="text" id="closing_hours" name="closing_hours" placeholder="Ej: Sábados 10:00 - 14:00" value="<?php echo sanitizar($config->closing_hours ?? ''); ?>">

</fieldset>

<fieldset>
    <legend>Imágenes del Sitio</legend>

    <label for="logo">Logo:</label>
    <?php if(!empty($config->logo_filename)): ?>
        <div class="imagen-actual">
            <p>Imagen Actual:</p>
            <img src="../../imagenes/config/<?php echo sanitizar($config->logo_filename); ?>" 
                 alt="Logo actual" 
                 class="imagen-small"
                 style="width: 300px; height: auto; object-fit: contain;">
            <p class="help-text">Ruta: ../../imagenes/config/<?php echo sanitizar($config->logo_filename); ?></p>
        </div>
    <?php endif; ?>
    <input type="file" id="logo" name="logo" accept="image/jpeg, image/png, image/gif, image/svg+xml">
    <p class="help-text">Tamaño recomendado: 300x100px. Formatos permitidos: JPG, PNG, GIF, SVG.</p>

    <label for="header_image">Imagen Cabecera Inicio:</label>
    <?php if(!empty($config->header_image_filename)): ?>
        <div class="imagen-actual">
            <p>Imagen Actual:</p>
            <img src="../../imagenes/config/<?php echo sanitizar($config->header_image_filename); ?>" 
                 alt="Imagen de cabecera actual" 
                 class="imagen-thumbnail"
                 style="width: 300px; height: auto; object-fit: contain;">
            <p class="help-text">Ruta: ../../imagenes/config/<?php echo sanitizar($config->header_image_filename); ?></p>
        </div>
    <?php endif; ?>
    <input type="file" id="header_image" name="header_image" accept="image/jpeg, image/png, image/gif, image/svg+xml">
    <p class="help-text">Tamaño recomendado: 1200x800px. Formatos permitidos: JPG, PNG, GIF, SVG.</p>
</fieldset> 