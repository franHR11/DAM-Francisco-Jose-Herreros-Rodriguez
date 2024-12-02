<?php

$archivo = "compilado.html";

$contenido = "<h1>Este es un contenido desde PHP</h1>";


for($i = 0;$i<20;$i++){
	$contenido .= '
		<article>
			<h3>Este es un titulo</h3>
			<p>Este es el contenido del articulo</p>
		</article>
	';
}

$manejadorarchivo = fopen($archivo, "w");

fwrite($manejadorarchivo, $contenido);
    
fclose($manejadorarchivo);
echo "ok compilado";

?>
