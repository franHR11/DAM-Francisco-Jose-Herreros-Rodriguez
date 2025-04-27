<?php
require '../../includes/app.php';
use App\Contacto;

estaAutenticado();

// Paginación
$paginaActual = intval($_GET['pagina'] ?? 1);
$porPagina = 10;
$offset = ($paginaActual - 1) * $porPagina;

// Total de mensajes para la paginación
$totalMensajes = Contacto::contarTodos();
$totalPaginas = ceil($totalMensajes / $porPagina);

// Obtener mensajes con límite
$mensajes = Contacto::limit($porPagina, $offset);

// Saber si hay mensajes no leídos
$mensajesNoLeidos = Contacto::mensajesNoLeidos();

// Template
incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Administración - Mensajes de Contacto</h1>

    <?php if(isset($_GET['resultado'])): ?>
        <?php if($_GET['resultado'] === '1'): ?>
            <p class="alerta exito">Mensaje marcado como leído</p>
        <?php elseif($_GET['resultado'] === '2'): ?>
            <p class="alerta exito">Mensaje eliminado correctamente</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($mensajesNoLeidos > 0): ?>
        <p class="alerta info">Tienes <?php echo $mensajesNoLeidos; ?> mensaje(s) sin leer</p>
    <?php endif; ?>

    <?php if (empty($mensajes)): ?>
        <p class="no-resultados">No hay mensajes para mostrar</p>
    <?php else: ?>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Tipo</th>
                    <th>Fecha recibido</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mensajes as $mensaje): ?>
                <tr class="<?php echo (int)$mensaje->leido === 0 ? 'mensaje-no-leido' : ''; ?>">
                    <td><?php echo htmlspecialchars($mensaje->id ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($mensaje->nombre ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($mensaje->email ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($mensaje->telefono ?? ''); ?></td>
                    <td><?php echo isset($mensaje->tipo) && $mensaje->tipo === 'compra' ? 'Compra' : 'Vende'; ?></td>
                    <td><?php echo isset($mensaje->creado) ? date('d/m/Y H:i', strtotime($mensaje->creado)) : ''; ?></td>
                    <td><?php echo (int)$mensaje->leido === 0 ? 'No leído' : 'Leído'; ?></td>
                    <td>
                        <div class="acciones">
                            <a href="ver.php?id=<?php echo htmlspecialchars($mensaje->id ?? ''); ?>" class="boton-verde-block">Ver</a>
                            <form method="POST" action="eliminar.php" class="w-100">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($mensaje->id ?? ''); ?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($totalPaginas > 1): ?>
        <div class="paginacion">
            <ul>
                <?php if ($paginaActual > 1): ?>
                    <li><a href="?pagina=<?php echo $paginaActual - 1; ?>">Anterior</a></li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="<?php echo $paginaActual === $i ? 'actual' : ''; ?>">
                        <a href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($paginaActual < $totalPaginas): ?>
                    <li><a href="?pagina=<?php echo $paginaActual + 1; ?>">Siguiente</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</main>

<?php incluirTemplate('footer'); ?> 