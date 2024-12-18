from tkinter import *

root = Tk()
root.title("Calculadora de kilos a Gramos")
root.geometry("500x500")

def calcular():
    try:
        value = float(kilos.get())
        m = int(value * 1000)
        gramos.set(str(m))
    except ValueError:
        gramos.set("ERROR No es un numero")
        return    
    
    
    
    
frame = Frame(root, padx=10, pady=10)
frame.grid(row=0, column=0, columnspan=2)

kilos = StringVar()
kilos_input =  Entry(frame, width=10, textvariable=kilos)
kilos_input.grid(row=0, column=1)

gramos = StringVar()
gramos.set("ingrese kilos")
Label(frame, textvariable=gramos).grid(row=1, column=1)

Button(frame, text="Calcular", command=calcular).grid(row=2, column=2)

Label(frame, text="Kilos: ").grid(row=0, column=0)
Label(frame, text="es igual a ").grid(row=1, column=0)
Label(frame, text="Gramos ").grid(row=1, column=2)

kilos_input.focus()


root.bind("<Return>", lambda x: calcular())
root.mainloop()