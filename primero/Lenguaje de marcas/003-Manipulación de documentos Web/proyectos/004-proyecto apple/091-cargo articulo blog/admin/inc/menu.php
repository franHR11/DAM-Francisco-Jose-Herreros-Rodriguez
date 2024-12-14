<?php

/* 
	Este archivo carga las entradas del menu de la izquierda
	Este archivo genera elementos de lista que tienen un hipervinculo	
*/

include "utilidades/error.php";                           // Incluyo los mensajes de error
include "config/config.php";                          // Traigo la conexión a la base de datos

// Primero crear la tabla si no existe
$createTable = "CREATE TABLE IF NOT EXISTS menu_visibilidad (
    Identificador int(255) NOT NULL AUTO_INCREMENT,
    nombre_tabla varchar(255) NOT NULL,
    visible tinyint(1) DEFAULT 1,
    PRIMARY KEY (Identificador)
)";
$conexion->query($createTable);

// Obtener todas las tablas de la base de datos
$showTables = "SHOW TABLES FROM proyectoapple";
$tablesResult = $conexion->query($showTables);

// Insertar las tablas en menu_visibilidad si no existen
while ($tabla = $tablesResult->fetch_array()) {
    $nombreTabla = $tabla[0];
    $checkExists = "SELECT COUNT(*) FROM menu_visibilidad WHERE nombre_tabla = '$nombreTabla'";
    $exists = $conexion->query($checkExists)->fetch_array()[0];
    
    if ($exists == 0) {
        $insertTable = "INSERT INTO menu_visibilidad (nombre_tabla, visible) VALUES ('$nombreTabla', 1)";
        $conexion->query($insertTable);
    }
}

// Obtener las tablas con su estado de visibilidad
$peticion = "SELECT t.TABLE_NAME, COALESCE(mv.visible, 1) as visible 
            FROM information_schema.TABLES t 
            LEFT JOIN menu_visibilidad mv ON t.TABLE_NAME = mv.nombre_tabla 
            WHERE t.TABLE_SCHEMA = 'proyectoapple'
            ORDER BY t.TABLE_NAME";
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
    if ($fila['visible'] == 1 || isset($_GET['mostrar_ocultos'])) {
        echo "<li class='" . ($fila['visible'] == 0 ? 'oculto' : '') . "'>";
        echo "<div class='menu-item'>";
        echo "<a href='?tabla=" . $fila['TABLE_NAME'] . "'>" 
             . $fila['TABLE_NAME'] . "</a>";
        echo "<button onclick='toggleTablaVisibilidad(\"" . $fila['TABLE_NAME'] . "\")' class='toggle-visibility'>";
        echo $fila['visible'] == 1 ? '👁️' : '👁️‍🗨️';
        echo "</button>";
        echo "</div>";
        echo "</li>";
    }
}

// Botón para mostrar/ocultar todas las tablas
echo "<li class='menu-control'>";
echo "<button onclick='window.location.href=\"?";
echo isset($_GET['mostrar_ocultos']) ? "" : "mostrar_ocultos=1";
echo "\"' class='show-all-button'>";
echo isset($_GET['mostrar_ocultos']) ? "Ocultar tablas invisibles" : "Mostrar todas las tablas";
echo "</button>";
echo "</li>";

// Mostrar enlaces personalizados
$queryEnlaces = "SELECT * FROM menu_enlaces ORDER BY orden ASC";
$resultadoEnlaces = $conexion->query($queryEnlaces);

echo "<li class='menu-section-title'>Enlaces Personalizados</li>";
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
function toggleTablaVisibilidad(nombreTabla) {
    fetch('inc/toggle_visibility.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'tabla=' + encodeURIComponent(nombreTabla)
    })
    .then(response => response.text())
    .then(() => {
        location.reload();
    });
}

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
