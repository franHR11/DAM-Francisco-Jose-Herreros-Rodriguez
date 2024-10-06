SELECT * FROM empleados
LEFT JOIN direcciones
ON empleados.id = direcciones.empleados_nombre;

