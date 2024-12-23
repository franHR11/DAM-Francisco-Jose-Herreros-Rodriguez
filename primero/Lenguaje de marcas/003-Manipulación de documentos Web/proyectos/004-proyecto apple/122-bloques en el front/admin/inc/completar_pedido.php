<?php
if(isset($_GET['file']) && isset($_GET['carpeta'])) {
    $fileName = basename($_GET['file']);
    $carpeta = basename($_GET['carpeta']);
    
    $rutaBase = dirname(dirname(dirname(__FILE__)));
    $rutaArchivo = $rutaBase . DIRECTORY_SEPARATOR . 'basededatos' . DIRECTORY_SEPARATOR . $carpeta . DIRECTORY_SEPARATOR . $fileName;
    
    if(file_exists($rutaArchivo) && is_file($rutaArchivo)) {
        $data = json_decode(file_get_contents($rutaArchivo), true);
        $data['estado'] = isset($data['estado']) && $data['estado'] == 'completado' ? 'pendiente' : 'completado';
        file_put_contents($rutaArchivo, json_encode($data, JSON_PRETTY_PRINT));
        
        header('Location: ../escritorio.php?carpeta=' . urlencode($carpeta));
    }
}
exit();
?>
