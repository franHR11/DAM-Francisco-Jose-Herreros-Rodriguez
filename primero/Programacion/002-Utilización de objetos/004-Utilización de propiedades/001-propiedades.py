class Gato:
    def __init__(self):
        self.altura = None
        self.edad = None
        self.peso = None
        self.nombre = None

    def maulla(self,numero):
        cadena = "Miau "*numero
        print(cadena)
    def estufera(self):
        print ("ffffffffff")       

gato1 = Gato()
print("El nombre del gato1 es",gato1.nombre)
gato1.nombre = "Micifu"
print("El nombre del gato1 es",gato1.nombre)
