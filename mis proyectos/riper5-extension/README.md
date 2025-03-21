# RIPER5 Mode Selector

Esta extensión para Cursor te permite seleccionar diferentes modos RIPER5 y activar/desactivar el modo memoria directamente desde la barra de estado.

## Características

- **Selección de modos múltiples**: Puedes seleccionar uno o varios modos RIPER5 simultáneamente
- **Toggle de memoria**: Activa o desactiva el modo memoria con un solo clic
- **Indicadores visuales**: La barra de estado muestra claramente qué modos están activos

## Uso

1. **Seleccionar modos**: Haz clic en el botón `Modo: [nombre]` o `Modos: [número]` en la barra de estado para abrir el selector de modos
2. **Activar/desactivar memoria**: Haz clic en el botón `Memoria: ON/OFF` para cambiar el estado del modo memoria

## Modos disponibles

- **INVESTIGACIÓN**: Recopilación de información únicamente
- **INNOVACIÓN**: Generación de ideas y enfoques potenciales
- **PLANIFICACIÓN**: Crear una especificación técnica detallada
- **EJECUCIÓN**: Implementar exactamente lo planificado
- **REVISIÓN**: Validar si la implementación sigue el plan
- **REFACTORIZACIÓN**: Mejorar la estructura sin cambiar funcionalidad
- **DEBUGGING**: Detectar y corregir errores
- **DOCUMENTACIÓN**: Generar documentación completa del código
- **OPTIMIZACIÓN_SQL**: Optimizar consultas SQL para mejor eficiencia
- **SEGURIDAD**: Detectar vulnerabilidades en el código
- **DOCUMENTACIÓN_TÉCNICA**: Generar documentación técnica completa
- **SEO**: Optimizar HTML, CSS y JS para SEO
- **ARQUITECTURA_MODULAR**: Implementar arquitectura modular estricta

## Modo Memoria

Cuando el modo memoria está activo, se deben crear y mantener actualizados los siguientes archivos en la carpeta docs/:

- **README.md**: Documentación para compartir el proyecto
- **MEMORIAS.md**: Registro de cambios y decisiones clave
- **CONEXIONES_BD.md**: Detalles sobre bases de datos y consultas SQL importantes

## Instalación manual

1. Descarga el archivo .vsix
2. Abre Cursor y ve a la pestaña de extensiones
3. Haz clic en los tres puntos (...) y selecciona "Instalar desde VSIX..."
4. Selecciona el archivo .vsix descargado

## Desarrollo

Para desarrollar esta extensión:

1. Clona el repositorio
2. Ejecuta `npm install` para instalar las dependencias
3. Abre el proyecto en VS Code o Cursor
4. Presiona F5 para iniciar una nueva ventana con la extensión cargada

## Licencia

MIT 