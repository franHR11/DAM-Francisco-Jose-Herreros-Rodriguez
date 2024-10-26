import shutil
import time

total, used, free = shutil.disk_usage("/")

print(f"Total: {total // (2**30)} GB")
print(f"Used: {used // (2**30)} GB")
print(f"Free: {free // (2**30)} GB")

archivo = open("espacio.txt",'a')

tiempo = time.time()

archivo.write(f"{total // (2**30)}|{used // (2**30)}|{free // (2**30)}|{tiempo}\n")

archivo.close()