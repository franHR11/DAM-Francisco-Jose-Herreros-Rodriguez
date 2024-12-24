
<!doctype html>
<html>
	<head>
		<style>
			body{
				font-family:sans-serif;
			}
			ul{
				list-style-type:none;
			}
			
			p{
				padding:0px;
				margin:0px;
				font-size:10px;
				font-family:sans-serif;
				background:rgb(240,240,240);
				padding:4px;
			}
			h1{
				text-align:center;
			}
		</style>
	</head>
	<body>
	<h1>Manual del desarrollador: <br>
	Proyecto: OldLace</h1>
<?php


function processFolderForHtml($source,$indice) {
    $html = "<ul>\n";
    $items = scandir($source);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $sourcePath = $source . DIRECTORY_SEPARATOR . $item;
        if (is_dir($sourcePath)) {
            $folderIcon = strpos($item, '.') === false ? "📁" : "📄"; // Folder or File Icon
            $html .= "<li><pre>$folderIcon $item</pre>\n";

            $html .= processFolderForHtml($sourcePath,$indice);
            $html .= "</li>\n";
        } else if (is_file($sourcePath) && pathinfo($item, PATHINFO_EXTENSION) === 'txt') {
        	if($indice == "no"){
            $contents = htmlspecialchars(file_get_contents($sourcePath));
            $html .= "<li><p>$contents</p></li>\n";
         }
        }
    }
    $html .= "</ul>\n";
    return $html;
}


		$sourceFolder = 'docs/admin'; // Replace with the path to your target folder
		?>
		<h2>Tabla de contenido</h2>
		<?php
		echo processFolderForHtml($sourceFolder,"si");
		?>
		<h2>Contenido de la documentación</h2>
		<?php
		echo processFolderForHtml($sourceFolder,"no");
		?>
	</body>
</html>