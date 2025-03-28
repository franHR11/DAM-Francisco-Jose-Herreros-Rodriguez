<?php
include "utilidades/error.php";                           
include "config/config.php";                          

if($_GET['formulario'] == 'bloquesproductos') {
    ?>
    <div class="form-productos">
        <div class="campo">
            <label>Tipo de Bloque:</label>
            <select name="tipobloque_tipo" id="tipoBloque" onchange="mostrarCamposSegunTipo()">
                <option value="">Seleccione un tipo de bloque</option>
                <?php
                $queryTipos = "SELECT * FROM tipobloque";
                $resultTipos = $conexion->query($queryTipos);
                while($tipo = $resultTipos->fetch_assoc()) {
                    echo "<option value='".$tipo['Identificador']."'>";
                    echo htmlspecialchars($tipo['tipo']);
                    echo "</option>";
                }
                ?>
            </select>
        </div>

        <div class="campo">
            <label>Título:</label>
            <input type="text" name="titulo">
        </div>

        <div class="campo">
            <label>Subtítulo:</label>
            <input type="text" name="subtitulo">
        </div>

        <div class="campo" id="campoTexto">
            <label>Texto:</label>
            <textarea name="texto" rows="4"></textarea>
        </div>

        <div class="campo" id="campoPrecio" style="display:none;">
            <label>Precio (€):</label>
            <input type="number" step="0.01" name="precio">
        </div>

        <div class="campo-imagen">
            <label>Imagen:</label>
            <input type="file" name="imagen" accept="image/*">
            <div class="preview-imagen"></div>
        </div>

        <div class="campo-imagen">
            <label>Imagen de Fondo:</label>
            <input type="file" name="fondo" accept="image/*">
            <div class="preview-fondo"></div>
        </div>

        <div class="campo">
            <label>Asociar a Producto:</label>
            <select name="productos_titulo">
                <option value="">Seleccione el producto al que pertenece</option>
                <?php
                $queryProductos = "SELECT * FROM productos";
                $resultProductos = $conexion->query($queryProductos);
                while($producto = $resultProductos->fetch_assoc()) {
                    echo "<option value='".$producto['Identificador']."'>";
                    echo htmlspecialchars($producto['titulo']);
                    echo "</option>";
                }
                ?>
            </select>
        </div>

        <div class="campo" id="campoEstilo">
            <label>Estilos (JSON):</label>
            <textarea name="estilo" rows="6" placeholder='{
    "self": {
        "color": "#000000",
        "background-color": "#ffffff"
    },
    "h3": {
        "color": "#333333",
        "font-size": "24px"
    }
}'></textarea>
            <small>Formato JSON para estilos personalizados. Deja vacío para usar estilos por defecto.</small>
        </div>
    </div>

    <style>
    .form-productos {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }
    .campo {
        margin-bottom: 15px;
    }
    .campo label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .campo input, .campo select, .campo textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .preview-imagen, .preview-fondo {
        margin-top: 10px;
        max-width: 200px;
    }
    #campoEstilo textarea {
        font-family: monospace;
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    #campoEstilo small {
        display: block;
        color: #666;
        margin-top: 5px;
    }
    </style>

    <script>
    function mostrarCamposSegunTipo() {
        const tipoBloque = document.getElementById('tipoBloque').value;
        const campoPrecio = document.getElementById('campoPrecio');
        const campoTexto = document.getElementById('campoTexto');

        // Por defecto, mostrar el campo de texto y ocultar precio
        campoTexto.style.display = 'block';
        campoPrecio.style.display = 'none';

        // Si es bloque tipo tienda (asumiendo que es el tipo 7)
        if(tipoBloque === '7') {
            campoPrecio.style.display = 'block';
        }
    }

    // Manejar previsualizaciones de imágenes
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
    return;
}

if($_GET['formulario'] == 'tiendas_productos') {
    include "formulariotiendas_productos.php";
    return;
}

