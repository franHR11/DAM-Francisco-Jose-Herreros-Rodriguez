
<?php
	function bloque($tipo,$contenido,$estilo=""){
		$cadena = "<div class='".$tipo."' style='".$estilo."'>";
		$cadena .= $contenido;
		$cadena .= "</div>";
		return $cadena;
	}
?>

<script>
	<?php include "bloque.js"?>
</script>
<style>
	<?php include "bloque.css"?>
</style>
