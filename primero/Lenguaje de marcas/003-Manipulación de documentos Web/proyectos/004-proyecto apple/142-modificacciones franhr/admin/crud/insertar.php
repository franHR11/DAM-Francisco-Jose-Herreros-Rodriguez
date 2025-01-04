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

    // Si es tipo tienda (7), manejar productos seleccionados
    if ($_POST['tipobloque_tipo'] == '7' && isset($_POST['productos'])) {
        $productos = [];
        
        // Obtener información de cada producto seleccionado
        foreach ($_POST['productos'] as $productoId) {
            $query = "SELECT * FROM productos WHERE Identificador = '".mysqli_real_escape_string($conexion, $productoId)."'";
            $result = $conexion->query($query);
            
            if($producto = $result->fetch_assoc()) {
                $productos[] = [
                    'id' => $producto['Identificador'],
                    'titulo' => $producto['titulo'],
                    'subtitulo' => $producto['subtitulo'],
                    'precio' => $producto['precio'],
                    'imagen' => $producto['imagen']
                ];
            }
        }

        // Convertir los productos a JSON
        $productosJson = json_encode($productos);

        // Verificar si se seleccionó un bloque tienda existente
        if (!empty($_POST['bloque_tienda_existente'])) {
            // Obtener los productos actuales del bloque
            $queryBloque = "SELECT texto FROM bloquesproductos WHERE Identificador = '".mysqli_real_escape_string($conexion, $_POST['bloque_tienda_existente'])."'";
            $resultBloque = $conexion->query($queryBloque);
            $bloqueExistente = $resultBloque->fetch_assoc();
            
            // Combinar productos existentes con nuevos
            $productosExistentes = json_decode($bloqueExistente['texto'], true) ?: [];
            $todosProductos = array_merge($productosExistentes, $productos);
            $productosJsonActualizado = json_encode($todosProductos);

            // Actualizar el bloque existente
            $updateQuery = "UPDATE bloquesproductos SET texto = '".mysqli_real_escape_string($conexion, $productosJsonActualizado)."' WHERE Identificador = '".mysqli_real_escape_string($conexion, $_POST['bloque_tienda_existente'])."'";
            
            if($conexion->query($updateQuery)) {
                header("Location: ../escritorio.php?tabla=bloquesproductos");
            } else {
                echo "Error: " . $conexion->error;
            }
        } else {
            // Crear nuevo bloque tienda
            $primer_producto_id = $_POST['productos'][0];
            $insertQuery = "INSERT INTO bloquesproductos (titulo, subtitulo, texto, imagen, tipobloque_tipo, productos_titulo) 
                          VALUES ('".mysqli_real_escape_string($conexion, $_POST['titulo'])."',
                                 '".mysqli_real_escape_string($conexion, $_POST['subtitulo'])."',
                                 '".mysqli_real_escape_string($conexion, $productosJson)."',
                                 '".mysqli_real_escape_string($conexion, $imagen)."',
                                 '".mysqli_real_escape_string($conexion, $_POST['tipobloque_tipo'])."',
                                 '".mysqli_real_escape_string($conexion, $primer_producto_id)."')";
            
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

// Añadir esta sección para productos después de la validación de categorías
if($_GET['tabla'] == 'productos') {
    // Validar precio
    if(isset($_POST['precio'])) {
        $precio = filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT);
        if($precio === false || $precio < 0) {
            die("Error: El precio debe ser un número válido y positivo.");
        }
    }

    // Procesar la imagen
    $imagen = '';
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = time() . '_' . $_FILES['imagen']['name'];
        $uploadDir = "../../static/";
        if(!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadDir . $imagen);
    }

    // Sanitizar campos de texto
    $titulo = $conexion->real_escape_string($_POST['titulo']);
    $subtitulo = $conexion->real_escape_string($_POST['subtitulo']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']); // Cambiado de texto a descripcion
    $categorias_nombre = intval($_POST['categorias_nombre']);

    // Construir la consulta específica para productos
    $insertQuery = "INSERT INTO productos (titulo, subtitulo, descripcion, precio, categorias_nombre, imagen) 
                   VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($insertQuery);
    $stmt->bind_param("sssdis", $titulo, $subtitulo, $descripcion, $precio, $categorias_nombre, $imagen);
    
    if($stmt->execute()) {
        echo "<div style='color: green;'>Producto insertado correctamente.</div>";
        header("refresh:2;url=../escritorio.php?tabla=productos");
    } else {
        echo "<div style='color: red;'>Error al insertar el producto: " . $stmt->error . "</div>";
    }
    
    $stmt->close();
    exit;
}

// Añadir manejo específico para tiendas
if($_GET['tabla'] == 'tiendas') {
    // Procesar imágenes si existen
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

    // Preparar la consulta para insertar en la tabla tiendas
    $insertTiendaQuery = "INSERT INTO tiendas (titulo, subtitulo, descripcion, imagen, fondo, estilo) 
                         VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($insertTiendaQuery);
    $stmt->bind_param("ssssss", 
        $_POST['titulo'],
        $_POST['subtitulo'],
        $_POST['descripcion'],
        $imagen,
        $fondo,
        $_POST['estilo']
    );

    if($stmt->execute()) {
        $tienda_id = $stmt->insert_id;
        
        // Si hay productos seleccionados, insertarlos en la tabla intermedia
        if(isset($_POST['productos']) && is_array($_POST['productos'])) {
            $orden = 0;
            foreach($_POST['productos'] as $producto_id) {
                $insertRelacionQuery = "INSERT INTO tiendas_productos (tienda_id, producto_id, orden) VALUES (?, ?, ?)";
                $stmtRel = $conexion->prepare($insertRelacionQuery);
                $stmtRel->bind_param("iii", $tienda_id, $producto_id, $orden);
                $stmtRel->execute();
                $orden++;
            }
        }
        
        echo "<div style='color: green;'>Tienda creada correctamente.</div>";
        header("refresh:2;url=../escritorio.php?tabla=tiendas");
    } else {
        echo "<div style='color: red;'>Error al crear la tienda: " . $stmt->error . "</div>";
    }
    
    exit;
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
