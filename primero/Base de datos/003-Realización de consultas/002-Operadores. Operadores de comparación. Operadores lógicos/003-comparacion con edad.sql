SELECT 
    nombre,
    apellidos,
    TIMESTAMPDIFF(YEAR, fechadenacimiento, CURDATE()) AS edad,
        TIMESTAMPDIFF(YEAR, fechadenacimiento, CURDATE()) >= 30 AS mayorque30
FROM 
    empresa.clientes;
