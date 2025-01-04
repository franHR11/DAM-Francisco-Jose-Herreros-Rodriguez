<?php

	// Enrutador del back de la aplicación que sirve los datos que se piden en función de la URL

	include "inc/error.php";								// Configuración de mensajes de error				
	include "Classes/ConexionBD.php";					// Importo la clase de conexión a base de datos
																				
	header('Content-Type: application/json');			// Indico que este archivo devuelve json
		
	$conexion = new ConexionBD();							// Creo una nueva instancia de la conexion
	
	if(isset($_GET['tabla']) && isset($_GET['tipo'])) {
		$tabla = $_GET['tabla'];
		$tipo = $_GET['tipo'];
		
		if($tabla === 'bloquesproductos') {
			$query = "SELECT * FROM bloquesproductos WHERE tipobloque_tipo = ?";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param('s', $tipo);
			$stmt->execute();
			$resultado = $stmt->get_result();
			
			$bloques = array();
			while($fila = $resultado->fetch_assoc()) {
				$bloques[] = $fila;
			}
			
			header('Content-Type: application/json');
			echo json_encode($bloques);
			exit;
		}
	}

// Si se solicitan bloques de tipo tienda
if(isset($_GET['tabla']) && $_GET['tabla'] == 'bloquesproductos' && isset($_GET['tipobloque'])) {
    try {
        // Usar Prepared Statements para mayor seguridad
        $query = "SELECT * FROM bloquesproductos WHERE tipobloque_tipo = ?";
        $stmt = $conexion->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Error preparando la consulta: " . $conexion->error);
        }
        
        $stmt->bind_param('s', $_GET['tipobloque']);
        
        if (!$stmt->execute()) {
            throw new Exception("Error ejecutando la consulta: " . $stmt->error);
        }
        
        $resultado = $stmt->get_result();
        $datos = array();
        
        while($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
        
        // Asegurarse de que no haya salida antes del JSON
        if (ob_get_length()) ob_clean();
        
        header('Content-Type: application/json');
        echo json_encode($datos);
        $stmt->close();
        exit;
        
    } catch (Exception $e) {
        // Log del error
        error_log("Error en la consulta de bloques tienda: " . $e->getMessage());
        
        // Devolver un JSON con el error
        header('Content-Type: application/json');
        echo json_encode(array("error" => $e->getMessage()));
        exit;
    }
}

	
	if(isset($_GET['tabla'])){								// Si la URL me envía una tabla
		echo $conexion->pideAlgo($_GET['tabla']);		// Llamo al método correspondiente del objeto
	}
	if(isset($_GET['busca'])){								// Si la URL me envía una búsqueda
		echo $conexion->buscaAlgo(					
				$_GET['busca'],
				$_GET['campo'],
				$_GET['dato']
			);														// Llamo al método correspondiente del objeto
	}
	if(isset($_GET['envio'])){
		$datos = json_decode($_GET['envio'], true);
		$archivo = '../basededatos/pedidos/'.date('U').'.json';
		$datosbonitos = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		file_put_contents($archivo, $datosbonitos);
		echo "ok";

	}
	
?>


