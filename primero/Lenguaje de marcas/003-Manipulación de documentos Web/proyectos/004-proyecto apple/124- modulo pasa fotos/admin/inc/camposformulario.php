<?php
include "utilidades/error.php";                           
include "config/config.php";                          

$peticion = "SHOW COLUMNS FROM ".$_GET['formulario'];
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
    if($fila['Field'] == "Identificador"){
        echo "<input type='hidden' name='".$fila['Field']."'>";
    }
    else if($fila['Field'] == "categoriasblog_categorias"){
        // Consulta para obtener las categorías
        $queryCategories = "SELECT * FROM categoriasblog";
        $resultCategories = $conexion->query($queryCategories);
        
        // Primero obtener el nombre del campo que contiene el título/nombre
        $estructuraQuery = "SHOW COLUMNS FROM categoriasblog";
        $estructuraResult = $conexion->query($estructuraQuery);
        $nombreCampo = null;
        
        while($columna = $estructuraResult->fetch_assoc()) {
            if($columna['Field'] != 'Identificador' && 
               (strpos(strtolower($columna['Field']), 'titulo') !== false || 
                strpos(strtolower($columna['Field']), 'nombre') !== false || 
                strpos(strtolower($columna['Field']), 'categoria') !== false)) {
                $nombreCampo = $columna['Field'];
                break;
            }
        }
        
        echo "<select name='categoriasblog_categorias' required>";
        echo "<option value=''>Seleccione una categoría</option>";
        
        while($categoria = $resultCategories->fetch_assoc()) {
            echo "<option value='".$categoria['Identificador']."'>";
            // Usar el campo encontrado o mostrar el ID si no se encuentra
            echo htmlspecialchars($nombreCampo ? $categoria[$nombreCampo] : 'Categoría '.$categoria['Identificador']);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "tipobloque"){
        $queryTipos = "SELECT * FROM tipobloque";
        $resultTipos = $conexion->query($queryTipos);
        
        echo "<select name='tipobloque' required>";
        echo "<option value=''>Seleccione un tipo de bloque</option>";
        
        while($tipo = $resultTipos->fetch_assoc()) {
            $nombreTipo = isset($tipo['nombre']) ? $tipo['nombre'] : 'Desconocido';
            echo "<option value='".$tipo['Identificador']."'>";
            echo htmlspecialchars($nombreTipo);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "tipobloque_tipo"){
        $queryTipos = "SELECT * FROM tipobloque";
        $resultTipos = $conexion->query($queryTipos);
        
        echo "<select name='tipobloque_tipo' required>";
        echo "<option value=''>Seleccione un tipo de bloque</option>";
        
        while($tipo = $resultTipos->fetch_assoc()) {
            $nombreTipo = isset($tipo['nombre']) ? $tipo['nombre'] : 'Desconocido';
            echo "<option value='".$tipo['Identificador']."'>";
            echo htmlspecialchars($nombreTipo);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "categorias_nombre"){
        $queryCategorias = "SELECT * FROM categorias";
        $resultCategorias = $conexion->query($queryCategorias);
        
        echo "<select name='categorias_nombre' required>";
        echo "<option value=''>Seleccione una categoría</option>";
        
        while($categoria = $resultCategorias->fetch_assoc()) {
            echo "<option value='".$categoria['Identificador']."'>";
            echo htmlspecialchars($categoria['nombre']);
            echo "</option>";
        }
        echo "</select>";
    }
    else if(strpos(strtolower($fila['Type']), 'date') !== false){
        echo "<input type='date' name='".$fila['Field']."'>";
    }
    else if(str_contains($fila['Field'],"imagen")){
        echo "<input type='file' name='".$fila['Field']."'>";
    }
    else{
        echo "<input type='text' name='".$fila['Field']."' 
              placeholder='".$fila['Field']."' required>";
    }
}

$conexion->close();
?>