<?php
/**
 * Sistema de Bloques para Construcción de Páginas Web
 * 
 * Este archivo define una jerarquía de clases para crear diferentes tipos de bloques
 * de contenido web, como galerías, mosaicos, tiendas y más. Incluye manejo de estilos,
 * imágenes y contenido dinámico.
 * 
 * @package    WebBlocks
 * @author     Francisco José Herreros Rodríguez
 * @version    2.0
 * @license    MIT
 */


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
            <div id="'.$this->uniqueId.'" class="bloque caja youtube-bloque" style="'.$estilosInline.';'.$backgroundStyle.'">
                '.$imagenHtml.'
                <div class="youtube-wrapper">
                    <div class="youtube-container">
                        <iframe 
                            width="560" 
                            height="315" 
                            src="https://www.youtube-nocookie.com/embed/'.$video.'?si=iJbR_XbLmg8-dssi" 
                            title="YouTube video player" 
                            frameborder="0" 
                            loading="lazy"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            referrerpolicy="strict-origin-when-cross-origin" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const iframe = document.querySelector("#'.$this->uniqueId.' iframe");
                        iframe.onerror = function() {
                            console.error("Error al cargar el video de YouTube");
                            iframe.parentElement.innerHTML = "<p>Lo sentimos, no se pudo cargar el video.</p>";
                        };
                    });
                </script>
            </div>
            <style>
                #'.$this->uniqueId.' {
                    width: 70%;
                    margin: 2rem auto;
                    padding: 2rem;
                    box-sizing: border-box;
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                }
                #'.$this->uniqueId.' .youtube-wrapper {
                    width: 100%;
                    max-width: 800px;
                    margin: 0 auto;
                }
                #'.$this->uniqueId.' .youtube-container {
                    position: relative;
                    width: 100%;
                    padding-bottom: 56.25%;
                    height: 0;
                    overflow: hidden;
                }
                #'.$this->uniqueId.' .youtube-container iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border-radius: 4px;
                }
            </style>
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
        
        // Validar y decodificar el texto JSON
        try {
            $this->mosaicos = json_decode($this->texto, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                error_log('Error decodificando JSON en BloqueMosaico: ' . json_last_error_msg());
                $this->mosaicos = []; // Inicializar como array vacío si hay error
            }
        } catch (Exception $e) {
            error_log('Excepción al decodificar JSON en BloqueMosaico: ' . $e->getMessage());
            $this->mosaicos = []; // Inicializar como array vacío si hay excepción
        }

        // Si aún es null después de la decodificación, usar array vacío
        if ($this->mosaicos === null) {
            $this->mosaicos = [];
        }
        
        // Resto del código con las validaciones de imagen y fondo
        $backgroundStyle = '';
        if (!empty($this->imagenfondo)) {
            $rutaImagenes = $this->getRutaImagenes();
            $backgroundStyle = 'background-image:url("'.$rutaImagenes.$this->imagenfondo.'");background-size:cover;background-position:center center;';
        }

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
                <div class='rejilla'>";
        
        // Ahora el foreach es seguro porque $this->mosaicos siempre será un array
        foreach($this->mosaicos as $clave => $valor) {
            $contenido .= "
                <div class='celda'>
                    " . htmlspecialchars($valor) . "
                </div>";
        }
                
        $contenido .= "</div></div>";

        // Agregar estilos específicos si existen
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
        
        // Decodificar JSON y validar
        $productos = json_decode($this->texto);
        
        // Verificar si hay datos válidos
        if (!$productos || !is_array($productos)) {
            error_log('Error decodificando JSON o no hay productos: ' . json_last_error_msg());
            error_log('Texto recibido: ' . print_r($this->texto, true));
            $productos = []; // Inicializar como array vacío si no hay datos válidos
        }

        $rutaImagenes = $this->getRutaImagenes();
        
        // Resto del código del método getBloque()...
        
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
            #".$this->uniqueId." .producto-link {
                text-decoration: none;
                color: inherit;
                display: block;
            }
            #".$this->uniqueId." .producto {
                width: 100% !important;
                box-sizing: border-box !important;
                transition: transform 0.2s ease;
                background: white;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                padding: 10px;
            }
            #".$this->uniqueId." .producto:hover {
                transform: translateY(-5px);
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
                margin: 10px auto 0 auto; // Añadido margin auto a los lados
                display: block; // Cambiado a block para que el margin auto funcione
                width: 80%; // Añadido un ancho específico
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
        
        // Iterar solo si hay productos
        if (!empty($productos)) {
            foreach($productos as $producto) {
                if (!is_object($producto)) {
                    error_log('Producto no es un objeto: ' . print_r($producto, true));
                    continue;
                }

                $productoId = property_exists($producto, 'id') ? $producto->id : '';
                
                $html .= "
                    <div class='producto'>
                        <a href='producto.php?prod={$productoId}' class='producto-link'>
                            <div class='producto-imagen'>
                                <img src='".$rutaImagenes.$producto->imagen."' alt='".$producto->titulo."'>
                            </div>
                            <h4 class='producto-titulo'>".$producto->titulo."</h4>
                            <h5 class='producto-subtitulo'>".($producto->subtitulo ?? '')."</h5>
                            <div class='producto-precio'>".$producto->precio."€</div>
                        </a>
                        <button class='boton-comprar'>Añadir al carrito</button>
                    </div>";
            }
        } else {
            $html .= "<div class='no-productos'>No hay productos disponibles</div>";
        }

        $html .= "</div></div>";
        // ...existing code...

        return $html;
    }
}

