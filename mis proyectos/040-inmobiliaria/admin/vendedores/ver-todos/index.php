<?php
require '../../../includes/app.php';

estaAutenticado();
use App\Vendedor;

// Configuración de paginación
$por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $por_pagina;

// Buscar vendedores
$termino_busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
if (!empty($termino_busqueda)) {
    $vendedores = Vendedor::buscar($termino_busqueda);
    $total_vendedores = count($vendedores);
} else {
    // Obtener vendedores paginados
    $vendedores = Vendedor::paginar($por_pagina, $offset);
    $total_vendedores = Vendedor::count();
}

// Calcular total de páginas
$total_paginas = ceil($total_vendedores / $por_pagina);

// Eliminar vendedor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        // Eliminar vendedor
        $vendedor = Vendedor::find($id);
        $resultado = $vendedor->eliminar();
        
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
    <h1>Administrar Vendedores</h1>
    
    <?php if ($resultado == 1): ?>
        <p class="alerta correcto">Vendedor creado correctamente</p>
    <?php elseif ($resultado == 2): ?>
        <p class="alerta correcto">Vendedor actualizado correctamente</p>
    <?php elseif ($resultado == 3): ?>
        <p class="alerta correcto">Vendedor eliminado correctamente</p>
    <?php endif; ?>

    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="<?php echo url('/admin/vendedores/crear.php'); ?>" class="boton boton-verde">Nuevo Vendedor</a>
            <a href="<?php echo url('/admin/index.php'); ?>" class="boton boton-amarillo">Volver</a>
        </div>

        <!-- Formulario de búsqueda -->
        <form class="formulario-busqueda" method="GET">
            <div class="campo">
                <label for="busqueda">Buscar Vendedor:</label>
                <input type="text" id="busqueda" name="busqueda" placeholder="Buscar por nombre, apellido o teléfono" value="<?php echo $termino_busqueda; ?>">
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
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php if(empty($vendedores)): ?>
                <tr>
                    <td colspan="5">No hay vendedores para mostrar</td>
                </tr>
            <?php else: ?>
                <?php foreach($vendedores as $vendedor): ?>
                    <tr>
                        <td><?php echo $vendedor->id; ?></td>
                        <td><?php echo $vendedor->nombre; ?></td>
                        <td><?php echo $vendedor->apellido; ?></td>
                        <td><?php echo $vendedor->telefono; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="submit" value="Eliminar" class="boton-rojo-block">
                            </form>
                            <a href="<?php echo url('/admin/vendedores/actualizar.php?id=' . $vendedor->id); ?>" class="boton-amarillo-block">Actualizar</a>
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