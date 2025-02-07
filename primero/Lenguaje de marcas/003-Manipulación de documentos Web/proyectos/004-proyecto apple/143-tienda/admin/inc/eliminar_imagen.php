<?php
session_start();
if(!isset($_SESSION['login'])){
    die("Acceso no autorizado");
}

// Recibir el contenido JSON
$input = json_decode(file_get_contents('php://input'), true);

if(isset($_POST['imagen'])) {
    // Mantener compatibilidad con la eliminación individual
    $imagen = $_POST['imagen'];
    $ruta = "../../static/" . basename($imagen);
    
    if(file_exists($ruta)) {
        if(unlink($ruta)) {
            echo "Imagen eliminada correctamente";
        } else {
            echo "Error al eliminar la imagen";
        }
    } else {
        echo "La imagen no existe";
    }
} elseif(isset($input['imagenes']) && is_array($input['imagenes'])) {
    // Eliminación múltiple
    $eliminadas = 0;
    $errores = 0;
    
    foreach($input['imagenes'] as $imagen) {
        $ruta = "../../static/" . basename($imagen);
        if(file_exists($ruta)) {
            if(unlink($ruta)) {
                $eliminadas++;
            } else {
                $errores++;
            }
        } else {
            $errores++;
        }
    }
    
    echo "Se eliminaron $eliminadas imágenes correctamente." . 
         ($errores > 0 ? " Hubo errores con $errores imágenes." : "");
}
?>
