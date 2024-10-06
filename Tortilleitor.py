'''
Este es un programa para ayudarte a saber los ingredientes 
que te hacen falta para hacer una tortilla de patatas

'''
#  presentación de los datos del programa

NOMBRE_DEL_PROGRAMA = "Programa Tortilleitor"
VERSION = "0.1"
AUTOR = "Francisco Jose Herreros Rodriguez"
print(NOMBRE_DEL_PROGRAMA,VERSION,AUTOR)

print("Soy Tortilleitor, tu asistente virtual para ayudarte a saber los ingredientes que te hacen falta para hacer una tortilla de patatas: ")
input("quieres que te ayude a contar los ingredientes que te faltan? contesta con un (si/no)")

#  Datos faltantes por aprender, si es si continuar, si es no apagar programa

#  Contabilizamos los ingredientes que el usuario tiene en casa
#  Datos faltantes por aprender, si tiene 4 huevos y le hacen talta 2, mostrar el numero faltante de huevos.

huevos = input("Cuantos Huevos tienes en la nevera: ")
print("Tienes",huevos,"huevos")
patatas = input("Cuantas Patatas tienes en la despensa: ")
print("Tienes",patatas,"patatas")
cebolla = input("Te gusta la tortilla con cebolla (si/no)")
print(cebolla,"te gusta la cebolla")
sal = input("Tienes sal en la despensa (si/no)")
print(sal,"tienes sal")
aceite = input("Tienes aceite en la despensa (si/no)")
print(aceite,"Tienes aceite")

#  Imprimimos la receta de la tortilla de patatas

print("Hecha aceite en una sarten grande y ponlo a calentar")
print("coge las ",patatas,"y las pelas, luego les hechas sal y cuando el aceite este caliente las pones a freir")
print(cebolla,"te gusta la cebolla, tu decides si ponerle o no")
print("coge",huevos,"huevos y batelos en un plato ondo con un tenedor")
print("cuando las",patatas,"esten fritas retiralas a un plato con papel absorvente para quitar el esceso de aceite")
print("cuando las",patatas,"patatas ya no tengan esceso de aceite hechas junto a los",huevos,"huevos en un bol y remueve todo")
print("en una sarte con poco aceite hecha la mescla de las patatas y los huevos")
print("Con ayuda de un plato cada 3 o 4 minutos ves dandole la vuelta para que se haga por ambos lados")
print("enplata tu tortilla perfecta y disfruta de tu tortilla de patatas")