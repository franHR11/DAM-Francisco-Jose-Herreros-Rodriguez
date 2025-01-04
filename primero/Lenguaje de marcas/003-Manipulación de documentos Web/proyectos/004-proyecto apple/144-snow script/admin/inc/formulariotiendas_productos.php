<?php
include "utilidades/error.php";  // Cambiado de ../utilidades/error.php
include "config/config.php";     // Cambiado de ../config/config.php

if ($_GET['formulario'] == 'tiendas_productos') {
    ?>
    <div class="form-tiendas-productos">
        <div class="campo">
            <label>Tienda:</label>
            <select name="tienda_id" required>
                <option value="">Seleccione una tienda</option>
                <?php
                $queryTiendas = "SELECT * FROM tiendas ORDER BY titulo";
                $resultTiendas = $conexion->query($queryTiendas);
                while($tienda = $resultTiendas->fetch_assoc()) {
                    echo "<option value='".$tienda['Identificador']."'>";
                    echo htmlspecialchars($tienda['titulo']);
                    echo "</option>";
                }
                ?>
            </select>
        </div>

        <div class="campo">
            <label>Producto:</label>
            <select name="producto_id" required>
                <option value="">Seleccione un producto</option>
                <?php
                $queryProductos = "SELECT * FROM productos ORDER BY titulo";
                $resultProductos = $conexion->query($queryProductos);
                while($producto = $resultProductos->fetch_assoc()) {
                    echo "<option value='".$producto['Identificador']."'>";
                    echo htmlspecialchars($producto['titulo'].' - '.$producto['precio'].'€');
                    echo "</option>";
                }
                ?>
            </select>
        </div>

        <div class="campo">
            <label>Orden:</label>
            <input type="number" name="orden" value="0" min="0">
        </div>
    </div>

    <style>
    .form-tiendas-productos {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }
    .campo {
        margin-bottom: 20px;
    }
    .campo label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .campo select, .campo input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .campo select {
        background-color: white;
    }
    </style>
    <?php
}
?>
