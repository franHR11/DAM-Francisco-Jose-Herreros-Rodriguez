# 💾 Gestión de Bases de Datos y Consultas

## Configuración de la Base de Datos

*   **Motor:** SQLite
*   **Archivo:** `db.sqlite3` (ubicado en la raíz del proyecto)
*   **Conexión:** Configurada en `webplayground/settings.py` bajo la clave `DATABASES['default']`.

## Tablas Principales (Modelos Django)

Django gestiona automáticamente el esquema de la base de datos a través de migraciones (`python manage.py migrate`). Las tablas principales incluyen:

*   **Autenticación y Usuarios (`django.contrib.auth`):**
    *   `auth_user`: Almacena la información de los usuarios (username, password hash, email, etc.).
    *   `auth_group`: Grupos de permisos.
    *   `auth_permission`: Permisos específicos.
    *   Tablas relacionadas para permisos de usuario y grupo.
*   **Sesiones (`django.contrib.sessions`):**
    *   `django_session`: Almacena datos de sesión.
*   **Administración (`django.contrib.admin`):**
    *   `django_admin_log`: Registra acciones realizadas en el panel de administración.
*   **Tipos de Contenido (`django.contrib.contenttypes`):**
    *   `django_content_type`: Registra los modelos del proyecto.
*   **Perfiles (`profiles` app):**
    *   `profiles_profile` (o similar): Tabla que extiende el modelo `User` para añadir información adicional al perfil (ej., avatar, biografía - *confirmar nombre exacto revisando `profiles/models.py`*).
*   **Páginas (`pages` app):**
    *   `pages_page` (o similar): Almacena el contenido de las páginas creadas por los usuarios (título, contenido HTML de CKEditor, autor - *confirmar nombre exacto revisando `pages/models.py`*).
*   **Mensajería (`messenger` app):**
    *   `messenger_thread` (o similar): Representa una conversación entre usuarios.
    *   `messenger_message` (o similar): Almacena los mensajes individuales dentro de un hilo de conversación (*confirmar nombres exactos revisando `messenger/models.py`*).

## Consultas SQL Importantes

Django ORM abstrae la mayoría de las consultas SQL. Las consultas complejas específicas se pueden encontrar en los métodos de los Managers o Vistas de las respectivas aplicaciones si fueran necesarias.

**Nota:** Los nombres exactos de las tablas específicas de las aplicaciones (`profiles`, `pages`, `messenger`) dependen de cómo se definieron los modelos en `models.py` y pueden variar ligeramente (Django añade el nombre de la app como prefijo por defecto). 