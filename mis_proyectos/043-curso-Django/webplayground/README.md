# 🚀 WebPlayground: Plataforma Social Interactiva

## 📌 DESCRIPCIÓN DEL PROYECTO:
WebPlayground es una aplicación web desarrollada con Django que funciona como una plataforma social básica. Permite a los usuarios registrarse, crear perfiles, interactuar mediante mensajería interna y crear páginas de contenido personalizadas utilizando un editor de texto enriquecido.

Está pensado para usuarios que deseen tener un espacio personalizable en línea y conectarse con otros usuarios a través de mensajes privados. Comercialmente, puede servir como base para una red social nicho, una comunidad en línea o una plataforma de blogs interactiva.

## ✨ CARACTERÍSTICAS PRINCIPALES:
*   👤 **Gestión de Usuarios:** Registro, inicio y cierre de sesión.
*   🖼️ **Perfiles de Usuario:** Cada usuario tiene un perfil editable.
*   📝 **Creación de Páginas:** Los usuarios pueden crear y editar páginas de contenido utilizando el editor CKEditor 5.
*   💬 **Mensajería Interna:** Sistema de mensajes privados entre usuarios.
*   🔒 **Autenticación Segura:** Utiliza el sistema de autenticación de Django.
*   🎨 **Frontend Básico:** Interfaz limpia construida con Bootstrap y jQuery.
*   ⚙️ **Panel de Administración:** Interfaz de administración de Django para gestionar usuarios, páginas, etc.

## ⚙️ FUNCIONALIDADES:
El proyecto está estructurado en módulos (aplicaciones Django):
*   `core`: Funcionalidades centrales y página de inicio.
*   `registration`: Manejo del registro y autenticación de usuarios.
*   `profiles`: Gestión de los perfiles de usuario.
*   `pages`: Creación y gestión de las páginas de contenido estático/dinámico por usuario. Incluye integración con CKEditor 5.
*   `messenger`: Sistema de mensajería entre usuarios registrados.

## 🔧 TECNOLOGÍAS UTILIZADAS:
*   🐍 **Python:** Lenguaje principal de backend.
*   <0xF0><0x9F><0xAA><0x9A> **Django 5.2:** Framework web principal.
*   💾 **SQLite:** Base de datos por defecto para desarrollo.
*   📜 **HTML5:** Lenguaje de marcado para la estructura web.
*   🎨 **CSS3:** Hojas de estilo para el diseño.
*   ⚡ **JavaScript:** Para interactividad en el frontend.
*   📄 **CKEditor 5:** Editor de texto enriquecido para la creación de páginas.
*   🅱️ **Bootstrap:** Framework CSS para el diseño responsive.
*   💲 **jQuery:** Biblioteca JavaScript para simplificar la manipulación del DOM y AJAX.
*   📦 **pip & requirements.txt:** Gestión de dependencias de Python.

## 🧪 ESTRUCTURA DE ARCHIVOS Y CARPETAS:
El proyecto sigue la estructura estándar de Django:
*   `webplayground/`: Carpeta principal del proyecto (settings, urls globales).
*   `core/`, `registration/`, `profiles/`, `pages/`, `messenger/`: Aplicaciones Django modulares.
    *   Cada app contiene típicamente: `models.py`, `views.py`, `urls.py`, `admin.py`, `templates/`, `static/`.
*   `templates/`: Contiene las plantillas HTML base y específicas de cada app.
*   `static/`: Almacena archivos estáticos (CSS, JS, imágenes) globales y por app.
*   `media/`: Directorio donde se almacenan los archivos subidos por los usuarios (ej. imágenes de perfil).
*   `manage.py`: Script de utilidad de Django para tareas administrativas.
*   `db.sqlite3`: Archivo de la base de datos SQLite.
*   `requirements.txt`: Lista de dependencias Python.
*   `docs/`: Carpeta con documentación adicional (MEMORIAS.md, CONEXIONES_BD.md).

## 🛠️ INSTRUCCIONES DE USO:
1.  **Clonar el repositorio:**
    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd webplayground
    ```
2.  **Crear y activar un entorno virtual:** (Recomendado)
    ```bash
    python -m venv venv
    # Windows
    .\venv\Scripts\activate
    # macOS/Linux
    source venv/bin/activate
    ```
3.  **Instalar dependencias:**
    ```bash
    pip install -r requirements.txt
    ```
4.  **Aplicar migraciones de la base de datos:**
    ```bash
    python manage.py migrate
    ```
5.  **Crear un superusuario (administrador):**
    ```bash
    python manage.py createsuperuser
    ```
    (Sigue las instrucciones para crear el usuario)
6.  **Ejecutar el servidor de desarrollo:**
    ```bash
    python manage.py runserver
    ```
    El sitio estará disponible en `http://127.0.0.1:8000/`. El panel de administración está en `http://127.0.0.1:8000/admin/`.

7.  **Configuración de Email:**
    *   En `DEBUG = True` (desarrollo), los emails se guardan como archivos en la carpeta `sent_emails/` (definido en `settings.py`).
    *   Para producción (`DEBUG = False`), necesitas configurar las variables de entorno o `settings.py` con los detalles de tu servidor SMTP (EMAIL_HOST, EMAIL_PORT, EMAIL_USE_TLS, EMAIL_HOST_USER, EMAIL_HOST_PASSWORD).

## 📝 EJEMPLO DE USO (Opcional):
*   Accede a `http://127.0.0.1:8000/` para ver la página principal.
*   Regístrate o inicia sesión a través de los enlaces correspondientes.
*   Visita la sección de perfiles para ver y editar tu perfil.
*   Navega a la sección de páginas para crear tu propia página.
*   Utiliza la mensajería para comunicarte con otros usuarios registrados.

---

## Licencia Español

Copyright (c) 2025 Francisco José Herreros (franHR) / PCProgramación

Todos los derechos reservados.

Este software es propiedad de Francisco José Herreros (franHR), desarrollador de PCProgramación (https://www.pcprogramacion.es). No está permitido copiar, modificar, distribuir o utilizar este código, ni total ni parcialmente, sin una autorización expresa y por escrito del autor.

El acceso a este repositorio tiene únicamente fines de revisión, auditoría o demostración, y no implica la cesión de ningún derecho de uso o explotación.

Para solicitar una licencia o permiso de uso, contacta con: desarrollo@pcprogramacion.es


## Licencia Ingles


Copyright (c) 2025 Francisco José Herreros (franHR) / PCProgramación

All rights reserved.

This software is the property of Francisco José Herreros (franHR), developer of PCProgramación (https://www.pcprogramacion.es). You may not copy, modify, distribute, or use this code, in whole or in part, without the express written permission of the author.

Access to this repository is strictly for review, auditing, or demonstration purposes, and does not grant any rights to use or exploit the software.

To request a license or permission, contact: desarrollo@pcprogramacion.es 