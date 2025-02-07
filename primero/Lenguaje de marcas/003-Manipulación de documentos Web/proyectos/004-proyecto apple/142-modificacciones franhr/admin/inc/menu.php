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

// Array para almacenar las tablas ya mostradas
$tablasYaMostradas = array();

while ($fila = $resultado->fetch_assoc()) {
    $nombreTabla = $fila['TABLE_NAME'];
    
    // Evitar mostrar 'tienda' si ya existe 'tiendas'
    if ($nombreTabla === 'tienda' && in_array('tiendas', $tablasYaMostradas)) {
        continue;
    }
    
    // Evitar mostrar la misma tabla dos veces
    if (!in_array($nombreTabla, $tablasYaMostradas)) {
        $tablasYaMostradas[] = $nombreTabla;
        
        // Si es 'tienda', cambiar a 'tiendas'
        if ($nombreTabla === 'tienda') {
            $nombreTabla = 'tiendas';
        }
        
        if ($fila['visible'] == 1 || isset($_GET['mostrar_ocultos'])) {
            echo "<li class='" . ($fila['visible'] == 0 ? 'oculto' : '') . "'>";
            echo "<div class='menu-item'>";
            echo "<a href='?tabla=" . $nombreTabla . "'>" 
                 . ucfirst($nombreTabla) . "</a>";
            echo "<button onclick='toggleTablaVisibilidad(\"" . $fila['TABLE_NAME'] . "\")' class='toggle-visibility'>";
            echo $fila['visible'] == 1 ? '👁️' : '👁️‍🗨️';
            echo "</button>";
            echo "</div>";
            echo "</li>";
        }
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

// Añadir nueva sección para gestión de imágenes
echo "<li class='menu-section-title'>GESTIÓN DE IMÁGENES</li>";
echo "<li><a href='?seccion=imagenes'>Gestor de imágenes</a></li>";

// Añadir nueva sección de información
echo "<li class='menu-section-title'>AYUDA</li>";
echo "<li><a href='?seccion=info'>Información y guía JSON</a></li>";

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
</script>
