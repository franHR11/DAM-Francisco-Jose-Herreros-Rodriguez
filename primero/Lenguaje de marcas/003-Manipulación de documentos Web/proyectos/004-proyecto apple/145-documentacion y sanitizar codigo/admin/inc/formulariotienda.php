<?php
include "../utilidades/error.php";
include "../config/config.php";

if ($_GET['formulario'] == 'tiendas') {
    ?>
    <div class="form-tienda">
        <div class="campo">
            <label>Título:</label>
            <input type="text" name="titulo" required>
        </div>

        <div class="campo">
            <label>Subtítulo:</label>
            <input type="text" name="subtitulo">
        </div>

        <div class="campo">
            <label>Descripción:</label>
            <textarea class="snow-editor" name="descripcion" rows="4"></textarea>
        </div>

        <div class="campo-imagen">
            <label>Imagen principal:</label>
            <input type="file" name="imagen" accept="image/*">
            <div class="preview-imagen"></div>
        </div>

        <div class="campo-imagen">
            <label>Imagen de fondo:</label>
            <input type="file" name="fondo" accept="image/*">
            <div class="preview-fondo"></div>
        </div>

        <div class="campo">
            <label>Seleccionar productos:</label>
            <div class="productos-lista">
                <?php
                $queryProductos = "SELECT * FROM productos ORDER BY titulo";
                $resultProductos = $conexion->query($queryProductos);
                while($producto = $resultProductos->fetch_assoc()) {
                    echo "<div class='producto-item'>";
                    echo "<input type='checkbox' name='productos[]' value='".$producto['Identificador']."'>";
                    echo "<label>".$producto['titulo']." - ".$producto['precio']."€</label>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <div class="campo">
            <label>Estilos (JSON):</label>
            <textarea name="estilo" rows="6" placeholder='{
    "self": {
        "background-color": "#ffffff",
        "padding": "20px"
    }
}'></textarea>
        </div>
    </div>

    <style>
    .form-tienda {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .campo {
        margin-bottom: 20px;
    }
    .campo label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .productos-lista {
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #ddd;
        padding: 10px;
    }
    .producto-item {
        padding: 5px 0;
    }
    .preview-imagen, .preview-fondo {
        margin-top: 10px;
        max-width: 200px;
    }
    </style>

    <script>
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const preview = this.parentElement.querySelector('.preview-imagen, .preview-fondo');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" style="max-width: 100%">`;
                }
                reader.readAsDataURL(file);
            }
        });
    });
    </script>
    <?php
}
?>
