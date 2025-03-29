<?php
require '../../../includes/app.php';

estaAutenticado();
use App\Propiedad;

// Configuración de paginación
$por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $por_pagina;

// Buscar propiedades
$termino_busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
if (!empty($termino_busqueda)) {
    $propiedades = Propiedad::buscar($termino_busqueda);
    $total_propiedades = count($propiedades);
} else {
    // Obtener propiedades paginadas
    $propiedades = Propiedad::paginar($por_pagina, $offset);
    $total_propiedades = Propiedad::count();
}

// Calcular total de páginas
$total_paginas = ceil($total_propiedades / $por_pagina);

// Eliminar propiedad
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        // ELIMINAR ARCHIVO
        $query = "SELECT imagen FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink("../../../imagenes/" . $propiedad["imagen"]);

        // ELIMINAR LA PROPIEDAD
        $query = "DELETE FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header("Location: ./index.php?resultado=3");
        }
    }
}

// MUESTRA MENSAJE CONDICIONAL
$resultado = $_GET["resultado"] ?? null;

incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Administrar Propiedades</h1>
    
    <?php if ($resultado == 1): ?>
        <p class="alerta correcto">Propiedad creada correctamente</p>
    <?php elseif ($resultado == 2): ?>
        <p class="alerta correcto">Propiedad actualizada correctamente</p>
    <?php elseif ($resultado == 3): ?>
        <p class="alerta correcto">Propiedad eliminada correctamente</p>
    <?php endif; ?>

    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="<?php echo url('/admin/propiedades/crear.php'); ?>" class="boton boton-verde">Nueva Propiedad</a>
            <a href="<?php echo url('/admin/index.php'); ?>" class="boton boton-amarillo">Volver</a>
        </div>

        <!-- Formulario de búsqueda -->
        <form class="formulario-busqueda" method="GET">
            <div class="campo">
                <label for="busqueda">Buscar Propiedad:</label>
                <input type="text" id="busqueda" name="busqueda" placeholder="Buscar por título o descripción" value="<?php echo $termino_busqueda; ?>">
            </div>
            <div class="botones-busqueda">
                <input type="submit" class="boton boton-verde" value="Buscar">
                <?php if(!empty($termino_busqueda)): ?>
                    <a href="index.php" class="boton boton-rojo">Limpiar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php if(empty($propiedades)): ?>
                <tr>
                    <td colspan="5">No hay propiedades para mostrar</td>
                </tr>
            <?php else: ?>
                <?php foreach($propiedades as $propiedad): ?>
                    <tr>
                        <td><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="<?php echo img_url($propiedad->imagen); ?>" class="imagen-tabla"></td>
                        <td><?php echo $propiedad->precio; ?> €</td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="submit" value="Eliminar" class="boton-rojo-block">
                            </form>
                            <a href="<?php echo url('/admin/propiedades/actualizar.php?id=' . $propiedad->id); ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Paginación -->
    <?php if($total_paginas > 1 && empty($termino_busqueda)): ?>
    <div class="paginacion">
        <ul class="paginador">
            <?php if($pagina_actual > 1): ?>
                <li><a href="?pagina=<?php echo $pagina_actual - 1; ?>" class="boton">&laquo; Anterior</a></li>
            <?php endif; ?>
            
            <?php for($i = 1; $i <= $total_paginas; $i++): ?>
                <li class="<?php echo $i === $pagina_actual ? 'actual' : ''; ?>">
                    <a href="?pagina=<?php echo $i; ?>" class="boton"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            
            <?php if($pagina_actual < $total_paginas): ?>
                <li><a href="?pagina=<?php echo $pagina_actual + 1; ?>" class="boton">Siguiente &raquo;</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>
</main>

<?php
incluirTemplate('footer');
?> 