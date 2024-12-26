<?php
class AtributoEstilo {
    public $atributo;
    public $valor;

    public function __construct($nuevoatributo, $nuevovalor) {
        $this->atributo = $nuevoatributo;
        $this->valor = $nuevovalor;
    }
}

class Estilo {
    public $estilo;

    public function __construct($estilos) {
        $this->estilo = $estilos;
    }
}

abstract class Bloque {
    protected $titulo;
    protected $subtitulo;
    protected $texto;
    protected $imagen;
    protected $imagenfondo;
    protected $estilo;

    public function __construct(
        $nuevotitulo,
        $nuevosubtitulo = "",
        $nuevotexto = "",
        $nuevaimagen = "",
        $nuevaimagenfondo = "",
        $nuevoestilo = []
    ) {
        $this->titulo = $nuevotitulo;
        $this->subtitulo = $nuevosubtitulo;
        $this->texto = $nuevotexto;
        $this->imagen = $nuevaimagen;
        $this->imagenfondo = $nuevaimagenfondo;
        $this->estilo = $nuevoestilo;
    }

    protected function procesarEstilos($estilos) {
        // Añadir esta línea para debug
        error_log('Estilos recibidos: ' . print_r($estilos, true));
        
        if(empty($estilos)) return "";
        
        // Si los estilos vienen como string JSON, convertirlos a array
        if(is_string($estilos)) {
            $estilos = json_decode($estilos, true);
            error_log('Estilos después de decode: ' . print_r($estilos, true));
        }
        
        $estilosInline = "";
        if(isset($estilos['self'])) {
            foreach($estilos['self'] as $propiedad => $valor) {
                $estilosInline .= "$propiedad:$valor;";
            }
        }
        return $estilosInline;
    }

    protected function getRutaImagenes() {
        // Usamos una ruta relativa desde donde se encuentra el script actual
        return "../static/";  // Simplificamos la ruta
    }
}

class BloqueCompleto extends Bloque {
    private $uniqueId;
    
    public function __construct($nuevotitulo, $nuevosubtitulo = "", $nuevotexto = "", $nuevaimagen = "", $nuevaimagenfondo = "", $nuevoestilo = []) {
        parent::__construct($nuevotitulo, $nuevosubtitulo, $nuevotexto, $nuevaimagen, $nuevaimagenfondo, $nuevoestilo);
        $this->uniqueId = 'bloque_' . uniqid();
    }

    public function getBloque() {
        $estilosInline = $this->procesarEstilos($this->estilo);
        
        // Manejo de imagen de fondo
        $backgroundStyle = '';
        if (!empty($this->imagenfondo)) {
            $rutaImagenes = $this->getRutaImagenes();
            $backgroundStyle = 'background-image:url("'.$rutaImagenes.$this->imagenfondo.'");';
        }

        // Manejo de imagen principal
        $imagenHtml = '';
        if (!empty($this->imagen)) {
            $rutaImagenes = $this->getRutaImagenes();
            $imagenHtml = '<img src="'.$rutaImagenes.$this->imagen.'" alt="'.$this->titulo.'">';
        }
        
        $html = "
            <div id='".$this->uniqueId."' class='bloque completo' style='".$estilosInline.";{$backgroundStyle}'>
                <div class='contenido'>
                    <h3>{$this->titulo}</h3>
                    <h4>{$this->subtitulo}</h4>
                    <p>{$this->texto}</p>
                    {$imagenHtml}
                </div>
            </div>
        ";

        if(is_array($this->estilo) && isset($this->estilo['self'])) {
            $html .= "<style>";
            foreach($this->estilo as $selector => $propiedades) {
                if($selector !== 'self') {
                    $html .= "#" . $this->uniqueId . " " . $selector . "{";
                    foreach($propiedades as $propiedad => $valor) {
                        $html .= "$propiedad:$valor;";
                    }
                    $html .= "}";
                }
            }
            $html .= "</style>";
        }
        
        return $html;
    }
}

class BloqueCaja extends Bloque {
    private $uniqueId;
    
    public function __construct($nuevotitulo, $nuevosubtitulo = "", $nuevotexto = "", $nuevaimagen = "", $nuevaimagenfondo = "", $nuevoestilo = []) {
        parent::__construct($nuevotitulo, $nuevosubtitulo, $nuevotexto, $nuevaimagen, $nuevaimagenfondo, $nuevoestilo);
        $this->uniqueId = 'bloque_' . uniqid();
    }
    
