DELIMITER $$

CREATE PROCEDURE CrearJugadoresCopia()
BEGIN
    -- Elimina la tabla jugadores_copia si existe
    DROP TABLE IF EXISTS jugadores_copia;

    -- Crea la tabla jugadores_copia copiando los datos de la tabla jugadores
    CREATE TABLE jugadores_copia AS
    SELECT * FROM jugadores;
END$$

DELIMITER ;