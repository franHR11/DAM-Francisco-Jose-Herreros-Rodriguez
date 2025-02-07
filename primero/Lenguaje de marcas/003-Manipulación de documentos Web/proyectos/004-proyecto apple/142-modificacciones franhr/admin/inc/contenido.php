<?php
include "utilidades/error.php";                           
include "config/config.php";                          

// Inicializar variable de paginación si no existe
if (!isset($_SESSION['pagina'])) {
    $_SESSION['pagina'] = 0;
}

// Asegurar que la página nunca sea negativa
$_SESSION['pagina'] = max(0, $_SESSION['pagina']);

// Add validation for tabla parameter
if (!isset($_GET['tabla']) || empty($_GET['tabla'])) {
    die("Error: No se especificó una tabla válida");
}

if($_GET['tabla'] == 'categoriasblog') {
    $peticion = "SELECT * FROM categoriasblog ORDER BY categoria ASC LIMIT 10 OFFSET ".($_SESSION['pagina']*10);
} else {
    $peticion = "SELECT * FROM ".$_GET['tabla']." LIMIT 10 OFFSET ".($_SESSION['pagina']*10);
}

$resultado = $conexion->query($peticion);

// Buscar y reemplazar todas las referencias a 'tienda' por 'tiendas'
if(isset($_GET['tabla'])) {
    // Verificar y corregir el nombre de la tabla si es necesario
    if($_GET['tabla'] == 'tienda') {
        $_GET['tabla'] = 'tiendas'; // Corregir el nombre de la tabla
    }

    // Verificar si la tabla existe antes de hacer la consulta
    $check_table = "SHOW TABLES LIKE '".mysqli_real_escape_string($conexion, $_GET['tabla'])."'";
    $table_exists = $conexion->query($check_table);
    
    if($table_exists->num_rows == 0) {
        echo "<div class='error'>Error: La tabla '".$_GET['tabla']."' no existe.</div>";
        return;
    }

    try {
        $peticion = "SELECT * FROM ".$_GET['tabla'];
        $resultado = $conexion->query($peticion);
        
        if($resultado === false) {
            throw new Exception($conexion->error);
        }
        
        if($_GET['tabla'] == 'tiendas') { // Cambiado de 'tienda' a 'tiendas'
            echo "<div class='contenedor-tabla'>";
            echo "<table>";
            echo "<tr>";
            
            // Obtener los nombres de las columnas
            $campos = $resultado->fetch_fields();
            foreach($campos as $campo) {
                echo "<th>".$campo->name."</th>";
            }
            echo "<th>Acciones</th>";
            echo "</tr>";

            // Mostrar los datos
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $valor) {
                    // Verificar si el valor es nulo y convertirlo a cadena vacía si lo es
                    $valorSeguro = ($valor === null) ? '' : (string)$valor;
                    echo "<td>".htmlspecialchars($valorSeguro, ENT_QUOTES, 'UTF-8')."</td>";
                }
                echo "<td>
                        <a href='crud/editar.php?tabla=tiendas&id=".$fila['Identificador']."'>Editar</a>
                        <a href='crud/eliminar.php?tabla=tiendas&id=".$fila['Identificador']."' onclick='return confirm(\"¿Estás seguro?\");'>Eliminar</a>
                     </td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        } else if($_GET['tabla'] == 'tiendas_productos') {
            try {
                $peticion = "SELECT tp.*, t.titulo as tienda_titulo, p.titulo as producto_titulo 
                             FROM tiendas_productos tp 
                             LEFT JOIN tiendas t ON tp.tienda_id = t.Identificador 
                             LEFT JOIN productos p ON tp.producto_id = p.Identificador";
                
                $resultado = $conexion->query($peticion);
                
                if($resultado === false) {
                    throw new Exception("Error en la consulta: " . $conexion->error);
                }

                echo "<div class='contenedor-tabla'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>ID Tienda</th>";
                echo "<th>Tienda</th>";
                echo "<th>ID Producto</th>";
                echo "<th>Producto</th>";
                echo "<th>Orden</th>";
                echo "<th>Acciones</th>";
                echo "</tr>";

                while($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['tienda_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['tienda_titulo']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['producto_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['producto_titulo']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['orden']) . "</td>";
                    echo "<td>
                            <a href='crud/editar.php?tabla=tiendas_productos&tienda_id=".$fila['tienda_id']."&producto_id=".$fila['producto_id']."'>Editar</a>
                            <a href='crud/eliminar.php?tabla=tiendas_productos&tienda_id=".$fila['tienda_id']."&producto_id=".$fila['producto_id']."' onclick='return confirm(\"¿Estás seguro?\");'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
                
            } catch (Exception $e) {
                echo "<div class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
            return;
        } else {
            // ... resto del código para otras tablas ...
        }
    } catch (Exception $e) {
        error_log("Error en la consulta: " . $e->getMessage());
        echo "<div class='error'>Error al cargar los datos: " . $e->getMessage() . "</div>";
    }
}

// Función de ayuda para manejar valores nulos
function safeHtmlSpecialChars($value) {
    if ($value === null) {
        return '';
    }
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Modificar otras partes del código donde se usa htmlspecialchars
while ($fila = $resultado->fetch_assoc()) {
    $identificador = "";
    echo "<tr>";
    foreach($fila as $clave=>$valor){
        if($clave == "Identificador"){
            $identificador = $valor;
        }
        // Procesar clave foránea
        if(str_contains($clave,"_")){
            $explotado = explode("_",$clave);
            // Add validation for array elements
            if(count($explotado) >= 2) {
                $tabla = $explotado[0];
                $columna = $explotado[1];
                
                // Validate table name before query
                if(!empty($tabla)) {
                    // Modificación específica para tipobloque
                    if($tabla == 'tipobloque') {
                        $peticion2 = "SELECT * FROM tipobloque WHERE Identificador = " . $valor;
                        $resultado2 = $conexion->query($peticion2);
                        
                        if($resultado2 && $fila2 = $resultado2->fetch_assoc()) {
                            // Intentar obtener el nombre del tipo de bloque
                            $valorMostrar = $fila2['tipo'] ?? $fila2['nombre'] ?? 
                                          $fila2['titulo'] ?? $fila2['descripcion'] ?? 
                                          'Tipo ' . $valor;
                            
                            echo "<td
                                tabla='".$_GET['tabla']."'
                                columna = '".$clave."'
                                identificador = '".safeHtmlSpecialChars($identificador)."'
                            >".safeHtmlSpecialChars($valorMostrar)."</td>";
                        } else {
                            echo "<td
                                tabla='".$_GET['tabla']."'
                                columna = '".$clave."'
                                identificador = '".safeHtmlSpecialChars($identificador)."'
                            >Sin asignar</td>";
                        }
                    } else {
                        // Resto del código existente para otras tablas
                        $peticion2 = "SELECT * FROM ".$tabla;
                        $resultado2 = $conexion->query($peticion2);
                        $encontrado = false;
                        
                        if($resultado2) {
                            while($fila2 = $resultado2->fetch_assoc()) {
                                if($fila2['Identificador'] == $valor) {
                                    // Intentamos mostrar el título, nombre, o categoría, en ese orden
                                    $valorMostrar = $fila2['titulo'] ?? $fila2['nombre'] ?? 
                                                  $fila2['categoria'] ?? $fila2['Nombre'] ?? 
                                                  'ID: ' . $valor;
                                    
                                    echo "<td
                                        tabla='".$_GET['tabla']."'
                                        columna = '".$clave."'
                                        identificador = '".safeHtmlSpecialChars($identificador)."'
                                    >".safeHtmlSpecialChars($valorMostrar)."</td>";
                                    $encontrado = true;
                                    break;
                                }
                            }
                        }
                        
                        if(!$encontrado) {
                            echo "<td
                                tabla='".$_GET['tabla']."'
                                columna = '".$clave."'
                                identificador = '".safeHtmlSpecialChars($identificador)."'
                            >Sin asignar</td>";
                        }
                    }
                } else {
                    echo "<td>Tabla inválida</td>";
                }
            } else {
                echo "<td>Formato inválido</td>";
            }
        }
        // Procesar campos de imagen
        else if(str_contains(strtolower($clave), "imagen") || 
                str_contains(strtolower($clave), "img") || 
                str_contains(strtolower($clave), "photo") ||
                str_contains(strtolower($clave), "fondo")){
            if(!empty($valor) && $valor != "null" && $valor != "NULL") {
                $rutaImagen = htmlspecialchars("../static/" . trim($valor));
                echo "<td>";
                echo "<img src='" . $rutaImagen . "' style='max-width:100px;' onerror=\"this.src='img/placeholder.jpg'\">";
                echo "</td>";
            } else {
                echo "<td>Sin imagen</td>";
            }
        }
        // Campos normales
        else {
            echo "<td
                tabla='".$_GET['tabla']."'
                columna = '".$clave."'
                identificador = '".safeHtmlSpecialChars($identificador)."'
            >".safeHtmlSpecialChars($valor)."</td>";
        }
    }
    echo "
    <td>
        <a href='crud/eliminar.php?tabla=".$_GET['tabla']."&id=".$identificador."'>
            <button class='eliminar'>X</button>
        </a>
    </td>";
    echo "</tr>";
}

$conexion->close();
?>