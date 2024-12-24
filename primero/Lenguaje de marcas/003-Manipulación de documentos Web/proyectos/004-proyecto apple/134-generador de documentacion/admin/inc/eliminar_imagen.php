<?php
session_start();
if(!isset($_SESSION['login'])){
    die("Acceso no autorizado");
}

if(isset($_POST['imagen'])) {
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
}
?>
