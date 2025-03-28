<?php

namespace App;

class Propiedad
{
    // base de date
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    // errores

    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    // definir la conexion a la base de datos

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';

    }


    public function guardar()
    {
        // sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === "id")
                continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];



        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;

    }
    // validacion
    public static function getErrores()
    {
        return self::$errores;
    }


    public function validar()
    {



        if (!$this->titulo) {
            self::$errores[] = 'Debes Añadir un Titulo';
        }
        if (!$this->precio) {
            self::$errores[] = 'Debes Añadir un Precio';
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'Debes Añadir una Descripcion y debe tener al menos 50 caracteres';
        }
        if (!$this->habitaciones) {
            self::$errores[] = 'Debes Añadir  Habitaciones';
        }
        if (!$this->wc) {
            self::$errores[] = 'Debes Añadir Baños';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = 'Debes Añadir Estacionamientos';
        }
        if (!$this->vendedorId) {
            self::$errores[] = 'Elije un Vendedor';
        }



        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }



        return self::$errores;

    }

    public function setImagen($imagen)
    {
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    // lista todas las propiedades

    public static function all()
    {
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    public static function consultarSQL($query)
    {

        // consultar base datos

        $resultado = self::$db->query($query);

        //iterar resultados

        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        //liberar memoria

$resultado ->free();



        // retornar los resultados

        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new self;
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
return $objeto;
    }
}


?>