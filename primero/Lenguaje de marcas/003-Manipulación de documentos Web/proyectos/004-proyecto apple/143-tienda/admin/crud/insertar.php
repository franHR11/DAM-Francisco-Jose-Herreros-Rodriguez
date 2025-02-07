<?php

// Este archivo inserta los campos que vienen del formulario
var_dump($_POST);
echo "<br>";
var_dump($_FILES);
echo "<br>";
include "../utilidades/error.php";                           // Incluyo los mensajes de error
include "../config/config.php";                          // Traigo la conexión a la base de datos

// Añadir esta sección después de las inclusiones iniciales
if($_GET['tabla'] == 'tiendas_productos') {
    // Validar que los IDs existan
    $tienda_id = (int)$_POST['tienda_id'];
    $producto_id = (int)$_POST['producto_id'];
    $orden = (int)$_POST['orden'];

    // Verificar que la tienda existe
    $checkTienda = $conexion->query("SELECT Identificador FROM tiendas WHERE Identificador = $tienda_id");
    if($checkTienda->num_rows == 0) {
        die("Error: La tienda seleccionada no existe.");
    }

    // Verificar que el producto existe
    $checkProducto = $conexion->query("SELECT Identificador FROM productos WHERE Identificador = $producto_id");
    if($checkProducto->num_rows == 0) {
        die("Error: El producto seleccionado no existe.");
    }

    // Verificar si la relación ya existe
    $checkRelacion = $conexion->query("SELECT * FROM tiendas_productos WHERE tienda_id = $tienda_id AND producto_id = $producto_id");
    
    if($checkRelacion->num_rows > 0) {
        // Si existe, actualizar el orden
        $stmt = $conexion->prepare("UPDATE tiendas_productos SET orden = ? WHERE tienda_id = ? AND producto_id = ?");
        $stmt->bind_param("iii", $orden, $tienda_id, $producto_id);
        
        if($stmt->execute()) {
            echo "<div style='color: green;'>Orden actualizado correctamente.</div>";
            header("refresh:2;url=../escritorio.php?tabla=tiendas_productos");
        } else {
            echo "<div style='color: red;'>Error actualizando el orden: " . $stmt->error . "</div>";
        }
    } else {
        // Si no existe, insertar nueva relación
        $stmt = $conexion->prepare("INSERT INTO tiendas_productos (tienda_id, producto_id, orden) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $tienda_id, $producto_id, $orden);
        
        if($stmt->execute()) {
            echo "<div style='color: green;'>Relación añadida correctamente.</div>";
            header("refresh:2;url=../escritorio.php?tabla=tiendas_productos");
        } else {
            echo "<div style='color: red;'>Error: " . $stmt->error . "</div>";
        }
    }
    
    $stmt->close();
    exit;
}

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

// Antes de construir la consulta, guardar y remover tienda_id si existe
$tienda_id = null;
if (isset($_POST['tienda_id'])) {
    $tienda_id = (int)$_POST['tienda_id'];
    unset($_POST['tienda_id']); // Removemos tienda_id de $_POST
}

// Construir la consulta de manera más segura
$campos = [];
$valores = [];

foreach ($_POST as $clave => $valor) {
    // Ignorar el campo Identificador y validar valores no vacíos
    if ($clave !== "Identificador" && (!empty(trim($valor)) || $valor === "0")) {
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

        $fileName = time() . '_' . basename($archivo['name']); // Añadido timestamp para evitar conflictos
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($archivo['tmp_name'], $targetPath)) {
            $campos[] = $campo;
            $valores[] = "'".$conexion->real_escape_string($fileName)."'";
        }
    }
}

// Solo construir la consulta si hay campos para insertar
if (count($campos) > 0) {
    $peticion = "INSERT INTO ".$_GET['tabla']." 
                 (".implode(",", $campos).") 
                 VALUES (".implode(",", $valores).")";

    try {
        if ($conexion->query($peticion)) {
            echo "<div style='color: green;'>Inserción realizada con éxito.</div>";
            header("refresh:2;url=../escritorio.php?tabla=".$_GET['tabla']);
        } else {
            throw new Exception($conexion->error);
        }
    } catch (Exception $e) {
        echo "<div style='color: red;'>Error en la inserción: " . $e->getMessage() . "</div>";
        echo "<pre>Query: " . $peticion . "</pre>";
        echo '<br><a href="javascript:history.back()">Volver al formulario</a>';
    }
} else {
    echo "<div style='color: red;'>Error: No hay datos válidos para insertar</div>";
    echo '<br><a href="javascript:history.back()">Volver al formulario</a>';
}

?>
