<?php if(isset($_GET['documento'])){?>
	<style>
		#documento-pedido .moneda{
		 	text-align: right !important;
		}
		#documento-pedido .nombre-columna {
			width: 400px !important;
			max-width: none !important;
			min-width: 400px !important;
		}
		#documento-pedido table {
			width: 100% !important;
			border-collapse: collapse !important;
		}
		#documento-pedido table th, 
		#documento-pedido table td {
			border: 1px solid #ddd !important;
			padding: 8px !important;
			border-radius: 0 !important;
		}
		#documento-pedido table th {
			background-color: #f2f2f2 !important;
		}
		/* Anulamos específicamente los estilos de escritorio.css */
		#documento-pedido table td:first-child,
		#documento-pedido table th:first-child {
			border-radius: 0 !important;
			padding: 8px !important;
			max-width: none !important;
			width: auto !important;
			min-width: auto !important;
		}
		#documento-pedido table td:last-child,
		#documento-pedido table th:last-child {
			border-radius: 0 !important;
			padding: 8px !important;
			max-width: none !important;
			width: auto !important;
			min-width: auto !important;
		}
	</style>
	<?php
	// Load and decode JSON data
	$jsonData = file_get_contents('../basededatos/pedidos/'.$_GET['documento']); // Ensure your JSON file is named 'data.json' and placed in the same directory
	$data = json_decode($jsonData, true);

	// Extract data
	$cliente = $data['cliente'];
	$pedido = $data['pedido'];
	$productos = $data['productos'];
	?>

	<!DOCTYPE html>
	<html lang="es">
	<head>
		 <meta charset="UTF-8">
		 <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <title>Pedido</title>
	</head>
	<body>
	<div id="documento-pedido">
	<h1>Pedido <?php echo isset($data['estado']) && $data['estado'] == 'completado' ? '(Completado)' : ''; ?></h1>
	<table>
		 <tr>
		     <td width="50%">
		         <h2>Emisor</h2>
		         <h3>PCprogramacion - franHR</h3>
		         <p>Calle de FranHR</p>
		         <p>46000 Valencia</p>
		         <p>54352345J</p>
		         <p>pcprogramacion@gmail.com</p>
		     </td>
		     <td>
		         <h2>Receptor</h2>
		         <h3><?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellidos']); ?></h3>
		         <p>Calle del cliente</p>
		         <p>Codigo postal y poblacion</p>
		         <p>DNI</p>
		         <p><?php echo htmlspecialchars($cliente['email']); ?></p>
		     </td>
		 </tr>
		 <tr>
		     <td>
		         <h2>Fecha de la factura</h2>
		         <p><?php echo htmlspecialchars($pedido['fecha']); ?></p>
		     </td>
		     <td>
		         <h2>Número de la factura</h2>
		         <p><?php echo htmlspecialchars($pedido['numerodepedido']); ?></p>
		     </td>
		 </tr>
		 <tr>
		     <td colspan="2">
		         <h2>Lineas de pedido</h2>
		     </td>
		 </tr>
	</table>
	<table>
		 <tr>
		     <th class="nombre-columna">Nombre</th>
		     <th>Descripcion</th>
		     <th>Precio</th>
		 </tr>
		 <?php
		 $total = 0;
		 foreach ($productos as $producto) {
		     $total += floatval($producto['precio']);
		     echo "<tr>";
		     echo "<td>" . htmlspecialchars($producto['nombre']) . "</td>";
		     echo "<td>" . htmlspecialchars($producto['descripcion']) . "</td>";
		     echo "<td class='moneda'>" . htmlspecialchars(number_format($producto['precio'], 2)) . " €</td>";
		     echo "</tr>";
		 }
		 ?>
		 <tr>
		     <td colspan="2"><strong>Total</strong></td>
		     <td class='moneda'><strong><?php echo htmlspecialchars(number_format($total, 2)); ?> €</strong></td>
		 </tr>
	</table>

	<?php
	// Mostrar el iframe si hay un enlace personalizado seleccionado
	if(isset($_GET['enlace_custom'])) {
	    echo '<iframe src="'.htmlspecialchars($_GET['enlace_custom']).'" 
	          style="width:100%; height:100%; border:none;"></iframe>';
	}
	?>
	</div>
	</body>
	</html>

		
<?php } ?>