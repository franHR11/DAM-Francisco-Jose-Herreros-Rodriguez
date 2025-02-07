<?php

include "../utilidades/error.php";
include "../config/config.php";

// Validar que tenemos los parámetros necesarios
if (!isset($_GET['tabla'])) {
    die("Error: No se especificó la tabla");
}

// Manejar diferentes tipos de identificadores
$id = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_GET['Identificador'])) {
    $id = $_GET['Identificador'];
}

if ($id === null) {
    die("Error: No se especificó un identificador válido");
}

try {
    if ($_GET['tabla'] === 'tiendas') {
        // Primero eliminar las relaciones en la tabla intermedia
        $deleteRelaciones = "DELETE FROM tiendas_productos WHERE tienda_id = ?";
        $stmt = $conexion->prepare($deleteRelaciones);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Luego eliminar la tienda
        $deleteTienda = "DELETE FROM tiendas WHERE Identificador = ?";
        $stmt = $conexion->prepare($deleteTienda);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            header("Location: ../escritorio.php?tabla=tiendas&mensaje=eliminado");
        } else {
            throw new Exception("Error al eliminar la tienda");
        }
    } 
    else if ($_GET['tabla'] === 'tiendas_productos') {
        // Validar que tenemos los IDs necesarios
        if (!isset($_GET['tienda_id']) || !isset($_GET['producto_id'])) {
            die("Error: Faltan identificadores para la relación tienda-producto");
        }
        
        $deleteRelacion = "DELETE FROM tiendas_productos WHERE tienda_id = ? AND producto_id = ?";
        $stmt = $conexion->prepare($deleteRelacion);
        $stmt->bind_param("ii", $_GET['tienda_id'], $_GET['producto_id']);
        
        if ($stmt->execute()) {
            header("Location: ../escritorio.php?tabla=tiendas_productos&mensaje=eliminado");
        } else {
            throw new Exception("Error al eliminar la relación tienda-producto");
        }
    }
    else {
        // Para otras tablas, usar la eliminación estándar
        $query = "DELETE FROM " . $_GET['tabla'] . " WHERE Identificador = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            header("Location: ../escritorio.php?tabla=" . $_GET['tabla'] . "&mensaje=eliminado");
        } else {
            throw new Exception("Error al eliminar el registro");
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    echo "<br><a href='javascript:history.back()'>Volver</a>";
}

$conexion->close();
?>

