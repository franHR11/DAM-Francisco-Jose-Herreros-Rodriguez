<?php
	
	class Persona{
		public $nombre;
		public $edad;
	}
	
	$persona1 = new Persona();
	$persona2 = new Persona();
	
	$persona1->nombre = "Jose Vicente";
	echo $persona1->nombre;
?>