<?php
include "utilidades/error.php";                           
include "config/config.php";                           

if($_GET['formulario'] == 'bloquesproductos' || $_GET['formulario'] == 'bloquescategorias') {
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
            <?php if($_GET['formulario'] == 'bloquesproductos' || $_GET['formulario'] == 'bloquescategorias'): ?>
                <textarea name="texto" id="editorTexto" class="snow-editor" rows="4"></textarea>
                <!-- Incluir los scripts necesarios para el editor Snow -->
                <script src="snow/jocarsa-snow.js"></script>
                <link rel="stylesheet" href="snow/jocarsa-snow.css">
            <?php else: ?>
                <textarea name="texto" rows="4"></textarea>
            <?php endif; ?>
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

        <?php if($_GET['formulario'] == 'bloquesproductos'): ?>
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
        <?php else: ?>
        <div class="campo">
            <label>Asociar a Categoría:</label>
            <select name="categorias_nombre">
                <option value="">Seleccione la categoría a la que pertenece</option>
                <?php
                $queryCategorias = "SELECT * FROM categorias";
                $resultCategorias = $conexion->query($queryCategorias);
                while($categoria = $resultCategorias->fetch_assoc()) {
                    echo "<option value='".$categoria['Identificador']."'>";
                    echo htmlspecialchars($categoria['nombre']);
                    echo "</option>";
                }
                ?>
            </select>
        </div>
        <?php endif; ?>

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
        const editorTexto = document.getElementById('editorTexto');

        // Por defecto, mostrar el campo de texto y ocultar precio
        campoTexto.style.display = 'block';
        campoPrecio.style.display = 'none';

        // Si es bloque tipo tienda (7)
        if(tipoBloque === '7') {
            campoPrecio.style.display = 'block';
            if(editorTexto) {
                editorTexto.style.display = 'none';
            }
        }
        
        // Si es bloque tipo texto completo (8)
        if(tipoBloque === '8') {
            campoTexto.style.display = 'block';
            if(editorTexto) {
                editorTexto.style.display = 'block';
                // Inicializar el editor Snow
                if(typeof jocarsaSnow !== 'undefined') {
                    jocarsaSnow.createEditor(editorTexto);
                }
            }
        }
    }

    // Inicializar el editor cuando la página carga
    document.addEventListener('DOMContentLoaded', function() {
        const tipoBloque = document.getElementById('tipoBloque');
        if(tipoBloque && tipoBloque.value === '8') {
            mostrarCamposSegunTipo();
        }
    });

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
        echo "<textarea class='snow-editor' name='descripcion' rows='4'></textarea>";
        echo "</div>";
    }
    else if($fila['Field'] == "precio") {
        echo "<div class='campo'>";
        echo "<label>Precio:</label>";
        echo "<input type='number' step='0.01' name='precio' required>";
        echo "</div>";
    }
    else if($fila['Field'] == "imagen" || $fila['Field'] == "fondo" || $fila['Field'] == "imagen2") {
        echo "<div class='campo-imagen'>";
        echo "<label>" . ucfirst($fila['Field']) . ":</label>";
        echo "<div class='imagen-opciones'>";
        echo "<input type='file' name='".$fila['Field']."' accept='image/*' class='input-imagen'>";
        echo "<button type='button' class='btn-biblioteca' data-campo='".$fila['Field']."'>Seleccionar de la biblioteca</button>";
        echo "</div>";
        echo "<div class='preview-".$fila['Field']."'></div>";
        echo "<input type='hidden' name='".$fila['Field']."_biblioteca' id='".$fila['Field']."_biblioteca'>";
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
    else if($fila['Field'] == "imagen2") {
        echo "<div class='campo-imagen'>";
        echo "<label>Imagen del producto:</label>";
        echo "<input type='file' name='imagen2' accept='image/*'>";
        echo "<div class='preview-imagen2'></div>";
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

.imagen-opciones {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}
.btn-biblioteca {
    padding: 8px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.btn-biblioteca:hover {
    background-color: #0056b3;
}
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}
.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 900px;
    border-radius: 5px;
}
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
.modal-footer {
    margin-top: 20px;
    text-align: right;
}
.modal-footer button {
    margin-left: 10px;
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

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalBiblioteca');
    const contenidoBiblioteca = document.getElementById('contenidoBiblioteca');
    const btnSeleccionar = document.getElementById('seleccionarImagen');
    const btnCancelar = document.getElementById('cancelarSeleccion');
    let campoActual = null;

    // Variable global para la imagen seleccionada
    window.imagenSeleccionada = null;

    document.querySelectorAll('.btn-biblioteca').forEach(btn => {
        btn.addEventListener('click', function() {
            campoActual = this.dataset.campo;
            modal.style.display = 'block';
            window.imagenSeleccionada = null;
            
            fetch('inc/biblioteca_medios.php?modal=1')
                .then(response => response.text())
                .then(html => {
                    contenidoBiblioteca.innerHTML = html;
                });
        });
    });

    // Función global para actualizar la selección de imagen
    window.actualizarSeleccionImagen = function(imagen) {
        window.imagenSeleccionada = imagen;
        console.log('Imagen seleccionada actualizada:', imagen);
    };

    btnSeleccionar.addEventListener('click', () => {
        const imagen = window.imagenSeleccionada;
        if (imagen) {
            console.log('Seleccionando imagen:', imagen);
            const preview = document.querySelector(`.preview-${campoActual}`);
            const inputBiblioteca = document.getElementById(`${campoActual}_biblioteca`);
            
            if (preview) {
                preview.innerHTML = `<img src="../static/${imagen}" style="max-width:200px">`;
            }
            
            if (inputBiblioteca) {
                inputBiblioteca.value = imagen;
            }
            
            const inputFile = document.querySelector(`input[name="${campoActual}"]`);
            if (inputFile) inputFile.value = '';
            
            modal.style.display = 'none';
        } else {
            alert('Por favor, selecciona una imagen primero');
        }
    });

    // Reiniciar la selección al cerrar el modal
    const resetSeleccion = () => {
        modal.style.display = 'none';
        window.imagenSeleccionada = null;
    };

    document.querySelector('.close').addEventListener('click', resetSeleccion);
    btnCancelar.addEventListener('click', resetSeleccion);
    
    window.onclick = function(event) {
        if (event.target == modal) {
            resetSeleccion();
        }
    };
});
</script>

<!-- Modal para la biblioteca de medios -->
<div id="modalBiblioteca" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Biblioteca de medios</h2>
        <div id="contenidoBiblioteca"></div>
        <div class="modal-footer">
            <button type="button" id="seleccionarImagen" class="btn btn-primary">Seleccionar</button>
            <button type="button" id="cancelarSeleccion" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</div>