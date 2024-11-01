SELECT 
jornadas.fecha,
partidos.horadeinicio,
equipos.nombre,
goleslocal,
fichajes.fechainicio,
fichajes.fechafinal
FROM partidos
LEFT JOIN equipos
ON partidos.local = equipos.Identificador
LEFT JOIN jornadas
ON partidos.jornada = jornadas.Identificador
LEFT JOIN fichajes
ON fichajes.equipos_nombre = equipos.Identificador;
;
