<?php

namespace App;

class BlogEntry
{
    // Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'contenido', 'imagen', 'categoria_id', 'destacado', 'creado', 'autor_id'];

    // Errores
    protected static $errores = [];

    // Propiedades
    public $id;
    public $titulo;
    public $contenido;
    public $imagen;
    public $categoria_id;
    public $destacado;
    public $creado;
    public $autor_id;

    /**
     * Conexión a la BD
     */
    public static function setDB($database)
    {
        self::$db = $database;
    }

    /**
     * Constructor
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->categoria_id = $args['categoria_id'] ?? null;
        $this->destacado = $args['destacado'] ?? '0';
        $this->creado = $args['creado'] ?? date('Y-m-d');
        $this->autor_id = $args['autor_id'] ?? null;
    }

    /**
     * Guardar entrada
     */
    public function guardar()
    {
        // sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        // Asegurar que autor_id sea NULL si está vacío
        if (isset($atributos['autor_id']) && $atributos['autor_id'] === '') {
            $atributos['autor_id'] = 'NULL';
        }

        $columnas = implode(', ', array_keys($atributos));
        $valores = [];
        
        foreach ($atributos as $key => $value) {
            // Si el valor es NULL o la cadena 'NULL', no usar comillas
            if ($value === 'NULL' || $value === NULL) {
                $valores[] = "NULL";
            } else {
                $valores[] = "'{$value}'";
            }
        }
        
        $valoresString = implode(', ', $valores);
        
        $query = "INSERT INTO blog_entries ({$columnas}) VALUES ({$valoresString})";
        
        $resultado = self::$db->query($query);
        return $resultado;
    }

    /**
     * Actualizar entrada
     */
    public function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Asegurar que autor_id sea NULL si está vacío
        if (isset($atributos['autor_id']) && $atributos['autor_id'] === '') {
            $atributos['autor_id'] = 'NULL';
        }

        $valores = [];
        foreach ($atributos as $key => $value) {
            // Si el valor es NULL o la cadena 'NULL', no usar comillas
            if ($value === 'NULL' || $value === NULL) {
                $valores[] = "{$key}=NULL";
            } else {
                $valores[] = "{$key}='{$value}'";
            }
        }

        $query = "UPDATE blog_entries SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    /**
     * Eliminar entrada
     */
    public function eliminar()
    {
        $query = "DELETE FROM blog_entries WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    /**
     * Atributos
     */
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    /**
     * Sanitizar atributos
     */
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = $value !== null ? self::$db->escape_string($value) : '';
        }

        return $sanitizado;
    }

    /**
     * Subir archivos
     */
    public function setImagen($imagen)
    {
        // Eliminar imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    /**
     * Eliminar imagen
     */
    public function borrarImagen()
    {
        // Comprobar si existe imagen y archivo
        if ($this->imagen && !empty($this->imagen)) {
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if ($existeArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
    }

    /**
     * Validación
     */
    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = 'El título es obligatorio';
        }

        if (!$this->contenido) {
            self::$errores[] = 'El contenido es obligatorio';
        }

        if (!$this->categoria_id) {
            self::$errores[] = 'La categoría es obligatoria';
        }

        return self::$errores;
    }

    /**
     * Obtener errores
     */
    public static function getErrores()
    {
        return self::$errores;
    }

    /**
     * Obtener todas las entradas
     */
    public static function all()
    {
        $query = "SELECT * FROM blog_entries ORDER BY creado DESC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
     * Obtener número limitado de entradas
     */
    public static function limit($limit, $offset = 0)
    {
        $query = "SELECT * FROM blog_entries ORDER BY creado DESC LIMIT {$limit} OFFSET {$offset}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
     * Contar todas las entradas
     */
    public static function contarTodos()
    {
        $query = "SELECT COUNT(*) as total FROM blog_entries";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        return $total['total'];
    }

    /**
     * Buscar entrada por id
     */
    public static function find($id)
    {
        $query = "SELECT * FROM blog_entries WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    /**
     * Buscar entradas
     */
    public static function buscar($termino, $columna = null)
    {
        if ($columna && in_array($columna, self::$columnasDB)) {
            $query = "SELECT * FROM blog_entries WHERE {$columna} LIKE '%{$termino}%' ORDER BY creado DESC";
        } else {
            $query = "SELECT * FROM blog_entries WHERE titulo LIKE '%{$termino}%' OR contenido LIKE '%{$termino}%' ORDER BY creado DESC";
        }
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
     * Obtener entradas por categoría
     */
    public static function porCategoria($categoria_id)
    {
        $query = "SELECT * FROM blog_entries WHERE categoria_id = {$categoria_id} ORDER BY creado DESC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
     * Obtener entradas destacadas
     */
    public static function destacados($limit = 3)
    {
        $query = "SELECT * FROM blog_entries WHERE destacado = '1' ORDER BY creado DESC LIMIT {$limit}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
     * Consultar SQL
     */
    protected static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    /**
     * Crear objeto
     */
    protected static function crearObjeto($registro)
    {
        $objeto = new self;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
} 