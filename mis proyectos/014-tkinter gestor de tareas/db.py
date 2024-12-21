# Importación de módulos necesarios
import ttkbootstrap as ttk
from ttkbootstrap.constants import *
import sqlite3  # Para manejar la base de datos SQLite
from tkcalendar import Calendar
from datetime import datetime
from ttkbootstrap import DateEntry
import time
import os  # Añadir al inicio con las otras importaciones

# Crear la ventana principal con tema Bootstrap
root = ttk.Window(themename="cosmo")
root.title('Gestor de Tareas')
root.geometry('700x600')

# Configuración de la base de datos
def init_db():
    """Inicializa la base de datos si no existe"""
    # Obtener la ruta del directorio actual donde está el script
    current_dir = os.path.dirname(os.path.abspath(__file__))
    # Crear la ruta completa para la base de datos
    db_path = os.path.join(current_dir, 'data', 'gestor.db')
    
    # Crear el directorio data si no existe
    os.makedirs(os.path.dirname(db_path), exist_ok=True)
    
    # Conectar a la base de datos en la nueva ubicación
    conn = sqlite3.connect(db_path)
    c = conn.cursor()
    
    # Crear tabla si no existe
    c.execute('''
        CREATE TABLE IF NOT EXISTS tareas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            description TEXT NOT NULL,
            completed BOOLEAN NOT NULL,
            due_date DATE,
            due_time TIME
        )
    ''')
    conn.commit()
    return conn, c

# Inicializar la conexión a la base de datos
conn, c = init_db()

# Agregar función para cerrar la base de datos correctamente
def on_closing():
    """Función para manejar el cierre de la aplicación"""
    if conn:
        conn.commit()  # Guardar cambios pendientes
        conn.close()   # Cerrar conexión
    root.destroy()     # Cerrar ventana

# Vincular el evento de cierre
root.protocol("WM_DELETE_WINDOW", on_closing)

# Modificar las funciones de manejo de tareas
def remove(id):
    def _remove():
        c.execute('DELETE FROM tareas WHERE id = ?', (id, ))
        conn.commit()
        # Actualizar vista manteniendo el filtro actual
        filter_by_date(cal.entry.get())
    return _remove

def complete(id):
    def _complete():
        todo = c.execute('SELECT * FROM tareas WHERE id = ?', (id, )).fetchone()
        c.execute('UPDATE tareas SET completed = ? WHERE id = ?', (not todo[3], id))
        conn.commit()
        # Actualizar vista manteniendo el filtro actual
        filter_by_date(cal.entry.get())
    return _complete

def remove_completed():
    c.execute('DELETE FROM tareas WHERE completed = ?', (True, ))
    conn.commit()
    # Actualizar vista manteniendo el filtro actual
    filter_by_date(cal.entry.get())

def toggle_all():
    todo = c.execute('SELECT completed FROM tareas LIMIT 1').fetchone()
    if todo:
        new_state = not todo[0]
        c.execute('UPDATE tareas SET completed = ?', (new_state,))
        conn.commit()
        # Actualizar vista manteniendo el filtro actual
        filter_by_date(cal.entry.get())

def addTodo():
    todo = e.get()
    if todo:
        selected_date = cal.entry.get()
        selected_time = f"{hour_spinbox.get()}:{minute_spinbox.get()}"
        
        c.execute("""
            INSERT INTO tareas (description, completed, due_date, due_time) 
            VALUES (?, ?, ?, ?)
        """, (todo, False, selected_date, selected_time))
        conn.commit()
        e.delete(0, END)
        # Actualizar vista manteniendo el filtro actual
        filter_by_date(selected_date)
    else:
        print('No hay tarea')

# Añadir variables globales para la paginación
TASKS_PER_PAGE = 10  # Aumentado de 5 a 10 tareas por página
current_page = 1
total_pages = 1
current_rows = []  # Añadir variable para mantener las filas actuales

