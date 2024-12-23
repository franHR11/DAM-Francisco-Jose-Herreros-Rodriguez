<?php
include "utilidades/error.php";                           
include "config/config.php";                          

$peticion = "SELECT * FROM ".$_GET['tabla'];
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
    $identificador = "";
    echo "<tr>";
    foreach($fila as $clave=>$valor){
        if($clave == "Identificador"){
            $identificador = $valor;
        }
        // Nueva lógica para detectar campos de imagen
        if(!str_contains(strtolower($clave), "imagen") && 
           !str_contains(strtolower($clave), "img") && 
           !str_contains(strtolower($clave), "photo") &&
           !str_contains(strtolower($clave), "fondo")){
            echo "<td
                tabla='".$_GET['tabla']."'
                columna = '".$clave."'
                identificador = '".$identificador."'
            >".$valor."</td>";
        } else {
            if(!empty($valor) && $valor != "null" && $valor != "NULL") {
                $rutaImagen = htmlspecialchars("../static/" . trim($valor));
                echo "<td>";
                echo "<img src='" . $rutaImagen . "' style='max-width:100px;' onerror=\"this.src='../admin/img/no-image.png'\">";
                echo "</td>";
            } else {
                echo "<td>Sin imagen</td>";
            }
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