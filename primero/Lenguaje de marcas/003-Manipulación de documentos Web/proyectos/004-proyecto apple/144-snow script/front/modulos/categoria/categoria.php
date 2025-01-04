<!-- Listado de bloques en la página de categoría -->
<main>
    <?php
    include "modulos/bloque/bloque.php";
    include "config.php";

    // Validar que exista el parámetro cat
    if (!isset($_GET['cat'])) {
        echo "<div>Error: No se ha especificado una categoría</div>";
        exit;
    }

    // Modificar la consulta para ser más específica y debuggear
    $categoria_id = (int)$_GET['cat'];
    $peticion = "
        SELECT bc.*, bc.imagen as imagen, bc.fondo as fondo, bc.titulo as titulo,
               bc.estilo as estilo, t.tipo as tipo_bloque, c.nombre as categoria_nombre
        FROM bloquescategorias bc
        LEFT JOIN tipobloque t ON bc.tipobloque_tipo = t.Identificador
        LEFT JOIN categorias c ON bc.categorias_nombre = c.Identificador
        WHERE bc.categorias_nombre = $categoria_id
        ORDER BY bc.Identificador ASC";

    // Debug de la consulta
    error_log("Consulta SQL para categoría $categoria_id: " . $peticion);

    $resultado = mysqli_query($conexion, $peticion);
    
    if (!$resultado) {
        error_log("Error en la consulta: " . mysqli_error($conexion));
        echo "<div>Error al cargar los bloques</div>";
        exit;
    }

    $num_bloques = mysqli_num_rows($resultado);
    error_log("Número de bloques encontrados: " . $num_bloques);

    if ($num_bloques == 0) {
        // Verificar si la categoría existe
        $check_cat = mysqli_query($conexion, "SELECT nombre FROM categorias WHERE Identificador = $categoria_id");
        if ($check_cat && mysqli_num_rows($check_cat) > 0) {
            $cat_info = mysqli_fetch_assoc($check_cat);
            echo "<div>No hay bloques configurados para la categoría: " . htmlspecialchars($cat_info['nombre']) . "</div>";
        } else {
            echo "<div>Error: Categoría no encontrada</div>";
        }
    } else {
        while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            // Debug de cada bloque
            error_log('Procesando bloque:');
            error_log('ID: ' . ($fila['Identificador'] ?? 'No ID'));
            error_log('Tipo: ' . ($fila['tipobloque_tipo'] ?? 'No tipo'));
            error_log('Título: ' . ($fila['titulo'] ?? 'No título'));
            error_log('Estilo: ' . ($fila['estilo'] ?? 'No estilo'));

            // Procesar el estilo
            $estilo = !empty($fila['estilo']) ? json_decode($fila['estilo'], true) : null;
            
            // Tipo de bloque como entero para el switch
            $tipo_bloque = (int)$fila['tipobloque_tipo'];

            // Crear y mostrar el bloque según su tipo
            switch($tipo_bloque) {
                case 1:									// Si el bloque es de tipo 1
                    $bloque = new BloqueCompleto(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],    // Agregamos la imagen
                        $fila['fondo'],     // Asegurarnos que este campo llega correctamente
                        $estilo  // Añadir los estilos aquí
                    );																			// Creo una nueva instancia
                    echo $bloque->getBloque();												// Lanzo el html del bloque
                    break;
                case 2:
                    // BloqueCaja ya tiene los estilos
                    $bloque = new BloqueCaja(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],    // Agregamos la imagen
                        $fila['fondo'],     // Agregamos el fondo
                        $estilo
                    );
                    echo $bloque->getBloque();												// Lanzo el html del bloque
                    break;
                case 3:							// Si el bloque es de tipo 2
                    $bloque = new BloqueMosaico(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],    // Agregamos la imagen
                        $fila['fondo'],     // Agregamos el fondo
                        ["uno","dos","tres","cuatro"],
                        $estilo  // Añadir los estilos aquí
                    );																		// Creo una nueva instancia
                    echo $bloque->getBloque();											// Lanzo el html del bloque
                    break;
                case 4:							// Si el bloque es de tipo 2
                    $bloque = new BloqueCajaYoutube(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],    // Agregamos la imagen
                        $fila['fondo'],     // Agregamos el fondo
                        $estilo  // Añadir los estilos aquí
                    );																		// Creo una nueva instancia
                    echo $bloque->getBloque();											// Lanzo el html del bloque
                    break;
                case 5:							// Si el bloque es de tipo 2
                    $bloque = new BloqueCajaDosColumnas(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],    // Agregamos la imagen
                        $fila['fondo'],     // Agregamos el fondo
                        $estilo  // Añadir los estilos aquí
                    );																		// Creo una nueva instancia
                    echo $bloque->getBloque();											// Lanzo el html del bloque
                    break;
                case 6:							// Si el bloque es de tipo 2
                    $bloque = new BloqueCajaPasaFotos(
                        $fila['titulo'], 
                        $fila['subtitulo'],
                        $fila['texto'],
                        $fila['imagen'],    // Agregamos la imagen
                        $fila['fondo'],     // Agregamos el fondo
                        $estilo  // Añadir los estilos aquí
                    );																		// Creo una nueva instancia
                    echo $bloque->getBloque();											// Lanzo el html del bloque
                    break;
                case 7:							// Nuevo bloque tipo tienda
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
                case 8:    // Asumiendo que 8 será el ID para BloqueTextoCompleto
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
                case 9: // Bloque Fondo y Título
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
    ?>
</main>
<script>
    <?php include "categoria.js"; ?>
</script>
<style>
    <?php include "categoria.css"; ?>
</style>