from tkinter import *
from tkinter import ttk
from tkinter import messagebox
import ttkbootstrap as ttkb  # Importar ttkbootstrap para mejorar el estilo
import sqlite3
import os  # Añadir esta importación


root = ttkb.Window(themename="superhero")  # Usar ttkbootstrap para la ventana principal
root.title('Gestor de Clientes')

# Centrar la ventana principal
window_width = 800
window_height = 600
screen_width = root.winfo_screenwidth()
screen_height = root.winfo_screenheight()
center_x = int(screen_width/2 - window_width/2)
center_y = int(screen_height/2 - window_height/2)
root.geometry(f'{window_width}x{window_height}+{center_x}+{center_y}')

# Obtener la ruta del directorio donde está el script
db_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'crm.db')

# Modificar la conexión para usar la ruta completa
conn = sqlite3.connect(db_path)

c = conn.cursor()

c.execute('''
    CREATE TABLE IF NOT EXISTS cliente (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT NOT NULL,
        telefono TEXT NOT NULL,
        empresa TEXT NOT NULL,
        email TEXT
    )
''')

def render_clientes():
    rows = c.execute('SELECT * FROM cliente').fetchall()
    
    tree.delete(*tree.get_children())
    for row in rows:
        tree.insert('',END, row[0], values=(row[1], row[2], row[3], row[4]))

def insertar(cliente):
    c.execute('''
        INSERT INTO cliente (nombre, telefono, empresa, email) VALUES (?, ?, ?, ?)
    ''', (cliente['nombre'], cliente['telefono'], cliente['empresa'], cliente['email']))
    conn.commit()
    
def actualizar_cliente(id, cliente):
    c.execute('''
        UPDATE cliente 
        SET nombre=?, telefono=?, empresa=?, email=? 
        WHERE id=?
    ''', (cliente['nombre'], cliente['telefono'], cliente['empresa'], cliente['email'], id))
    conn.commit()

def nuevo_cliente():
    def guardar():
        if not nombre.get():
            messagebox.showerror('Error', 'El nombre es requerido')          
            return
        if not telefono.get():
            messagebox.showerror('Error', 'El Telefono es requerido')          
            return
        if not empresa.get():
            messagebox.showerror('Error', 'La Empresa es requerido')          
            return
        
        cliente = {
            'nombre': nombre.get(),
            'telefono': telefono.get(),
            'empresa': empresa.get(),
            'email': email.get()
        }
        insertar(cliente)
        render_clientes()  # Añadimos esta línea para actualizar la lista
        top.destroy()
        
    
    top = Toplevel(root)  # Asegurarse de que la ventana secundaria también use ttkbootstrap
    top.title('Nuevo Cliente')
    
    # Hacer que top siempre esté por encima
    top.transient(root)
    top.grab_set()
    
    # Centrar la ventana top
    top_width = 400
    top_height = 300
    top_x = int(screen_width/2 - top_width/2)
    top_y = int(screen_height/2 - top_height/2)
    top.geometry(f'{top_width}x{top_height}+{top_x}+{top_y}')
    
    lnombre = ttkb.Label(top, text='Nombre')  # Usar ttkbootstrap para los widgets
    nombre = ttkb.Entry(top, width=40)
    lnombre.grid(row=0, column=0, padx=10, pady=10)
    nombre.grid(row=0, column=1, padx=10, pady=10)
    
    ltelefono = ttkb.Label(top, text='Telefono')
    telefono = ttkb.Entry(top, width=40)
    ltelefono.grid(row=1, column=0, padx=10, pady=10)
    telefono.grid(row=1, column=1, padx=10, pady=10)
    
    lempresa = ttkb.Label(top, text='Empresa')
    empresa = ttkb.Entry(top, width=40)
    lempresa.grid(row=2, column=0, padx=10, pady=10)
    empresa.grid(row=2, column=1, padx=10, pady=10)
    
    lemail = ttkb.Label(top, text='Email')
    email = ttkb.Entry(top, width=40)
    lemail.grid(row=3, column=0, padx=10, pady=10)
    email.grid(row=3, column=1, padx=10, pady=10)
        
    guardar = ttkb.Button(top, text='Guardar', command=guardar)
    guardar.grid(row=4, column=1, columnspan=2, padx=10, pady=10)
    
    top.mainloop()
    
