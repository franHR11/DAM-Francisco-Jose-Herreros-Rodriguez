SELECT 
jornadas.fecha,
partidos.horadeinicio,
equipos.nombre,
goleslocal
FROM partidos
LEFT JOIN equipos
ON partidos.local = equipos.Identificador
LEFT JOIN jornadas
ON partidos.jornada = jornadas.Identificador
;