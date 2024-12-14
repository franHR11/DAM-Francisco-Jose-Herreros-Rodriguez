<?php

// Este archivo inserta los campos que vienen del formulario
var_dump($_POST);
echo "<br>";
var_dump($_FILES);
echo "<br>";
include "../utilidades/error.php";                           // Incluyo los mensajes de error
include "../config/config.php";                          // Traigo la conexión a la base de datos

$peticion = "
INSERT INTO 
".$_GET['tabla']." 
VALUES("; 

// Recorre las claves de `$_POST` y maneja los valores
foreach (array_keys($_POST) as $clave) {
    if ($clave == "Identificador") {
        $peticion .= "NULL,";
    } else {
        $peticion .= "'".$conexion->real_escape_string($_POST[$clave])."',";
    }
}

// Recorre las claves de `$_FILES` para manejar archivos
foreach ($_FILES as $clave => $archivo) {
	var_dump($archivo);
   if ($archivo['error'] !== UPLOAD_ERR_OK) {
    echo "Error en la subida del archivo. Código de error: " . $archivo['error'];
    continue;
}
        // Procesa el archivo como contenido binario
        $fileTmpName = $archivo['tmp_name'];
        $fileContent = file_get_contents($fileTmpName);
        $fileContentEscaped = $conexion->real_escape_string($fileContent);
        $peticion .= "'".$fileContentEscaped."',";
    
}

// Elimina la última coma
$peticion = substr($peticion, 0, -1);
$peticion .= ")";

// Ejecuta la consulta
echo "Consulta SQL: ".$peticion."<br>"; // Para depuración
$resultado = $conexion->query($peticion);

if (!$resultado) {
    echo "Error en la inserción: " . $conexion->error;
}
?>
echo "ok";
<meta http-equiv="refresh" content="5; url=../escritorio.php">

