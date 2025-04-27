<?php
// Importar conexión y clases
require '../../includes/app.php';

use App\BlogCategory;

// Este archivo debe copiarse a admin/blog/categorias/index.php solo si el original no funciona

// Autenticar usuario
$auth = estaAutenticado();
if (!$auth) {
    header('Location: ../../index.php');
}

// Mensaje condicional
$mensaje = $_GET['mensaje'] ?? null;

// Consultar categorías
$busqueda = '';

if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $categorias = BlogCategory::buscar($busqueda);
} else {
    $categorias = BlogCategory::all();
}

// TEMPLATES
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Blog - Gestión de Categorías</h1>
    
    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="../index.php" class="boton boton-verde">Volver</a>
            <a href="crear.php" class="boton boton-verde">Nueva Categoría</a>
        </div>
        
        <form class="formulario-busqueda" method="GET">
            <div>
                <label for="busqueda">Buscar Categoría:</label>
                <input type="text" id="busqueda" name="busqueda" placeholder="Buscar por nombre..." value="<?php echo htmlspecialchars($busqueda); ?>">
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
            <p class="alerta exito">Categoría creada correctamente</p>
        <?php elseif($_GET['resultado'] === '2'): ?>
            <p class="alerta exito">Categoría actualizada correctamente</p>
        <?php elseif($_GET['resultado'] === '3'): ?>
            <p class="alerta exito">Categoría eliminada correctamente</p>
        <?php endif; ?>
    <?php endif; ?>

    <h2>Categorías del Blog</h2>

    <div class="blog-categories">
        <?php if (!empty($categorias)) : ?>
            <?php foreach ($categorias as $categoria) : ?>
                <div class="blog-category">
                    <div class="blog-category-content">
                        <h3><?php echo $categoria->nombre; ?></h3>
                        <?php if ($categoria->descripcion) : ?>
                            <p><?php echo $categoria->descripcion; ?></p>
                        <?php else : ?>
                            <p class="sin-descripcion">Sin descripción</p>
                        <?php endif; ?>
                        
                        <?php 
                        // Contar entradas en esta categoría
                        $totalEntradas = BlogCategory::contarEntradas($categoria->id);
                        ?>
                        <p class="total-entradas">
                            <span><?php echo $totalEntradas; ?></span> 
                            <?php echo $totalEntradas === 1 ? 'entrada' : 'entradas'; ?>
                        </p>
                    </div>
                    
                    <div class="acciones">
                        <a href="actualizar.php?id=<?php echo $categoria->id; ?>" class="boton boton-amarillo">Editar</a>
                        <form method="POST" action="../index.php" class="formulario-eliminar">
                            <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">
                            <input type="hidden" name="tipo" value="categoria">
                            <input type="submit" class="boton boton-rojo" value="Eliminar">
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No hay categorías. ¡Crea la primera!</p>
        <?php endif; ?>
    </div>
    
    <div class="alinear-derecha">
        <a href="../index.php" class="boton boton-verde">Volver al Dashboard</a>
    </div>
</main>

<?php
incluirTemplate('footer');
?> 