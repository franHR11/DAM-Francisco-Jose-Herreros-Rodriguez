<?php
include_once "config/config.php"; // Asegurarse de que tenemos conexión a la base de datos

// Mostrar el iframe si hay un enlace seleccionado
if(isset($_GET['enlace'])) {
    echo '<iframe src="'.htmlspecialchars($_GET['enlace']).'" 
          style="width:100%; height:100%; border:none;"></iframe>';
}

// Mostrar enlaces personalizados
$queryEnlaces = "SELECT * FROM menu_enlaces ORDER BY orden ASC";
$resultadoEnlaces = $conexion->query($queryEnlaces);

while ($enlace = $resultadoEnlaces->fetch_assoc()) {
    echo "<li class='menu-item custom-link'>";
    echo "<a href='?enlace=" . urlencode($enlace['url']) . "'>" 
         . htmlspecialchars($enlace['nombre']) . "</a>";
    echo "<button onclick='eliminarEnlace(" . $enlace['Identificador'] . ")' class='delete-link'>❌</button>";
    echo "</li>";
}

// Formulario para agregar nuevos enlaces
echo "<li class='menu-add-link'>";
echo "<form id='addLinkForm' onsubmit='return agregarEnlace(event)'>";
echo "<input type='text' id='linkName' placeholder='Nombre del enlace' required>";
echo "<input type='url' id='linkUrl' placeholder='URL' required>";
echo "<button type='submit'>➕</button>";
echo "</form>";
echo "</li>";
?>

<script>
function agregarEnlace(event) {
    event.preventDefault();
    const nombre = document.getElementById('linkName').value;
    const url = document.getElementById('linkUrl').value;
    
    fetch('inc/gestionar_enlaces.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=add&nombre=' + encodeURIComponent(nombre) + '&url=' + encodeURIComponent(url)
    })
    .then(response => response.text())
    .then(() => {
        location.reload();
    });
    return false;
}

function eliminarEnlace(id) {
    if(confirm('¿Estás seguro de eliminar este enlace?')) {
        fetch('inc/gestionar_enlaces.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.text())
        .then(() => {
            location.reload();
        });
    }
}
</script>