    public function getBloque() {
        $estilosInline = $this->procesarEstilos($this->estilo);
        
        // Manejo de imagen de fondo
        $backgroundStyle = '';
        if (!empty($this->imagenfondo)) {
            $rutaImagenes = $this->getRutaImagenes();
            $backgroundStyle = 'background-image:url("'.$rutaImagenes.$this->imagenfondo.'");background-size:cover;background-position:center center;';
        }

        // Manejo de imagen principal
        $imagenHtml = '';
        if (!empty($this->imagen)) {
            $rutaImagenes = $this->getRutaImagenes();
            $imagenHtml = '<img src="'.$rutaImagenes.$this->imagen.'" alt="'.$this->titulo.'">';
        }
        
        $html = "
        <article id='".$this->uniqueId."' class='bloque caja' style='".$estilosInline.";{$backgroundStyle}'>
            <h3>".$this->titulo."</h3>
            <h4>".$this->subtitulo."</h4>
            {$imagenHtml}
            ".$this->texto."
        </article>";
        
        // Agregar estilos específicos si usa el nuevo formato
        if(is_array($this->estilo) && isset($this->estilo['self'])) {
            $html .= "<style>";
            foreach($this->estilo as $selector => $propiedades) {
                if($selector !== 'self') {
                    $html .= "#" . $this->uniqueId . " " . $selector . "{";
                    foreach($propiedades as $propiedad => $valor) {
                        $html .= "$propiedad:$valor;";
                    }
                    $html .= "}";
                }
            }
            $html .= "</style>";
        }
        
        return $html;
    }
}

class BloqueCajaDosColumnas extends Bloque {
    private $uniqueId;
    
    public function __construct($nuevotitulo, $nuevosubtitulo = "", $nuevotexto = "", $nuevaimagen = "", $nuevaimagenfondo = "", $nuevoestilo = []) {
        parent::__construct($nuevotitulo, $nuevosubtitulo, $nuevotexto, $nuevaimagen, $nuevaimagenfondo, $nuevoestilo);
        $this->uniqueId = 'bloque_' . uniqid();
    }

    public function getBloque() {
        $estilosInline = $this->procesarEstilos($this->estilo);
        $textojson = json_decode($this->texto);
        
        // Manejo de imagen de fondo
        $backgroundStyle = '';
        if (!empty($this->imagenfondo)) {
            $rutaImagenes = $this->getRutaImagenes();
            $backgroundStyle = 'background-image:url("'.$rutaImagenes.$this->imagenfondo.'");background-size:cover;background-position:center center;';
        }

        // Manejo de imagen principal
        $imagenHtml = '';
        if (!empty($this->imagen)) {
            $rutaImagenes = $this->getRutaImagenes();
            $imagenHtml = '<img src="'.$rutaImagenes.$this->imagen.'" alt="'.$this->titulo.'">';
        }
        
        $html = "
            <div id='".$this->uniqueId."' class='bloque caja' style='".$estilosInline.";{$backgroundStyle}'>
                <h3>{$this->titulo}</h3>
                <h4>{$this->subtitulo}</h4>
                {$imagenHtml}
                <div class='doscolumnastexto'>
                    <p>{$textojson->columna1}</p>
                    <p>{$textojson->columna2}</p>
                </div>
            </div>
        ";

        if(is_array($this->estilo) && isset($this->estilo['self'])) {
            $html .= "<style>";
            foreach($this->estilo as $selector => $propiedades) {
                if($selector !== 'self') {
                    $html .= "#" . $this->uniqueId . " " . $selector . "{";
                    foreach($propiedades as $propiedad => $valor) {
                        $html .= "$propiedad:$valor;";
                    }
                    $html .= "}";
                }
            }
            $html .= "</style>";
        }
        
        return $html;
    }
}

class BloqueCajaPasaFotos extends Bloque {
    private $uniqueId;
    
    public function __construct($nuevotitulo, $nuevosubtitulo = "", $nuevotexto = "", $nuevaimagen = "", $nuevaimagenfondo = "", $nuevoestilo = []) {
        parent::__construct($nuevotitulo, $nuevosubtitulo, $nuevotexto, $nuevaimagen, $nuevaimagenfondo, $nuevoestilo);
        $this->uniqueId = 'bloque_' . uniqid();
    }

    public function getBloque() {
        $estilosInline = $this->procesarEstilos($this->estilo);
        $textojson = json_decode($this->texto);
        $rutaImagenes = $this->getRutaImagenes();
        
        $html = "
            <div id='".$this->uniqueId."' class='bloque caja pasafotos-container' style='".$estilosInline."'>
                <div class='contenedorpasafotos' style='width:".(count($textojson)*900+100)."px;'>";
        
        foreach($textojson as $valor){
            $html .= '
                <article style="background-image:url(\''.$rutaImagenes.$valor->imagen.'\');background-size:cover;background-position:center center;">
                    <h3>'.$valor->titulo.'</h3>
                    <p>'.$valor->texto.'</p>
                </article>
            ';
        }
        
        $html .= "</div><div class='controlador'>";
        
        for($i = 1; $i <= count($textojson); $i++){
            $html .= "<button value='".$i."'></button>";
        }
        
        $html .= "</div></div>";

        if(is_array($this->estilo) && isset($this->estilo['self'])) {
            $html .= "<style>";
            foreach($this->estilo as $selector => $propiedades) {
                if($selector !== 'self') {
                    $html .= "#" . $this->uniqueId . " " . $selector . "{";
                    foreach($propiedades as $propiedad => $valor) {
                        $html .= "$propiedad:$valor;";
                    }
                    $html .= "}";
                }
            }
            $html .= "</style>";
        }
        
        return $html;
    }
}

