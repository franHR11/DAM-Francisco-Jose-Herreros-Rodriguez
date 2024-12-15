import os

ruta = "E:/xampp/htdocs/DAM-Francisco-Jose-Herreros-Rodriguez/primero"

for directorio_raiz, subcarpetas, archivos in os.walk(ruta):
    for archivo in archivos:
        ruta_completa = os.path.join(directorio_raiz, archivo)
        print(ruta_completa)