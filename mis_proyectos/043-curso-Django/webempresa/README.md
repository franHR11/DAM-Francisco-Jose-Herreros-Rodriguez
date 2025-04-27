# 🌟 WebEmpresa – Plataforma Empresarial en Django

## 📌 DESCRIPCIÓN DEL PROYECTO
WebEmpresa es una solución web integral desarrollada en Django, orientada a empresas, profesionales y negocios que buscan gestionar su presencia online de forma profesional. Permite la administración centralizada de páginas, servicios, blog, enlaces sociales y contacto, todo desde un panel de administración seguro y personalizable.

- **¿Qué hace este proyecto?**
  - Gestiona contenido dinámico (páginas, servicios, blog, enlaces, contacto) desde el admin de Django.
  - Facilita la comunicación con clientes y la presentación de servicios o productos.
- **¿Para quién está pensado?**
  - Empresas, autónomos, agencias, pymes y profesionales que necesitan una web corporativa moderna, escalable y fácil de administrar.
- **Utilidad y enfoque comercial:**
  - Centraliza la presencia digital, mejora la imagen de marca y agiliza la captación de clientes y la gestión de contenidos.

---

## ✨ CARACTERÍSTICAS PRINCIPALES
- 🛠️ **Gestión de páginas** (informativas, legales, landing, etc.)
- 📰 **Blog** integrado para noticias y artículos
- 📦 **Gestión de servicios/productos**
- 🔗 **Enlaces sociales y externos** dinámicos
- 📬 **Formulario de contacto** con envío de emails
- 🔒 **Panel de administración** seguro y personalizable
- 👤 **Autenticación y permisos** para usuarios y grupos
- 📝 **Editor enriquecido CKEditor5** para contenidos
- 🌐 **URLs amigables (SEO)** con slugs
- 📊 **Paneles de control y filtros avanzados en admin**
- 📁 **Soporte para archivos estáticos y multimedia**
- 🌍 **Preparado para despliegue en producción**

---

## ⚙️ FUNCIONALIDADES
- **Módulo Pages:** Gestión de páginas estáticas y dinámicas.
- **Módulo Blog:** Publicación y administración de artículos con categorías y slugs SEO.
- **Módulo Services:** Catálogo de servicios/productos con descripciones y precios.
- **Módulo Social:** Administración de enlaces sociales y externos (context processors globales).
- **Módulo Contact:** Formulario de contacto con validación y envío de emails vía SMTP.
- **Panel Admin:** Gestión centralizada de todo el contenido, permisos por grupo, campos de solo lectura según rol.
- **Sistema de usuarios:** Login, permisos, grupos y protección de vistas.
- **Integración CKEditor5:** Edición rica de contenido en admin.
- **URLs amigables:** Navegación intuitiva y SEO friendly.
- **Carga de archivos:** Soporte para imágenes y documentos.

---

## 🔧 TECNOLOGÍAS UTILIZADAS
- 🐍 **Python 3**
- 🌟 **Django 5.2**
- 📦 **django-ckeditor-5** (editor enriquecido)
- 📦 **Pillow** (gestión de imágenes)
- 📦 **Mailtrap** (SMTP testing)
- 🗄️ **SQLite** (desarrollo) / **PostgreSQL/MySQL** (producción)
- 📝 **HTML5, CSS3, Bootstrap**
- ⚡ **Gunicorn/Nginx** (despliegue recomendado)

---

