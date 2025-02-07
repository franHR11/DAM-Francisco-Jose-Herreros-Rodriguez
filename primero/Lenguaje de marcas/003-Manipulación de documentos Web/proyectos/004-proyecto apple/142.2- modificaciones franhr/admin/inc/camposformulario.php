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

$peticion = "SHOW COLUMNS FROM ".$_GET['formulario'];
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
    if($fila['Field'] == "Identificador"){
        echo "<input type='hidden' name='".$fila['Field']."'>";
    }
    else if($fila['Field'] == "categoriasblog_categorias"){
        // Consulta para obtener las categorías
        $queryCategories = "SELECT * FROM categoriasblog";
        $resultCategories = $conexion->query($queryCategories);
        
        // Primero obtener el nombre del campo que contiene el título/nombre
        $estructuraQuery = "SHOW COLUMNS FROM categoriasblog";
        $estructuraResult = $conexion->query($estructuraQuery);
        $nombreCampo = null;
        
        while($columna = $estructuraResult->fetch_assoc()) {
            if($columna['Field'] != 'Identificador' && 
               (strpos(strtolower($columna['Field']), 'titulo') !== false || 
                strpos(strtolower($columna['Field']), 'nombre') !== false || 
                strpos(strtolower($columna['Field']), 'categoria') !== false)) {
                $nombreCampo = $columna['Field'];
                break;
            }
        }
        
        echo "<select name='categoriasblog_categorias'>";
        echo "<option value=''>Seleccione una categoría</option>";
        
        while($categoria = $resultCategories->fetch_assoc()) {
            echo "<option value='".$categoria['Identificador']."'>";
            // Usar el campo encontrado o mostrar el ID si no se encuentra
            echo htmlspecialchars($nombreCampo ? $categoria[$nombreCampo] : 'Categoría '.$categoria['Identificador']);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "productos_titulo"){
        $queryProductos = "SELECT * FROM productos";
        $resultProductos = $conexion->query($queryProductos);
        
        echo "<select name='producto_id'>";
        echo "<option value=''>Seleccione un producto</option>";
        
        while($producto = $resultProductos->fetch_assoc()) {
            echo "<option value='".$producto['Identificador']."'>";
            echo htmlspecialchars($producto['titulo']);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "tipobloque" || $fila['Field'] == "tipobloque_tipo"){
        $queryTipos = "SELECT * FROM tipobloque";
        $resultTipos = $conexion->query($queryTipos);
        
        echo "<select name='".$fila['Field']."'>";
        echo "<option value=''>Seleccione un tipo de bloque</option>";
        
        while($tipo = $resultTipos->fetch_assoc()) {
            // Buscar el nombre del tipo de bloque en todos los campos posibles
            $nombreTipo = $tipo['titulo'] ?? $tipo['nombre'] ?? $tipo['tipo'] ?? $tipo['descripcion'] ?? 'Tipo '.$tipo['Identificador'];
            echo "<option value='".$tipo['Identificador']."'>";
            echo htmlspecialchars($nombreTipo);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "categorias_nombre"){
        $queryCategorias = "SELECT * FROM categorias";
        $resultCategorias = $conexion->query($queryCategorias);
        
        echo "<select name='categorias_nombre'>"; // Cambiar el nombre del campo a 'categorias_nombre'
        echo "<option value=''>Seleccione una categoría</option>";
        
        while($categoria = $resultCategorias->fetch_assoc()) {
            echo "<option value='".$categoria['Identificador']."'>";
            echo htmlspecialchars($categoria['nombre']);
            echo "</option>";
        }
        echo "</select>";
    }
    else if(strpos(strtolower($fila['Type']), 'date') !== false){
        echo "<input type='date' name='".$fila['Field']."'>";
    }
    else if(str_contains(strtolower($fila['Field']),"imagen")){
        echo "<div class='campo-imagen'>";
        echo "<label>Imagen principal:</label>";
        echo "<input type='file' name='".$fila['Field']."'>";
        echo "</div>";
    }
    else if(str_contains(strtolower($fila['Field']),"fondo")){
        echo "<div class='campo-fondo'>";
        echo "<label>Imagen de fondo:</label>";
        echo "<input type='file' name='".$fila['Field']."'>";
        echo "</div>";
    }
    else{
        echo "<input type='text' name='".$fila['Field']."' 
              placeholder='".$fila['Field']."'>";
    }
}

$conexion->close();
?>

<style>
.campo-imagen, .campo-fondo {
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
}

.campo-imagen {
    background: #e3f2fd;
    border: 1px solid #2196f3;
}

.campo-fondo {
    background: #f5f5f5;
    border: 1px solid #9e9e9e;
}

.campo-imagen label, .campo-fondo label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
</style>