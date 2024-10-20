import time

inicio = time.time()
print(inicio)

iteraciones = 1000000000
numero = 1.00000000065

for i in range(0,iteraciones):
    numero *=1.000000045

final= time.time()
print(final)

print(final-inicio)