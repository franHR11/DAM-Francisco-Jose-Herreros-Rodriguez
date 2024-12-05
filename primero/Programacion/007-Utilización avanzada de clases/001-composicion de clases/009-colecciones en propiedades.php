<?php
	class Persona{
		// Propiedades, son variables del objeto
			private $nombre;
			private $apellidos;
			private $edad;
			private $telefonos;
		
		// Métodos
			// Método constructor, le da valores iniciales al objeto
				public function __construct(
											$nuevonombre,
											$nuevosapellidos,
											$nuevaedad,
											$nuevostelefonos
										){
					$this->nombre = $nuevonombre;
					$this->apellidos = $nuevosapellidos;
					$this->edad = $nuevaedad;
					$this->edad = $nuevaedad;
					$this->telefonos = $nuevostelefonos;
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
	
	$persona1 = new Persona("Jose Vicente","Carratala Sanchis",46,[123456,345678]);
	echo "<br>";
	var_dump($persona1);
?>