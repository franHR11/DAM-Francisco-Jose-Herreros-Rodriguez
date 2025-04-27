<?php

// Habilitar reporte de todos los errores PHP para desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';
require 'funciones.php';
require 'config/database.php';
require 'url_helpers.php';

// conectarnos a la base de datos
$db = conectarDB();

use App\ActiveRecord;
use App\Propiedad;
use App\Vendedor;
use App\Categoria;
use App\BlogEntry;
use App\BlogCategory;
use App\SiteConfig;
use App\Contacto;

ActiveRecord::setDB($db);

// Y también establecerla explícitamente en cada clase que la necesite
Propiedad::setDB($db);
Vendedor::setDB($db);
Categoria::setDB($db);
BlogEntry::setDB($db);
BlogCategory::setDB($db);
SiteConfig::setDB($db);
Contacto::setDB($db);

$destacado = isset($_POST['destacado']) ? 1 : 0;
$categoria_id = $_POST['categoria_id'] ?? 'NULL';

?>