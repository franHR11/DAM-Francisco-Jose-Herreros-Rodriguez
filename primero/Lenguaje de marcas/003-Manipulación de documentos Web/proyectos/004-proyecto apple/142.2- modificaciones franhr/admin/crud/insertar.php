<?php

// Este archivo inserta los campos que vienen del formulario
var_dump($_POST);
echo "<br>";
var_dump($_FILES);
echo "<br>";
include "../utilidades/error.php";                           // Incluyo los mensajes de error
include "../config/config.php";                          // Traigo la conexión a la base de datos

if($_GET['tabla'] == 'bloquesproductos') {
    // Procesar la imagen principal y la imagen de fondo
    $imagen = '';
    $fondo = '';

    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = time() . '_' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], '../../static/' . $imagen);
    }

    if(isset($_FILES['fondo']) && $_FILES['fondo']['error'] == 0) {
        $fondo = time() . '_' . $_FILES['fondo']['name'];
        move_uploaded_file($_FILES['fondo']['tmp_name'], '../../static/' . $fondo);
    }

    // Si es tipo tienda (7), manejar como producto
    if ($_POST['tipobloque_tipo'] == '7') {
        // Crear el objeto JSON con los datos del producto
        $nuevoProducto = [
            'titulo' => $_POST['titulo'],
            'subtitulo' => $_POST['subtitulo'],
            'precio' => $_POST['precio'],
            'imagen' => $imagen
        ];

        // Verificar si ya existe un bloque de tipo tienda
        $query = "SELECT * FROM bloquesproductos WHERE tipobloque_tipo = '7' AND productos_titulo = '".mysqli_real_escape_string($conexion, $_POST['productos_titulo'])."'";
        $result = $conexion->query($query);

        if($result->num_rows > 0) {
            // Si existe, añadir el nuevo producto al bloque existente
            $fila = $result->fetch_assoc();
            $productos = json_decode($fila['texto'], true) ?: [];
            $productos[] = $nuevoProducto;
            $productosJson = json_encode($productos);

            $updateQuery = "UPDATE bloquesproductos SET texto = '".mysqli_real_escape_string($conexion, $productosJson)."' WHERE Identificador = ".$fila['Identificador'];
            if($conexion->query($updateQuery)) {
                echo "<div style='color: green;'>Producto añadido al bloque tienda existente.</div>";
                header("refresh:2;url=../escritorio.php?tabla=bloquesproductos");
            } else {
                echo "Error: " . $conexion->error;
            }
        } else {
            // Si no existe, crear un nuevo bloque de tipo tienda
            $productosJson = json_encode([$nuevoProducto]);
            // Continuar con la inserción normal
            $insertQuery = "INSERT INTO bloquesproductos (titulo, subtitulo, texto, imagen, tipobloque_tipo, productos_titulo) 
                          VALUES ('".mysqli_real_escape_string($conexion, $_POST['titulo'])."',
                                 '".mysqli_real_escape_string($conexion, $_POST['subtitulo'])."',
                                 '".mysqli_real_escape_string($conexion, $productosJson)."',
                                 '".mysqli_real_escape_string($conexion, $imagen)."',
                                 '".mysqli_real_escape_string($conexion, $_POST['tipobloque_tipo'])."',
                                 '".mysqli_real_escape_string($conexion, $_POST['productos_titulo'])."')";
            
            if($conexion->query($insertQuery)) {
                header("Location: ../escritorio.php?tabla=bloquesproductos");
            } else {
                echo "Error: " . $conexion->error;
            }
        }
    } else {
        // Para otros tipos de bloques, insertar normalmente
        $insertQuery = "INSERT INTO bloquesproductos (titulo, subtitulo, texto, imagen, fondo, tipobloque_tipo, productos_titulo) 
                      VALUES ('".mysqli_real_escape_string($conexion, $_POST['titulo'])."',
                             '".mysqli_real_escape_string($conexion, $_POST['subtitulo'])."',
                             '".mysqli_real_escape_string($conexion, $_POST['texto'])."',
                             '".mysqli_real_escape_string($conexion, $imagen)."',
                             '".mysqli_real_escape_string($conexion, $fondo)."',
                             '".mysqli_real_escape_string($conexion, $_POST['tipobloque_tipo'])."',
                             '".mysqli_real_escape_string($conexion, $_POST['productos_titulo'])."')";
        
        if($conexion->query($insertQuery)) {
            header("Location: ../escritorio.php?tabla=bloquesproductos");
        } else {
            echo "Error: " . $conexion->error;
        }
    }
    exit;
}

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
    // Solo incluir el campo si tiene un valor o es Identificador
    if ($clave == "Identificador") {
        $campos[] = $clave;
        $valores[] = "NULL";
    } else if (!empty(trim($valor))) { // Solo incluir campos con valores no vacíos
        $campos[] = $clave;
        $valores[] = "'".$conexion->real_escape_string($valor)."'";
    }
}

// Manejar tanto imágenes como fondos
foreach ($_FILES as $campo => $archivo) {
    if ($archivo['error'] === UPLOAD_ERR_OK && !empty($archivo['name'])) {
        $uploadDir = "../../static/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = basename($archivo['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($archivo['tmp_name'], $targetPath)) {
            $campos[] = $campo;
            $valores[] = "'".$conexion->real_escape_string($fileName)."'";
        }
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
