<?php
require '../../../includes/app.php';

use App\Categoria;

estaAutenticado();

// Obtener todas las categorías
$categorias = Categoria::all();

// Buscar categorías
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

if (!empty($busqueda)) {
    // Filtrar categorías por nombre (implementación básica)
    $categorias_filtradas = [];
    foreach($categorias as $categoria) {
        if(stripos($categoria->nombre, $busqueda) !== false) {
            $categorias_filtradas[] = $categoria;
        }
    }
    $categorias = $categorias_filtradas;
}

// Eliminar categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        $categoria = Categoria::find($id);
        $resultado = $categoria->eliminar();
        
        if ($resultado) {
            header("Location: ./index.php?resultado=3");
            exit;
        }
    }
}

// Mensaje condicional
$resultado = $_GET["resultado"] ?? null;

incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Administrar Categorías</h1>
    
    <?php if ($resultado == 3): ?>
        <p class="alerta correcto">Categoría eliminada correctamente</p>
    <?php endif; ?>

    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="../../" class="boton boton-amarillo">Volver</a>
            <a href="../crear.php" class="boton boton-verde">Nueva Categoría</a>
        </div>

        <!-- Formulario de búsqueda para categorías -->
        <form class="formulario-busqueda" method="GET" action="./index.php">
            <div class="campo">
                <label for="busqueda">Buscar Categoría:</label>
                <input type="text" id="busqueda" name="busqueda" placeholder="Buscar por nombre" value="<?php echo $busqueda; ?>">
            </div>
            <div class="botones-busqueda">
                <input type="submit" class="boton boton-verde" value="Buscar">
                <?php if(!empty($busqueda)): ?>
                    <a href="./index.php" class="boton boton-rojo">Limpiar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Propiedades</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php if(empty($categorias)): ?>
                <tr>
                    <td colspan="4">No hay categorías para mostrar</td>
                </tr>
            <?php else: ?>
                <?php foreach($categorias as $categoria): 
                    // Contar propiedades por categoría
                    $db = conectarDB();
                    $query = "SELECT COUNT(*) as total FROM propiedades WHERE categoria_id = " . $categoria->id;
                    $resultado = mysqli_query($db, $query);
                    $total = mysqli_fetch_assoc($resultado);
                ?>
                    <tr>
                        <td><?php echo $categoria->id; ?></td>
                        <td><?php echo $categoria->nombre; ?></td>
                        <td><?php echo $total['total']; ?> propiedades</td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">
                                <input type="submit" value="Eliminar" class="boton-rojo-block">
                            </form>
                            <a href="../actualizar.php?id=<?php echo $categoria->id;?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php
incluirTemplate('footer');
?> 