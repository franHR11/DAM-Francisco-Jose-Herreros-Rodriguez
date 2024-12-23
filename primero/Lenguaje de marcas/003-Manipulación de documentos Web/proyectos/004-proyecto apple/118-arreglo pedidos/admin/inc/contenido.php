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
        // Verificar si el valor es null
        if(is_null($valor)) {
            echo "<td>-</td>";
        }
        // Si es un campo de imagen o fondo
        else if($clave == "imagen" || $clave == "fondo") {
            if(!empty($valor)) {
                $imgData = base64_encode($valor);
                echo "<td><img style='max-width:100px;' src='data:image/jpeg;base64,{$imgData}'></td>";
            } else {
                echo "<td>Sin imagen</td>";
            }
        }
        // Para otros campos
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