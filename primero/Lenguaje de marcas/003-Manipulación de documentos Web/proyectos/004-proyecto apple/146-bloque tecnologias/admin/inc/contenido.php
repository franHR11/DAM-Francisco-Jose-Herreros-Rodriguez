<?php
include "utilidades/error.php";
include "config/config.php";

// Inicializar variable de paginación si no existe
if (!isset($_SESSION['pagina'])) {
    $_SESSION['pagina'] = 0;
}

// Asegurar que la página nunca sea negativa
$_SESSION['pagina'] = max(0, $_SESSION['pagina']);

// Add validation for tabla parameter
if (!isset($_GET['tabla']) || empty($_GET['tabla'])) {
    die("Error: No se especificó una tabla válida");
}

$tabla = $_GET['tabla'] ?? '';
$peticion = '';

if($tabla) {
    // Construir la consulta base
    $peticion = "SELECT * FROM ".$tabla;
    
    // Añadir joins específicos según la tabla
    switch($tabla) {
        case 'tiendas_productos':
            $peticion = "SELECT tp.*, t.titulo as tienda_nombre, p.titulo as producto_nombre 
                        FROM tiendas_productos tp
                        JOIN tiendas t ON tp.tienda_id = t.Identificador
                        JOIN productos p ON tp.producto_id = p.Identificador";
            break;
        case 'bloquesproductos':
            $peticion = "SELECT b.*, p.titulo as producto_nombre, t.tipo as tipo_bloque 
                        FROM bloquesproductos b
                        LEFT JOIN productos p ON b.productos_titulo = p.Identificador
                        LEFT JOIN tipobloque t ON b.tipobloque_tipo = t.Identificador
                        LIMIT 10 OFFSET ".($_SESSION['pagina']*10);
            break;
        case 'bloquescategorias':
            $peticion = "SELECT b.*, c.nombre as categoria_nombre, t.tipo as tipo_bloque 
                        FROM bloquescategorias b
                        LEFT JOIN categorias c ON b.categorias_nombre = c.Identificador
                        LEFT JOIN tipobloque t ON b.tipobloque_tipo = t.Identificador
                        LIMIT 10 OFFSET ".($_SESSION['pagina']*10);
            break;
        default:
            if($tabla == 'categoriasblog') {
                $peticion = "SELECT * FROM categoriasblog ORDER BY categoria ASC LIMIT 10 OFFSET ".($_SESSION['pagina']*10);
            } else {
                $peticion = "SELECT * FROM ".$_GET['tabla']." LIMIT 10 OFFSET ".($_SESSION['pagina']*10);
            }
            break;
    }

    try {
        $resultado = $conexion->query($peticion);
        if(!$resultado) {
            throw new Exception($conexion->error);
        }

        // Obtener el nombre real de la clave primaria
        $descripcion_tabla = $conexion->query("DESCRIBE $tabla");
        $clave_primaria = null;
        while($campo = $descripcion_tabla->fetch_assoc()) {
            if($campo['Key'] == 'PRI') {
                $clave_primaria = $campo['Field'];
                break;
            }
        }

        if(!$clave_primaria) {
            $clave_primaria = 'Identificador'; // valor por defecto
        }

        // Mostrar los datos en una tabla
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
        echo "<thead><tr>";
        
        // Obtener los nombres de las columnas
        $finfo = $resultado->fetch_fields();
        foreach ($finfo as $campo) {
            echo "<th>".$campo->name."</th>";
        }
        echo "<th>Acciones</th>";
        echo "</tr></thead>";
        
        echo "<tbody>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            // Usar la clave primaria identificada
            $idRegistro = isset($fila[$clave_primaria]) ? (int)$fila[$clave_primaria] : 0;
            
            foreach($fila as $campo => $valor) {
                $valorSeguro = ($valor !== null) ? htmlspecialchars($valor) : '';
                $esEditable = ($campo !== $clave_primaria && $campo !== 'imagen' && $campo !== 'imagen2' && $campo !== 'categorias_nombre') ? 'editable' : '';
                
                // Modificación para mostrar valores relacionados
                if ($campo === 'categorias_nombre' && isset($fila['categoria_nombre'])) {
                    $valorSeguro = htmlspecialchars($fila['categoria_nombre'] ?? '');
                } else if ($campo === 'tipobloque_tipo' && isset($fila['tipo_bloque'])) {
                    $valorSeguro = htmlspecialchars($fila['tipo_bloque'] ?? '');
                } else if ($campo === 'productos_titulo' && isset($fila['producto_nombre'])) {
                    $valorSeguro = htmlspecialchars($fila['producto_nombre'] ?? '');
                }
                
                // Modificación para mostrar miniaturas de imágenes
                if ($campo === 'imagen' || $campo === 'fondo' || $campo === 'imagen2') {
                    echo "<td class='$esEditable' 
                             data-tabla='" . htmlspecialchars($tabla) . "' 
                             data-columna='" . htmlspecialchars($campo) . "' 
                             data-id='" . $idRegistro . "'>";
                    if ($valor) {
                        echo "<img src='../static/$valor' alt='$valor' style='max-width: 50px; max-height: 50px; object-fit: contain;'>";
                    }
                    echo "</td>";
                } else {
                    $valorCompleto = $valorSeguro;
                    if (strlen($valorSeguro) > 100) {
                        $valorSeguro = substr($valorSeguro, 0, 100) . '...';
                    }
                    echo "<td class='$esEditable contenido-celda' 
                             data-tabla='" . htmlspecialchars($tabla) . "' 
                             data-columna='" . htmlspecialchars($campo) . "' 
                             data-id='" . $idRegistro . "'
                             title='" . htmlspecialchars($valorCompleto) . "'>" 
                         . $valorSeguro . "</td>";
                }
            }
            echo "<td class='acciones'>";
            echo "<a href='crud/eliminar.php?tabla=".$tabla."&id=".$idRegistro."' 
                  class='btn btn-danger btn-sm' 
                  onclick='return confirm(\"¿Estás seguro que deseas eliminar este elemento?\")'>
                  <i class='fas fa-trash'></i>
                  </a> ";
            echo "<a href='?tabla=".$tabla."&editar=1&id=".$idRegistro."' 
                  class='btn btn-primary btn-sm'>
                  <i class='fas fa-edit'></i>
                  </a>";
            if($tabla == 'tiendas') {
                echo "<a href='../front/tienda.php?tienda_id=".$fila['Identificador']."' 
                      target='_blank' 
                      class='btn btn-info btn-sm'>
                      <i class='fas fa-store'></i>
                      </a>";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        
    } catch(Exception $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}

$conexion->close();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
.alert code {
    background: #fff;
    padding: 2px 6px;
    border-radius: 3px;
}

.acciones {
    white-space: nowrap;
    width: 100px;
}

.acciones .btn {
    padding: 5px 10px;
    margin: 0 2px;
}

.acciones .btn i {
    font-size: 14px;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn i {
    color: white;
}

.btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
    margin-left: 2px;
}

.btn-info:hover {
    background-color: #138496;
    border-color: #117a8b;
}

.table td img {
    display: block;
    margin: 0 auto;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
</style>