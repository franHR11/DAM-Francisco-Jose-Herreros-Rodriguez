<?php
$directorio = "../static/";
$imagenes = glob($directorio . "*.{jpg,jpeg,png,gif,webp,svg}", GLOB_BRACE);

echo "<div class='gestor-imagenes'>";
echo "<h2>Gestor de Imágenes</h2>";

// Mostrar mensajes
if(isset($_GET['mensaje'])) {
    echo "<div class='mensaje-exito'>" . htmlspecialchars($_GET['mensaje']) . "</div>";
}
if(isset($_GET['error'])) {
    echo "<div class='mensaje-error'>" . htmlspecialchars($_GET['error']) . "</div>";
}

// Formulario de subida
echo "<div class='upload-form'>";
echo "<form action='inc/subir_imagen.php' method='post' enctype='multipart/form-data' class='form-inline'>";
echo "<input type='file' name='imagen' accept='image/*' required>";
echo "<button type='submit' class='btn-subir'>Subir Imagen</button>";
echo "</form>";
echo "<button onclick='eliminarSeleccionadas()' class='btn-eliminar-multiple'>Eliminar seleccionadas</button>";
echo "</div>";

echo "<div class='grid-imagenes'>";

foreach($imagenes as $imagen) {
    $nombreArchivo = basename($imagen);
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    echo "<div class='imagen-container'>";
    echo "<input type='checkbox' class='selector-imagen' data-nombre='$nombreArchivo'>";
    echo "<img src='../static/$nombreArchivo' alt='$nombreArchivo'>";
    echo "<p class='nombre-archivo' onclick='mostrarFormularioRenombrar(this, \"$nombreArchivo\")'>$nombreArchivo</p>";
    echo "<form class='form-renombrar' style='display:none;'>";
    echo "<input type='text' class='input-renombrar' value='" . pathinfo($nombreArchivo, PATHINFO_FILENAME) . "'>";
    echo "<input type='hidden' value='$extension'>";
    echo "<button type='button' class='btn-guardar' onclick='renombrarImagen(this, \"$nombreArchivo\")'>Guardar</button>";
    echo "<button type='button' class='btn-cancelar' onclick='cancelarRenombrado(this)'>Cancelar</button>";
    echo "</form>";
    echo "<button onclick='eliminarImagen(\"$nombreArchivo\")' class='btn-eliminar'>Eliminar</button>";
    echo "</div>";
}

echo "</div></div>";
?>

<script>
function eliminarImagen(nombre) {
    if(confirm('¿Estás seguro de que quieres eliminar esta imagen?')) {
        fetch('inc/eliminar_imagen.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'imagen=' + encodeURIComponent(nombre)
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
}

function mostrarFormularioRenombrar(elemento, nombreActual) {
    const container = elemento.parentElement;
    elemento.style.display = 'none';
    container.querySelector('.form-renombrar').style.display = 'block';
}

function cancelarRenombrado(elemento) {
    const container = elemento.closest('.imagen-container');
    container.querySelector('.nombre-archivo').style.display = 'block';
    container.querySelector('.form-renombrar').style.display = 'none';
}

function renombrarImagen(elemento, nombreActual) {
    const container = elemento.closest('.imagen-container');
    const nuevoNombre = container.querySelector('.input-renombrar').value;
    const extension = container.querySelector('input[type="hidden"]').value;
    
    if(nuevoNombre.trim() === '') {
        alert('El nombre no puede estar vacío');
        return;
    }

    fetch('inc/renombrar_imagen.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'nombre_actual=' + encodeURIComponent(nombreActual) + 
              '&nuevo_nombre=' + encodeURIComponent(nuevoNombre) + 
              '&extension=' + encodeURIComponent(extension)
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        location.reload();
    });
}

function eliminarSeleccionadas() {
    const imagenes = document.querySelectorAll('.selector-imagen:checked');
    if(imagenes.length === 0) {
        alert('Por favor, selecciona al menos una imagen');
        return;
    }
    
    if(confirm('¿Estás seguro de que quieres eliminar las imágenes seleccionadas?')) {
        const nombresImagenes = Array.from(imagenes).map(checkbox => checkbox.dataset.nombre);
        
        fetch('inc/eliminar_imagen.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({imagenes: nombresImagenes})
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
}
</script>

<style>
.gestor-imagenes {
    padding: 20px;
}

.upload-form {
    margin-bottom: 20px;
    padding: 20px;
    background: #f5f5f5;
    border-radius: 5px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.form-inline {
    display: flex;
    gap: 10px;
    align-items: center;
}

.btn-subir {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 8px 15px;
    cursor: pointer;
    border-radius: 3px;
    margin-left: 10px;
}

.btn-subir:hover {
    background: #45a049;
}

.grid-imagenes {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    padding: 20px;
}

.imagen-container {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    position: relative;
}

.imagen-container img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.btn-eliminar {
    background: #ff4444;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 3px;
}

.btn-eliminar:hover {
    background: #cc0000;
}

.mensaje-exito {
    background-color: #dff0d8;
    color: #3c763d;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #d6e9c6;
}

.mensaje-error {
    background-color: #f2dede;
    color: #a94442;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #ebccd1;
}

.nombre-archivo {
    cursor: pointer;
    padding: 5px;
}

.nombre-archivo:hover {
    background-color: #f0f0f0;
}

.form-renombrar {
    margin: 10px 0;
}

.input-renombrar {
    width: 70%;
    padding: 5px;
    margin-right: 5px;
}

.btn-guardar {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 3px;
    margin-right: 5px;
}

.btn-cancelar {
    background: #777;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 3px;
}

.btn-eliminar-multiple {
    background: #ff4444;
    color: white;
    border: none;
    padding: 8px 15px;
    cursor: pointer;
    border-radius: 3px;
}

.btn-eliminar-multiple:hover {
    background: #cc0000;
}

.selector-imagen {
    position: absolute;
    top: 10px;
    left: 10px;
    transform: scale(1.5);
}
</style>
