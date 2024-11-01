from ConectorBD import *
import tkinter as tk

conexion1 = ConectorBD()

def damedatos(tabla):
    print(tabla)
    global texto
    datos = conexion1.leerTabla(tabla)
    textoformateado = ""
    
    for dato in datos:
        for clave, valor in dato.items():
            textoformateado += f"{clave}: {valor}\n"
        textoformateado += "---------------\n"
    
    texto.delete(1.0, tk.END)
    texto.insert(tk.END, textoformateado)  

ventana = tk.Tk()

tablas = conexion1.dameTablas()

for tabla in tablas:
    tk.Button(
        ventana,
        text=tabla['Tables_in_programacion'],
        command=lambda t=tabla['Tables_in_programacion']: damedatos(t)
    ).pack(padx=10, pady=10)

texto = tk.Text(ventana)
texto.pack(padx=10, pady=10)

ventana.mainloop()