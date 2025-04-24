<?php

namespace App;

class Contacto extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'mensajes_contacto';
    protected static $columnasDB = ['id', 'nombre', 'email', 'telefono', 'mensaje', 'tipo', 'presupuesto', 'contacto_via', 'fecha_contacto', 'hora_contacto', 'creado', 'leido'];

    // Propiedades
    public $id;
    public $nombre;
    public $email;
    public $telefono;
    public $mensaje;
    public $tipo;
    public $presupuesto;
    public $contacto_via;
    public $fecha_contacto;
    public $hora_contacto;
    public $creado;
    public $leido;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->mensaje = $args['mensaje'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->presupuesto = $args['presupuesto'] ?? '';
        $this->contacto_via = $args['contacto_via'] ?? '';
        $this->fecha_contacto = $args['fecha_contacto'] ?? null;
        $this->hora_contacto = $args['hora_contacto'] ?? null;
        $this->creado = $args['creado'] ?? date('Y-m-d H:i:s');
        $this->leido = $args['leido'] ?? 0;
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = 'El nombre es obligatorio';
        }
        if (!$this->email) {
            self::$errores[] = 'El email es obligatorio';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$errores[] = 'El email no es válido';
        }
        if (!$this->telefono) {
            self::$errores[] = 'El teléfono es obligatorio';
        }
        if (!$this->mensaje) {
            self::$errores[] = 'El mensaje es obligatorio';
        }
        if (!$this->tipo) {
            self::$errores[] = 'Debe seleccionar si compra o vende';
        }
        if (!$this->contacto_via) {
            self::$errores[] = 'Debe seleccionar la vía de contacto';
        }
        if ($this->contacto_via === 'telefono') {
            if (!$this->fecha_contacto) {
                self::$errores[] = 'La fecha de contacto es obligatoria';
            }
            if (!$this->hora_contacto) {
                self::$errores[] = 'La hora de contacto es obligatoria';
            }
        }
        return self::$errores;
    }

    public static function mensajesNoLeidos()
    {
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla . " WHERE leido = 0";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_assoc();
        return (int) $total['total'];
    }

    public function marcarComoLeido()
    {
        $this->leido = 1;
        return $this->actualizar();
    }
} 