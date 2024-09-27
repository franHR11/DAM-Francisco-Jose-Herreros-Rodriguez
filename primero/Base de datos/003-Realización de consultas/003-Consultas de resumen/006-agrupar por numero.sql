SELECT 
n1 AS 'El número propiamente dicho',
COUNT(n1) AS 'Número de veces que se ha repetido ese número'
FROM `euromillones`
GROUP BY(n1)
;