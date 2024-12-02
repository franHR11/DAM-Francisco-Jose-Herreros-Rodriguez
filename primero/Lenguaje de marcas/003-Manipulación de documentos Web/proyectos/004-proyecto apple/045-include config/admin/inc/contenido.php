<?php

include "error.php";	

	
include "config.php";


$peticion = "SELECT * FROM ".$_GET['tabla'];
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
	echo "<tr>";
	foreach($fila as $clave=>$valor){
		if(strlen($valor) < 300){
  			echo "<td>".$valor."</td>";
  		}else{
  			echo "<td><img src='data:image/png;base64,".base64_encode($valor)."'></td>";
  		}
  	}
  echo "</tr>";
}


$conexion->close();
?>
