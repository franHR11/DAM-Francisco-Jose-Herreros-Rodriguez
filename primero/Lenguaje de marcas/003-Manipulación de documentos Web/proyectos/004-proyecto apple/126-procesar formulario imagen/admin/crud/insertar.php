<?php

// Este archivo inserta los campos que vienen del formulario
var_dump($_POST);
echo "<br>";
var_dump($_FILES);
echo "<br>";
include "../utilidades/error.php";                           // Incluyo los mensajes de error
include "../config/config.php";                          // Traigo la conexión a la base de datos

// Validación mejorada de la categoría
if (isset($_POST['categoriasblog_categorias'])) {
    $categoria_id = intval($_POST['categoriasblog_categorias']);
    $stmt = $conexion->prepare("SELECT Identificador FROM categoriasblog WHERE Identificador = ?");
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        die("Error: La categoría seleccionada (ID: $categoria_id) no existe en la base de datos.");
    }
    $stmt->close();
}

// Construir la consulta de manera más segura
$campos = [];
$valores = [];

foreach ($_POST as $clave => $valor) {
    if ($clave == "Identificador") {
        $campos[] = $clave;
        $valores[] = "NULL";
    } else {
        $campos[] = $clave;
        $valores[] = "'".$conexion->real_escape_string($valor)."'";
    }
}

// Manejar la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = "../../static/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = basename($_FILES['imagen']['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
        $campos[] = "imagen";
        $valores[] = "'".$conexion->real_escape_string($fileName)."'";
    }
}

// Construir la consulta final
$peticion = "INSERT INTO ".$_GET['tabla']." 
             (".implode(",", $campos).") 
             VALUES (".implode(",", $valores).")";

// Ejecutar la consulta con mejor manejo de errores
try {
    echo "Consulta SQL: ".$peticion."<br>";
    $resultado = $conexion->query($peticion);
    
    if ($resultado) {
        echo "<div style='color: green;'>Inserción realizada con éxito.</div>";
        header("refresh:2;url=../escritorio.php");
    } else {
        throw new Exception($conexion->error);
    }
} catch (Exception $e) {
    echo "<div style='color: red;'>Error en la inserción: " . $e->getMessage() . "</div>";
    echo '<br><a href="javascript:history.back()">Volver al formulario</a>';
    exit();
}

?>
