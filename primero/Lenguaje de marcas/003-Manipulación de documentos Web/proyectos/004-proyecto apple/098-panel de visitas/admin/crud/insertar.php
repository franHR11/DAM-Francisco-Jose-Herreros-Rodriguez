<?php
include "../utilidades/error.php";                           
include "../config/config.php";

$peticion = "INSERT INTO ".$_GET['tabla']." ("; 

// Primero construimos la lista de campos
$campos = [];
foreach (array_keys($_POST) as $clave) {
    if(!empty($_POST[$clave])) {
        $campos[] = $clave;
    }
}

// Agregar campos de imagen si existen
foreach ($_FILES as $clave => $archivo) {
    if($archivo['size'] > 0) {
        $campos[] = $clave;
    }
}

$peticion .= implode(",", $campos) . ") VALUES (";

// Luego los valores
$valores = [];
foreach ($campos as $campo) {
    if ($campo == "Identificador") {
        $valores[] = "NULL";
    } 
    // Si es un campo de imagen
    else if(isset($_FILES[$campo])) {
        $imagen = file_get_contents($_FILES[$campo]['tmp_name']);
        $valores[] = "'".$conexion->real_escape_string($imagen)."'";
    }
    // Para el resto de campos
    else {
        $valores[] = "'".$conexion->real_escape_string($_POST[$campo])."'";
    }
}

$peticion .= implode(",", $valores) . ")";

$resultado = $conexion->query($peticion);

if (!$resultado) {
    die("Error en la inserción: " . $conexion->error);
}

echo "ok";
?>
<meta http-equiv="refresh" content="5; url=../escritorio.php">