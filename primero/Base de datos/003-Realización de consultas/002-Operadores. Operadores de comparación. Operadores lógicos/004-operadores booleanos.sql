SELECT 
    nombre,
    apellidos,
    TIMESTAMPDIFF(YEAR, fechadenacimiento, CURDATE()) AS edad,
    TIMESTAMPDIFF(YEAR, fechadenacimiento, CURDATE()) >= 30 AS mayorque30,
    TIMESTAMPDIFF(YEAR, fechadenacimiento, CURDATE()) >= 30 && TIMESTAMPDIFF(YEAR, fechadenacimiento, CURDATE()) < 40 AS treintañero
        
FROM 
    empresa.clientes;