## 🧪 ESTRUCTURA DE ARCHIVOS Y CARPETAS
```
webempresa/
├── blog/           # App de blog (artículos, categorías)
├── contact/        # App de contacto (formulario, envío email)
├── core/           # App principal (home, base, estáticos)
├── pages/          # App de páginas estáticas/dinámicas
├── services/       # App de servicios/productos
├── social/         # App de enlaces sociales
├── media/          # Archivos subidos
├── static/         # Archivos estáticos globales
├── templates/      # Plantillas globales y por app
├── db.sqlite3      # Base de datos (desarrollo)
├── manage.py       # Script de gestión Django
├── webempresa/     # Configuración global del proyecto
│   ├── settings.py
│   ├── urls.py
│   └── wsgi.py
└── ...
```
- **Cada app** tiene sus propios modelos, vistas, templates y admin.
- **media/** almacena archivos subidos por usuarios (imágenes, docs).
- **static/** para CSS, JS e imágenes globales.
- **templates/** contiene las plantillas HTML.

---

## 🛠️ INSTRUCCIONES DE USO
1. **Clona el repositorio:**
   ```bash
   git clone <url-del-repo>
   cd webempresa
   ```
2. **Crea y activa un entorno virtual:**
   ```bash
   python -m venv venv
   venv\Scripts\activate  # Windows
   # o
   source venv/bin/activate  # Linux/Mac
   ```
3. **Instala las dependencias:**
   ```bash
   pip install -r requirements.txt
   ```
4. **Configura variables en `webempresa/settings.py` o `.env`:**
   - `DEBUG = False`
   - `ALLOWED_HOSTS = ['tudominio.com']`
   - `EMAIL_HOST`, `EMAIL_HOST_USER`, `EMAIL_HOST_PASSWORD`, `EMAIL_PORT`
   - `STATIC_ROOT`, `MEDIA_ROOT`
5. **Aplica migraciones y crea superusuario:**
   ```bash
   python manage.py makemigrations
   python manage.py migrate
   python manage.py createsuperuser
   ```
6. **Ejecuta el servidor en local:**
   ```bash
   python manage.py runserver
   ```
7. **Accede a:**
   - `http://127.0.0.1:8000/` (sitio web)
   - `http://127.0.0.1:8000/admin/` (panel admin)

---

## 📝 EJEMPLO DE USO
- Accede a `/page/` para ver páginas informativas.
- Publica artículos en `/blog/` y gestiona desde `/admin/`.
- Envía mensajes desde `/contact/` (emails vía Mailtrap o SMTP real).
- Administra enlaces sociales dinámicamente desde el admin.

---

## 🔗 BASE DE DATOS Y CONEXIONES
- **Tablas principales:** Users, Pages, Blog, Services, SocialLinks, ContactMessages
- **Configuración:**
  - Por defecto SQLite, pero fácilmente adaptable a PostgreSQL/MySQL.
  - Variables de conexión en `settings.py` o `.env`.
- **Ejemplo conexión PostgreSQL:**
  ```python
  DATABASES = {
      'default': {
          'ENGINE': 'django.db.backends.postgresql',
          'NAME': 'nombre_db',
          'USER': 'usuario_db',
          'PASSWORD': 'contraseña_db',
          'HOST': 'localhost',
          'PORT': '5432',
      }
  }
  ```

---

## 🔑 VARIABLES Y CONFIGURACIÓN .ENV (EJEMPLO)
```env
SECRET_KEY=tu_clave_secreta
DEBUG=False
ALLOWED_HOSTS=localhost,127.0.0.1,tudominio.com
EMAIL_HOST=smtp.tudominio.com
EMAIL_HOST_USER=usuario
EMAIL_HOST_PASSWORD=contraseña
EMAIL_PORT=587
DATABASE_URL=postgres://usuario:contraseña@localhost:5432/nombre_db
```

---

## 📜 LICENCIA ESPAÑOL
Copyright (c) 2025 Francisco José Herreros (franHR) / PCProgramación

Todos los derechos reservados.

Este software es propiedad de Francisco José Herreros (franHR), desarrollador de PCProgramación (https://www.pcprogramacion.es). No está permitido copiar, modificar, distribuir o utilizar este código, ni total ni parcialmente, sin una autorización expresa y por escrito del autor.

El acceso a este repositorio tiene únicamente fines de revisión, auditoría o demostración, y no implica la cesión de ningún derecho de uso o explotación.

Para solicitar una licencia o permiso de uso, contacta con: desarrollo@pcprogramacion.es

---

## 📜 LICENSE ENGLISH
Copyright (c) 2025 Francisco José Herreros (franHR) / PCProgramación

All rights reserved.

This software is the property of Francisco José Herreros (franHR), developer of PCProgramación (https://www.pcprogramacion.es). You may not copy, modify, distribute, or use this code, in whole or in part, without the express written permission of the author.

Access to this repository is strictly for review, auditing, or demonstration purposes, and does not grant any rights to use or exploit the software.

To request a license or permission, contact: desarrollo@pcprogramacion.es
