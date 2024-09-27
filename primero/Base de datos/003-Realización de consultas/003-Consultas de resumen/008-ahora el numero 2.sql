SELECT 
n2 AS 'El número propiamente dicho',
COUNT(n2) AS 'Número de veces que se ha repetido ese número'
FROM `euromillones`
GROUP BY(n2)
ORDER BY n2 ASC
;