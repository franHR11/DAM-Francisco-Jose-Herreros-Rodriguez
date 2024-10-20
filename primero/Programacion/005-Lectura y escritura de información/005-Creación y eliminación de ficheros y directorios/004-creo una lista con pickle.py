import pickle      # Importamos la libreria pickle

archivo = open("archivo.bin",'wb')

frutas = ['manzana','pera','platano']

pickle.dump(frutas, archivo)

archivo.close()