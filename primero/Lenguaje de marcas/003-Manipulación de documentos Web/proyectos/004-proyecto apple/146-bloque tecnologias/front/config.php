<?php
/**
 * Configuración de la base de datos
 * 
 * @description Establece la conexión con la base de datos MySQL
 * @param string $host Servidor de la base de datos (localhost)
 * @param string $user Usuario de la base de datos (proyectoapple)
 * @param string $password Contraseña de la base de datos (proyectoapple)
 * @param string $database Nombre de la base de datos (proyectoapple)
 * @return mysqli Objeto de conexión a la base de datos
 * @throws mysqli_sql_exception Si la conexión falla
 * @author Francisco José Herreros Rodríguez
 */
$conexion = mysqli_connect(
    "localhost", 
    "proyectoapple", 
    "proyectoapple", 
    "proyectoapple"
);
?>