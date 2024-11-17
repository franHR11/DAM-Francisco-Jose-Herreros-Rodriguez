import tkinter as tk                                                            # Importo la libreria

ventana = tk.Tk();                                                              # Creo una ventana

operando1 = tk.IntVar()                                                         # Esta variable almacena un entero
operando2 = tk.IntVar()                                                         # Esta variable almacena un entero
operacion = tk.StringVar()                                                      # Esta variable almacena una cadena

def suma(a,b):
    return a+b
def resta(a,b):
    return a-b
def multiplicacion(a,b):
    return a*b
def division(a,b):
    return a/b

def calcula():
    print("Vamos a calcular algo")
    global operando1                                                            # Traigo las variables dentro de la funcion
    global operando2
    global operacion
    global resultado

    numeroresultado = None                                                      # Aporta una variable
    if operacion.get() == "+":                                                  # Si la operacion es de suma
        numeroresultado = suma(operando1.get(),operando2.get())                     # Realizo la operacion                                  # Actualizo el resultado
    elif operacion.get() == "-":
        numeroresultado = resta(operando1.get(),operando2.get()) 
    elif operacion.get() == "*":
        numeroresultado = multiplicacion(operando1.get(),operando2.get()) 
    elif operacion.get() == "/":
        numeroresultado = division(operando1.get(),operando2.get()) 
    else:
        numeroresultado = "No permitido"

    resultado.config(text=numeroresultado)
        

tk.Label(ventana,text="Introduce el primer operando").pack(padx=20,pady=4)  # Creo una etiqueta
tk.Entry(ventana,textvariable = operando1).pack(padx=20,pady=4)                                      # Creo un campo

tk.Label(ventana,text="Introduce el segundo operando").pack(padx=20,pady=4)  # Creo una etiqueta
tk.Entry(ventana,textvariable = operando2).pack(padx=20,pady=4)                                      # Creo un campo

tk.Label(ventana,text="Escoge operación").pack(padx=20,pady=4)              # Creo una etiqueta
tk.Entry(ventana,textvariable = operacion).pack(padx=20,pady=4)                                      # Creo un campo

tk.Label(ventana,text="Pulsa para ejecutar").pack(padx=20,pady=4)              # Creo una etiqueta
tk.Button(ventana,text="Vamos alla!",command=calcula).pack(padx=20,pady=4)               # Creo un boton

tk.Label(ventana,text="El resultado aparecerá aquí").pack(padx=20,pady=4)  # Creo una etiqueta
resultado = tk.Label(ventana,text="X")
resultado.pack(padx=20,pady=4)

ventana.mainloop();