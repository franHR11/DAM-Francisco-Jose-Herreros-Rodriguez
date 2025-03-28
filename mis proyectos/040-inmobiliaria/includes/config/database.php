<?php
if (!function_exists('conectarDB')) {
    function conectarDB(){
        $db = new mysqli("localhost","franhr","franhr","proyectoinmobiliaria");
        if(!$db){
            echo "Error no se pudo conectar a la Base de Datos";
            exit;
        }
        return $db;
    }
}
?>