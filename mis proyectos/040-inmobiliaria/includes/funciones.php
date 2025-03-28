<?php

define('TEMPLATE_URL', __DIR__ . '/templates') ;    
define('FUNCIONES_URL',__DIR__ . '/funciones.php'); 
define('CARPETA_IMAGENES',__DIR__ . '/../imagenes/'); 
    function incluirTemplate($nombre, $inicio = false) {
        include TEMPLATE_URL . "/{$nombre}.php";
    }
    function estaAutenticado() {
        session_start();
        
        if(!isset($_SESSION['login'])) {
            return false;
        }
        
        return true;
    

}

function debuguear($variable){
    echo'<pre>';
    var_dump($variable);
    echo'</pre>';
    exit;

}
    



?>