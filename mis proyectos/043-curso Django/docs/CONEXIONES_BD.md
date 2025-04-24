# CONEXIONES_BD.md

## Tablas utilizadas y su propósito
- **Project**: Almacena los proyectos del portafolio, con campos como título, descripción, imagen y URL.

## Consultas SQL importantes
- Uso principal a través del ORM de Django: `Project.objects.all()` para mostrar proyectos en la web.

## Estructura general de la base de datos
- Base de datos SQLite por defecto en desarrollo (`db.sqlite3`).
- Para producción se recomienda PostgreSQL o MySQL.
- Migraciones gestionadas con `python manage.py migrate`.
