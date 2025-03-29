<?php
require '../../includes/app.php';

estaAutenticado();

// Importar clases
use App\BlogEntry;
use App\BlogCategory;

// Eliminar entrada o categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        $tipo = $_POST['tipo'] ?? '';
        
        if (validarTipoContenido($tipo)) {
            if ($tipo === 'entrada') {
                $entrada = BlogEntry::find($id);
                $entrada->eliminar();
            } elseif ($tipo === 'categoria') {
                $categoria = BlogCategory::find($id);
                $categoria->eliminar();
            }
        }
    }
}

// Obtener entradas del blog
$entradas = BlogEntry::all();

// TEMPLATES
incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Blog - Administración</h1>
    
    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="<?php echo url('/admin/blog/crear.php'); ?>" class="boton boton-verde">Nueva Entrada</a>
            <a href="<?php echo url('/admin/blog/ver-todas/index.php'); ?>" class="boton boton-amarillo">Ver Todas</a>
            <a href="<?php echo url('/admin/blog/categorias/index.php'); ?>" class="boton boton-azul">Gestionar Categorías</a>
        </div>
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
                            <form method="POST" class="formulario-eliminar">
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

    <div class="alinear-derecha">
        <a href="<?php echo url('/admin/index.php'); ?>" class="boton boton-verde">Volver al Dashboard</a>
    </div>
</main>

<?php
incluirTemplate('footer');
?> 