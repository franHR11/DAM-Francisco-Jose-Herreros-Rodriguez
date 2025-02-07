<?php
// Activar el buffer de salida
ob_start();

include "../utilidades/error.php";                           
include "../config/config.php";                          

// Para debug, guardar en log en lugar de mostrar en pantalla
error_log('POST data: ' . print_r($_POST, true));
error_log('FILES data: ' . print_r($_FILES, true));

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

if($_GET['tabla'] == 'bloquesproductos' || $_GET['tabla'] == 'bloquescategorias' || $_GET['tabla'] == 'bloquestiendas') {
    // Procesar la imagen principal y la imagen de fondo
    $imagen = '';
    $fondo = '';

    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = time() . '_' . $_FILES['imagen']['name'];
        if(!move_uploaded_file($_FILES['imagen']['tmp_name'], '../../static/' . $imagen)) {
            error_log('Error moving uploaded image file');
        }
    }

    if(isset($_FILES['fondo']) && $_FILES['fondo']['error'] == 0) {
        $fondo = time() . '_' . $_FILES['fondo']['name'];
        if(!move_uploaded_file($_FILES['fondo']['tmp_name'], '../../static/' . $fondo)) {
            error_log('Error moving uploaded background file');
        }
    }

    // Para tipos de bloques normales
    $campo_relacion = '';
    $valor_relacion = '';
    
    // Determinar el campo de relación según la tabla
    switch($_GET['tabla']) {
        case 'bloquesproductos':
            $campo_relacion = 'productos_titulo';
            $valor_relacion = $_POST['productos_titulo'];
            break;
        case 'bloquescategorias':
            $campo_relacion = 'categorias_nombre';
            $valor_relacion = $_POST['categorias_nombre'];
            break;
        case 'bloquestiendas':
            $campo_relacion = 'tiendas_id';
            $valor_relacion = $_POST['tiendas_id'];
            break;
    }

    // Si es tipo texto completo (8) o fondo y título (9), no escapar el HTML
    $texto = in_array($_POST['tipobloque_tipo'], ['8', '9']) ? 
        $_POST['texto'] : 
        mysqli_real_escape_string($conexion, $_POST['texto']);

    // Procesar el estilo si existe
    $estilo = isset($_POST['estilo']) ? $_POST['estilo'] : '';
    
    // Debug para ver qué estilo llega
    error_log('Estilo recibido: ' . print_r($estilo, true));

    $insertQuery = "INSERT INTO {$_GET['tabla']} (titulo, subtitulo, texto, imagen, fondo, tipobloque_tipo, estilo, {$campo_relacion}) 
                  VALUES ('".mysqli_real_escape_string($conexion, $_POST['titulo'])."',
                         '".mysqli_real_escape_string($conexion, $_POST['subtitulo'])."',
                         '".$texto."',
                         '".mysqli_real_escape_string($conexion, $imagen)."',
                         '".mysqli_real_escape_string($conexion, $fondo)."',
                         '".mysqli_real_escape_string($conexion, $_POST['tipobloque_tipo'])."',
                         '".mysqli_real_escape_string($conexion, $estilo)."',
                         '".mysqli_real_escape_string($conexion, $valor_relacion)."')";

    // Debug de la consulta
    error_log('Query de inserción: ' . $insertQuery);

    if($conexion->query($insertQuery)) {
        // Limpiar cualquier salida previa
        ob_clean();
        header("Location: ../escritorio.php?tabla=".$_GET['tabla']);
        exit();
    } else {
        error_log("Error en la inserción: " . $conexion->error);
        ob_clean();
        header("Location: ../escritorio.php?tabla=".$_GET['tabla']."&error=1");
        exit();
    }
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
if (isset($_POST['tienda_id']) && !empty($_POST['tienda_id'])) {
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
        // Si es el campo descripción, no escapar el HTML
        if ($clave === 'descripcion') {
            $valores[] = "'".$conexion->real_escape_string($valor)."'";
        } else {
            $valores[] = "'".$conexion->real_escape_string($valor)."'";
        }
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
            // Si es un producto y tiene tienda_id, crear la relación
            if ($_GET['tabla'] == 'productos' && $tienda_id) {
                $producto_id = $conexion->insert_id; // Obtener el ID del producto recién insertado
                $orden = 0; // Orden por defecto
                
                // Insertar en la tabla tiendas_productos
                $stmt = $conexion->prepare("INSERT INTO tiendas_productos (tienda_id, producto_id, orden) VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $tienda_id, $producto_id, $orden);
                $stmt->execute();
            }
            
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

// Asegurarse de que se envíe todo el buffer antes de salir
ob_end_flush();
?>
