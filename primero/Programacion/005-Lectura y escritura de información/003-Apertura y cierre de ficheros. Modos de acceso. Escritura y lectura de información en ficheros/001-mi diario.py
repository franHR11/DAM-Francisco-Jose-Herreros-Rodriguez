'''
Hola Jose Vicente, en visual studio code el archivo lo crea en la raiz, dentro de la carpeta
DAM,para que puedas verlo

'''
print("Aplicacion para escribir en un diario v 0.1")

fecha = input("Introduce la fecha de hoy: ")
mensaje = input("Introduce tu mensaje: ")


archivo = open("diariofran.txt", "a")
archivo.write(fecha+"/"+mensaje+"\n")
archivo.close()

      
        

      
        
