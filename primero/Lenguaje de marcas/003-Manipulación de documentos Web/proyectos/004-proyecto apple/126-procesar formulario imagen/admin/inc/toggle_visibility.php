<?php
include "../utilidades/error.php";
include "../config/config.php";

if(isset($_POST['tabla'])) {
    $tabla = $conexion->real_escape_string($_POST['tabla']);
    
    // Alternar la visibilidad
    $peticion = "UPDATE menu_visibilidad 
                 SET visible = NOT visible 
                 WHERE nombre_tabla = '$tabla'";
    $conexion->query($peticion);
    
    echo "ok";
}
?>
