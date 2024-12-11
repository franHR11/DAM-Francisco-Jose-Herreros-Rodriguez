<?php
	include "inc/error.php";
	include "inc/pidealgo.php";
	include "inc/buscaalgo.php";																			
	header('Content-Type: application/json');		
	if(isset($_GET['tabla'])){
		echo pideAlgo($_GET['tabla']);
	}
	if(isset($_GET['busca'])){
		echo buscaAlgo($_GET['busca'],$_GET['campo'],$_GET['dato']);
	}
	
?>
	
	
