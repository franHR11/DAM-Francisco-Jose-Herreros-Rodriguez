# Inmobiliaria - Sistema de Gestión de Propiedades

## Sección Comercial
Plataforma web para la gestión y publicación de propiedades inmobiliarias. Este sistema permite a los agentes inmobiliarios publicar propiedades, y a los usuarios navegar por el catálogo de propiedades disponibles, ver detalles, contactar con los vendedores y acceder a información corporativa.

## Descripción y Características
El sistema Inmobiliaria ofrece una solución completa para la gestión de propiedades con las siguientes características:

- **Catálogo de propiedades:** Visualización organizada de las propiedades disponibles
- **Página de detalle:** Información detallada de cada propiedad con imágenes
- **Panel de administración:** Gestión de propiedades (crear, actualizar, eliminar)
- **Autenticación de usuario:** Sistema de login para vendedores
- **Blog:** Sección de noticias y artículos relacionados
- **Contacto:** Formulario para comunicación con la inmobiliaria
- **Responsive design:** Adaptable a diferentes dispositivos

## Funcionalidades del Blog

La plataforma ahora cuenta con un sistema de blog completamente funcional que incluye:

- **Panel de Administración**: Permite crear, editar y eliminar entradas de blog
- **Gestión de Categorías**: Organización de entradas por categorías temáticas
- **Entradas Destacadas**: Posibilidad de destacar entradas importantes en la página principal
- **Editor Avanzado**: Implementación de SunEditor para una edición rica de contenido
- **Imágenes**: Carga y procesamiento de imágenes para las entradas
- **Visualización Pública**: Las entradas se muestran en la sección de blog y en la página principal

### Características técnicas

- Clases OOP para gestionar entradas (BlogEntry) y categorías (BlogCategory)
- Manejo de imágenes con Intervention Image (con fallback a métodos nativos)
- Sistema de rutas para acceder a las distintas secciones del blog
- Consultas SQL optimizadas para recuperar entradas por categoría, destacadas, etc.
- Procesamiento de formularios con validación de datos

## Sección Técnica

### Requisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Composer para gestión de dependencias
- Node.js y NPM para gestión de assets

### Instalación
1. Clonar el repositorio
2. Ejecutar `composer install` para instalar dependencias PHP
3. Ejecutar `npm install` para instalar dependencias Node.js
4. Configurar la conexión a la base de datos en `includes/config/database.php`
5. Importar la estructura de la base de datos desde el archivo SQL proporcionado
6. Ejecutar `gulp` para compilar los assets

### Estructura del proyecto
- **admin/**: Panel de administración
  - **propiedades/**: CRUD de propiedades
- **build/**: Archivos compilados (CSS, JS, imágenes optimizadas)
- **classes/**: Clases PHP del proyecto
- **includes/**: Funciones y configuraciones
  - **config/**: Archivos de configuración
  - **templates/**: Plantillas HTML reutilizables
- **src/**: Archivos fuente (SASS, JS)
- **vendor/**: Dependencias de Composer

### Uso
1. Acceder al sitio web principal para visualizar las propiedades
2. Para gestionar propiedades, acceder a `/admin` con credenciales de administrador
3. Para actualizar estilos o scripts, modificar los archivos en `/src` y ejecutar `gulp` para compilar 