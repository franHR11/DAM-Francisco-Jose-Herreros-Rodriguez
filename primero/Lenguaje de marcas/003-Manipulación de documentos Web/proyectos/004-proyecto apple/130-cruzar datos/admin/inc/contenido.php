<?php
include "utilidades/error.php";                           
include "config/config.php";                          

// Add validation for tabla parameter
if (!isset($_GET['tabla']) || empty($_GET['tabla'])) {
    die("Error: No se especificó una tabla válida");
}

$peticion = "SELECT * FROM ".$_GET['tabla'];
if($_GET['tabla'] == 'categoriasblog') {
    $peticion = "SELECT * FROM categoriasblog ORDER BY Nombre ASC";
}

$resultado = $conexion->query($peticion);

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
                    // Modificamos la consulta para buscar por múltiples columnas posibles
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
                                    identificador = '".$identificador."'
                                >".$valorMostrar."</td>";
                                $encontrado = true;
                                break;
                            }
                        }
                    }
                    
                    if(!$encontrado) {
                        echo "<td
                            tabla='".$_GET['tabla']."'
                            columna = '".$clave."'
                            identificador = '".$identificador."'
                        >Sin asignar</td>";
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
                echo "<img src='" . $rutaImagen . "' style='max-width:100px;' onerror=\"this.src='../admin/img/no-image.png'\">";
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
                identificador = '".$identificador."'
            >".$valor."</td>";
        }
    }
    echo "
    <td>
        <a href='crud/eliminar.php?tabla=".$_GET['tabla']."&Identificador=".$identificador."'>
            <button class='eliminar'>X</button>
        </a>
    </td>";
    echo "</tr>";
}

$conexion->close();
?>