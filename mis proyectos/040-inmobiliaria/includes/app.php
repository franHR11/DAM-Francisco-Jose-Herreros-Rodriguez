<?php
require __DIR__ . '/../vendor/autoload.php';
require 'funciones.php';
require 'config/database.php';

// conectarnos a la base de datos
$db = conectarDB();


use App\Propiedad;

Propiedad::setDB($db);


?>