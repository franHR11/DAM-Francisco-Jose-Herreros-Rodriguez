<?php

$file = "compilado.html";

$content = "<h1>Este es un contenido desde PHP</h1>";

$fileHandle = fopen($file, "w");

fwrite($fileHandle, $content);
    
fclose($fileHandle);

?>
