from tkinter import *
from tkinter import ttk

root = Tk()
root.title('Gestor de Clientes')

tree = ttk.Treeview(root)
tree['columns'] = ('Nombre', 'Telefono', 'Empresa')

# tree.column('#0')
tree.column('#0' , width=0, stretch=NO)
tree.column('Nombre')
tree.column('Telefono')
tree.column('Empresa')

# tree.heading('#0', text='ID')
tree.heading('#0')
tree.heading('Nombre', text='Nombre')
tree.heading('Telefono', text='Telefono')
tree.heading('Empresa', text='Empresa')

tree.grid(row=0, column=0, columnspan=3, padx=10, pady=10)

tree.insert('', 'end', text='1', values=('Juan', '123456789', 'Empresa 1'))
tree.insert('', 'end', text='1', values=('Juan', '123456789', 'Empresa 1'))
tree.insert('', 'end', text='1', values=('Juan', '123456789', 'Empresa 1'))

root.mainloop()