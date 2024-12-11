
<?php
	function bloque($tipo,$contenido){
		$cadena = "<div class='".$tipo."'>";
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
