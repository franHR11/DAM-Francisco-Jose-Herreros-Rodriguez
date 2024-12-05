<?php
	class Persona{
		// Propiedades, son variables del objeto
			private $nombre;
			private $apellidos;
			private $edad;
		
		// Métodos
			// Método constructor, le da valores iniciales al objeto
				public function __construct($nuevonombre,$nuevosapellidos,$nuevaedad){
					$this->nombre = $nuevonombre;
					$this->apellidos = $nuevosapellidos;
					$this->edad = $nuevaedad;
				}
			// Métodos set y get - leen y escriben valores a las propiedades 
				public function setNombre($nuevonombre){
					$this->nombre = $nuevonombre;
				}
				public function getNombre(){
					return $this->nombre;
				}
			// Métodos libres
				public function saluda(){
					return "Hola como estas";
				}
	}
	
	$persona1 = new Persona();
	$persona1->setNombre("Jose Vicente");
	echo $persona1->getNombre();
	echo "<br>";
	var_dump($persona1);
?>