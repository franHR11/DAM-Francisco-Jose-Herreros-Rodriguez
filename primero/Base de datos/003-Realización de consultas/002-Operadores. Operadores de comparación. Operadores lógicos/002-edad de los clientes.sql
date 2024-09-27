SELECT 
    nombre,
    apellidos,
    TIMESTAMPDIFF(YEAR, fechadenacimiento, CURDATE()) AS edad
FROM 
    empresa.clientes;
