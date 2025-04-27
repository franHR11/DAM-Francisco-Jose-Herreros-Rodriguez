<?php
require '../includes/app.php';

estaAutenticado();
use App\Propiedad;
use App\Vendedor;
use App\Categoria;

// Limitar a 10 propiedades y 10 vendedores
$propiedades = Propiedad::get(10);
$vendedores = Vendedor::get(10);
$categorias = Categoria::all();

// Obtener propiedades destacadas
$propiedades_destacadas = Propiedad::getDestacados(6);

// Contar el total de registros
$total_propiedades = Propiedad::count();
$total_vendedores = Vendedor::count();
$total_categorias = count($categorias);

// Buscar propiedades y vendedores
$busqueda_propiedades = isset($_GET['busqueda_prop']) ? $_GET['busqueda_prop'] : '';
$busqueda_vendedores = isset($_GET['busqueda_vend']) ? $_GET['busqueda_vend'] : '';
$busqueda_categorias = isset($_GET['busqueda_cat']) ? $_GET['busqueda_cat'] : '';

if (!empty($busqueda_propiedades)) {
    $propiedades = Propiedad::buscar($busqueda_propiedades);
}

if (!empty($busqueda_vendedores)) {
    $vendedores = Vendedor::buscar($busqueda_vendedores);
}

if (!empty($busqueda_categorias)) {
    // Filtrar categorías por nombre (implementación básica)
    $categorias_filtradas = [];
    foreach($categorias as $categoria) {
        if(stripos($categoria->nombre, $busqueda_categorias) !== false) {
            $categorias_filtradas[] = $categoria;
        }
    }
    $categorias = $categorias_filtradas;
}

// MUESTRA MENSAJE CONDICIONAL
$resultado = $_GET["resultado"] ?? null;
$tipo = $_GET["tipo"] ?? null;

// eliminar registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $tipo = $_POST['tipo'];

    if ($id) {
        if ($tipo === 'propiedad') {
            // ELIMINAR ARCHIVO
            $query = "SELECT imagen FROM propiedades WHERE id = {$id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink("../imagenes/" . $propiedad["imagen"]);

            // ELIMINAR LA PROPIEDAD
            $query = "DELETE FROM propiedades WHERE id = {$id}";
            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                header("Location: ./index.php?resultado=3&tipo=propiedad");
            }
        } elseif ($tipo === 'vendedor') {
            // Eliminar vendedor
            $vendedor = Vendedor::find($id);
            $resultado = $vendedor->eliminar();
            
            if ($resultado) {
                header("Location: ./index.php?resultado=3&tipo=vendedor");
            }
        } elseif ($tipo === 'categoria') {
            // Eliminar categoria
            $categoria = Categoria::find($id);
            $resultado = $categoria->eliminar();
            
            if ($resultado) {
                header("Location: ./index.php?resultado=3&tipo=categoria");
            }
        }
    }
}

