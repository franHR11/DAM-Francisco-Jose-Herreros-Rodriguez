from JVAnaliticas import *
        
sesion = JVAnaliticas()
sesion.graficaTarta(
    """
    SELECT 
    COUNT(extra3) AS numero,
    extra3 as valor
    FROM logs
    WHERE extra3 != ""
    GROUP BY extra3
    ORDER BY numero DESC
    LIMIT 20;
    """, "paises.jpg"
)

sesion.graficaTarta(
    """
    SELECT 
    COUNT(referencia) AS numero,
    referencia as valor
    FROM logs
    WHERE referencia != ""
    GROUP BY referencia
    ORDER BY numero DESC
    LIMIT 20;
    """, "idiomas.jpg"
)
sesion.graficaBarras(
    """
    SELECT 
    COUNT(anio) AS numero,
    anio AS valor
    FROM logs
    GROUP BY anio
    """, "visitasporaño.jpg"
)