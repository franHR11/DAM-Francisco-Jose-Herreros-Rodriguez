import pickle

archivo = open("archivo.bin",'rb')

frutas = pickle.load(archivo)

print(frutas)

for fruta in frutas:
    print(fruta)

archivo.close()