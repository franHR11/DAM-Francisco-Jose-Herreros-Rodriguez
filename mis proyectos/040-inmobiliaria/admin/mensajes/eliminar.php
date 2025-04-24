<?php
require '../../includes/app.php';
use App\Contacto;

estaAutenticado();

// Validar el ID
$id = $_POST['id'] ?? null;
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

// Eliminar el mensaje
$resultado = false;

if (method_exists($mensaje, 'eliminar')) {
    $resultado = $mensaje->eliminar();
} else {
    // Alternativa si el método eliminar no existe
    $db = conectarDB();
    $query = "DELETE FROM mensajes_contacto WHERE id = " . (int)$id . " LIMIT 1";
    $resultado = $db->query($query);
}

if ($resultado) {
    header('Location: /admin/mensajes?resultado=2');
} else {
    header('Location: /admin/mensajes?error=1');
} 