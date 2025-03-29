<?php
require __DIR__ . '/../vendor/autoload.php';
require 'funciones.php';
require 'config/database.php';
require 'url_helpers.php';

// conectarnos a la base de datos
$db = conectarDB();


use App\Propiedad;
use App\Vendedor;
use App\Categoria;
use App\BlogEntry;
use App\BlogCategory;

Propiedad::setDB($db);
Vendedor::setDB($db);
Categoria::setDB($db);
BlogEntry::setDB($db);
BlogCategory::setDB($db);

$destacado = isset($_POST['destacado']) ? 1 : 0;
$categoria_id = $_POST['categoria_id'] ?? 'NULL';

?>