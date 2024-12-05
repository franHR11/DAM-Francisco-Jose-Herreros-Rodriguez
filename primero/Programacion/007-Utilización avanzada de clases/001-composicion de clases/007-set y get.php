<?php
	class Persona{
		private $nombre;
		private $apellidos;
		private $edad;
		
		public function setNombre($nuevonombre){
			$this->nombre = $nuevonombre;
		}
		public function getNombre(){
			return $this->nombre;
		}
	}
	
	$persona1 = new Persona();
	$persona1->setNombre("Jose Vicente");
	echo $persona1->getNombre();
	echo "<br>";
	var_dump($persona1);
?>