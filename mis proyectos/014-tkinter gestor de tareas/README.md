# Gestor de Tareas

Una aplicación de escritorio simple para gestionar tareas diarias, desarrollada con Python y Tkinter.

## Características

- Añadir nuevas tareas
- Marcar tareas como completadas
- Eliminar tareas individuales
- Eliminar todas las tareas completadas
- Seleccionar/deseleccionar todas las tareas
- Interfaz gráfica moderna y fácil de usar
- Almacenamiento persistente con SQLite

## Requisitos Previos

- Python 3.x instalado
- Tkinter (viene incluido con la mayoría de las instalaciones de Python)
- SQLite3 (viene incluido con Python)

## Instalación

1. Clona o descarga este repositorio
2. Navega hasta el directorio del proyecto
3. (Opcional) Crea un entorno virtual:
   ```bash
   python -m venv venv
   source venv/bin/activate  # En Windows: venv\Scripts\activate
   ```
4. Instala las dependencias:
   ```bash
   pip install -r requirements.txt
   ```

## Uso

1. Ejecuta el script:
   ```bash
   python db.py
   ```

2. La aplicación se abrirá mostrando la interfaz del gestor de tareas

3. Para usar la aplicación:
   - Escribe una tarea en el campo de texto y presiona "Agregar" o Enter
   - Marca las tareas como completadas usando los checkboxes
   - Elimina tareas individuales con el botón "Eliminar"
   - Usa "Seleccionar Todas" para marcar/desmarcar todas las tareas
   - Usa "Eliminar Completadas" para eliminar todas las tareas marcadas

## Estructura de Archivos

- `db.py`: Script principal de la aplicación
- `gestor.db`: Base de datos SQLite (se crea automáticamente)
- `requirements.txt`: Lista de dependencias
- `README.md`: Este archivo


## Creado por franHR