//TEMPLATES
incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Administrador Inmobiliaria</h1>
    
    <?php if ($resultado == 1):
        if ($tipo === 'vendedor') {
            $mensaje = 'Vendedor creado correctamente';
        } elseif ($tipo === 'categoria') {
            $mensaje = 'Categoría creada correctamente';
        } else {
            $mensaje = 'Anuncio creado correctamente';
        }
    ?>
        <p class="alerta correcto"><?php echo $mensaje; ?></p>
    <?php elseif ($resultado == 2):
        if ($tipo === 'vendedor') {
            $mensaje = 'Vendedor actualizado correctamente';
        } elseif ($tipo === 'categoria') {
            $mensaje = 'Categoría actualizada correctamente';
        } else {
            $mensaje = 'Anuncio actualizado correctamente';
        }
    ?>
        <p class="alerta correcto"><?php echo $mensaje; ?></p>
    <?php elseif ($resultado == 3):
        if ($tipo === 'vendedor') {
            $mensaje = 'Vendedor eliminado correctamente';
        } elseif ($tipo === 'categoria') {
            $mensaje = 'Categoría eliminada correctamente';
        } else {
            $mensaje = 'Anuncio eliminado correctamente';
        }
    ?>
        <p class="alerta correcto"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <h2>Propiedades</h2>
    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="<?php echo url('/admin/propiedades/crear.php'); ?>" class="boton boton-verde">Nueva Propiedad</a>
            <a href="<?php echo url('/admin/propiedades/ver-todas/'); ?>" class="boton boton-amarillo">Ver Todas (<?php echo $total_propiedades; ?>)</a>
        </div>

        <!-- Formulario de búsqueda para propiedades -->
        <form class="formulario-busqueda" method="GET" action="./">
            <div class="campo">
                <label for="busqueda_prop">Buscar Propiedad:</label>
                <input type="text" id="busqueda_prop" name="busqueda_prop" placeholder="Buscar por título o descripción" value="<?php echo $busqueda_propiedades; ?>">
            </div>
            <div class="botones-busqueda">
                <input type="submit" class="boton boton-verde" value="Buscar">
                <?php if(!empty($busqueda_propiedades)): ?>
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
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" value="Eliminar" class="boton-rojo-block">
                            </form>
                            <a href="<?php echo url('/admin/propiedades/actualizar.php?id=' . $propiedad->id); ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Sección de Propiedades Destacadas -->
    <section class="propiedades-destacadas">
        <h3>Propiedades Destacadas</h3>
        
        <?php if(empty($propiedades_destacadas)): ?>
            <p class="sin-resultados">No hay propiedades destacadas para mostrar.</p>
        <?php else: ?>
            <div class="grid-propiedades">
                <?php foreach($propiedades_destacadas as $propiedad): ?>
                    <div class="propiedad-destacada">
                        <img src="<?php echo img_url($propiedad->imagen); ?>" alt="Imagen propiedad">
                        
                        <div class="contenido-propiedad">
                            <h4><?php echo $propiedad->titulo; ?></h4>
                            <p class="descripcion-propiedad"><?php echo substr($propiedad->descripcion, 0, 100) . '...'; ?></p>
                            <p class="precio"><?php echo number_format($propiedad->precio, 0, ',', '.'); ?> €</p>
                            
                            <ul class="iconos-caracteristicas">
                                <li>
                                    <img loading="lazy" src="../build/img/icono_wc.svg" alt="icono wc">
                                    <p><?php echo $propiedad->wc; ?></p>
                                </li>
                                <li>
                                    <img loading="lazy" src="../build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                                    <p><?php echo $propiedad->estacionamiento; ?></p>
                                </li>
                                <li>
                                    <img loading="lazy" src="../build/img/icono_dormitorio.svg" alt="icono habitaciones">
                                    <p><?php echo $propiedad->habitaciones; ?></p>
                                </li>
                            </ul>
                            
                            <div class="acciones">
                                <a href="<?php echo url('/admin/propiedades/actualizar.php?id=' . $propiedad->id); ?>" class="boton-amarillo-block">
                                    Editar
                                </a>
                                
                                <form method="POST" class="w-100">
                                    <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                    <input type="hidden" name="tipo" value="propiedad">
                                    <input type="submit" value="Eliminar" class="boton-rojo-block">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <h2>Vendedores</h2>
    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="vendedores/crear.php" class="boton boton-verde">Nuevo Vendedor</a>
            <a href="vendedores/ver-todos/" class="boton boton-amarillo">Ver Todos (<?php echo $total_vendedores; ?>)</a>
        </div>

        <!-- Formulario de búsqueda para vendedores -->
        <form class="formulario-busqueda" method="GET" action="./">
            <div class="campo">
                <label for="busqueda_vend">Buscar Vendedor:</label>
                <input type="text" id="busqueda_vend" name="busqueda_vend" placeholder="Buscar por nombre, apellido o teléfono" value="<?php echo $busqueda_vendedores; ?>">
            </div>
            <div class="botones-busqueda">
                <input type="submit" class="boton boton-verde" value="Buscar">
                <?php if(!empty($busqueda_vendedores)): ?>
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
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" value="Eliminar" class="boton-rojo-block">
                            </form>
                            <a href="vendedores/actualizar.php?id=<?php echo $vendedor->id;?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <h2>Categorías</h2>
    <div class="admin-header con-busqueda">
        <div class="botones-accion">
            <a href="categorias/crear.php" class="boton boton-verde">Nueva Categoría</a>
            <a href="categorias/ver-todas/" class="boton boton-amarillo">Ver Todas (<?php echo $total_categorias; ?>)</a>
        </div>

        <!-- Formulario de búsqueda para categorías -->
        <form class="formulario-busqueda" method="GET" action="./">
            <div class="campo">
                <label for="busqueda_cat">Buscar Categoría:</label>
                <input type="text" id="busqueda_cat" name="busqueda_cat" placeholder="Buscar por nombre" value="<?php echo $busqueda_categorias; ?>">
            </div>
            <div class="botones-busqueda">
                <input type="submit" class="boton boton-verde" value="Buscar">
                <?php if(!empty($busqueda_categorias)): ?>
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
                                <input type="hidden" name="tipo" value="categoria">
                                <input type="submit" value="Eliminar" class="boton-rojo-block">
                            </form>
                            <a href="categorias/actualizar.php?id=<?php echo $categoria->id;?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php
// CERRAR LA CONEXION
mysqli_close($db);
incluirTemplate('footer');
?>