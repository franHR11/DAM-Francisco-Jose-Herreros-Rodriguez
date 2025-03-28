<?php
    // IMPORTAR LA CONEXION

    require 'includes/config/database.php';
    $db = conectarDB();

    //  CREAR UN EMAIL Y PASSWORD

$email = 'correo@correo.com';
$password = 'franhr';

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //QUERRY PARA CREAR USUARIO
    $query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

echo $query;


    // AGREGARLO A LA BASE DE DATOS
mysqli_query($db, $query)









?>