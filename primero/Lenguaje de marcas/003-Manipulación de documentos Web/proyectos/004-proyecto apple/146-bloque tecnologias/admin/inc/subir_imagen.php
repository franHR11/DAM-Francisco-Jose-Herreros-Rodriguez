<?php
session_start();
if(!isset($_SESSION['login'])){
    die("Acceso no autorizado");
}

if(isset($_FILES['imagen'])) {
    $archivo = $_FILES['imagen'];
    $nombre = $archivo['name'];
    $tipo = $archivo['type'];
    $ruta_temporal = $archivo['tmp_name'];
    
    // Validar que sea una imagen
    if(strpos($tipo, 'image/') === 0) {
        $ruta_destino = "../../static/" . basename($nombre);
        
        // Si existe la imagen, la eliminaremos primero
        if(file_exists($ruta_destino)) {
            unlink($ruta_destino);
        }
        
        if(move_uploaded_file($ruta_temporal, $ruta_destino)) {
            header("Location: ../escritorio.php?seccion=imagenes&mensaje=Imagen subida correctamente");
            exit();
        } else {
            header("Location: ../escritorio.php?seccion=imagenes&error=Error al subir la imagen");
            exit();
        }
    } else {
        header("Location: ../escritorio.php?seccion=imagenes&error=El archivo debe ser una imagen");
        exit();
    }
} else {
    header("Location: ../escritorio.php?seccion=imagenes&error=No se recibió ninguna imagen");
    exit();
}
?>
