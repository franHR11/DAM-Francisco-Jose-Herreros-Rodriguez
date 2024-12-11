<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	class Bloque{
		// Propiedades, son variables del objeto
			protected $titulo;
			protected $subtitulo;
			protected $texto;
			protected $imagen;
			protected $imagenfondo;
			
		
		// Métodos
			// Método constructor, le da valores iniciales al objeto
				public function __construct(
								$nuevotitulo,
								$nuevosubtitulo,
								$nuevotexto,
								$nuevaimagen,
								$nuevaimagenfondo			
										){
					$this->titulo = $nuevotitulo;
					$this->subtitulo = $nuevosubtitulo;
					$this->texto = $nuevotexto;
					$this->imagen = $nuevaimagen;
					$this->imagenfondo = $nuevaimagenfondo;
				}
			// Métodos set y get - leen y escriben valores a las propiedades 
				public function getBloque(){
					return "
						<div class='bloque'>
							<h3>".$this->titulo."</h3>
							<h4>".$this->subtitulo."</h4>
							<p>".$this->texto."</p>
						</div>
						";
				}
			// Métodos libres	
	}
	class BloqueCompleto extends Bloque{
		public function getBloque(){
					return "
						<div class='bloque completo'>
							<h3>".$this->titulo."</h3>
							<h4>".$this->subtitulo."</h4>
							<p>".$this->texto."</p>
						</div>
						";
				}
	}
	
	$bloque1 = new Bloque("Titulo1","Este es un subtitulo","Este es el texto","","");
	echo $bloque1->getBloque();
	
	$bloque2 = new BloqueCompleto("Titulo2","Este es un subtitulo2","Este es el texto2","","");
	echo $bloque2->getBloque();
	
	
	
	
?>