<?php

/**
 * Funciones de ayuda para URLs relativas
 */

/**
 * Determina la URL base de la aplicación para generar URLs relativas
 * 
 * @return string URL base relativa
 */
function obtenerUrlBase() {
    // Obtener la ruta del script actual respecto a la raíz del servidor
    $script_path = $_SERVER['SCRIPT_NAME'];
    
    // Determinar cuántos niveles estamos desde la raíz del proyecto
    $ruta_proyecto = 'DAM-Francisco-Jose-Herreros-Rodriguez/mis proyectos/040-inmobiliaria';
    
    // Encontrar la posición del proyecto en la ruta
    $pos = strpos($script_path, $ruta_proyecto);
    if ($pos !== false) {
        // Si encontramos la ruta del proyecto, extraemos la parte inicial
        $base_url = substr($script_path, 0, $pos + strlen($ruta_proyecto));
        return $base_url;
    }
    
    // Si no podemos determinar la ruta base exacta, intentamos con una aproximación
    $niveles = substr_count($script_path, '/') - 1;
    $ruta_relativa = str_repeat('../', $niveles);
    
    return $ruta_relativa;
}

/**
 * Genera una URL absoluta a partir de una ruta relativa al proyecto
 * 
 * @param string $ruta Ruta relativa al proyecto (ej. /admin/blog/crear)
 * @return string URL absoluta completa
 */
function url($ruta) {
    // Asegurarse de que BASE_URL está definida
    if (!defined('BASE_URL')) {
        // Manejo de error: BASE_URL no definida
        // Puedes lanzar una excepción, mostrar un error o retornar una URL por defecto
        error_log("Error: La constante BASE_URL no está definida.");
        return '#error-base-url-not-defined'; // Retorna un enlace de error
    }
    
    // Eliminar la barra inicial de la ruta si existe para evitar dobles barras
    $ruta_limpia = ltrim($ruta, '/');
    
    // Concatenar la URL base con la ruta limpia
    return rtrim(BASE_URL, '/') . '/' . $ruta_limpia;
}

/**
 * Genera una URL absoluta para imágenes
 * 
 * @param string $imagen Nombre del archivo de imagen
 * @return string URL absoluta a la imagen
 */
function img_url($imagen) {
    // Utilizar la función url() para generar la URL base absoluta
    return url('imagenes/' . $imagen);
} 