class BloqueTextoCompleto extends Bloque {
    private $uniqueId;
    
    public function __construct($nuevotitulo, $nuevosubtitulo = "", $nuevotexto = "", $nuevaimagen = "", $nuevaimagenfondo = "", $nuevoestilo = []) {
        parent::__construct($nuevotitulo, $nuevosubtitulo, $nuevotexto, $nuevaimagen, $nuevaimagenfondo, $nuevoestilo);
        $this->uniqueId = 'bloque_' . uniqid();
    }

    public function getBloque() {
        $estilosInline = $this->procesarEstilos($this->estilo);
        
        $html = "
            <div id='".$this->uniqueId."' class='bloque-texto-completo' style='".$estilosInline."'>
                <div class='contenido-texto'>
                    ".html_entity_decode($this->texto)."
                </div>
                <style>
                    #".$this->uniqueId." {
                        width: 80%;
                        margin: 2rem auto;
                        padding: 2rem;
                        box-sizing: border-box;
                    }
                    #".$this->uniqueId." .contenido-texto {
                        width: 100%;
                        max-width: 1200px;
                        margin: 0 auto;
                    }
                    #".$this->uniqueId." .contenido-texto img {
                        max-width: 100%;
                        height: auto;
                    }
                </style>
            </div>
        ";

        // Añadir estilos personalizados si existen
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

class BloqueFondoYTitulo extends Bloque {
    private $uniqueId;
    
    public function __construct($nuevotitulo, $nuevosubtitulo = "", $nuevotexto = "", $nuevaimagen = "", $nuevaimagenfondo = "", $nuevoestilo = []) {
        parent::__construct($nuevotitulo, $nuevosubtitulo, $nuevotexto, $nuevaimagen, $nuevaimagenfondo, $nuevoestilo);
        $this->uniqueId = 'bloque_' . uniqid();
    }

    public function getBloque() {
        $estilosInline = $this->procesarEstilos($this->estilo);
        $rutaImagenes = $this->getRutaImagenes();
        
        // Debug de estilos
        error_log('Estilos recibidos en BloqueFondoYTitulo: ' . print_r($this->estilo, true));
        
        // Manejo de imagen de fondo
        $backgroundStyle = '';
        if (!empty($this->imagenfondo)) {
            $rutaCompleta = $rutaImagenes . $this->imagenfondo;
            $backgroundStyle = 'background-image:url("'.$rutaCompleta.'");background-size:cover;background-position:center;';
        }

        // Generar el HTML primero
        $html = "
            <div id='".$this->uniqueId."' class='bloque-fondo-titulo'>
                <div class='contenido-fondo-titulo'>
                    <h2>{$this->titulo}</h2>
                    " . ($this->subtitulo ? "<h3>{$this->subtitulo}</h3>" : "") . "
                    " . ($this->texto ? "<h4>{$this->texto}</h4>" : "") . "
                </div>
            </div>
        ";

        // Luego generar todos los estilos
        $html .= "<style>";
        
        // Estilos base
        $html .= "
            #".$this->uniqueId." {
                width: 100%;
                height: 400px;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                ".$backgroundStyle."
            }
            #".$this->uniqueId." .contenido-fondo-titulo {
                padding: 2rem;
                z-index: 2;
                position: relative;
                width: 100%;
            }
            #".$this->uniqueId." h2,
            #".$this->uniqueId." h3,
            #".$this->uniqueId." h4 {
                margin: 0 0 15px;
            }
        ";

        // Aplicar estilos personalizados si existen
        if (is_array($this->estilo)) {
            // Estilos para el contenedor
            if (isset($this->estilo['self'])) {
                $html .= "#".$this->uniqueId." .contenido-fondo-titulo {";
                foreach ($this->estilo['self'] as $propiedad => $valor) {
                    if ($propiedad === 'background') {
                        $html .= "background-color: ".$valor." !important;";
                    } else {
                        $html .= $propiedad.": ".$valor." !important;";
                    }
                }
                $html .= "}";
            }

            // Estilos para los elementos h2, h3, h4
            foreach (['h2', 'h3', 'h4'] as $tag) {
                if (isset($this->estilo[$tag])) {
                    $html .= "#".$this->uniqueId." ".$tag." {";
                    foreach ($this->estilo[$tag] as $propiedad => $valor) {
                        $html .= $propiedad.": ".$valor." !important;";
                    }
                    $html .= "}";
                }
            }
        }

        $html .= "</style>";
        
        return $html;
    }
}
?>