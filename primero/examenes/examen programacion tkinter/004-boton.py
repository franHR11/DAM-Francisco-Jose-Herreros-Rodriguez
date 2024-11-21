import tkinter as tk                                                        # Importo la libreria

ventana = tk.Tk();                                                          # Creo una ventana

tk.Label(ventana,text="Introduce el primer operando").pack(padx=20,pady=4)  # Creo una etiqueta
tk.Entry(ventana).pack(padx=20,pady=4)                                      # Creo un campo

tk.Label(ventana,text="Introduce el segundo operando").pack(padx=20,pady=4)  # Creo una etiqueta
tk.Entry(ventana).pack(padx=20,pady=4)                                      # Creo un campo

tk.Label(ventana,text="Escoge operación").pack(padx=20,pady=4)              # Creo una etiqueta
tk.Entry(ventana).pack(padx=20,pady=4)                                      # Creo un campo

tk.Label(ventana,text="Pulsa para ejecutar").pack(padx=20,pady=4)              # Creo una etiqueta
tk.Button(ventana,text="Vamos alla!").pack(padx=20,pady=4)               # Creo un boton

tk.Label(ventana,text="El resultado aparecerá aquí").pack(padx=20,pady=4)  # Creo una etiqueta
resultado = tk.Label(ventana,text="X")
resultado.pack(padx=20,pady=4)

ventana.mainloop();