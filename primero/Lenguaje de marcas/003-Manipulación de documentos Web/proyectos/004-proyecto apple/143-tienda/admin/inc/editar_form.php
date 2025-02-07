<?php
if(isset($_GET['editar']) && isset($_GET['tabla']) && isset($_GET['id'])) {
    $tabla = htmlspecialchars(strip_tags($_GET['tabla']));
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Obtener el nombre de la clave primaria
    $descripcion_tabla = $conexion->query("DESCRIBE $tabla");
    $clave_primaria = null;
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

    // Obtener datos del registro actual usando la clave primaria correcta
    $query = "SELECT * FROM $tabla WHERE $clave_primaria = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $datos = $resultado->fetch_assoc();

    if ($datos): ?>
        <div class="formulario-container">
            <h2>Editar registro en <?php echo htmlspecialchars($tabla); ?></h2>
            <form method="POST" action="crud/actualizar.php" enctype="multipart/form-data">
                <input type="hidden" name="tabla" value="<?php echo htmlspecialchars($tabla); ?>">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <input type="hidden" name="clave_primaria" value="<?php echo htmlspecialchars($clave_primaria); ?>">
                
                <?php
                // Obtener la estructura de la tabla
                $peticion = "SHOW COLUMNS FROM " . $tabla;
                $resultado_estructura = $conexion->query($peticion);

                while ($campo = $resultado_estructura->fetch_assoc()):
                    $nombre_campo = $campo['Field'];
                    $valor_actual = $datos[$nombre_campo] ?? '';

                    if($nombre_campo == "Identificador") {
                        continue;
                    }

                    // Primero mostrar selector de tienda si estamos en productos
                    if($tabla == 'productos' && $nombre_campo == 'titulo' && !isset($tiendaMostrada)) {
                        echo "<div class='campo'>";
                        echo "<label>Seleccionar Tienda (opcional):</label>";
                        echo "<select name='tienda_id'>";
                        echo "<option value=''>Sin tienda</option>";
                        
                        $queryTiendas = "SELECT * FROM tiendas ORDER BY titulo";
                        $resultTiendas = $conexion->query($queryTiendas);
                        while($tienda = $resultTiendas->fetch_assoc()) {
                            $selected = (isset($datos['tienda_id']) && $datos['tienda_id'] == $tienda['Identificador']) ? 'selected' : '';
                            echo "<option value='".$tienda['Identificador']."' ".$selected.">";
                            echo htmlspecialchars($tienda['titulo']);
                            echo "</option>";
                        }
                        echo "</select>";
                        echo "</div>";
                        $tiendaMostrada = true;
                    }

                    echo "<div class='campo'>";
                    echo "<label>" . ucfirst($nombre_campo) . ":</label>";

                    // Manejar diferentes tipos de campos
                    if($nombre_campo == "descripcion") {
                        echo "<textarea name='$nombre_campo' rows='4'>" . htmlspecialchars($valor_actual) . "</textarea>";
                    }
                    else if($nombre_campo == "precio") {
                        echo "<input type='number' step='0.01' name='$nombre_campo' value='$valor_actual' required>";
                    }
                    else if($nombre_campo == "imagen" || $nombre_campo == "fondo") { // Modificado aquí
                        echo "<input type='file' name='$nombre_campo' accept='image/*'>";
                        if($valor_actual) {
                            echo "<div class='preview-imagen'><img src='../static/$valor_actual' style='max-width:200px'></div>";
                        }
                    }
                    else if($nombre_campo == "categorias_nombre") {
                        echo "<select name='$nombre_campo' required>";
                        echo "<option value=''>Seleccione una categoría</option>";
                        
                        $queryCategorias = "SELECT * FROM categorias ORDER BY nombre";
                        $resultCategorias = $conexion->query($queryCategorias);
                        while($categoria = $resultCategorias->fetch_assoc()) {
                            $selected = ($valor_actual == $categoria['Identificador']) ? 'selected' : '';
                            echo "<option value='" . $categoria['Identificador'] . "' $selected>";
                            echo htmlspecialchars($categoria['nombre']);
                            echo "</option>";
                        }
                        echo "</select>";
                    }
                    else if($nombre_campo == "categoriasblog_categorias") {
                        echo "<select name='$nombre_campo' required>";
                        echo "<option value=''>Seleccione una categoría</option>";
                        
                        $queryCategorias = "SELECT * FROM categoriasblog ORDER BY categoria";
                        $resultCategorias = $conexion->query($queryCategorias);
                        while($categoria = $resultCategorias->fetch_assoc()) {
                            $selected = ($valor_actual == $categoria['Identificador']) ? 'selected' : '';
                            echo "<option value='" . $categoria['Identificador'] . "' $selected>";
                            echo htmlspecialchars($categoria['categoria']);
                            echo "</option>";
                        }
                        echo "</select>";
                    }
                    else if($nombre_campo == "tipobloque_tipo") {
                        echo "<select name='$nombre_campo' required>";
                        echo "<option value=''>Seleccione un tipo de bloque</option>";
                        
                        $queryTipos = "SELECT * FROM tipobloque ORDER BY tipo";
                        $resultTipos = $conexion->query($queryTipos);
                        while($tipo = $resultTipos->fetch_assoc()) {
                            $selected = ($valor_actual == $tipo['Identificador']) ? 'selected' : '';
                            echo "<option value='".$tipo['Identificador']."' ".$selected.">";
                            echo htmlspecialchars($tipo['tipo']);
                            echo "</option>";
                        }
                        echo "</select>";
                    }
                    else if($nombre_campo == "productos_titulo") {
                        echo "<select name='$nombre_campo' required>";
                        echo "<option value=''>Seleccione un producto</option>";
                        
                        $queryProductos = "SELECT * FROM productos ORDER BY titulo";
                        $resultProductos = $conexion->query($queryProductos);
                        while($producto = $resultProductos->fetch_assoc()) {
                            $selected = ($valor_actual == $producto['Identificador']) ? 'selected' : '';
                            echo "<option value='" . $producto['Identificador'] . "' $selected>";
                            echo htmlspecialchars($producto['titulo']);
                            echo "</option>";
                        }
                        echo "</select>";
                    }
                    else {
                        echo "<input type='text' name='$nombre_campo' value='" . htmlspecialchars($valor_actual) . "'>";
                    }
                    echo "</div>";
                endwhile;
                ?>

                <button type="submit" name="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="?tabla=<?php echo urlencode($tabla); ?>" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>

        <style>
        .campo {
            margin-bottom: 20px;
        }
        .campo label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .campo input[type="text"],
        .campo input[type="number"],
        .campo select,
        .campo textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .preview-imagen {
            margin-top: 10px;
        }
        </style>
    <?php endif;
}
?>
