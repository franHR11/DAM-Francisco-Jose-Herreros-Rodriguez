<?php

namespace App;

class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Errores
    protected static $errores = [];

    // Definir la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;
    }

    // Guardar registro
    public function guardar() {
        if(!is_null($this->id)) {
            // Actualizar
            return $this->actualizar();
        } else {
            // Crear
            return $this->crear();
        }
    }

    // Crear un registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $columnas = join(', ', array_keys($atributos));
        $valores = join("', '", array_values($atributos));

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= $columnas;
        $query .= ") VALUES ('";
        $query .= $valores;
        $query .= "')";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Actualizar un registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Obtener todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtener registros con un límite
    public static function limit($limit, $offset = 0) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${limit} OFFSET ${offset}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Buscar un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Buscar registros por una columna específica
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Realizar búsqueda en base a una columna
    public static function buscar($texto, $columna = 'nombre') {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} LIKE '%${texto}%'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Contar registros
    public static function contarTodos() {
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        return (int) $total['total'];
    }

    // SQL para consultas
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    // Crear un objeto con los datos del registro
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los atributos
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Validación
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }
} 