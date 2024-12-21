<?php
include "../utilidades/error.php";
include "../config/config.php";

// Para debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['action'])) {
    try {
        switch($_POST['action']) {
            case 'add':
                if(isset($_POST['nombre']) && isset($_POST['url'])) {
                    $nombre = $conexion->real_escape_string($_POST['nombre']);
                    $url = $conexion->real_escape_string($_POST['url']);
                    
                    // Query más simple y directa
                    $query = "INSERT INTO menu_enlaces (nombre, url) VALUES ('$nombre', '$url')";
                    
                    if(!$conexion->query($query)) {
                        throw new Exception("Error en inserción: " . $conexion->error);
                    }
                    echo "ok-added";
                }
                break;
                
            case 'delete':
                if(isset($_POST['id'])) {
                    $id = (int)$_POST['id'];
                    $query = "DELETE FROM menu_enlaces WHERE Identificador = $id";
                    if(!$conexion->query($query)) {
                        throw new Exception("Error en eliminación: " . $conexion->error);
                    }
                    echo "ok-deleted";
                }
                break;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No action specified";
}

$conexion->close();
?>
