import os
from datetime import datetime
import json
from pathlib import Path

ruta = "E:/xampp/htdocs/DAM-Francisco-Jose-Herreros-Rodriguez/primero"

archivo = "registro.json"
rutaarchivo = Path(archivo)
registro = []

for directorio_raiz, subcarpetas, archivos in os.walk(ruta):
    for archivo in archivos:
        ruta_completa = os.path.join(directorio_raiz, archivo)
        tiempo_modificacion = os.path.getmtime(ruta_completa)
        fecha_modificacion = datetime.fromtimestamp(tiempo_modificacion).strftime('%Y-%m-%d %H:%M:%S')
        
        tamano_bytes = os.path.getsize(ruta_completa)
        registro.append({
                "ruta":ruta_completa,
                "fecha":fecha_modificacion,
                "tamano":tamano_bytes
            })
        
if rutaarchivo.exists():
    incidencias = 0
    print("Existe, vamos a leerlo")
    archivo = open("registro.json",'r')
    diccionario = json.load(archivo)
    archivo.close()
    for entrada in diccionario:
        for dato in registro:
            if entrada['ruta'] == dato['ruta']:
                if entrada['fecha'] == dato['fecha'] and entrada['tamano'] == dato['tamano']:
                    pass
                else:
                    incidencias+= 1
                    print("el archivo ",entrada['ruta'],"ha sido modificado")
    print("Han ocurrido",incidencias,"incidencias")
else:
    
    archivo = open("registro.json",'w')
    json.dump(registro,archivo,indent=4)
    archivo.close()