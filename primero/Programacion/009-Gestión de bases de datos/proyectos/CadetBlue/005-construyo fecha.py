import os
import time
from datetime import datetime
try:
    os.mkdir("C:/Users/franh/Desktop/backups")
except:
    print("la carpeta ya existe, continuamos...")
    
ahora = datetime.now()                                          # Atrapo el tiempo actual
fecha = ahora.strftime("%Y-%m-%d-%H-%M-%S")                     # Lo formateo en un formato humanamente entendible
epoch = str(round(time.time()))                                 # Obtengo la era unix
fechacompuesta = fecha+"_"+epoch                                # Creo una fecha compuesta
print(fechacompuesta)                                           # Imprimo la fecha
os.mkdir("C:/Users/franh/Desktop/backups/"+fechacompuesta)           # Creo un directorio con la fecha compuesta