# Añadir funciones de paginación
def update_pagination_info(total_rows):
    """Actualiza la información de paginación"""
    global total_pages, current_page, current_rows
    current_rows = total_rows.copy()  # Hacer una copia para evitar referencias
    total_items = len(total_rows)
    total_pages = max(1, (total_items + TASKS_PER_PAGE - 1) // TASKS_PER_PAGE)
    
    # Asegurar que current_page esté en rango válido
    current_page = max(1, min(current_page, total_pages))
    
    # Actualizar la etiqueta de paginación y estado de botones
    update_pagination_display(total_items)

def update_pagination_display(total_items):
    """Actualiza la visualización de la paginación"""
    if total_items == 0:
        pagination_label.configure(text='No hay tareas')
        prev_btn.configure(state='disabled')
        next_btn.configure(state='disabled')
    else:
        pagination_label.configure(
            text=f'Página {current_page} de {total_pages} ({total_items} tareas)'
        )
        # Actualizar estado de los botones
        prev_btn.configure(state='normal' if current_page > 1 else 'disabled')
        next_btn.configure(state='normal' if current_page < total_pages else 'disabled')

def next_page():
    """Avanza a la siguiente página"""
    global current_page
    if current_page < total_pages:
        current_page += 1
        render_todos(current_rows, False)

def prev_page():
    """Retrocede a la página anterior"""
    global current_page
    if current_page > 1:
        current_page -= 1
        render_todos(current_rows, False)

def update_navigation_buttons():
    """Actualiza el estado de los botones de navegación"""
    prev_btn.configure(state=('normal' if current_page > 1 else 'disabled'))
    next_btn.configure(state=('normal' if current_page < total_pages else 'disabled'))

# Modificar la función filter_by_date para mejorar el filtrado
def filter_by_date(date=None):
    """Filtra las tareas por fecha"""
    global current_page
    current_page = 1  # Reset a la primera página al filtrar
    
    if date and date.strip():
        query = '''
            SELECT * FROM tareas 
            WHERE strftime('%Y-%m-%d', due_date) = strftime('%Y-%m-%d', ?)
            ORDER BY due_time
        '''
        rows = c.execute(query, (date,)).fetchall()
    else:
        rows = c.execute('SELECT * FROM tareas ORDER BY due_date, due_time').fetchall()
    render_todos(rows, True)  # Actualizar paginación

# Modificar la función on_date_change para ser más robusta
def on_date_change(event=None):
    """Manejador del evento de cambio de fecha"""
    selected_date = cal.entry.get()
    if selected_date:
        print("Fecha seleccionada:", selected_date)  # Debug
        filter_by_date(selected_date)

def show_all_tasks():
    """Muestra todas las tareas sin filtrar"""
    filter_by_date()

# Modificar la función render_todos para aceptar las filas como parámetro
def render_todos(rows=None, update_pagination=True):
    """
    Renderiza las tareas con paginación
    :param rows: Lista de tareas a mostrar
    :param update_pagination: Si se debe actualizar la información de paginación
    """
    if rows is None:
        rows = c.execute('SELECT * FROM tareas ORDER BY due_date, due_time').fetchall()
    
    if update_pagination:
        update_pagination_info(rows)
    else:
        # Actualizar solo la visualización sin resetear la paginación
        update_pagination_display(len(current_rows))
    
    # Calcular índices para la página actual
    start_idx = (current_page - 1) * TASKS_PER_PAGE
    end_idx = min(start_idx + TASKS_PER_PAGE, len(rows))  # Asegurar que no exceda el límite
    page_rows = rows[start_idx:end_idx]
    
    # Limpiar el frame antes de renderizar
    for widget in frame.winfo_children():
        widget.destroy()
    
    # Crear frame con estilo para las tareas
    style_frame = ttk.Frame(frame)
    style_frame.pack(fill='both', expand=True)
    
    if not page_rows:
        # Mostrar mensaje si no hay tareas
        no_tasks_label = ttk.Label(style_frame,
                                 text="No hay tareas para mostrar",
                                 bootstyle="secondary")
        no_tasks_label.pack(pady=20)
        return

    # Crear widgets para cada tarea en la página actual
    for row in page_rows:
        id, created, description, completed, due_date, due_time = row
        
        task_frame = ttk.Frame(style_frame)
        task_frame.pack(fill='x', padx=5, pady=2)
        
        # Formatear fecha y hora para mostrar
        date_str = f"📅 {due_date}" if due_date else ""
        time_str = f"⏰ {due_time}" if due_time else ""
        
        # Crear checkbox con fecha y hora
        full_text = f"{description} {date_str} {time_str}"
        l = ttk.Checkbutton(task_frame, 
                           text=full_text,
                           command=complete(id),
                           bootstyle="primary-round-toggle")
        l.pack(side=LEFT, padx=(10, 0))
        
        # Crear botón de eliminar
        btn = ttk.Button(task_frame, text='Eliminar',
                        command=remove(id),
                        bootstyle="danger-outline")
        btn.pack(side=RIGHT, padx=5)
        
        if completed:
            l.state(['selected'])

# Crear un frame principal que contenga todo
main_container = ttk.Frame(root)
main_container.pack(fill=BOTH, expand=True, padx=20, pady=10)

# Título
title_label = ttk.Label(main_container, 
                       text='GESTOR DE TAREAS',
                       font=('Helvetica', 16, 'bold'),
                       bootstyle="primary")
title_label.pack(pady=(0, 20))

# Frame para calendario y hora
datetime_frame = ttk.Frame(main_container)
datetime_frame.pack(fill=X, pady=(0, 10))

# Añadir nueva función para el botón de filtro
def apply_filter():
    """Aplica el filtro de fecha manualmente"""
    selected_date = cal.entry.get()
    if selected_date:
        filter_by_date(selected_date)
    else:
        print("Selecciona una fecha primero")

# Modificar la clase CustomDateEntry para no filtrar automáticamente
class CustomDateEntry(ttk.DateEntry):
    def _on_date_selected(self, *args):
        """Se llama cuando se selecciona una fecha"""
        super()._on_date_selected(*args)
        # Ya no filtramos aquí automáticamente

# Usar la clase personalizada para el calendario
cal = CustomDateEntry(
    datetime_frame,
    bootstyle="primary",
    firstweekday=0,
    dateformat="%Y-%m-%d",
    width=12,
    startdate=datetime.now()
)
cal.pack(side=LEFT, padx=5)

# Añadir botón de filtro
filter_btn = ttk.Button(datetime_frame,
                       text='Filtrar',
                       command=apply_filter,
                       bootstyle="info")
filter_btn.pack(side=LEFT, padx=5)

# Añadir botón para mostrar todas las tareas (después del frame de fecha y hora)
show_all_btn = ttk.Button(datetime_frame,
                         text='Mostrar Todo',
                         command=show_all_tasks,
                         bootstyle="secondary-outline")
show_all_btn.pack(side=RIGHT, padx=5)

# Frame para la hora
time_frame = ttk.Frame(datetime_frame)
time_frame.pack(side=LEFT, padx=5)

# Spinboxes para hora y minutos
hour_spinbox = ttk.Spinbox(time_frame,
                          from_=0,
                          to=23,
                          width=3,
                          format="%02.0f")
hour_spinbox.set('12')
hour_spinbox.pack(side=LEFT)

ttk.Label(time_frame, text=':').pack(side=LEFT)

minute_spinbox = ttk.Spinbox(time_frame,
                            from_=0,
                            to=59,
                            width=3,
                            format="%02.0f")
minute_spinbox.set('00')
minute_spinbox.pack(side=LEFT)

# Frame para la entrada de nuevas tareas
input_frame = ttk.Frame(main_container)
input_frame.pack(fill=X, pady=(0, 20))

l = ttk.Label(input_frame, 
              text='Nueva Tarea:',
              font=('Helvetica', 11))
l.pack(side=LEFT, padx=(0, 5))

e = ttk.Entry(input_frame, 
              width=50,
              font=('Helvetica', 11))
e.pack(side=LEFT, padx=5, fill=X, expand=True)

btn = ttk.Button(input_frame, 
                 text='Agregar',
                 command=addTodo,
                 bootstyle="primary")
btn.pack(side=LEFT, padx=(5, 0))

# Frame principal para la lista de tareas
frame = ttk.Labelframe(main_container, 
                      text='Mis Tareas',
                      padding=10,
                      bootstyle="default")
frame.pack(fill=BOTH, expand=True, pady=(0, 10))

# Añadir frame para la paginación (después del frame principal de tareas)
pagination_frame = ttk.Frame(main_container)
pagination_frame.pack(fill=X, pady=(0, 10))

# Botones de navegación y etiqueta de página
prev_btn = ttk.Button(
    pagination_frame,
    text='← Anterior',
    command=prev_page,
    bootstyle="secondary-outline",
    state='disabled'  # Estado inicial
)
prev_btn.pack(side=LEFT, padx=5)

pagination_label = ttk.Label(pagination_frame,
                           text='Página 1 de 1',
                           bootstyle="secondary")
pagination_label.pack(side=LEFT, expand=True)

next_btn = ttk.Button(pagination_frame,
                      text='Siguiente →',
                      command=next_page,
                      bootstyle="secondary-outline")
next_btn.pack(side=RIGHT, padx=5)

# Frame para botones de acción
action_frame = ttk.Frame(main_container)
action_frame.pack(fill=X, pady=(0, 10))

# Botón para eliminar tareas completadas
delete_completed_btn = ttk.Button(action_frame,
                                text='Eliminar Completadas',
                                command=remove_completed,
                                bootstyle="danger")
delete_completed_btn.pack(side=LEFT, padx=5)

# Botón para seleccionar/deseleccionar todas las tareas
select_all_btn = ttk.Button(action_frame,
                           text='Seleccionar Todas',
                           command=toggle_all,
                           bootstyle="info")
select_all_btn.pack(side=LEFT, padx=5)

# Frame para los créditos
credits_frame = ttk.Frame(main_container)
credits_frame.pack(fill=X, pady=(0, 5))

credits_label = ttk.Label(credits_frame, 
                         text='Hecho con ♥ por franHR',
                         font=('Helvetica', 9),
                         bootstyle="secondary")
credits_label.pack()

# Eliminar configuración anterior del grid ya que usamos pack
# root.grid_rowconfigure(2, weight=1)
# root.grid_columnconfigure(0, weight=1)

# Configuración final
if __name__ == "__main__":
    e.focus()  # Poner el foco en el campo de entrada
    root.bind('<Return>', lambda x: addTodo())
    render_todos()
    root.mainloop()