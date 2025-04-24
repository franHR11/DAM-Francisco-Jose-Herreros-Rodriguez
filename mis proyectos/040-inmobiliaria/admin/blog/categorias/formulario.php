<fieldset>
    <legend>Información de la Categoría de Blog</legend>

    <label for="nombre">Nombre:</label>
    <input 
        type="text" 
        id="nombre" 
        name="nombre" 
        placeholder="Nombre de la Categoría" 
        value="<?php echo sanitizar($categoria->nombre ?? ''); ?>"
    >

    <label for="descripcion">Descripción:</label>
    <textarea 
        id="descripcion" 
        name="descripcion"
        placeholder="Descripción (opcional)"
    ><?php echo sanitizar($categoria->descripcion ?? ''); ?></textarea>

</fieldset>
