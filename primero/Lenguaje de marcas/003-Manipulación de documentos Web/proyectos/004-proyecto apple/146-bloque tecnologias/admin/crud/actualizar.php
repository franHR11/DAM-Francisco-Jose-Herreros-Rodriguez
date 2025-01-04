<?php
include "../utilidades/error.php";
include "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tabla = htmlspecialchars(strip_tags($_POST['tabla']));
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $clave_primaria = $_POST['clave_primaria'] ?? null;

    // Si no se envió la clave primaria, intentar detectarla
    if (!$clave_primaria) {
        $descripcion_tabla = $conexion->query("DESCRIBE $tabla");
        while($campo = $descripcion_tabla->fetch_assoc()) {
            if($campo['Key'] == 'PRI') {
                $clave_primaria = $campo['Field'];
                break;
            }
            // Buscar también campos con nombres comunes de ID si no se encuentra PRI
            if(in_array($campo['Field'], ['id', 'ID', 'Id', 'Identificador', 'identificador', 'nombre']) && !$clave_primaria) {
                $clave_primaria = $campo['Field'];
            }
        }

        // Si aún no encontramos la clave primaria, asumimos que es el primer campo
        if(!$clave_primaria) {
            $descripcion_tabla->data_seek(0);
            $primer_campo = $descripcion_tabla->fetch_assoc();
            $clave_primaria = $primer_campo['Field'];
        }
    }

    if (!$clave_primaria) {
        die("Error: No se pudo determinar la clave primaria de la tabla");
    }
    
    // Extraer tienda_id si existe y eliminarlo de $_POST
    $tienda_id = null;
    if (isset($_POST['tienda_id'])) {
        $tienda_id = filter_var($_POST['tienda_id'], FILTER_SANITIZE_NUMBER_INT);
        unset($_POST['tienda_id']);
    }

    // Eliminar campos del sistema que no deben ser parte de la actualización
    unset($_POST['submit'], $_POST['tabla'], $_POST['id'], $_POST['clave_primaria']);

    $campos = [];
    $valores = [];
    $tipos = "";

    // Manejar archivos subidos y selecciones de biblioteca
    if (!empty($_FILES) || !empty($_POST)) {
        foreach ($_FILES as $campo => $archivo) {
            // Si hay una imagen seleccionada de la biblioteca
            if (isset($_POST[$campo.'_biblioteca']) && !empty($_POST[$campo.'_biblioteca'])) {
                $campos[] = "$campo = ?";
                $valores[] = $_POST[$campo.'_biblioteca'];
                $tipos .= "s";
                continue;
            }

            // Si hay un archivo subido
            if ($archivo['error'] === UPLOAD_ERR_OK && $archivo['size'] > 0) {
                $nombre_archivo = time() . '_' . basename($archivo['name']);
                $ruta_destino = "../../static/" . $nombre_archivo;
                
                // Primero obtener la imagen anterior
                $query = "SELECT $campo FROM $tabla WHERE $clave_primaria = ?";
                $stmt_img = $conexion->prepare($query);
                $stmt_img->bind_param("i", $id);
                $stmt_img->execute();
                $result = $stmt_img->get_result();
                if ($row = $result->fetch_assoc()) {
                    $imagen_anterior = $row[$campo];
                    // Eliminar imagen anterior si existe
                    if ($imagen_anterior && file_exists("../../static/" . $imagen_anterior)) {
                        unlink("../../static/" . $imagen_anterior);
                    }
                }
                
                if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
                    $campos[] = "$campo = ?";
                    $valores[] = $nombre_archivo;
                    $tipos .= "s";
                }
            } elseif (isset($_POST['quitar_' . $campo]) && $_POST['quitar_' . $campo] == '1') {
                // Si se marcó para quitar la imagen pero no se subió una nueva
                $campos[] = "$campo = ?";
                $valores[] = null;
                $tipos .= "s";
            }
        }
    }

    // Manejar la eliminación de imágenes - Modificación del código existente
    foreach ($_POST as $campo => $valor) {
        if (strpos($campo, 'quitar_') === 0 && $valor == '1') {
            $nombre_campo = substr($campo, 7); // quitar el prefijo 'quitar_'
            
            // Solo eliminar el archivo si no se está subiendo uno nuevo
            if (!isset($_FILES[$nombre_campo]) || $_FILES[$nombre_campo]['error'] !== UPLOAD_ERR_OK) {
                // Eliminar el archivo físico si existe
                $query = "SELECT $nombre_campo FROM $tabla WHERE $clave_primaria = ?";
                $stmt_img = $conexion->prepare($query);
                $stmt_img->bind_param("i", $id);
                $stmt_img->execute();
                $result = $stmt_img->get_result();
                if ($row = $result->fetch_assoc()) {
                    $archivo = $row[$nombre_campo];
                    if ($archivo && file_exists("../../static/" . $archivo)) {
                        unlink("../../static/" . $archivo);
                    }
                }
                
                // Añadir el campo a la lista de actualizaciones si no se está subiendo una nueva imagen
                if (!isset($campos[$nombre_campo])) {
                    $campos[] = "$nombre_campo = ?";
                    $valores[] = null;
                    $tipos .= "s";
                }
            }
            
            // Eliminar el campo quitar_ del POST
            unset($_POST[$campo]);
        }
    }

    // Manejar campos normales (excluyendo los campos quitar_)
    foreach ($_POST as $campo => $valor) {
        if ($campo !== 'submit' && $campo !== 'tabla' && $campo !== 'id' && strpos($campo, 'quitar_') !== 0) {
            $campos[] = "$campo = ?";
            $valores[] = $valor;
            $tipos .= "s";
        }
    }

    if (!empty($campos)) {
        $sql = "UPDATE $tabla SET " . implode(", ", $campos) . " WHERE $clave_primaria = ?";
        $tipos .= "i";
        $valores[] = $id;

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param($tipos, ...$valores);
        
        if ($stmt->execute()) {
            // Si es un producto y tiene tienda_id, actualizar la relación
            if ($tabla === 'productos' && $tienda_id !== null) {
                // Eliminar relaciones existentes
                $delete_stmt = $conexion->prepare("DELETE FROM tiendas_productos WHERE producto_id = ?");
                $delete_stmt->bind_param("i", $id);
                $delete_stmt->execute();
                
                if ($tienda_id > 0) {
                    // Insertar nueva relación
                    $insert_stmt = $conexion->prepare("INSERT INTO tiendas_productos (tienda_id, producto_id, orden) VALUES (?, ?, 0)");
                    $insert_stmt->bind_param("ii", $tienda_id, $id);
                    $insert_stmt->execute();
                }
            }

            header("Location: ../escritorio.php?tabla=" . urlencode($tabla));
            exit();
        } else {
            echo "Error al actualizar: " . $conexion->error;
        }
    } else {
        // Si no hay campos para actualizar pero hay tienda_id, actualizar solo la relación
        if ($tabla === 'productos' && $tienda_id !== null) {
            $delete_stmt = $conexion->prepare("DELETE FROM tiendas_productos WHERE producto_id = ?");
            $delete_stmt->bind_param("i", $id);
            $delete_stmt->execute();
            
            if ($tienda_id > 0) {
                $insert_stmt = $conexion->prepare("INSERT INTO tiendas_productos (tienda_id, producto_id, orden) VALUES (?, ?, 0)");
                $insert_stmt->bind_param("ii", $tienda_id, $id);
                $insert_stmt->execute();
            }
            
            header("Location: ../escritorio.php?tabla=" . urlencode($tabla));
            exit();
        }
    }
}
?>
