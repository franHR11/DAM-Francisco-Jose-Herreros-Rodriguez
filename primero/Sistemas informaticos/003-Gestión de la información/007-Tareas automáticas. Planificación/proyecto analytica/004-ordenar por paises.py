import sqlite3


conexion = sqlite3.connect("./registros.db")
conexion.row_factory = sqlite3.Row

cursor = conexion.cursor()

cursor.execute(
    """
        SELECT 
        COUNT(extra3) AS numero,
        extra3 as valor
        FROM logs
        WHERE extra3 != ""
        GROUP BY extra3
        ORDER BY numero DESC
        LIMIT 20;
    """)

filas = cursor.fetchall()

for fila in filas:
    diccionario = dict(fila)
    print(diccionario)