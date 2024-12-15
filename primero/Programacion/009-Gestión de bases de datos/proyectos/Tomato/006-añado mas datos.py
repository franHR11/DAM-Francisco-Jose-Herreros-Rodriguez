import matplotlib.pyplot as plt
import psutil

# Obtener métricas del sistema
carga_cpu = psutil.cpu_percent(interval=1)
carga_ram = psutil.virtual_memory().percent
uso_disco = psutil.disk_usage('/').percent

# Guardar las métricas en un archivo
ruta_archivo = "C:/Users/franh/Desktop/backups/cargaampliada.txt"
with open(ruta_archivo, 'a') as archivo:
    archivo.write(f"{carga_cpu},{carga_ram},{uso_disco}\n")

# Leer y procesar el archivo para las gráficas
with open(ruta_archivo, 'r') as archivo:
    lineas = archivo.readlines()

datos_cpu, datos_ram, datos_disco = [], [], []
for linea in lineas:
    linea = linea.strip()
    if linea:
        cpu, ram, disco = map(float, linea.split(','))
        datos_cpu.append(cpu)
        datos_ram.append(ram)
        datos_disco.append(disco)

# Generar las gráficas
plt.figure(figsize=(10, 6))
plt.plot(datos_cpu, label='CPU', marker='o')
plt.plot(datos_ram, label='RAM', marker='s')
plt.plot(datos_disco, label='Disco', marker='^')
plt.grid(True)
plt.ylim(0, 100)
plt.title('Uso del Sistema')
plt.xlabel('Muestras')
plt.ylabel('Porcentaje de Uso')
plt.legend()

# Guardar la gráfica como imagen
ruta_imagen = "C:/Users/franh/Desktop/backups/cargacpu.jpg"
plt.savefig(ruta_imagen)
plt.close()

print("Métricas guardadas y gráfica generada correctamente.")