<?php

$file = "archivo.txt";

$content = "Este es el contenido que quiero escribir en el archivo.\n";

$fileHandle = fopen($file, "w");

if ($fileHandle) {
    fwrite($fileHandle, $content);
    echo "Contenido escrito en el archivo correctamente.";
    
    fclose($fileHandle);
} else {
    echo "No se pudo abrir el archivo para escritura.";
}
?>
