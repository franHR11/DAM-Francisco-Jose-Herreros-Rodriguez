<?php if(isset($_GET['carpeta'])){?>
	<table>
		<thead>
			<tr>
				<td>Documento</td>
				<td>Operaciones</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$folder = '../basededatos/'.$_GET['carpeta']."/";

				// Check if the folder exists
				if (is_dir($folder)) {
					 // Get all files and directories inside the folder
					 $files = scandir($folder);

					 // Filter out `.` and `..`
					 $files = array_diff($files, array('.', '..'));

					 // Print each file name
					 foreach ($files as $file) {
						  $filePath = $folder . $file;
						  $data = json_decode(file_get_contents($filePath), true);
						  $completado = isset($data['estado']) && $data['estado'] == 'completado';
						  echo "
						  	<tr class='".($completado ? "pedido-completado" : "")."'>
						  		<td>".$file . "</td>
						  		<td>
						  			<a href='?documento=".$file . "'>
						  				<button class='btn btn-ver'>
						  					Ver el pedido
						  				</button>
						  			</a>
						  			<a href='inc/eliminar_pedido.php?file=".$file."&carpeta=".$_GET['carpeta']."'>
						  				<button class='btn btn-eliminar'>
						  					Eliminar
						  				</button>
						  			</a>
						  			<a href='inc/completar_pedido.php?file=".$file."&carpeta=".$_GET['carpeta']."'>
						  				<button class='btn ".($completado ? "btn-completado" : "btn-completar")."'>
						  					".($completado ? "Completado" : "Completar")."
						  				</button>
						  			</a>
						  		</td>
						  	</tr>";
					 }
				} else {
					 echo "The folder does not exist.";
				}
				?>
		</tbody>
	</table>
	
<?php } ?>