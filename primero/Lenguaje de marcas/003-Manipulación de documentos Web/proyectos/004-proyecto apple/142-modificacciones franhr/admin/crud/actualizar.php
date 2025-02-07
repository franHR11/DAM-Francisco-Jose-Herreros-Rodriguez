<?php
include "../utilidades/error.php";
include "../config/config.php";

// Verificar que se recibieron los parámetros necesarios
if (!isset($_POST['tabla']) || !isset($_POST['id'])) {
    die("Error: Faltan parámetros necesarios");
}

$tabla = $_POST['tabla'];
$id = intval($_POST['id']);

// Validar que la tabla y el ID son válidos
if ($tabla !== 'tiendas' || $id <= 0) {
    die("Error: Tabla o ID inválidos");
}

try {
    // Procesar imágenes si se subieron nuevas
    $imagen = null;
    $fondo = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = time() . '_' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], '../../static/' . $imagen);
    }

    if (isset($_FILES['fondo']) && $_FILES['fondo']['error'] === UPLOAD_ERR_OK) {
        $fondo = time() . '_' . $_FILES['fondo']['name'];
        move_uploaded_file($_FILES['fondo']['tmp_name'], '../../static/' . $fondo);
    }

    // Construir la consulta de actualización
    $updates = [];
    if (!empty($_POST['titulo'])) $updates[] = "titulo = '" . $conexion->real_escape_string($_POST['titulo']) . "'";
    if (!empty($_POST['subtitulo'])) $updates[] = "subtitulo = '" . $conexion->real_escape_string($_POST['subtitulo']) . "'";
    if (!empty($_POST['descripcion'])) $updates[] = "descripcion = '" . $conexion->real_escape_string($_POST['descripcion']) . "'";
    if ($imagen) $updates[] = "imagen = '" . $conexion->real_escape_string($imagen) . "'";
    if ($fondo) $updates[] = "fondo = '" . $conexion->real_escape_string($fondo) . "'";
    if (isset($_POST['estilo'])) $updates[] = "estilo = '" . $conexion->real_escape_string($_POST['estilo']) . "'";

    if (!empty($updates)) {
        $updateQuery = "UPDATE tiendas SET " . implode(", ", $updates) . " WHERE Identificador = " . $id;
        if (!$conexion->query($updateQuery)) {
            throw new Exception("Error actualizando la tienda: " . $conexion->error);
        }
    }

    // Actualizar productos asociados si se proporcionaron
    if (isset($_POST['productos']) && is_array($_POST['productos'])) {
        // Primero eliminar todas las asociaciones existentes
        $deleteQuery = "DELETE FROM tiendas_productos WHERE tienda_id = " . $id;
        if (!$conexion->query($deleteQuery)) {
            throw new Exception("Error eliminando productos antiguos: " . $conexion->error);
        }

        // Insertar nuevas asociaciones
        foreach ($_POST['productos'] as $orden => $producto_id) {
            $insertQuery = "INSERT INTO tiendas_productos (tienda_id, producto_id, orden) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($insertQuery);
            $stmt->bind_param("iii", $id, $producto_id, $orden);
            if (!$stmt->execute()) {
                throw new Exception("Error asociando producto: " . $stmt->error);
            }
        }
    }

    // Redirigir al listado de tiendas
    header("Location: ../escritorio.php?tabla=tiendas&mensaje=actualizado");
    exit;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    echo "<br><a href='javascript:history.back()'>Volver</a>";
}
?>
