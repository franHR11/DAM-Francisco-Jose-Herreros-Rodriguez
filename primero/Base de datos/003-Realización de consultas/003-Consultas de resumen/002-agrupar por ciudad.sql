SELECT 
COUNT(Identificador) AS 'Número de clientes',
poblacion
FROM clientes
GROUP BY(poblacion)
;