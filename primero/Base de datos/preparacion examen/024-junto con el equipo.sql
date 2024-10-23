SELECT 
equipos.nombre,
goleslocal
FROM partidos
LEFT JOIN equipos
ON partidos.local = equipos.Identificador
;