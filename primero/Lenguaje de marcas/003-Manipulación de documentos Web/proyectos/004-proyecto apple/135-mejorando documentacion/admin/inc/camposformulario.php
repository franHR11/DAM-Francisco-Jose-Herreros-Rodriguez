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
        
        echo "<select name='categoriasblog_categorias'>";
        echo "<option value=''>Seleccione una categoría</option>";
        
        while($categoria = $resultCategories->fetch_assoc()) {
            echo "<option value='".$categoria['Identificador']."'>";
            // Usar el campo encontrado o mostrar el ID si no se encuentra
            echo htmlspecialchars($nombreCampo ? $categoria[$nombreCampo] : 'Categoría '.$categoria['Identificador']);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "productos_titulo"){
        $queryProductos = "SELECT * FROM productos";
        $resultProductos = $conexion->query($queryProductos);
        
        echo "<select name='productos_titulo'>";
        echo "<option value=''>Seleccione un producto</option>";
        
        while($producto = $resultProductos->fetch_assoc()) {
            echo "<option value='".$producto['Identificador']."'>";
            echo htmlspecialchars($producto['titulo']);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "tipobloque" || $fila['Field'] == "tipobloque_tipo"){
        $queryTipos = "SELECT * FROM tipobloque";
        $resultTipos = $conexion->query($queryTipos);
        
        echo "<select name='".$fila['Field']."'>";
        echo "<option value=''>Seleccione un tipo de bloque</option>";
        
        while($tipo = $resultTipos->fetch_assoc()) {
            // Buscar el nombre del tipo de bloque en todos los campos posibles
            $nombreTipo = $tipo['titulo'] ?? $tipo['nombre'] ?? $tipo['tipo'] ?? $tipo['descripcion'] ?? 'Tipo '.$tipo['Identificador'];
            echo "<option value='".$tipo['Identificador']."'>";
            echo htmlspecialchars($nombreTipo);
            echo "</option>";
        }
        echo "</select>";
    }
    else if($fila['Field'] == "categorias_nombre"){
        $queryCategorias = "SELECT * FROM categorias";
        $resultCategorias = $conexion->query($queryCategorias);
        
        echo "<select name='categorias_nombre'>";
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
    else if(str_contains(strtolower($fila['Field']),"imagen")){
        echo "<div class='campo-imagen'>";
        echo "<label>Imagen principal:</label>";
        echo "<input type='file' name='".$fila['Field']."'>";
        echo "</div>";
    }
    else if(str_contains(strtolower($fila['Field']),"fondo")){
        echo "<div class='campo-fondo'>";
        echo "<label>Imagen de fondo:</label>";
        echo "<input type='file' name='".$fila['Field']."'>";
        echo "</div>";
    }
    else{
        echo "<input type='text' name='".$fila['Field']."' 
              placeholder='".$fila['Field']."'>";
    }
}

$conexion->close();
?>

<style>
.campo-imagen, .campo-fondo {
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
}

.campo-imagen {
    background: #e3f2fd;
    border: 1px solid #2196f3;
}

.campo-fondo {
    background: #f5f5f5;
    border: 1px solid #9e9e9e;
}

.campo-imagen label, .campo-fondo label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
</style>