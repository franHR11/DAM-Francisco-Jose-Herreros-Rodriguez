<?php
$directorio = "../static/";
$imagenes = glob($directorio . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

echo "<div class='gestor-imagenes'>";
echo "<h2>Gestor de Imágenes</h2>";
echo "<div class='grid-imagenes'>";

foreach($imagenes as $imagen) {
    $nombreArchivo = basename($imagen);
    echo "<div class='imagen-container'>";
    echo "<img src='../static/$nombreArchivo' alt='$nombreArchivo'>";
    echo "<p>$nombreArchivo</p>";
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
</script>

<style>
.gestor-imagenes {
    padding: 20px;
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
</style>
