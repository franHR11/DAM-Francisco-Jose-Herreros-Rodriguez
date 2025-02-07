<?php

include "../utilidades/error.php";
include "../config/config.php";

// Depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Imprimir parámetros recibidos
echo "Parámetros recibidos:<br>";
echo "tabla: " . (isset($_GET['tabla']) ? $_GET['tabla'] : 'no definido') . "<br>";
echo "id: " . (isset($_GET['id']) ? $_GET['id'] : 'no definido') . "<br>";

// Validación mejorada de parámetros
if (!isset($_GET['tabla']) || !isset($_GET['id'])) {
    die("Error: Faltan parámetros necesarios");
}

// Sanitización moderna de parámetros
$tabla = htmlspecialchars(strip_tags($_GET['tabla']));
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

// Validación de datos
if(empty($tabla) || empty($id)) {
    die("Error: Parámetros inválidos");
}

try {
    // Obtener el nombre de la clave primaria
    $descripcion_tabla = $conexion->query("DESCRIBE $tabla");
    $clave_primaria = null;
    while($campo = $descripcion_tabla->fetch_assoc()) {
        if($campo['Key'] == 'PRI') {
            $clave_primaria = $campo['Field'];
            break;
        }
        // Buscar también campos con nombres comunes de ID si no se encuentra PRI
        if(in_array($campo['Field'], ['id', 'ID', 'Id', 'Identificador', 'identificador', 'nombre']) && !$clave_primaria) {
            $clave_primaria = $campo['Field'];
        }
    }

    // Si aún no encontramos la clave primaria, asumimos que es el primer campo
    if(!$clave_primaria) {
        $descripcion_tabla->data_seek(0);
        $primer_campo = $descripcion_tabla->fetch_assoc();
        $clave_primaria = $primer_campo['Field'];
    }

    if(!$clave_primaria) {
        throw new Exception("No se encontró la clave primaria de la tabla");
    }

    // Si la tabla es productos, primero eliminar las relaciones en tiendas_productos
    if($tabla == 'productos') {
        $stmt = $conexion->prepare("DELETE FROM tiendas_productos WHERE producto_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    // Eliminar el registro usando la clave primaria detectada
    $stmt = $conexion->prepare("DELETE FROM $tabla WHERE $clave_primaria = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header("Location: ../escritorio.php?tabla=" . urlencode($tabla));
        exit();
    } else {
        throw new Exception("Error al eliminar el registro");
    }
} catch(Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}

$conexion->close();
?>

