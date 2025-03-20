import tkinter as tk
from tkinter import ttk, filedialog, messagebox, simpledialog
import mysql.connector
import sqlite3
import json
import os
import pandas as pd
from tkinter.scrolledtext import ScrolledText
import re

class DatabaseAnalyzer(tk.Tk):
    def __init__(self):
        super().__init__()
        self.title("Analizador de Bases de Datos")
        self.geometry("1200x800")
        self.minsize(800, 600)
        
        # Variables
        self.connection = None
        self.db_type = tk.StringVar(value="mysql")
        self.db_info = {}
        self.current_db = ""
        
        # Estilo
        self.style = ttk.Style()
        self.style.theme_use('clam')
        
        # Crear interfaz
        self.create_widgets()
        
    def create_widgets(self):
        # Frame principal
        main_frame = ttk.Frame(self)
        main_frame.pack(fill=tk.BOTH, expand=True, padx=10, pady=10)
        
        # Panel izquierdo - Conexión
        left_frame = ttk.LabelFrame(main_frame, text="Conexión")
        left_frame.pack(side=tk.LEFT, fill=tk.Y, expand=False, padx=5, pady=5)
        
        # Opciones de tipo de base de datos
        ttk.Label(left_frame, text="Tipo de base de datos:").pack(anchor=tk.W, padx=5, pady=5)
        ttk.Radiobutton(left_frame, text="MySQL", variable=self.db_type, value="mysql").pack(anchor=tk.W, padx=5)
        ttk.Radiobutton(left_frame, text="SQLite", variable=self.db_type, value="sqlite").pack(anchor=tk.W, padx=5, pady=5)
        
        # Parámetros MySQL
        self.mysql_frame = ttk.LabelFrame(left_frame, text="MySQL Connection")
        self.mysql_frame.pack(fill=tk.X, padx=5, pady=5)
        
        ttk.Label(self.mysql_frame, text="Host:").grid(row=0, column=0, sticky=tk.W, padx=5, pady=2)
        self.host_entry = ttk.Entry(self.mysql_frame, width=20)
        self.host_entry.grid(row=0, column=1, padx=5, pady=2)
        self.host_entry.insert(0, "localhost")
        
        ttk.Label(self.mysql_frame, text="Puerto:").grid(row=1, column=0, sticky=tk.W, padx=5, pady=2)
        self.port_entry = ttk.Entry(self.mysql_frame, width=20)
        self.port_entry.grid(row=1, column=1, padx=5, pady=2)
        self.port_entry.insert(0, "3306")
        
        ttk.Label(self.mysql_frame, text="Usuario:").grid(row=2, column=0, sticky=tk.W, padx=5, pady=2)
        self.user_entry = ttk.Entry(self.mysql_frame, width=20)
        self.user_entry.grid(row=2, column=1, padx=5, pady=2)
        self.user_entry.insert(0, "root")
        
        ttk.Label(self.mysql_frame, text="Contraseña:").grid(row=3, column=0, sticky=tk.W, padx=5, pady=2)
        self.password_entry = ttk.Entry(self.mysql_frame, width=20, show="*")
        self.password_entry.grid(row=3, column=1, padx=5, pady=2)
        
        ttk.Label(self.mysql_frame, text="Base de datos:").grid(row=4, column=0, sticky=tk.W, padx=5, pady=2)
        self.database_entry = ttk.Entry(self.mysql_frame, width=20)
        self.database_entry.grid(row=4, column=1, padx=5, pady=2)
        
        # Botón para importar archivo SQL de MySQL
        ttk.Button(self.mysql_frame, text="Importar SQL", command=self.import_mysql_sql).grid(row=5, column=0, columnspan=2, padx=5, pady=5, sticky=tk.EW)
        
        # SQLite Frame
        self.sqlite_frame = ttk.LabelFrame(left_frame, text="SQLite Connection")
        self.sqlite_frame.pack(fill=tk.X, padx=5, pady=5)
        
        ttk.Label(self.sqlite_frame, text="Archivo DB:").grid(row=0, column=0, sticky=tk.W, padx=5, pady=2)
        self.sqlite_path = ttk.Entry(self.sqlite_frame, width=20)
        self.sqlite_path.grid(row=0, column=1, padx=5, pady=2)
        
        ttk.Button(self.sqlite_frame, text="Buscar", command=self.browse_sqlite_file).grid(row=0, column=2, padx=5, pady=2)
        
        # Botones de acción
        button_frame = ttk.Frame(left_frame)
        button_frame.pack(fill=tk.X, padx=5, pady=15)
        
        ttk.Button(button_frame, text="Conectar", command=self.connect_database).pack(fill=tk.X, pady=2)
        ttk.Button(button_frame, text="Analizar DB", command=self.analyze_database).pack(fill=tk.X, pady=2)
        
        # Exportar
        export_frame = ttk.LabelFrame(left_frame, text="Exportar")
        export_frame.pack(fill=tk.X, padx=5, pady=5)
        
        ttk.Button(export_frame, text="Exportar a JSON", command=lambda: self.export_data("json")).pack(fill=tk.X, pady=2)
        ttk.Button(export_frame, text="Exportar a HTML", command=lambda: self.export_data("html")).pack(fill=tk.X, pady=2)
        ttk.Button(export_frame, text="Exportar a TXT", command=lambda: self.export_data("txt")).pack(fill=tk.X, pady=2)
        ttk.Button(export_frame, text="Exportar a Markdown", command=lambda: self.export_data("md")).pack(fill=tk.X, pady=2)
        
        # Panel derecho - Resultados
        right_frame = ttk.Frame(main_frame)
        right_frame.pack(side=tk.RIGHT, fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        # Notebook para las pestañas
        self.notebook = ttk.Notebook(right_frame)
        self.notebook.pack(fill=tk.BOTH, expand=True)
        
        # Pestaña de resultados
        self.result_tab = ttk.Frame(self.notebook)
        self.notebook.add(self.result_tab, text="Resultados")
        
        # Área de texto con desplazamiento
        self.result_text = ScrolledText(self.result_tab, wrap=tk.WORD, width=80, height=30)
        self.result_text.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        # Pestaña de SQL
        self.sql_tab = ttk.Frame(self.notebook)
        self.notebook.add(self.sql_tab, text="SQL")
        
        self.sql_text = ScrolledText(self.sql_tab, wrap=tk.WORD, width=80, height=30)
        self.sql_text.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        # Añadir pestaña de importación
        self.import_tab = ttk.Frame(self.notebook)
        self.notebook.add(self.import_tab, text="Importación")
        
        self.import_text = ScrolledText(self.import_tab, wrap=tk.WORD, width=80, height=30)
        self.import_text.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)
    
    def browse_sqlite_file(self):
        filename = filedialog.askopenfilename(title="Seleccionar archivo SQLite",
                                            filetypes=(("SQLite files", "*.db *.sqlite *.sqlite3"), 
                                                      ("All files", "*.*")))
        if filename:
            self.sqlite_path.delete(0, tk.END)
            self.sqlite_path.insert(0, filename)
    
    def import_mysql_sql(self):
        """Importar archivo SQL de MySQL"""
        # Seleccionar archivo SQL
        sql_file = filedialog.askopenfilename(
            title="Seleccionar archivo SQL de MySQL",
            filetypes=(("SQL files", "*.sql"), ("All files", "*.*"))
        )
        
        if not sql_file:
            return
        
        # Verificar campos MySQL
        host = self.host_entry.get() or "localhost"
        port = self.port_entry.get() or "3306"
        user = self.user_entry.get() or "root"
        password = self.password_entry.get()
        database = self.database_entry.get()
        
        if not database:
            # Solicitar nombre de base de datos si no está especificado
            database = simpledialog.askstring("Base de datos", "Introduce el nombre de la base de datos a crear/usar:", 
                                             initialvalue="importacion_sql")
            if not database:
                messagebox.showerror("Error", "Se requiere un nombre de base de datos para la importación")
                return
            # Actualizar el campo en la interfaz
            self.database_entry.delete(0, tk.END)
            self.database_entry.insert(0, database)
        
        try:
            # Limpiar el área de importación
            self.import_text.delete(1.0, tk.END)
            self.import_text.insert(tk.END, f"Importando archivo SQL: {sql_file}\n\n")
            self.import_text.insert(tk.END, f"Usando conexión: {user}@{host}:{port}, Base de datos: {database}\n\n")
            
            # Leer el archivo SQL
            with open(sql_file, 'r', encoding='utf-8') as f:
                sql_content = f.read()
            
            # Cambiar a la pestaña de importación
            self.notebook.select(self.import_tab)
            
            # Conexión a MySQL
            try:
                conn = mysql.connector.connect(
                    host=host,
                    port=int(port),
                    user=user,
                    password=password
                )
                cursor = conn.cursor()
                
                # Verificar si la base de datos existe, si no, crearla
                cursor.execute(f"CREATE DATABASE IF NOT EXISTS `{database}`")
                cursor.execute(f"USE `{database}`")
                
                # Dividir el contenido SQL en consultas individuales
                # Este es un enfoque básico, puede requerir ajustes según la complejidad del archivo SQL
                queries = self.split_sql_statements(sql_content)
                
                # Ejecutar cada consulta
                executed = 0
                for i, query in enumerate(queries):
                    if query.strip():
                        try:
                            self.import_text.insert(tk.END, f"Ejecutando consulta {i+1}...\n")
                            cursor.execute(query)
                            executed += 1
                        except Exception as e:
                            self.import_text.insert(tk.END, f"Error en consulta {i+1}: {str(e)}\n")
                            self.import_text.insert(tk.END, f"Consulta: {query[:100]}...\n\n")
                
                conn.commit()
                self.import_text.insert(tk.END, f"\nImportación completada. {executed} consultas ejecutadas correctamente.\n")
                
                # Actualizar la conexión actual si es necesario
                self.current_db = database
                if self.connection:
                    self.connection.close()
                self.connection = conn
                
                messagebox.showinfo("Éxito", f"Archivo SQL importado correctamente en la base de datos '{database}'")
                
            except Exception as e:
                self.import_text.insert(tk.END, f"Error de conexión: {str(e)}\n")
                messagebox.showerror("Error de importación", str(e))
            
        except Exception as e:
            messagebox.showerror("Error al leer archivo", str(e))
    
    def split_sql_statements(self, sql_content):
        """Divide un archivo SQL en consultas individuales"""
        # Eliminar comentarios
        sql_content = re.sub(r'--.*?\n', '\n', sql_content)
        sql_content = re.sub(r'/\*.*?\*/', '', sql_content, flags=re.DOTALL)
        
        # Dividir por punto y coma no dentro de comillas
        queries = []
        buffer = ""
        in_string = False
        in_backtick = False
        delimiter = ";"
        
        # Buscar delimiter personalizado
        delimiter_match = re.search(r'DELIMITER\s+([^\s]+)', sql_content)
        if delimiter_match:
            custom_delimiter = delimiter_match.group(1)
            # Si encontramos un delimiter personalizado, primero dividimos por DELIMITER
            sections = re.split(r'(DELIMITER\s+[^\s]+)', sql_content)
            processed_sections = []
            
            current_delimiter = ";"
            for section in sections:
                if section.strip().startswith("DELIMITER"):
                    dlm_match = re.search(r'DELIMITER\s+([^\s]+)', section)
                    if dlm_match:
                        current_delimiter = dlm_match.group(1)
                    processed_sections.append("")  # No incluimos la línea DELIMITER
                else:
                    # Dividir esta sección según el delimitador actual
                    if current_delimiter == ";":
                        processed_sections.append(section)
                    else:
                        # Dividir por el delimitador personalizado y cambiar de nuevo a ";"
                        subsections = section.split(current_delimiter)
                        for i, subsection in enumerate(subsections):
                            if i < len(subsections) - 1:
                                processed_sections.append(subsection + ";")  # Reemplazar delimitador personalizado por ";"
                            else:
                                processed_sections.append(subsection)
                        current_delimiter = ";"
            
            # Unir todas las secciones procesadas
            sql_content = "".join(processed_sections)
        
        # Ahora dividir por ";" normalmente
        for char in sql_content:
            if char == "'" and not in_backtick:
                in_string = not in_string
            elif char == "`" and not in_string:
                in_backtick = not in_backtick
            
            buffer += char
            
            if char == delimiter and not in_string and not in_backtick:
                queries.append(buffer.strip())
                buffer = ""
        
        # Añadir cualquier consulta restante
        if buffer.strip():
            queries.append(buffer.strip())
        
        return queries
        
    def connect_database(self):
        try:
            if self.connection:
                self.connection.close()
                self.connection = None
            
            db_type = self.db_type.get()
            
            if db_type == "mysql":
                host = self.host_entry.get()
                port = int(self.port_entry.get())
                user = self.user_entry.get()
                password = self.password_entry.get()
                database = self.database_entry.get()
                
                if not all([host, port, user, database]):
                    messagebox.showerror("Error", "Completa todos los campos requeridos para MySQL")
                    return
                
                self.connection = mysql.connector.connect(
                    host=host,
                    port=port,
                    user=user,
                    password=password,
                    database=database
                )
                self.current_db = database
                
            elif db_type == "sqlite":
                db_path = self.sqlite_path.get()
                
                if not db_path:
                    messagebox.showerror("Error", "Selecciona un archivo SQLite")
                    return
                
                self.connection = sqlite3.connect(db_path)
                self.current_db = os.path.basename(db_path)
            
            messagebox.showinfo("Éxito", f"Conexión exitosa a {db_type}")
        
        except Exception as e:
            messagebox.showerror("Error de conexión", str(e))
    
    def analyze_database(self):
        if not self.connection:
            messagebox.showerror("Error", "Primero debes conectarte a una base de datos")
            return
        
        try:
            db_type = self.db_type.get()
            self.db_info = {
                "database_name": self.current_db,
                "database_type": db_type,
                "tables": {}
            }
            
            # Obtener todas las tablas
            tables = self.get_tables(db_type)
            
            # Analizar cada tabla
            for table in tables:
                table_info = {
                    "columns": [],
                    "primary_keys": [],
                    "foreign_keys": [],
                    "sample_data": [],
                    "create_statement": ""
                }
                
                # Obtener estructura de columnas
                table_info["columns"] = self.get_columns(db_type, table)
                
                # Obtener claves primarias
                table_info["primary_keys"] = self.get_primary_keys(db_type, table)
                
                # Obtener claves foráneas
                table_info["foreign_keys"] = self.get_foreign_keys(db_type, table)
                
                # Obtener datos de muestra (5 filas)
                table_info["sample_data"] = self.get_sample_data(table)
                
                # Obtener sentencia CREATE
                table_info["create_statement"] = self.get_create_statement(db_type, table)
                
                # Guardar info de la tabla
                self.db_info["tables"][table] = table_info
            
            # Mostrar resultados
            self.display_results()
            
            # Generar SQL
            self.generate_sql()
            
            messagebox.showinfo("Éxito", "Análisis completado correctamente")
            
        except Exception as e:
            messagebox.showerror("Error de análisis", str(e))
    
    def get_tables(self, db_type):
        cursor = self.connection.cursor()
        tables = []
        
        if db_type == "mysql":
            cursor.execute("SHOW TABLES")
            for table in cursor:
                tables.append(table[0])
        
        elif db_type == "sqlite":
            cursor.execute("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")
            for table in cursor:
                tables.append(table[0])
        
        cursor.close()
        return tables
    
    def get_columns(self, db_type, table):
        cursor = self.connection.cursor()
        columns = []
        
        if db_type == "mysql":
            cursor.execute(f"DESCRIBE `{table}`")
            for column in cursor:
                columns.append({
                    "name": column[0],
                    "type": column[1],
                    "nullable": "YES" if column[2] == "YES" else "NO",
                    "key": column[3],
                    "default": column[4],
                    "extra": column[5]
                })
        
        elif db_type == "sqlite":
            cursor.execute(f"PRAGMA table_info(`{table}`)")
            for column in cursor:
                columns.append({
                    "name": column[1],
                    "type": column[2],
                    "nullable": "NO" if column[3] == 1 else "YES",
                    "key": "PRI" if column[5] == 1 else "",
                    "default": column[4],
                    "extra": ""
                })
        
        cursor.close()
        return columns
    
    def get_primary_keys(self, db_type, table):
        cursor = self.connection.cursor()
        primary_keys = []
        
        try:
            if db_type == "mysql":
                cursor.execute(f"""
                    SELECT COLUMN_NAME
                    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                    WHERE TABLE_SCHEMA = '{self.current_db}'
                    AND TABLE_NAME = '{table}'
                    AND CONSTRAINT_NAME = 'PRIMARY'
                """)
                for pk in cursor:
                    primary_keys.append(pk[0])
            
            elif db_type == "sqlite":
                cursor.execute(f"PRAGMA table_info(`{table}`)")
                for column in cursor:
                    if column[5] == 1:  # pk flag
                        primary_keys.append(column[1])
        except:
            pass  # Algunas bases de datos pueden no soportar estas consultas
        
        cursor.close()
        return primary_keys
    
    def get_foreign_keys(self, db_type, table):
        cursor = self.connection.cursor()
        foreign_keys = []
        
        try:
            if db_type == "mysql":
                cursor.execute(f"""
                    SELECT
                        COLUMN_NAME,
                        REFERENCED_TABLE_NAME,
                        REFERENCED_COLUMN_NAME
                    FROM
                        INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                    WHERE
                        TABLE_SCHEMA = '{self.current_db}'
                        AND TABLE_NAME = '{table}'
                        AND REFERENCED_TABLE_NAME IS NOT NULL
                """)
                for fk in cursor:
                    foreign_keys.append({
                        "column": fk[0],
                        "referenced_table": fk[1],
                        "referenced_column": fk[2]
                    })
            
            elif db_type == "sqlite":
                cursor.execute(f"PRAGMA foreign_key_list(`{table}`)")
                for fk in cursor:
                    foreign_keys.append({
                        "column": fk[3],
                        "referenced_table": fk[2],
                        "referenced_column": fk[4]
                    })
        except:
            pass  # Algunas bases de datos pueden no soportar estas consultas
        
        cursor.close()
        return foreign_keys
    
    def get_sample_data(self, table):
        cursor = self.connection.cursor()
        data = []
        
        try:
            cursor.execute(f"SELECT * FROM `{table}` LIMIT 5")
            columns = [desc[0] for desc in cursor.description]
            data.append(columns)
            
            for row in cursor:
                data.append([str(cell) for cell in row])
        except:
            pass
        
        cursor.close()
        return data
    
    def get_create_statement(self, db_type, table):
        cursor = self.connection.cursor()
        create_statement = ""
        
        try:
            if db_type == "mysql":
                cursor.execute(f"SHOW CREATE TABLE `{table}`")
                create_statement = cursor.fetchone()[1]
            
            elif db_type == "sqlite":
                cursor.execute(f"SELECT sql FROM sqlite_master WHERE type='table' AND name='{table}'")
                create_statement = cursor.fetchone()[0]
        except:
            create_statement = f"-- No se pudo obtener la sentencia CREATE para la tabla {table}"
        
        cursor.close()
        return create_statement
    
    def display_results(self):
        # Limpiar el área de resultados
        self.result_text.delete(1.0, tk.END)
        
        # Mostrar info de la base de datos
        self.result_text.insert(tk.END, f"# Análisis de la Base de Datos: {self.db_info['database_name']}\n\n")
        self.result_text.insert(tk.END, f"Tipo de Base de Datos: {self.db_info['database_type']}\n")
        self.result_text.insert(tk.END, f"Número de tablas: {len(self.db_info['tables'])}\n\n")
        
        # Mostrar info de cada tabla
        for table_name, table_info in self.db_info['tables'].items():
            self.result_text.insert(tk.END, f"## Tabla: {table_name}\n\n")
            
            # Columnas
            self.result_text.insert(tk.END, "### Estructura de Columnas\n\n")
            self.result_text.insert(tk.END, "| Columna | Tipo | Nullable | Key | Default | Extra |\n")
            self.result_text.insert(tk.END, "|---------|------|----------|-----|---------|-------|\n")
            
            for column in table_info['columns']:
                self.result_text.insert(tk.END, f"| {column['name']} | {column['type']} | {column['nullable']} | {column['key']} | {column['default'] or 'NULL'} | {column['extra']} |\n")
            
            self.result_text.insert(tk.END, "\n")
            
            # Claves Primarias
            if table_info['primary_keys']:
                self.result_text.insert(tk.END, "### Claves Primarias\n\n")
                for pk in table_info['primary_keys']:
                    self.result_text.insert(tk.END, f"- {pk}\n")
                
                self.result_text.insert(tk.END, "\n")
            
            # Claves Foráneas
            if table_info['foreign_keys']:
                self.result_text.insert(tk.END, "### Claves Foráneas\n\n")
                self.result_text.insert(tk.END, "| Columna | Tabla Referenciada | Columna Referenciada |\n")
                self.result_text.insert(tk.END, "|---------|-------------------|---------------------|\n")
                
                for fk in table_info['foreign_keys']:
                    self.result_text.insert(tk.END, f"| {fk['column']} | {fk['referenced_table']} | {fk['referenced_column']} |\n")
                
                self.result_text.insert(tk.END, "\n")
            
            # Datos de muestra
            if table_info['sample_data'] and len(table_info['sample_data']) > 1:
                self.result_text.insert(tk.END, "### Datos de Muestra\n\n")
                
                columns = table_info['sample_data'][0]
                header = "| " + " | ".join(columns) + " |\n"
                separator = "|" + "|".join(["---"] * len(columns)) + "|\n"
                
                self.result_text.insert(tk.END, header)
                self.result_text.insert(tk.END, separator)
                
                for row in table_info['sample_data'][1:]:
                    self.result_text.insert(tk.END, "| " + " | ".join(row) + " |\n")
                
                self.result_text.insert(tk.END, "\n")
            
            self.result_text.insert(tk.END, "---\n\n")
    
    def generate_sql(self):
        # Limpiar el área de SQL
        self.sql_text.delete(1.0, tk.END)
        
        # Generar sentencias CREATE TABLE
        self.sql_text.insert(tk.END, "-- Sentencias SQL para recrear la base de datos\n\n")
        
        for table_name, table_info in self.db_info['tables'].items():
            self.sql_text.insert(tk.END, f"-- Tabla: {table_name}\n")
            self.sql_text.insert(tk.END, f"{table_info['create_statement']};\n\n")
    
    def export_data(self, format_type):
        if not self.db_info:
            messagebox.showerror("Error", "Primero debes analizar una base de datos")
            return
        
        try:
            # Abrir diálogo para guardar archivo
            file_path = filedialog.asksaveasfilename(
                defaultextension=f".{format_type}",
                filetypes=[(f"{format_type.upper()} files", f"*.{format_type}"), ("All files", "*.*")]
            )
            
            if not file_path:
                return
            
            if format_type == "json":
                with open(file_path, 'w', encoding='utf-8') as f:
                    json.dump(self.db_info, f, indent=4, ensure_ascii=False)
            
            elif format_type == "html":
                html = self.generate_html()
                with open(file_path, 'w', encoding='utf-8') as f:
                    f.write(html)
            
            elif format_type == "txt" or format_type == "md":
                with open(file_path, 'w', encoding='utf-8') as f:
                    f.write(self.result_text.get(1.0, tk.END))
            
            messagebox.showinfo("Éxito", f"Datos exportados correctamente a {file_path}")
            
        except Exception as e:
            messagebox.showerror("Error al exportar", str(e))
    
    def generate_html(self):
        html = f"""<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis de Base de Datos: {self.db_info['database_name']}</title>
    <style>
        body {{ font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; color: #333; }}
        h1 {{ color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }}
        h2 {{ color: #2980b9; margin-top: 30px; }}
        h3 {{ color: #3498db; }}
        table {{ border-collapse: collapse; width: 100%; margin-bottom: 20px; }}
        th, td {{ padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }}
        th {{ background-color: #f2f2f2; }}
        tr:hover {{ background-color: #f5f5f5; }}
        .container {{ max-width: 1200px; margin: 0 auto; }}
        .table-info {{ margin-bottom: 40px; padding-bottom: 20px; border-bottom: 1px solid #eee; }}
        .sql-code {{ background-color: #f8f8f8; padding: 15px; border-radius: 5px; font-family: monospace; white-space: pre-wrap; }}
    </style>
</head>
<body>
    <div class="container">
        <h1>Análisis de Base de Datos: {self.db_info['database_name']}</h1>
        <p><strong>Tipo de Base de Datos:</strong> {self.db_info['database_type']}</p>
        <p><strong>Número de tablas:</strong> {len(self.db_info['tables'])}</p>
"""
        
        # Generar HTML para cada tabla
        for table_name, table_info in self.db_info['tables'].items():
            html += f"""
        <div class="table-info">
            <h2>Tabla: {table_name}</h2>
            
            <h3>Estructura de Columnas</h3>
            <table>
                <thead>
                    <tr>
                        <th>Columna</th>
                        <th>Tipo</th>
                        <th>Nullable</th>
                        <th>Key</th>
                        <th>Default</th>
                        <th>Extra</th>
                    </tr>
                </thead>
                <tbody>
"""
            
            for column in table_info['columns']:
                html += f"""
                    <tr>
                        <td>{column['name']}</td>
                        <td>{column['type']}</td>
                        <td>{column['nullable']}</td>
                        <td>{column['key']}</td>
                        <td>{column['default'] or 'NULL'}</td>
                        <td>{column['extra']}</td>
                    </tr>
"""
            
            html += """
                </tbody>
            </table>
"""
            
            # Claves Primarias
            if table_info['primary_keys']:
                html += """
            <h3>Claves Primarias</h3>
            <ul>
"""
                for pk in table_info['primary_keys']:
                    html += f"                <li>{pk}</li>\n"
                
                html += "            </ul>\n"
            
            # Claves Foráneas
            if table_info['foreign_keys']:
                html += """
            <h3>Claves Foráneas</h3>
            <table>
                <thead>
                    <tr>
                        <th>Columna</th>
                        <th>Tabla Referenciada</th>
                        <th>Columna Referenciada</th>
                    </tr>
                </thead>
                <tbody>
"""
                
                for fk in table_info['foreign_keys']:
                    html += f"""
                    <tr>
                        <td>{fk['column']}</td>
                        <td>{fk['referenced_table']}</td>
                        <td>{fk['referenced_column']}</td>
                    </tr>
"""
                
                html += """
                </tbody>
            </table>
"""
            
            # Datos de muestra
            if table_info['sample_data'] and len(table_info['sample_data']) > 1:
                html += """
            <h3>Datos de Muestra</h3>
            <table>
                <thead>
                    <tr>
"""
                
                for column in table_info['sample_data'][0]:
                    html += f"                        <th>{column}</th>\n"
                
                html += """
                    </tr>
                </thead>
                <tbody>
"""
                
                for row in table_info['sample_data'][1:]:
                    html += "                    <tr>\n"
                    for cell in row:
                        html += f"                        <td>{cell}</td>\n"
                    html += "                    </tr>\n"
                
                html += """
                </tbody>
            </table>
"""
            
            # SQL de creación
            html += f"""
            <h3>Sentencia SQL de Creación</h3>
            <div class="sql-code">{table_info['create_statement'].replace("<", "&lt;").replace(">", "&gt;")}</div>
        </div>
"""
        
        html += """
    </div>
</body>
</html>
"""
        
        return html

if __name__ == "__main__":
    app = DatabaseAnalyzer()
    app.mainloop()