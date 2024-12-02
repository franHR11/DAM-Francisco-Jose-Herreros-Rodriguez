<?php include "error.php"?>
<!doctype html>
<html>
	<head>
		<link rel="Stylesheet" href="estilo/escritorio.css">
	</head>
	<body>
		<header></header>
		<main>
			<nav>
				<ul>
					<?php include "inc/menu.php"?>
				</ul>
			</nav>
			<section>
				<?php if(isset($_GET['tabla'])){?>
					<table>
						<thead>
							<tr>
								<?php include "inc/cabeceras.php"?>
							</tr>
						</thead>
						<tbody>
							<?php include "inc/contenido.php"?>
						</tbody>
					</table>
					<a href="?formulario=<?php echo $_GET['tabla'] ?>">
						<button id="nuevo">+</button>
					</a>
				<?php } ?>
				<?php if(isset($_GET['formulario'])){?>
					<h3>Nuevo elemento: <?php echo $_GET['formulario'] ?></h3>
					<form action="insertar.php">
						<input type="hidden" name="tabla" value="<?php echo $_GET['formulario'] ?>">
						<?php include "inc/camposformulario.php"?>
						<input type="submit">
					</form>
					</form>
				<?php } ?>
			</section>
		</main>
	</body>
</html>
