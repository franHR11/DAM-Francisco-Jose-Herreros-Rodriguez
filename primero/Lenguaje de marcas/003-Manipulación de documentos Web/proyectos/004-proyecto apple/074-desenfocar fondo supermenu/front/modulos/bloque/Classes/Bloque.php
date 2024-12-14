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

    public function buildStyles() {
        $cadena = "";
        foreach ($this->estilo as $clave => $valor) {
            $cadena .= "$clave:$valor;";
        }
        return $cadena;
    }
}

class BloqueCompleto extends Bloque {
    public function getBloque() {
        $cadena = $this->buildStyles();
        return "
            <div class='bloque completo' style='$cadena'>
                <h3>{$this->titulo}</h3>
                <h4>{$this->subtitulo}</h4>
                <p>{$this->texto}</p>
            </div>
        ";
    }
}

class BloqueCaja extends Bloque {
    public function getBloque() {
        $cadena = $this->buildStyles();
        return "
            <div class='bloque caja' style='$cadena'>
                <h3>{$this->titulo}</h3>
                <h4>{$this->subtitulo}</h4>
                <p>{$this->texto}</p>
            </div>
        ";
    }
}

class BloqueMosaico extends Bloque {
    private $mosaicos;

    public function __construct(
        $nuevotitulo,
        $nuevosubtitulo = "",
        $nuevotexto = "",
        $nuevaimagen = "",
        $nuevaimagenfondo = "",
        $mosaicos = []
    ) {
        parent::__construct(
            $nuevotitulo,
            $nuevosubtitulo,
            $nuevotexto,
            $nuevaimagen,
            $nuevaimagenfondo
        );
        $this->mosaicos = $mosaicos;
    }

    public function getBloque() {
        $cadena = $this->buildStyles();
        return "
            <div class='bloque mosaico' style='$cadena'>
                <h3>{$this->titulo}</h3>
                <h4>{$this->subtitulo}</h4>
                <p>{$this->texto}</p>
            </div>
        ";
    }
}
?>