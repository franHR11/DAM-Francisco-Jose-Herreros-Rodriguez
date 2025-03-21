# Documentación de Base de Datos

Esta extensión actualmente no utiliza base de datos directamente. El almacenamiento de preferencias se realiza mediante el API `globalState` de VSCode.

## Configuraciones Almacenadas

| Clave | Tipo | Descripción |
|-------|------|-------------|
| `activeModes` | `string[]` | Lista de modos RIPER5 activos |
| `memoryMode` | `boolean` | Estado del modo memoria (activado/desactivado) |

## Ejemplo de datos almacenados

```json
{
  "activeModes": ["INVESTIGACIÓN", "PLANIFICACIÓN"],
  "memoryMode": true
}
```

## Persistencia de Datos

Los datos se guardan en el sistema de almacenamiento persistente de VSCode, lo que permite que las preferencias se mantengan entre sesiones.

### Código relevante

En el archivo `modeManager.ts`:

```typescript
// Cargar estados guardados
this.activeModes = context.globalState.get('activeModes', []);
this.memoryMode = context.globalState.get('memoryMode', false);

// Guardar estados
await this.context.globalState.update('activeModes', this.activeModes);
await this.context.globalState.update('memoryMode', this.memoryMode);
``` 