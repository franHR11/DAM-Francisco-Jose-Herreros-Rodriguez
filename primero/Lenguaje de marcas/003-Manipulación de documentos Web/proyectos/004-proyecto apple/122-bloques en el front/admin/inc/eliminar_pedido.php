<?php
if(isset($_GET['file']) && isset($_GET['carpeta'])) {
    $fileName = basename($_GET['file']);
    $carpeta = basename($_GET['carpeta']);
    
    // Ruta absoluta simplificada
    $rutaArchivo = dirname(dirname(dirname(__FILE__))) . '/basededatos/' . $carpeta . '/' . $fileName;
    
    // Debug
    error_log("Intentando eliminar archivo: " . $rutaArchivo);
    
    if(file_exists($rutaArchivo)) {
        if(is_writable($rutaArchivo)) {
            if(unlink($rutaArchivo)) {
                header('Location: ../escritorio.php?carpeta=' . urlencode($carpeta) . '&mensaje=Pedido eliminado correctamente');
            } else {
                error_log("Error al eliminar el archivo: " . error_get_last()['message']);
                header('Location: ../escritorio.php?carpeta=' . urlencode($carpeta) . '&mensaje=Error al eliminar el pedido');
            }
        } else {
            error_log("El archivo no tiene permisos de escritura: " . $rutaArchivo);
            header('Location: ../escritorio.php?carpeta=' . urlencode($carpeta) . '&mensaje=Error de permisos');
        }
    } else {
        error_log("El archivo no existe: " . $rutaArchivo);
        header('Location: ../escritorio.php?carpeta=' . urlencode($carpeta) . '&mensaje=El archivo no existe');
    }
} else {
    header('Location: ../escritorio.php?carpeta=pedidos&mensaje=Faltan parámetros');
}
exit();
?>
