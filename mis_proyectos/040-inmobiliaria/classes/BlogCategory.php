<?php

namespace App;

class BlogCategory
{
    // base de date
    protected static $db;
    protected static $columnasDB = ['id', 'nombre', 'descripcion'];

    // errores
    protected static $errores = [];

    public $id;
    public $nombre;
    public $descripcion;

    // definir la conexion a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
    }

    public function guardar()
    {
        // sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $query = "INSERT INTO blog_categories (";
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

        $query = "UPDATE blog_categories SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function eliminar()
    {
        $query = "DELETE FROM blog_categories WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
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
        if (!$this->nombre) {
            self::$errores[] = 'El nombre de la categoría es obligatorio';
        }
        return self::$errores;
    }

    // lista todas las categorías
    public static function all()
    {
        $query = "SELECT * FROM blog_categories ORDER BY nombre ASC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Cuenta el total de categorías
    public static function count()
    {
        $query = "SELECT COUNT(*) as total FROM blog_categories";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        
        return $total['total'];
    }

    // Busca categorías por término
    public static function buscar($termino)
    {
        $query = "SELECT * FROM blog_categories WHERE nombre LIKE '%{$termino}%' OR descripcion LIKE '%{$termino}%' ORDER BY nombre ASC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Buscar categoría por ID
    public static function find($id) {
        $query = "SELECT * FROM blog_categories WHERE id = {$id}";
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

    // Contar entradas en categoría
    public static function contarEntradas($id)
    {
        $query = "SELECT COUNT(*) as total FROM blog_entries WHERE categoria_id = {$id}";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        return $total['total'];
    }
} 