$peticion = "SHOW COLUMNS FROM ".$_GET['formulario'];
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
    // Primero mostramos el selector de tienda si estamos en el formulario de productos
    if($_GET['formulario'] == 'productos' && !isset($tiendaMostrada)) {
        echo "<div class='campo'>";
        echo "<label>Seleccionar Tienda (opcional):</label>";
        echo "<select name='tienda_id'>";
        echo "<option value=''>Sin tienda</option>";
        
        $queryTiendas = "SELECT * FROM tiendas ORDER BY titulo";
        $resultTiendas = $conexion->query($queryTiendas);
        while($tienda = $resultTiendas->fetch_assoc()) {
            echo "<option value='".$tienda['Identificador']."'>";
            echo htmlspecialchars($tienda['titulo']);
            echo "</option>";
        }
        echo "</select>";
        echo "</div>";
        $tiendaMostrada = true;
    }

    // Omitir el campo Identificador
    if($fila['Field'] == "Identificador") {
        continue;
    }
    
    // Manejo especial para campos de fecha
    if($fila['Field'] == "fecha") {
        echo "<div class='campo'>";
        echo "<label>Fecha:</label>";
        echo "<input type='date' name='fecha' required>";
        echo "</div>";
        continue;
    }

    // Manejo especial para categorías del blog
    if($fila['Field'] == "categoriasblog_categorias") {
        echo "<div class='campo'>";
        echo "<label>Categoría del Blog:</label>";
        echo "<select name='categoriasblog_categorias' required>";
        echo "<option value=''>Seleccione una categoría</option>";
        
        $queryCategoriasBlog = "SELECT * FROM categoriasblog ORDER BY categoria";
        $resultCategoriasBlog = $conexion->query($queryCategoriasBlog);
        while($categoria = $resultCategoriasBlog->fetch_assoc()) {
            echo "<option value='".$categoria['Identificador']."'>";
            echo htmlspecialchars($categoria['categoria']);
            echo "</option>";
        }
        echo "</select>";
        echo "</div>";
        continue;
    }

    // Ahora procesamos cada campo según su tipo
    else if($fila['Field'] == "titulo") {
        echo "<div class='campo'>";
        echo "<label>Título:</label>";
        echo "<input type='text' name='titulo' required>";
        echo "</div>";
    }
    else if($fila['Field'] == "descripcion") {
        echo "<div class='campo'>";
        echo "<label>Descripción:</label>";
        echo "<textarea name='descripcion' rows='4'></textarea>";
        echo "</div>";
    }
    else if($fila['Field'] == "precio") {
        echo "<div class='campo'>";
        echo "<label>Precio:</label>";
        echo "<input type='number' step='0.01' name='precio' required>";
        echo "</div>";
    }
    else if($fila['Field'] == "imagen" || $fila['Field'] == "fondo") {
        echo "<div class='campo-imagen'>";
        echo "<label>" . ucfirst($fila['Field']) . ":</label>";
        echo "<input type='file' name='".$fila['Field']."' accept='image/*'>";
        echo "<div class='preview-".$fila['Field']."'></div>";
        echo "</div>";
    }
    else if($fila['Field'] == "categorias_nombre") {
        echo "<div class='campo'>";
        echo "<label>Categoría:</label>";
        echo "<select name='categorias_nombre' required>";
        echo "<option value=''>Seleccione una categoría</option>";
        
        $queryCategorias = "SELECT * FROM categorias ORDER BY nombre";
        $resultCategorias = $conexion->query($queryCategorias);
        while($categoria = $resultCategorias->fetch_assoc()) {
            echo "<option value='".$categoria['Identificador']."'>";
            echo htmlspecialchars($categoria['nombre']);
            echo "</option>";
        }
        echo "</select>";
        echo "</div>";
    }
    else if($fila['Field'] == "tipobloque_tipo") {
        echo "<div class='campo'>";
        echo "<label>Tipo de Bloque:</label>";
        echo "<select name='tipobloque_tipo' required>";
        echo "<option value=''>Seleccione un tipo de bloque</option>";
        
        $queryTipos = "SELECT * FROM tipobloque ORDER BY tipo";
        $resultTipos = $conexion->query($queryTipos);
        while($tipo = $resultTipos->fetch_assoc()) {
            echo "<option value='".$tipo['Identificador']."'>";
            echo htmlspecialchars($tipo['tipo']);
            echo "</option>";
        }
        echo "</select>";
        echo "</div>";
    }
    else {
        echo "<div class='campo'>";
        echo "<label>".ucfirst($fila['Field']).":</label>";
        echo "<input type='text' name='".$fila['Field']."' placeholder='".$fila['Field']."'>";
        echo "</div>";
    }
}

$conexion->close();
?>

<style>
.campo-imagen, .campo-fondo {
    margin: 10px 0;
    padding: 15px;
    border-radius: 5px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
}

.campo {
    margin-bottom: 20px;
}

.campo label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

.campo input[type="text"],
.campo input[type="number"],
.campo select,
.campo textarea {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
}

.campo select {
    background-color: white;
}

.preview-imagen {
    margin-top: 10px;
    max-width: 200px;
}
</style>

<script>
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function(e) {
        const preview = this.parentElement.querySelector('.preview-imagen');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" style="max-width: 100%; border-radius: 4px;">`;
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>