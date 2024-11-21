import tkinter as tk

def iva():
        numero = float(entry.get())  # Obtenemos el número ingresado
        resultadoiva = numero + (numero * 0.21)  # Sumamos el 21% al número
        label_resultado.config(text=f"Resultado IVA: {resultadoiva:.2f}")  # Mostramos el resultado
        return resultadoiva
        
def irpf():
        numero = float(entry.get())  # Obtenemos el número ingresado
        resultadoirpf = numero + (numero * 0.15)  # Sumamos el 15% al número
        label_resultadoirpf.config(text=f"Resultado IRPF: {resultadoirpf:.2f}")  # Mostramos el resultado
        return resultadoirpf
        
def total():
        numero = float(entry.get())  # Obtenemos el número ingresado
        resultadototal = numero + (numero - label_resultadoirpf + label_resultado)  # Sumamos el total al número
        label_resultadototal.config(text=f"Resultado Total: {resultadototal:.2f}")  # Mostramos el resultado 
        return resultadototal          
      

# Crear la ventana principal
ventana = tk.Tk()
ventana.title("Calculadora IVA Y IRPF")
ventana.geometry("500x500")

# Etiqueta para el numero a introducir
label_instr = tk.Label(ventana, text="Introduce un número:")
label_instr.pack(pady=5)

# Campo de texto para introducir el número
entry = tk.Entry(ventana, width=20)
entry.pack(pady=5)

# Botón para calcular y sumar el 21%
boton_calcular = tk.Button(ventana, text="Calcular IVA 21%", command=iva)
boton_calcular.pack(pady=10)

# Botón para calcular y sumar el 15%
boton_calcular = tk.Button(ventana, text="Calcular IRPF 15%", command=irpf)
boton_calcular.pack(pady=10)

# Botón para calcular el TOTAL BASE IMPONIBLE + IVA - IRPF
boton_calcular = tk.Button(ventana, text="Calcular TOTAL", command=total)
boton_calcular.pack(pady=10)

# Etiqueta para mostrar el resultado iva
label_resultado = tk.Label(ventana, text="", font=("Arial", 12, "bold"))
label_resultado.pack(pady=10)

# Etiqueta para mostrar el resultado IRPF
label_resultadoirpf = tk.Label(ventana, text="", font=("Arial", 12, "bold"))
label_resultadoirpf.pack(pady=10)

# Etiqueta para mostrar el resultado TOTAL
label_resultadototal = tk.Label(ventana, text="", font=("Arial", 12, "bold"))
label_resultadototal.pack(pady=10)


# Iniciar el bucle principal
ventana.mainloop()
