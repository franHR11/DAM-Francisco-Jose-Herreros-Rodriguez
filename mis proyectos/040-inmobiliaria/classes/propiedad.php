<?php

namespace App;

class Propiedad
{
    // base de date
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId', 'destacado', 'categoria_id'];

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
    public $destacado;
    public $categoria_id;

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
        $this->destacado = $args['destacado'] ?? 0;
        $this->categoria_id = $args['categoria_id'] ?? null;

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

    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

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

    // Cambiar el estado de destacado
    public function setDestacado($destacado) {
        $this->destacado = $destacado;
    }

    // lista todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtiene un número limitado de propiedades
    public static function get($limite)
    {
        $query = "SELECT * FROM propiedades LIMIT {$limite}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtiene propiedades destacadas
    public static function getDestacados($limite = 6)
    {
        $query = "SELECT * FROM propiedades WHERE destacado = 1 LIMIT {$limite}";
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // Obtiene propiedades por categoría
    public static function getPorCategoria($categoria_id, $por_pagina = 10, $offset = 0)
    {
        $query = "SELECT * FROM propiedades WHERE categoria_id = {$categoria_id} LIMIT {$por_pagina} OFFSET {$offset}";
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // Cuenta el total de propiedades
    public static function count()
    {
        $query = "SELECT COUNT(*) as total FROM propiedades";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        
        return $total['total'];
    }

    // Cuenta el total de propiedades por categoría
    public static function countPorCategoria($categoria_id)
    {
        $query = "SELECT COUNT(*) as total FROM propiedades WHERE categoria_id = {$categoria_id}";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        
        return $total['total'];
    }

    // Obtiene propiedades con paginación
    public static function paginar($por_pagina, $offset)
    {
        $query = "SELECT * FROM propiedades LIMIT {$por_pagina} OFFSET {$offset}";
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // Busca propiedades por término
    public static function buscar($termino, $por_pagina = null, $offset = 0)
    {
        $query = "SELECT * FROM propiedades WHERE titulo LIKE '%{$termino}%' OR descripcion LIKE '%{$termino}%'";
        
        if($por_pagina) {
            $query .= " LIMIT {$por_pagina} OFFSET {$offset}";
        }
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // Cuenta resultados de búsqueda
    public static function countBusqueda($termino)
    {
        $query = "SELECT COUNT(*) as total FROM propiedades WHERE titulo LIKE '%{$termino}%' OR descripcion LIKE '%{$termino}%'";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        
        return $total['total'];
    }

    // Buscar propiedad por ID
    public static function find($id) {
        $query = "SELECT * FROM propiedades WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
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
        $resultado->free();

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