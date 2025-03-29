<?php
// Verificar si $rutaBase está definida, si no, definirla
if (!isset($rutaBase)) {
    // Determinar si estamos en admin para ajustar las rutas
    $rutaBase = '';
    
    // Detectar ruta actual
    $ruta_actual = $_SERVER['SCRIPT_FILENAME'];
    
    // Detectar si estamos en carpeta admin o subcarpetas
    if (strpos($ruta_actual, '/admin/') !== false || strpos($ruta_actual, '\\admin\\') !== false) {
        // Contamos las subcarpetas después de /admin/
        $partes_ruta = explode('admin', $ruta_actual);
        if (isset($partes_ruta[1])) {
            $subcarpetas = trim($partes_ruta[1], '/\\');
            $nivel = substr_count($subcarpetas, '/') + substr_count($subcarpetas, '\\');
            
            // Determinar el rutaBase según el nivel
            if ($nivel === 0) { 
                // Estamos en admin/index.php
                $rutaBase = '../';
            } else if ($nivel === 1) {
                // Estamos en admin/alguna_carpeta/
                $rutaBase = '../../';
            } else if ($nivel >= 2) {
                // Estamos en admin/alguna_carpeta/subcarpeta/ o más profundo
                $rutaBase = '';
                for ($i = 0; $i <= $nivel; $i++) {
                    $rutaBase .= '../';
                }
            }
        }
    }
}

// Determinar la sección activa basada en la URL actual
$seccionActual = '';

if (strpos($_SERVER['SCRIPT_NAME'], '/admin/propiedades/') !== false) {
    $seccionActual = 'propiedades';
} elseif (strpos($_SERVER['SCRIPT_NAME'], '/admin/vendedores/') !== false) {
    $seccionActual = 'vendedores';
} elseif (strpos($_SERVER['SCRIPT_NAME'], '/admin/categorias/') !== false) {
    $seccionActual = 'categorias';
} elseif (strpos($_SERVER['SCRIPT_NAME'], '/admin/blog/') !== false) {
    $seccionActual = 'blog';
}
?>

<div class="admin-navbar">
    <div class="contenedor">
        <nav class="admin-menu">
            <a href="<?php echo $rutaBase; ?>admin/index.php" class="<?php echo $seccionActual === '' && strpos($_SERVER['SCRIPT_NAME'], '/admin/index.php') !== false ? 'activo' : ''; ?>">Dashboard</a>
            <a href="<?php echo $rutaBase; ?>admin/propiedades/ver-todas/index.php" class="<?php echo $seccionActual === 'propiedades' ? 'activo' : ''; ?>">Propiedades</a>
            <a href="<?php echo $rutaBase; ?>admin/vendedores/ver-todos/index.php" class="<?php echo $seccionActual === 'vendedores' ? 'activo' : ''; ?>">Vendedores</a>
            <a href="<?php echo $rutaBase; ?>admin/categorias/ver-todas/index.php" class="<?php echo $seccionActual === 'categorias' ? 'activo' : ''; ?>">Categorías</a>
            <a href="<?php echo $rutaBase; ?>admin/blog/index.php" class="<?php echo $seccionActual === 'blog' ? 'activo' : ''; ?>">Blog</a>
        </nav>
    </div>
</div> 