def editar_cliente():
    seleccion = tree.selection()
    if not seleccion:
        messagebox.showerror('Error', 'Por favor, seleccione un cliente para editar')
        return
    if len(seleccion) > 1:
        messagebox.showerror('Error', 'Por favor, seleccione solo un cliente para editar')
        return
    
    # Obtener datos del cliente seleccionado
    id_cliente = seleccion[0]
    cliente = c.execute('SELECT * FROM cliente WHERE id=?', (id_cliente,)).fetchone()
    
    def guardar():
        if not nombre.get():
            messagebox.showerror('Error', 'El nombre es requerido')          
            return
        if not telefono.get():
            messagebox.showerror('Error', 'El Telefono es requerido')          
            return
        if not empresa.get():
            messagebox.showerror('Error', 'La Empresa es requerido')          
            return
        
        cliente_actualizado = {
            'nombre': nombre.get(),
            'telefono': telefono.get(),
            'empresa': empresa.get(),
            'email': email.get()
        }
        actualizar_cliente(id_cliente, cliente_actualizado)
        render_clientes()
        top.destroy()
    
    top = Toplevel(root)
    top.title('Editar Cliente')
    top.transient(root)
    top.grab_set()
    
    # Centrar la ventana top
    top_width = 400
    top_height = 300
    top_x = int(screen_width/2 - top_width/2)
    top_y = int(screen_height/2 - top_height/2)
    top.geometry(f'{top_width}x{top_height}+{top_x}+{top_y}')
    
    # Crear widgets con los datos del cliente
    lnombre = ttkb.Label(top, text='Nombre')
    nombre = ttkb.Entry(top, width=40)
    nombre.insert(0, cliente[1])  # Insertar dato existente
    lnombre.grid(row=0, column=0, padx=10, pady=10)
    nombre.grid(row=0, column=1, padx=10, pady=10)
    
    ltelefono = ttkb.Label(top, text='Telefono')
    telefono = ttkb.Entry(top, width=40)
    telefono.insert(0, cliente[2])  # Insertar dato existente
    ltelefono.grid(row=1, column=0, padx=10, pady=10)
    telefono.grid(row=1, column=1, padx=10, pady=10)
    
    lempresa = ttkb.Label(top, text='Empresa')
    empresa = ttkb.Entry(top, width=40)
    empresa.insert(0, cliente[3])  # Insertar dato existente
    lempresa.grid(row=2, column=0, padx=10, pady=10)
    empresa.grid(row=2, column=1, padx=10, pady=10)
    
    lemail = ttkb.Label(top, text='Email')
    email = ttkb.Entry(top, width=40)
    email.insert(0, cliente[4] if cliente[4] else '')  # Insertar dato existente
    lemail.grid(row=3, column=0, padx=10, pady=10)
    email.grid(row=3, column=1, padx=10, pady=10)
    
    guardar = ttkb.Button(top, text='Actualizar', command=guardar)
    guardar.grid(row=4, column=1, columnspan=2, padx=10, pady=10)
    
    top.mainloop()

def eliminar_cliente():
    seleccion = tree.selection()
    if not seleccion:
        messagebox.showerror('Error', 'Por favor, seleccione uno o más clientes para eliminar')
        return
    
    cantidad = len(seleccion)
    mensaje = f'¿Está seguro de que desea eliminar {cantidad} cliente{"s" if cantidad > 1 else ""}?'
    respuesta = messagebox.askyesno('Confirmar', mensaje)
    
    if respuesta:
        # Crear una sola consulta SQL para eliminar todos los clientes seleccionados
        placeholders = ','.join('?' * len(seleccion))
        query = f'DELETE FROM cliente WHERE id IN ({placeholders})'
        c.execute(query, seleccion)
        conn.commit()
        render_clientes()

