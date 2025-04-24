<?php

define('TEMPLATE_URL', __DIR__ . '/templates') ;    
define('FUNCIONES_URL',__DIR__ . '/funciones.php'); 
define('CARPETA_IMAGENES',__DIR__ . '/../imagenes/'); 
    function incluirTemplate($nombre, $inicio = false) {
        include TEMPLATE_URL . "/{$nombre}.php";
    }
    function estaAutenticado() {
        session_start();
        
        if(!isset($_SESSION['login']) || !$_SESSION['login']) {
            // Redirigir usando la función url() para obtener la ruta absoluta
            header("Location: " . url('/login.php?error=no_auth'));
            exit;
        }
        // Si está autenticado, simplemente retorna true (o no hace nada si no necesitas el valor de retorno)
        return true; 
    }

function debuguear($variable){
    echo'<pre>';
    var_dump($variable);
    echo'</pre>';
    exit;
}

// Función para sanitizar el HTML
function sanitizar($html) {
    $sanitizado = htmlspecialchars($html ?? '');
    return $sanitizado;
}

// Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad', 'entrada', 'categoria'];
    return in_array($tipo, $tipos);
}

/**
 * Obtiene una propiedad de un objeto de forma segura
 * 
 * @param object|null $objeto El objeto del que obtener la propiedad
 * @param string $propiedad El nombre de la propiedad a obtener
 * @param mixed $default El valor por defecto si la propiedad no existe
 * @return mixed El valor de la propiedad o el valor por defecto
 */
function obtenerPropiedad($objeto, $propiedad, $default = '') {
    if (!$objeto || !isset($objeto->$propiedad)) {
        return $default;
    }
    return $objeto->$propiedad;
}
    
?>