from tkinter import *

root = Tk()
root.title("Ventana de prueba")
root.geometry("500x500")


l1 = Label(root, text="Hola mundo")
l2 = Label(root, text="Hola mundo 2")


l1.grid(row=0, column=0)
l2.grid(row=0, column=1)



root.mainloop()