<?php if(isset($_GET['formulario'])){?>
	<h3>Nuevo elemento: <?php echo $_GET['formulario'] ?></h3>
	<form 
	action="crud/insertar.php?tabla=<?php echo $_GET['formulario']?>" 
	method="POST"
	enctype="multipart/form-data"
	>
		<?php include "camposformulario.php"?>
		<input type="submit">
	</form>
	</form>
<?php } ?>

<style>
/* Estilos para campos de tipo fecha */
input[type="date"] {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    background-color: white;
}

/* Mejoras visuales para los selectores */
select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    background-color: white;
    cursor: pointer;
}

select:hover {
    border-color: #adb5bd;
}
</style>
