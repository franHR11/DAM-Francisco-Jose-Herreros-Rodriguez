<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class Persona{
		private $nombre;
		public $edad;
		public function __construct($nuevonombre,$nuevaedad){
			$this->nombre = $nuevonombre;
			$this->edad = $nuevaedad;
		}
		public function saluda(){
			return "Hola, ".$this->nombre.", yo te saludo";
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nuevonombre){
			$this->nombre = $nuevonombre;
		}
	}
	
	$persona1 = new Persona("Jose Vicente",46);
	$persona2 = new Persona("Juan",47);
	
	
	echo $persona1->saluda();
	$persona1->setNombre("Jorge");
	echo $persona1->saluda();
?>