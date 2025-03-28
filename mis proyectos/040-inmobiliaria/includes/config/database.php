<?php
    function conectarDB(){
        $db = mysqli_connect("localhost","franhr","franhr","proyectoinmobiliaria");
        if(!$db){
            echo "Error no se pudo conectar a la Base de Datos";
            exit;
        }
return $db;
}
?>