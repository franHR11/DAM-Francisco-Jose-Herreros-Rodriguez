from tkinter import *

root = Tk()
root.title("Ventana de prueba")
root.geometry("500x500")

l = Label(root, text="Hola mundo")
 
def click():
    l.pack()


btn = Button(root, text="Clickeame", command=click, fg="#ffffff", bg="blue")
btn.pack()



root.mainloop()