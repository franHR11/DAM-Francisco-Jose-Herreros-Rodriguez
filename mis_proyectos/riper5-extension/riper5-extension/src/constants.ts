// Definiciones constantes para los modos disponibles
export const MODES = [
    'INVESTIGACIÓN',
    'INNOVACIÓN',
    'PLANIFICACIÓN',
    'EJECUCIÓN',
    'REVISIÓN',
    'REFACTORIZACIÓN',
    'DEBUGGING',
    'DOCUMENTACIÓN',
    'OPTIMIZACIÓN_SQL',
    'SEGURIDAD',
    'DOCUMENTACIÓN_TÉCNICA',
    'SEO',
    'ARQUITECTURA_MODULAR'
];

export const MODE_DESCRIPTIONS = {
    'INVESTIGACIÓN': 'Recopilación de información únicamente',
    'INNOVACIÓN': 'Generación de ideas y enfoques potenciales',
    'PLANIFICACIÓN': 'Crear una especificación técnica detallada',
    'EJECUCIÓN': 'Implementar exactamente lo planificado',
    'REVISIÓN': 'Validar si la implementación sigue el plan',
    'REFACTORIZACIÓN': 'Mejorar la estructura sin cambiar funcionalidad',
    'DEBUGGING': 'Detectar y corregir errores',
    'DOCUMENTACIÓN': 'Generar documentación completa del código',
    'OPTIMIZACIÓN_SQL': 'Optimizar consultas SQL para mejor eficiencia',
    'SEGURIDAD': 'Detectar vulnerabilidades en el código',
    'DOCUMENTACIÓN_TÉCNICA': 'Generar documentación técnica completa',
    'SEO': 'Optimizar HTML, CSS y JS para SEO',
    'ARQUITECTURA_MODULAR': 'Implementar arquitectura modular estricta'
};

// Instrucciones para el modo memoria
export const MEMORY_MODE_INSTRUCTIONS = {
    on: `⚙️ Reglas Generales
1️⃣ Si el modo memoria está en ON, se deben crear y mantener actualizados los siguientes archivos en la carpeta docs/:

README.md → Documentación para compartir el proyecto.
MEMORIAS.md → Registro de cambios y decisiones clave.
CONEXIONES_BD.md → Detalles sobre bases de datos y consultas SQL importantes.

✅ Cada vez que se agregue una nueva funcionalidad, se debe actualizar README.md y MEMORIAS.md automáticamente.  
✅ Si se crean nuevas conexiones o consultas a la base de datos, deben reflejarse en CONEXIONES_BD.md.`,
    
    off: `⚙️ Reglas Generales
2️⃣ Si el modo memoria está en OFF, no se realizará ninguna actualización documental.`
};
