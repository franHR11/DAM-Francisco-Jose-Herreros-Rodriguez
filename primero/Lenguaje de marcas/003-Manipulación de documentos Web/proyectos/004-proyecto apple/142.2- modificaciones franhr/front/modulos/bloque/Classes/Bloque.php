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
        $rutaImagenes = $this->getRutaImagenes();
        
        // Manejo de imagen de fondo
        $backgroundStyle = '';
        if (!empty($this->imagenfondo)) {
            $rutaCompleta = $rutaImagenes . $this->imagenfondo;
            $backgroundStyle = 'background-image:url("'.$rutaCompleta.'");background-size:cover;background-position:center center;';
        }

        // Manejo de imagen principal
        $imagenHtml = '';
        if (!empty($this->imagen)) {
            $rutaCompleta = $rutaImagenes . $this->imagen;
            $imagenHtml = "<img src='{$rutaCompleta}' alt='{$this->titulo}'>";
        }

        $html = "
            <div id='".$this->uniqueId."' class='bloque completo' style='".$estilosInline.";{$backgroundStyle}'>
                <div class='overlay'></div>
                <div class='contenido'>
                    <h3>{$this->titulo}</h3>
                    <h4>{$this->subtitulo}</h4>
                    <p>{$this->texto}</p>
                    <div class='imagen-container'>{$imagenHtml}</div>
                </div>
                <style>
                    #".$this->uniqueId." {
                        position: relative;
                        min-height: 600px;
                        width: 100%;
                        overflow: hidden;
                    }
                    #".$this->uniqueId." .overlay {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0,0,0,0.3);
                    }
                    #".$this->uniqueId." .contenido {
                        position: relative;
                        z-index: 2;
                        width: 100%;
                        height: 100%;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                    }
                    #".$this->uniqueId." .imagen-container {
                        width: 100%;
                        max-width: 800px;
                        margin: 20px auto;
                        padding: 0 20px;
                        box-sizing: border-box;
                    }
                    #".$this->uniqueId." img {
                        width: 100%;
                        height: auto;
                        max-height: 400px;
                        object-fit: contain;
                        display: block;
                        margin: 0 auto;
                    }
                </style>
            </div>
        ";
        
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
        
        // Debug para ver el contenido de texto
        error_log('Texto recibido: ' . print_r($this->texto, true));
        
        // Intentar decodificar el JSON
        $textojson = json_decode($this->texto);
        
        // Si hay error en el JSON, mostrar el error
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('Error decodificando JSON: ' . json_last_error_msg());
            // Si el texto no es JSON, intentar convertirlo a array
            $textojson = [$this->texto];
        }
        
        // Asegurarse de que tengamos un array
        if (!is_array($textojson) && !is_object($textojson)) {
            $textojson = [$textojson];
        }
        
        // Convertir objeto a array si es necesario
        if (is_object($textojson)) {
            $textojson = [$textojson];
        }
        
        $rutaImagenes = $this->getRutaImagenes();
        
        $html = "
            <div id='".$this->uniqueId."' class='bloque caja pasafotos-container' style='".$estilosInline."'>
                <div class='contenedorpasafotos' style='width:".(count($textojson)*900+100)."px;'>";
        
        foreach($textojson as $valor){
            // Validar que valor sea un objeto y tenga las propiedades necesarias
            if (is_object($valor) && isset($valor->imagen) && isset($valor->titulo) && isset($valor->texto)) {
                $html .= '
                    <article style="background-image:url(\''.$rutaImagenes.$valor->imagen.'\');background-size:cover;background-position:center center;">
                        <h3>'.$valor->titulo.'</h3>
                        <p>'.$valor->texto.'</p>
                    </article>
                ';
            } else {
                error_log('Valor inválido en pasafotos: ' . print_r($valor, true));
            }
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

class BloqueTienda extends Bloque {
    private $uniqueId;
    
    public function __construct($nuevotitulo, $nuevosubtitulo = "", $nuevotexto = "", $nuevaimagen = "", $nuevaimagenfondo = "", $nuevoestilo = []) {
        parent::__construct($nuevotitulo, $nuevosubtitulo, $nuevotexto, $nuevaimagen, $nuevaimagenfondo, $nuevoestilo);
        $this->uniqueId = 'bloque_' . uniqid();
    }

    public function getBloque() {
        $estilosInline = $this->procesarEstilos($this->estilo);
        $productos = json_decode($this->texto);
        
        if (!is_array($productos)) {
            error_log('Error al decodificar JSON: ' . json_last_error_msg());
            return '<div>Error al cargar los productos.</div>';
        }

        $rutaImagenes = $this->getRutaImagenes();
        
        // Añadir estilos específicos para este bloque
        $html = "
        <style>
            #".$this->uniqueId." .grid-productos {
                display: grid !important;
                grid-template-columns: repeat(4, 1fr) !important;
                gap: 20px !important;
                max-width: 1200px !important;
                margin: 0 auto !important;
                padding: 20px !important;
            }
            #".$this->uniqueId." .producto {
                width: 100% !important;
                box-sizing: border-box !important;
            }
            #".$this->uniqueId." .producto-imagen img {
                width: 100% !important;
                height: auto !important;
                padding: 10px !important;
            }
            #".$this->uniqueId." .producto-titulo {
                margin-bottom: 5px;
                font-weight: bold;
            }
            #".$this->uniqueId." .producto-subtitulo {
                font-size: 0.8em;
                color: #666;
                font-weight: normal;
                margin-top: 0;
                margin-bottom: 10px;
            }
            #".$this->uniqueId." .boton-comprar {
                background-color: #0071e3;
                color: white;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            #".$this->uniqueId." .boton-comprar:hover {
                background-color: #0077ed;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const botonesComprar = document.querySelectorAll('#".$this->uniqueId." .boton-comprar');
                botonesComprar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        const producto = {
                            nombre: this.closest('.producto').querySelector('.producto-titulo').textContent,
                            descripcion: this.closest('.producto').querySelector('.producto-subtitulo')?.textContent || '',
                            precio: this.closest('.producto').querySelector('.producto-precio').textContent.replace('€', '').trim(),
                            imagen: this.closest('.producto').querySelector('img').getAttribute('src')
                        };

                        // Recuperar el carrito actual
                        let carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
                        carrito.push(producto);
                        localStorage.setItem('carrito', JSON.stringify(carrito));
                        
                        // Actualizar el contador del carrito si existe
                        if(typeof actualizarContadorCarrito === 'function') {
                            actualizarContadorCarrito();
                        }
                        
                        // Notificar al usuario
                        alert('Producto añadido al carrito');
                        
                        // Si existe la función listadoProductos, actualizamos el carrito
                        if(typeof listadoProductos === 'function') {
                            listadoProductos();
                        }
                    });
                });
            });
        </script>
        <div id='".$this->uniqueId."' class='bloque tienda' style='".$estilosInline."'>
            <h3>{$this->titulo}</h3>
            <h4>{$this->subtitulo}</h4>
            <div class='grid-productos'>";
        
        foreach($productos as $producto) {
            if (!is_object($producto)) {
                error_log('Producto no es un objeto: ' . print_r($producto, true));
                continue;
            }

            $productoId = property_exists($producto, 'id') ? $producto->id : '';
            $subtitulo = property_exists($producto, 'subtitulo') ? 
                        "<p class='producto-subtitulo'>{$producto->subtitulo}</p>" : 
                        ""; // Si no existe subtítulo, devuelve una cadena vacía

            $html .= "
                <div class='producto'>
                    <a href='producto.php?prod={$_GET['prod']}' class='producto-link' style='text-decoration: none; color: inherit;'>
                        <div class='producto-imagen'>
                            <img src='".$rutaImagenes.$producto->imagen."' alt='".$producto->titulo."'>
                        </div>
                        <h4 class='producto-titulo'>".$producto->titulo."</h4>
                        ".$subtitulo."
                        <div class='producto-precio'>".$producto->precio."€</div>
                    </a>
                    <button class='boton-comprar'>Añadir al carrito</button>
                </div>";
        }
        
        $html .= "</div></div>";

        // Añadir estilos adicionales para los enlaces
        $html .= "
        <style>
            #".$this->uniqueId." .producto-link {
                display: block;
                transition: transform 0.2s ease;
            }
            #".$this->uniqueId." .producto-link:hover {
                transform: translateY(-5px);
            }
            #".$this->uniqueId." .producto {
                display: flex;
                flex-direction: column;
            }
            #".$this->uniqueId." .boton-comprar {
                margin-top: auto;
            }
        </style>";

        return $html;
    }
}
?>