def buscar_cliente(*args):
    # Obtener el texto de búsqueda
    busqueda = buscar_entry.get().lower()
    
    # Si el campo de búsqueda está vacío, mostrar todos los clientes
    if not busqueda:
        render_clientes()
        return
    
    # Realizar la búsqueda en la base de datos
    query = '''
        SELECT * FROM cliente 
        WHERE lower(nombre) LIKE ? 
        OR lower(telefono) LIKE ? 
        OR lower(empresa) LIKE ? 
        OR lower(email) LIKE ?
    '''
    parametros = tuple(f'%{busqueda}%' for _ in range(4))
    rows = c.execute(query, parametros).fetchall()
    
    # Limpiar el TreeView
    tree.delete(*tree.get_children())
    
    # Mostrar los resultados filtrados
    for row in rows:
        tree.insert('', END, row[0], values=(row[1], row[2], row[3], row[4]))

# Crear frame para la barra de herramientas (búsqueda y botones)
toolbar_frame = ttkb.Frame(root)
toolbar_frame.grid(row=0, column=0, columnspan=2, padx=10, pady=(10,5), sticky='ew')

# Frame para búsqueda (dentro de toolbar_frame)
search_frame = ttkb.Frame(toolbar_frame)
search_frame.pack(side=LEFT, fill=X, expand=True)

buscar_label = ttkb.Label(search_frame, text="Buscar:")
buscar_label.pack(side=LEFT, padx=(0,5))

buscar_entry = ttkb.Entry(search_frame, width=40)
buscar_entry.pack(side=LEFT, fill=X, expand=True)

# Vincular la función de búsqueda al evento de escritura
buscar_entry.bind('<KeyRelease>', buscar_cliente)

# Frame para botones (dentro de toolbar_frame)
button_frame = ttkb.Frame(toolbar_frame)
button_frame.pack(side=RIGHT, padx=(10,0))

# Botones con iconos y estilos mejorados
btn_nuevo = ttkb.Button(
    button_frame, 
    text='Nuevo Cliente', 
    command=nuevo_cliente,
    bootstyle="success"  # Verde para nuevo
)
btn_nuevo.pack(side=LEFT, padx=5)

btn_editar = ttkb.Button(
    button_frame, 
    text='Editar Cliente', 
    command=editar_cliente,
    bootstyle="warning"  # Amarillo para editar
)
btn_editar.pack(side=LEFT, padx=5)

btn_eliminar = ttkb.Button(
    button_frame, 
    text='Eliminar Cliente', 
    command=eliminar_cliente,
    bootstyle="danger"  # Rojo para eliminar
)
btn_eliminar.pack(side=LEFT, padx=5)

# TreeView frame (ajustar posición)
tree_frame = ttkb.Frame(root)
tree_frame.grid(row=1, column=0, columnspan=2, padx=10, pady=5, sticky='nsew')

# Configurar el grid de la ventana principal
root.grid_rowconfigure(1, weight=1)
root.grid_columnconfigure(0, weight=1)

# Crear el Treeview y la barra de desplazamiento
tree = ttkb.Treeview(tree_frame, height=15)  # height=15 hace el TreeView más alto
tree_scroll = ttkb.Scrollbar(tree_frame, orient="vertical", command=tree.yview)
tree.configure(yscrollcommand=tree_scroll.set)

# Configurar las columnas del TreeView
tree['columns'] = ('Nombre', 'Telefono', 'Empresa', 'Email')
tree.column('#0', width=0, stretch=NO)
tree.column('Nombre', width=200)
tree.column('Telefono', width=150)
tree.column('Empresa', width=200)
tree.column('Email', width=200)

tree.heading('#0')
tree.heading('Nombre', text='Nombre')
tree.heading('Telefono', text='Telefono')
tree.heading('Empresa', text='Empresa')
tree.heading('Email', text='Email')

# Colocar el TreeView y la barra de desplazamiento
tree.grid(row=0, column=0, sticky='nsew')
tree_scroll.grid(row=0, column=1, sticky='ns')

# Configurar el grid del frame para que el TreeView se expanda
tree_frame.grid_rowconfigure(0, weight=1)
tree_frame.grid_columnconfigure(0, weight=1)

# Ajustar posición y espaciado de los créditos
credits_frame = ttkb.Frame(root)
credits_frame.grid(row=2, column=0, columnspan=2, pady=(5,10))

# Etiqueta con los créditos y el ícono de corazón
credits_label = ttkb.Label(
    credits_frame, 
    text="Hecho con ❤️ por franHR",
    font=("Helvetica", 10),
    bootstyle="secondary"
)
credits_label.pack()

render_clientes()
root.mainloop()