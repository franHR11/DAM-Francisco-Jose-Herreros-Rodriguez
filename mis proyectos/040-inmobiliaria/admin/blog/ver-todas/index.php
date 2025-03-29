<?php
// Importar conexión y clases
require '../../../includes/app.php';

use App\BlogEntry;

// Autenticar usuario
estaAutenticado(); // Solo llamamos a la función, ella maneja la redirección si es necesario

// Mensaje condicional
$mensaje = $_GET['mensaje'] ?? null;

// Consultar entradas de blog
$offset = 0;
$limit = 10;
$busqueda = '';
$pagina = 1;

if (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) {
    $pagina = (int) $_GET['pagina'];
    $offset = ($pagina - 1) * $limit;
}

if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $entradas = BlogEntry::buscar($busqueda, 'titulo');
    $totalEntradas = count($entradas);
} else {
    $entradas = BlogEntry::limit($limit, $offset);
    $totalEntradas = BlogEntry::contarTodos();
}

// Calcular número de páginas
$totalPaginas = ceil($totalEntradas / $limit);

// TEMPLATES
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Blog - Ver todas las entradas</h1>
    
    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="<?php echo url('/admin/blog/index.php'); ?>" class="boton boton-verde">Volver</a>
            <a href="<?php echo url('/admin/blog/crear.php'); ?>" class="boton boton-verde">Nueva Entrada</a>
        </div>
        
        <form class="formulario-busqueda" method="GET">
            <div>
                <label for="busqueda">Buscar Entrada:</label>
                <input type="text" id="busqueda" name="busqueda" placeholder="Buscar por título..." value="<?php echo htmlspecialchars($busqueda); ?>">
            </div>
            <div class="botones-busqueda">
                <input type="submit" class="boton boton-verde" value="Buscar">
                <?php if (!empty($busqueda)) : ?>
                    <a href="index.php" class="boton boton-rojo">Limpiar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    
    <?php if(isset($_GET['resultado'])): ?>
        <?php if($_GET['resultado'] === '1'): ?>
            <p class="alerta exito">Entrada creada correctamente</p>
        <?php elseif($_GET['resultado'] === '2'): ?>
            <p class="alerta exito">Entrada actualizada correctamente</p>
        <?php elseif($_GET['resultado'] === '3'): ?>
            <p class="alerta exito">Entrada eliminada correctamente</p>
        <?php endif; ?>
    <?php endif; ?>

    <div class="admin-blog-contenedor">
        <?php if(!empty($entradas)): ?>
            <?php foreach($entradas as $entrada): ?>
                <div class="entrada-blog-admin">
                    <div class="imagen-blog-admin">
                        <?php if($entrada->imagen): ?>
                            <img src="<?php echo img_url($entrada->imagen); ?>" alt="Imagen del artículo">
                        <?php else: ?>
                            <p class="no-imagen">Sin imagen</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="contenido-blog">
                        <h3><?php echo $entrada->titulo; ?></h3>
                        <p class="meta-info">
                            Fecha: <?php echo date('d/m/Y', strtotime($entrada->creado)); ?>
                            <?php 
                                // Obtener nombre de categoría
                                $db = conectarDB();
                                $query = "SELECT nombre FROM blog_categories WHERE id = {$entrada->categoria_id}";
                                $resultado = mysqli_query($db, $query);
                                $categoria = mysqli_fetch_assoc($resultado);
                                echo $categoria ? ' | Categoría: ' . $categoria['nombre'] : '';
                            ?>
                        </p>
                        <div class="texto-entrada">
                            <?php 
                                // Mostrar solo un extracto del contenido
                                $extracto = substr(strip_tags($entrada->contenido), 0, 150);
                                echo $extracto . (strlen(strip_tags($entrada->contenido)) > 150 ? '...' : '');
                            ?>
                        </div>
                        
                        <div class="acciones-entrada">
                            <a href="<?php echo url('/admin/blog/actualizar.php?id=' . $entrada->id); ?>" class="boton boton-amarillo">Editar</a>
                            <form method="POST" action="<?php echo url('/admin/blog/index.php'); ?>" class="formulario-eliminar">
                                <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                                <input type="hidden" name="tipo" value="entrada">
                                <input type="submit" class="boton boton-rojo" value="Eliminar">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay entradas de blog. ¡Crea la primera!</p>
        <?php endif; ?>
    </div>
    
    <?php if ($totalPaginas > 1 && empty($busqueda)) : ?>
        <div class="paginacion">
            <?php if ($pagina > 1) : ?>
                <a href="?pagina=<?php echo $pagina - 1; ?>" class="boton boton-verde">&laquo; Anterior</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                <a href="?pagina=<?php echo $i; ?>" class="boton <?php echo $pagina === $i ? 'boton-verde' : 'boton-amarillo'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
            
            <?php if ($pagina < $totalPaginas) : ?>
                <a href="?pagina=<?php echo $pagina + 1; ?>" class="boton boton-verde">Siguiente &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <div class="alinear-derecha">
        <a href="<?php echo url('/admin/index.php'); ?>" class="boton boton-verde">Volver al Dashboard</a>
    </div>
</main>

<?php
incluirTemplate('footer');
?> 