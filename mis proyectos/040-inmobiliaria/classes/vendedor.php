<?php

namespace App;

class Vendedor
{
    // Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    // Errores
    protected static $errores = [];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    // Definir la conexión a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function guardar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = "INSERT INTO vendedores (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE vendedores SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function eliminar()
    {
        $query = "DELETE FROM vendedores WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
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

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Validación
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = 'El nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$errores[] = 'El apellido es obligatorio';
        }
        if (!$this->telefono) {
            self::$errores[] = 'El teléfono es obligatorio';
        }
        if (!preg_match('/[0-9]{9}/', $this->telefono)) {
            self::$errores[] = 'Formato de teléfono no válido';
        }

        return self::$errores;
    }

    // Lista todos los vendedores
    public static function all()
    {
        $query = "SELECT * FROM vendedores";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtiene un número limitado de vendedores
    public static function get($limite)
    {
        $query = "SELECT * FROM vendedores LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Cuenta el total de vendedores
    public static function count()
    {
        $query = "SELECT COUNT(*) as total FROM vendedores";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        
        return $total['total'];
    }

    // Obtiene vendedores con paginación
    public static function paginar($por_pagina, $offset)
    {
        $query = "SELECT * FROM vendedores LIMIT {$por_pagina} OFFSET {$offset}";
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // Busca vendedores por término
    public static function buscar($termino)
    {
        $query = "SELECT * FROM vendedores WHERE nombre LIKE '%{$termino}%' OR apellido LIKE '%{$termino}%' OR telefono LIKE '%{$termino}%'";
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // Busca un vendedor por su id
    public static function find($id)
    {
        $query = "SELECT * FROM vendedores WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        // Consultar base datos
        $resultado = self::$db->query($query);

        // Iterar resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar memoria
        $resultado->free();

        // Retornar los resultados
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