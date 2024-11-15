<?php
	
	class Persona{
		public $nombre;
		public $edad;
		public function __construct($nuevonombre,$nuevaedad){
			$this->nombre = $nuevonombre;
			$this->edad = $nuevaedad;
		}
		public function saluda(){
			return "Hola, ".$this->nombre.", yo te saludo";
		}
	}
	
	$persona1 = new Persona("Jose Vicente",46);
	$persona2 = new Persona("Juan",47);
	
	
	echo $persona1->nombre;
	echo $persona1->saluda();
?>