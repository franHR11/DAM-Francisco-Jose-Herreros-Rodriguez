<?php
session_start();
if(!isset($_SESSION['login'])){
    die("Acceso no autorizado");
}

if(isset($_POST['nombre_actual']) && isset($_POST['nuevo_nombre']) && isset($_POST['extension'])) {
    $nombre_actual = $_POST['nombre_actual'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $extension = $_POST['extension'];
    
    $ruta_actual = "../../static/" . basename($nombre_actual);
    $ruta_nueva = "../../static/" . basename($nuevo_nombre . "." . $extension);
    
    if(!file_exists($ruta_actual)) {
        echo "La imagen original no existe";
        exit;
    }
    
    if(file_exists($ruta_nueva) && $ruta_actual !== $ruta_nueva) {
        echo "Ya existe una imagen con ese nombre";
        exit;
    }
    
    if(rename($ruta_actual, $ruta_nueva)) {
        echo "Imagen renombrada correctamente";
    } else {
        echo "Error al renombrar la imagen";
    }
} else {
    echo "Faltan datos necesarios";
}
?>
