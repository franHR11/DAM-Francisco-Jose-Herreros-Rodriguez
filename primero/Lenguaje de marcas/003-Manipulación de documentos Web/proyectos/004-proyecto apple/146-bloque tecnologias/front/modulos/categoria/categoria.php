<!-- Listado de bloques en la página de categoría -->
<main>
    <?php
    /**
     * @webblock Módulo de Categorías
     * @author FranHR
     * @description Gestiona la visualización de bloques de contenido por categorías.
     * Este módulo se encarga de:
     * - Cargar y mostrar bloques según la categoría seleccionada
     * - Manejar diferentes tipos de bloques (completo, caja, mosaico, etc.)
     * - Gestionar errores y validaciones
     */

    // Incluir dependencias necesarias
    require_once "modulos/bloque/bloque.php";
    require_once "config.php";

    // Validación de entrada
    $categoria_id = filter_input(INPUT_GET, 'cat', FILTER_VALIDATE_INT);
    if (!$categoria_id) {
        echo "<div class='error-message'>Error: No se ha especificado una categoría válida</div>";
        exit;
    }

    // Consulta preparada para prevenir SQL Injection
    $peticion = "
        SELECT bc.*, t.tipo as tipo_bloque, c.nombre as categoria_nombre
        FROM bloquescategorias bc
        LEFT JOIN tipobloque t ON bc.tipobloque_tipo = t.Identificador
        LEFT JOIN categorias c ON bc.categorias_nombre = c.Identificador
        WHERE bc.categorias_nombre = ?
        ORDER BY bc.Identificador ASC";

    $stmt = mysqli_prepare($conexion, $peticion);
    mysqli_stmt_bind_param($stmt, "i", $categoria_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (!$resultado) {
        error_log("Error en la consulta: " . mysqli_error($conexion));
        echo "<div class='error-message'>Error al cargar los bloques</div>";
        exit;
    }

    // Manejo de resultados
    if (mysqli_num_rows($resultado) === 0) {
        // Verificar existencia de categoría
        $check_stmt = mysqli_prepare($conexion, "SELECT nombre FROM categorias WHERE Identificador = ?");
        mysqli_stmt_bind_param($check_stmt, "i", $categoria_id);
        mysqli_stmt_execute($check_stmt);
        $cat_result = mysqli_stmt_get_result($check_stmt);
        
        if ($cat_info = mysqli_fetch_assoc($cat_result)) {
            echo "<div class='info-message'>No hay bloques configurados para la categoría: " . 
                 htmlspecialchars($cat_info['nombre']) . "</div>";
        } else {
            echo "<div class='error-message'>Error: Categoría no encontrada</div>";
        }
        mysqli_stmt_close($check_stmt);
    } else {
        // Procesamiento de bloques
        while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $estilo = !empty($fila['estilo']) ? json_decode($fila['estilo'], true) : [];
            $tipo_bloque = (int)$fila['tipobloque_tipo'];
            
            $params = [
                'titulo' => $fila['titulo'],
                'subtitulo' => $fila['subtitulo'],
                'texto' => $fila['texto'],
                'imagen' => $fila['imagen'],
                'fondo' => $fila['fondo'],
                'estilo' => $estilo
            ];

            // Crear bloque según tipo
            switch($tipo_bloque) {
                case 1:
                    $bloque = new BloqueCompleto(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                case 2:
                    $bloque = new BloqueCaja(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                case 3:
                    $bloque = new BloqueMosaico(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        ["uno","dos","tres","cuatro"],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                case 4:
                    $bloque = new BloqueCajaYoutube(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                case 5:
                    $bloque = new BloqueCajaDosColumnas(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                case 6:
                    $bloque = new BloqueCajaPasaFotos(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                case 7:
                    $bloque = new BloqueTienda(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                case 8:
                    $bloque = new BloqueTextoCompleto(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                case 9:
                    $bloque = new BloqueFondoYTitulo(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],
                        $fila['fondo'],
                        $estilo
                    );
                    echo $bloque->getBloque();
                    break;
                default:
                    error_log("Tipo de bloque no reconocido: " . $tipo_bloque);
                    break;
            }
        }
    }

    mysqli_stmt_close($stmt);
    ?>
</main>
<script>
    <?php include "categoria.js"; ?>
</script>
<style>
    <?php include "categoria.css"; ?>
</style>