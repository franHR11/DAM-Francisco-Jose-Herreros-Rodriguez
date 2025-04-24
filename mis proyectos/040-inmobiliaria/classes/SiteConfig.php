<?php

namespace App;

class SiteConfig extends ActiveRecord // Asumiendo que ActiveRecord existe y es la base
{
    // Base de datos
    protected static $tabla = 'site_config';
    protected static $columnasDB = [
        'id', 'site_name', 'meta_description', 'logo_filename', 'header_image_filename',
        // Nuevas columnas para datos de empresa
        'company_name', 'address', 'city', 'zip_code', 'opening_hours', 'closing_hours'
    ];

    // Errores
    protected static $errores = [];

    // Atributos
    public $id = 1; // Siempre trabajaremos con el ID 1
    public $site_name;
    public $meta_description;
    public $logo_filename;
    public $header_image_filename;
    
    // Nuevos atributos para datos de empresa
    public $company_name;
    public $address;
    public $city;
    public $zip_code;
    public $opening_hours;
    public $closing_hours;

    // --- Constructor Adaptado --- 
    // No necesitamos un constructor complejo si siempre cargamos ID 1
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 1; // Asegurar que el ID sea siempre 1
        $this->site_name = $args['site_name'] ?? '';
        $this->meta_description = $args['meta_description'] ?? '';
        $this->logo_filename = $args['logo_filename'] ?? '';
        $this->header_image_filename = $args['header_image_filename'] ?? '';

        // Inicializar los nuevos atributos
        $this->company_name = $args['company_name'] ?? '';
        $this->address = $args['address'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->zip_code = $args['zip_code'] ?? '';
        $this->opening_hours = $args['opening_hours'] ?? '';
        $this->closing_hours = $args['closing_hours'] ?? '';
    }

    // --- Validación --- 
    public function validar() {
        static::$errores = []; // Limpiar errores previos
        if (!$this->site_name) {
            static::$errores[] = 'Debes añadir un nombre para el sitio.';
        }
        
        // Los campos de la empresa son opcionales, no se añaden validaciones de obligatoriedad aquí.
        // Se podrían añadir validaciones de formato si se desea (ej: formato de CP, etc.)

        return static::$errores;
    }

    // --- Manejo de Imágenes (solo asigna el nombre de archivo) ---
    public function setLogo($filename) {
        if ($filename) {
            $this->logo_filename = $filename;
        }
    }

    public function setHeaderImage($filename) {
        if ($filename) {
            $this->header_image_filename = $filename;
        }
    }
    
    // --- Métodos Heredados de ActiveRecord (asumiendo que existen) ---
    // find($id), all(), guardar(), eliminar(), sanitizarAtributos(), atributos(), getErrores() 
    // Deberían funcionar si la herencia y la clase ActiveRecord están correctamente configuradas.

    // Necesitamos asegurarnos que `actualizar` existe en la clase base o definirlo aquí.
    // Si no existe, lo adaptamos de Propiedad:
    /*
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla ." SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        return $resultado;
    }
    */

} 