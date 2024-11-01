SELECT 

jornadas.fecha,
partidos.horadeinicio,
equipos.nombre,
divisiones.nombre,
goleslocal,
fichajes.fechainicio,
fichajes.fechafinal,
jugadores.nombre,
jugadores.apellidos,
paises.nombre

FROM partidos

LEFT JOIN equipos
ON partidos.local = equipos.Identificador
LEFT JOIN jornadas
ON partidos.jornada = jornadas.Identificador
LEFT JOIN fichajes
ON fichajes.equipos_nombre = equipos.Identificador
LEFT JOIN jugadores
ON fichajes.jugadores_nombre = jugadores.Identificador
LEFT JOIN paises
ON jugadores.paises_nombre = paises.Identificador
LEFT JOIN divisiones
ON equipos.divisiones_nombre = divisiones.Identificador
;
