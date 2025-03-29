<?php

define('BASE_URL', 'http://dam-francisco-jose-herreros-rodriguez.test:8080/mis%20proyectos/040-inmobiliaria/');

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