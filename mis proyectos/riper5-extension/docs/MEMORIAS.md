# Registro de Cambios y Decisiones

## Versión 0.1.0 (Inicial)

### Estructura del Proyecto
- Se eligió un diseño modular con separación de responsabilidades
- Archivos principales:
  - `extension.ts`: Punto de entrada principal
  - `modeManager.ts`: Manejo de estados y lógica de modos
  - `statusBarItems.ts`: Gestión de elementos visuales
  - `constants.ts`: Constantes y valores predefinidos
  - `quickPickHelpers.ts`: Interfaces de usuario

### Patrones de Diseño
- Patrón Singleton para el ModeManager
- Patrón Observer para notificar cambios en el estado

### Decisiones Técnicas
- Uso de TypeScript para mejor tipado y mantenibilidad
- Persistencia de configuraciones mediante el API de estado global de VSCode
- Interfaz de usuario simple mediante la barra de estado

## Próximas Mejoras
- [ ] Añadir tests unitarios
- [ ] Mejorar personalización de instrucciones por modo
- [ ] Añadir soporte para comandos de teclado personalizados
- [ ] Implementar notificaciones de cambio de modo 