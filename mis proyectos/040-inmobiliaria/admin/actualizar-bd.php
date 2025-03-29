<?php
require '../includes/app.php';

estaAutenticado();

// Conexión a la base de datos
$db = conectarDB();

// Función para verificar si una columna existe en una tabla
function columnaExiste($db, $tabla, $columna) {
    $query = "SHOW COLUMNS FROM {$tabla} LIKE '{$columna}'";
    $resultado = $db->query($query);
    return $resultado->num_rows > 0;
}

// Función para verificar si una tabla existe
function tablaExiste($db, $tabla) {
    $query = "SHOW TABLES LIKE '{$tabla}'";
    $resultado = $db->query($query);
    return $resultado->num_rows > 0;
}

// Inicializar mensajes
$mensajes = [];

// Verificar y agregar columna destacado a la tabla propiedades
if (!columnaExiste($db, 'propiedades', 'destacado')) {
    $query = "ALTER TABLE propiedades ADD COLUMN destacado TINYINT(1) NOT NULL DEFAULT 0";
    if ($db->query($query)) {
        $mensajes[] = 'Columna "destacado" agregada correctamente a la tabla propiedades.';
    } else {
        $mensajes[] = 'Error al agregar columna "destacado": ' . $db->error;
    }
}

// Verificar y agregar columna categoria_id a la tabla propiedades
if (!columnaExiste($db, 'propiedades', 'categoria_id')) {
    $query = "ALTER TABLE propiedades ADD COLUMN categoria_id INT NULL DEFAULT NULL";
    if ($db->query($query)) {
        $mensajes[] = 'Columna "categoria_id" agregada correctamente a la tabla propiedades.';
    } else {
        $mensajes[] = 'Error al agregar columna "categoria_id": ' . $db->error;
    }
}

// Verificar y crear tabla categorias
if (!tablaExiste($db, 'categorias')) {
    $query = "CREATE TABLE categorias (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL
    )";
    if ($db->query($query)) {
        $mensajes[] = 'Tabla "categorias" creada correctamente.';
        
        // Insertar algunas categorías por defecto
        $categorias = [
            'Casas', 
            'Apartamentos', 
            'Locales Comerciales', 
            'Terrenos', 
            'Oficinas'
        ];
        
        foreach ($categorias as $categoria) {
            $cat = mysqli_real_escape_string($db, $categoria);
            $query = "INSERT INTO categorias (nombre) VALUES ('{$cat}')";
            $db->query($query);
        }
        
        $mensajes[] = 'Categorías iniciales agregadas.';
    } else {
        $mensajes[] = 'Error al crear tabla "categorias": ' . $db->error;
    }
}

// Crear índice en categorias_id para mejorar rendimiento
if (columnaExiste($db, 'propiedades', 'categoria_id')) {
    $query = "SHOW INDEX FROM propiedades WHERE Column_name = 'categoria_id'";
    $resultado = $db->query($query);
    
    if ($resultado->num_rows === 0) {
        $query = "ALTER TABLE propiedades ADD INDEX idx_categoria (categoria_id)";
        if ($db->query($query)) {
            $mensajes[] = 'Índice creado para categoria_id.';
        } else {
            $mensajes[] = 'Error al crear índice para categoria_id: ' . $db->error;
        }
    }
}

// Agregar clave foránea entre propiedades y categorias
if (columnaExiste($db, 'propiedades', 'categoria_id') && tablaExiste($db, 'categorias')) {
    $query = "SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
              WHERE REFERENCED_TABLE_NAME = 'categorias' 
              AND TABLE_NAME = 'propiedades'";
    $resultado = $db->query($query);
    
    if ($resultado->num_rows === 0) {
        $query = "ALTER TABLE propiedades 
                  ADD CONSTRAINT fk_categoria 
                  FOREIGN KEY (categoria_id) REFERENCES categorias(id) 
                  ON DELETE SET NULL";
        if ($db->query($query)) {
            $mensajes[] = 'Clave foránea creada entre propiedades y categorias.';
        } else {
            $mensajes[] = 'Error al crear clave foránea: ' . $db->error;
        }
    }
}

// Incluir template header
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualización de Base de Datos</h1>
    
    <?php foreach ($mensajes as $mensaje): ?>
        <div class="alerta correcto">
            <?php echo $mensaje; ?>
        </div>
    <?php endforeach; ?>
    
    <?php if (count($mensajes) === 0): ?>
        <div class="alerta">
            No fue necesario realizar cambios. La estructura de la base de datos ya está actualizada.
        </div>
    <?php endif; ?>
    
    <a href="./" class="boton boton-verde">Volver</a>
</main>

<?php incluirTemplate('footer'); ?> 