class BloqueCajaYoutube extends Bloque {
    private $uniqueId;
    
    public function __construct($nuevotitulo, $nuevosubtitulo = "", $nuevotexto = "", $nuevaimagen = "", $nuevaimagenfondo = "", $nuevoestilo = []) {
        parent::__construct($nuevotitulo, $nuevosubtitulo, $nuevotexto, $nuevaimagen, $nuevaimagenfondo, $nuevoestilo);
        $this->uniqueId = 'bloque_' . uniqid();
    }

    public function getBloque($video) {
        $estilosInline = $this->procesarEstilos($this->estilo);
        
        // Manejo de imagen de fondo
        $backgroundStyle = '';
        if (!empty($this->imagenfondo)) {
            $rutaImagenes = $this->getRutaImagenes();
            $backgroundStyle = 'background-image:url("'.$rutaImagenes.$this->imagenfondo.'");background-size:cover;background-position:center center;';
        }

        // Manejo de imagen principal
        $imagenHtml = '';
        if (!empty($this->imagen)) {
            $rutaImagenes = $this->getRutaImagenes();
            $imagenHtml = '<img src="'.$rutaImagenes.$this->imagen.'" alt="'.$this->titulo.'">';
        }
        
        $html = '
            <div id="'.$this->uniqueId.'" class="bloque caja" style="'.$estilosInline.';'.$backgroundStyle.'">
                '.$imagenHtml.'
                <iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video.'?si=iJbR_XbLmg8-dssi" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        ';

        if(is_array($this->estilo) && isset($this->estilo['self'])) {
            $html .= "<style>";
            foreach($this->estilo as $selector => $propiedades) {
                if($selector !== 'self') {
                    $html .= "#" . $this->uniqueId . " " . $selector . "{";
                    foreach($propiedades as $propiedad => $valor) {
                        $html .= "$propiedad:$valor;";
                    }
                    $html .= "}";
                }
            }
            $html .= "</style>";
        }
        
        return $html;
    }
}

class BloqueMosaico extends Bloque {
    private $uniqueId;
    private $mosaicos;

    public function __construct(
        $nuevotitulo,
        $nuevosubtitulo = "",
        $nuevotexto = "",
        $nuevaimagen = "",
        $nuevaimagenfondo = "",
        $mosaicos = [],
        $nuevoestilo = []
    ) {
        parent::__construct(
            $nuevotitulo,
            $nuevosubtitulo,
            $nuevotexto,
            $nuevaimagen,
            $nuevaimagenfondo,
            $nuevoestilo
        );
        $this->uniqueId = 'bloque_' . uniqid();
        $this->mosaicos = $mosaicos;
    }

    public function getBloque() {
        $estilosInline = $this->procesarEstilos($this->estilo);
        
        // Manejo de imagen de fondo
        $backgroundStyle = '';
        if (!empty($this->imagenfondo)) {
            $rutaImagenes = $this->getRutaImagenes();
            $backgroundStyle = 'background-image:url("'.$rutaImagenes.$this->imagenfondo.'");background-size:cover;background-position:center center;';
        }

        // Manejo de imagen principal
        $imagenHtml = '';
        if (!empty($this->imagen)) {
            $rutaImagenes = $this->getRutaImagenes();
            $imagenHtml = '<img src="'.$rutaImagenes.$this->imagen.'" alt="'.$this->titulo.'">';
        }
        
        $contenido = "
            <div id='".$this->uniqueId."' class='bloque mosaico' style='".$estilosInline.";{$backgroundStyle}'>
                <h3>{$this->titulo}</h3>
                <h4>{$this->subtitulo}</h4>
                {$imagenHtml}
                <div class='rejilla'>
        ";
        
        $this->mosaicos = json_decode($this->texto);
					
        foreach($this->mosaicos as $clave=>$valor){
            $contenido .= "
                <div class='celda'>
                {$valor}
                </div>
            ";
        }
                
        $contenido .= "
                </div>
            </div>
        ";

        if(is_array($this->estilo) && isset($this->estilo['self'])) {
            $contenido .= "<style>";
            foreach($this->estilo as $selector => $propiedades) {
                if($selector !== 'self') {
                    $contenido .= "#" . $this->uniqueId . " " . $selector . "{";
                    foreach($propiedades as $propiedad => $valor) {
                        $contenido .= "$propiedad:$valor;";
                    }
                    $contenido .= "}";
                }
            }
            $contenido .= "</style>";
        }
        
        return $contenido;
    }
}
?>