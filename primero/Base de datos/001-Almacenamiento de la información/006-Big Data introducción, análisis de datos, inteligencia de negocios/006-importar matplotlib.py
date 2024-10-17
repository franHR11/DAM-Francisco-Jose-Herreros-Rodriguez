'''LA BASE DE DATOS SE ENCUENTRA EN LA RAIZ PRINCIPAL
INSTALAR MATPLOTLIB CON EL SIGUIENTE COMANDO EN LA TERMINAL // WINDOWS // pip install matplotlib //LINUX //  pip3 install matplotlib

'''


import matplotlib.pyplot as plt                                  #Importamos la libreria matplotlib

etiquetas = ['Category A', 'Category B', 'Category C']          #Creamos una lista con las etiquetas
datos = [30, 45, 25]                                            #Creamos una lista con los datos

plt.pie(datos, labels=etiquetas)                                #Creamos un grafico de pastel con los datos y etiquetas

plt.show()                                                      #Mostramos la grafica

plt.savefig('grafica.png')                                      #Guardamos la grafica en un archivo

plt.close()                                                     #Cerramos la grafica