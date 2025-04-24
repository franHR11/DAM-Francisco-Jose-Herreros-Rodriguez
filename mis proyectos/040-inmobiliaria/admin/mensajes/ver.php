<?php
require '../../includes/app.php';
use App\Contacto;

estaAutenticado();

// Validar el ID
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /admin/mensajes');
    exit;
}

// Obtener el mensaje
$mensaje = Contacto::find($id);
if (!$mensaje) {
    header('Location: /admin/mensajes');
    exit;
}

// Helpers para acceder de forma segura a las propiedades
function getProp($obj, $prop, $default = '') {
    return property_exists($obj, $prop) ? $obj->$prop : $default;
}

// Marcar mensaje como leído (actualización directa en la BD)
$db = conectarDB();
$query = "UPDATE mensajes_contacto SET leido = 1 WHERE id = " . (int)$id . " LIMIT 1";
$db->query($query);

// Template
incluirTemplate('header');
incluirTemplate('admin-menu');
?>

<main class="contenedor seccion">
    <h1>Detalle del Mensaje</h1>
    
    <a href="index.php" class="boton boton-verde">Volver</a>

    <div class="mensaje-detalle">
        <div class="mensaje-info">
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars(getProp($mensaje, 'nombre')); ?></p>
            <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars(getProp($mensaje, 'email')); ?>"><?php echo htmlspecialchars(getProp($mensaje, 'email')); ?></a></p>
            <p><strong>Teléfono:</strong> <a href="tel:<?php echo htmlspecialchars(getProp($mensaje, 'telefono')); ?>"><?php echo htmlspecialchars(getProp($mensaje, 'telefono')); ?></a></p>
            <p><strong>Tipo:</strong> <?php echo getProp($mensaje, 'tipo') === 'compra' ? 'Compra' : 'Vende'; ?></p>
            
            <?php if (!empty(getProp($mensaje, 'presupuesto'))): ?>
                <p><strong>Presupuesto:</strong> $<?php echo number_format((float)getProp($mensaje, 'presupuesto'), 2); ?></p>
            <?php endif; ?>
            
            <p><strong>Prefiere contacto vía:</strong> <?php echo getProp($mensaje, 'contacto_via') === 'telefono' ? 'Teléfono' : 'Email'; ?></p>
            
            <?php if (getProp($mensaje, 'contacto_via') === 'telefono'): ?>
                <p><strong>Fecha preferida:</strong> 
                <?php 
                    $fecha = getProp($mensaje, 'fecha_contacto');
                    echo !empty($fecha) ? date('d/m/Y', strtotime($fecha)) : 'No especificada'; 
                ?>
                </p>
                <p><strong>Hora preferida:</strong> 
                <?php 
                    $hora = getProp($mensaje, 'hora_contacto');
                    echo !empty($hora) ? date('H:i', strtotime($hora)) : 'No especificada'; 
                ?>
                </p>
            <?php endif; ?>
            
            <p><strong>Fecha de recepción:</strong> 
            <?php 
                $creado = getProp($mensaje, 'creado');
                echo !empty($creado) ? date('d/m/Y H:i', strtotime($creado)) : 'Desconocida'; 
            ?>
            </p>
        </div>
        
        <div class="mensaje-contenido">
            <h3>Mensaje:</h3>
            <div class="contenido-texto">
                <?php echo nl2br(htmlspecialchars(getProp($mensaje, 'mensaje'))); ?>
            </div>
        </div>
        
        <div class="mensaje-acciones">
            <a href="mailto:<?php echo htmlspecialchars(getProp($mensaje, 'email')); ?>" class="boton boton-verde">Responder por Email</a>
            <form method="POST" action="eliminar.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars(getProp($mensaje, 'id')); ?>">
                <input type="submit" class="boton boton-rojo" value="Eliminar Mensaje">
            </form>
        </div>
    </div>
</main>

<?php incluirTemplate('footer'); ?> 