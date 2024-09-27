class Gato:
    def __init__(self,nuevonombre,nuevaaltura,nuevopeso,nuevaedad):
        self.altura = nuevaaltura
        self.edad = nuevaedad
        self.peso = nuevopeso
        self.nombre = nuevonombre

    def maulla(self,numero):
        cadena = "Miau "*numero
        print(cadena)
    def estufera(self):
        print ("ffffffffff")       

gato1 = Gato("Micifu",10,0.2,0)
print("El nombre del gato es:",gato1.nombre)
print("La edad del gato es:",gato1.edad)


