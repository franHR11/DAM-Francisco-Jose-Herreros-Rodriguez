// Gestiona el estado de los modos y proporciona métodos para cambiarlos
import * as vscode from 'vscode';
import { MODES } from './constants';
import * as fs from 'fs';
import * as path from 'path';

// Interfaz para la descripción de modos
interface ModeDescription {
    resumen: string;
    completa: string;
}

export class ModeManager {
    private context: vscode.ExtensionContext;
    private activeModes: string[] = [];
    private memoryMode: boolean = false;
    private modeDescriptions: { [key: string]: ModeDescription } = {};

    constructor(context: vscode.ExtensionContext) {
        this.context = context;
        // Cargar estados guardados
        this.activeModes = context.globalState.get('activeModes', []);
        this.memoryMode = context.globalState.get('memoryMode', false);
        
        // Cargar descripciones de modos desde reglas.md
        this.loadModeDescriptionsFromRules();
    }

    /**
     * Carga las descripciones detalladas de los modos desde el archivo reglas.md
     */
    private loadModeDescriptionsFromRules(): void {
        try {
            // Buscar el archivo reglas.md en el workspace
            const workspaceFolders = vscode.workspace.workspaceFolders;
            if (workspaceFolders && workspaceFolders.length > 0) {
                const rootPath = workspaceFolders[0].uri.fsPath;
                const reglasPath = path.join(rootPath, 'reglas.md');
                
                if (fs.existsSync(reglasPath)) {
                    const content = fs.readFileSync(reglasPath, 'utf8');
                    this.parseModeDescriptionsFromContent(content);
                } else {
                    console.log('No se encontró el archivo reglas.md');
                }
            }
        } catch (error) {
            console.error('Error al cargar descripciones de modos:', error);
        }
    }

    /**
     * Analiza el contenido del archivo reglas.md para extraer descripciones de modos
     * @param content El contenido del archivo reglas.md
     */
    private parseModeDescriptionsFromContent(content: string): void {
        // Inicializar con descripciones básicas en caso de fallo
        this.modeDescriptions = {
            'INVESTIGACIÓN': {
                resumen: 'Recopilación de información únicamente.',
                completa: 'Recopilación de información únicamente.'
            },
            'INNOVACIÓN': {
                resumen: 'Generación de ideas y enfoques potenciales.',
                completa: 'Generación de ideas y enfoques potenciales.'
            },
            'PLANIFICACIÓN': {
                resumen: 'Crear una especificación técnica detallada.',
                completa: 'Crear una especificación técnica detallada.'
            },
            'EJECUCIÓN': {
                resumen: 'Implementar exactamente lo planificado.',
                completa: 'Implementar exactamente lo planificado.'
            },
            'REVISIÓN': {
                resumen: 'Validar si la implementación sigue exactamente el plan.',
                completa: 'Validar si la implementación sigue exactamente el plan.'
            },
            'REFACTORIZACIÓN': {
                resumen: 'Mejorar la estructura del código sin cambiar funcionalidad.',
                completa: 'Mejorar la estructura del código sin cambiar funcionalidad.'
            },
            'DEBUGGING': {
                resumen: 'Identificar y corregir errores.',
                completa: 'Identificar y corregir errores.'
            },
            'DOCUMENTACIÓN': {
                resumen: 'Crear documentación clara y completa.',
                completa: 'Crear documentación clara y completa.'
            },
            'OPTIMIZACIÓN_SQL': {
                resumen: 'Optimizar consultas SQL.',
                completa: 'Optimizar consultas SQL.'
            },
            'SEGURIDAD': {
                resumen: 'Identificar vulnerabilidades y proponer soluciones.',
                completa: 'Identificar vulnerabilidades y proponer soluciones.'
            },
            'DOCUMENTACIÓN_TÉCNICA': {
                resumen: 'Crear documentación técnica detallada.',
                completa: 'Crear documentación técnica detallada.'
            },
            'SEO': {
                resumen: 'Optimizar código para buscadores.',
                completa: 'Optimizar código para buscadores.'
            },
            'ARQUITECTURA_MODULAR': {
                resumen: 'Implementar arquitectura con componentes independientes.',
                completa: 'Implementar arquitectura con componentes independientes.'
            }
        };
        
        try {
            // Patrones para extraer información de modos
            const modoPattern = /MODO\s+\d+\s*:?\s*([A-ZÓÍÁÉÚÑ_]+)[\s\n]+(.*?)(?=MODO\s+\d+|$)/gs;
            const modos = [...content.matchAll(modoPattern)];
            
            modos.forEach(modo => {
                if (modo && modo.length >= 3) {
                    const nombreModo = modo[1].trim();
                    const descripcionCompleta = modo[2].trim();
                    
                    // Extraer una descripción resumida
                    let descripcionResumida = '';
                    const propositoMatch = descripcionCompleta.match(/Propósito:\s*([^\n]+)/);
                    if (propositoMatch && propositoMatch.length > 1) {
                        descripcionResumida = propositoMatch[1].trim();
                    } else {
                        // Si no encuentra "Propósito", tomar las primeras 150 caracteres
                        descripcionResumida = descripcionCompleta.substring(0, 150).trim();
                        if (descripcionResumida.length === 150) {
                            descripcionResumida += '...';
                        }
                    }
                    
                    // Normalizar nombre del modo
                    let nombreNormalizado = nombreModo
                        .replace('MODO', '')
                        .replace(':', '')
                        .trim();
                    
                    // Manejar casos especiales
                    if (nombreNormalizado === 'DEBUGGING AUTOMÁTICO' || nombreNormalizado === 'DE DEBUGGING') {
                        nombreNormalizado = 'DEBUGGING';
                    } else if (nombreNormalizado === 'GENERACIÓN DE DOCUMENTACIÓN AUTOMÁTICA') {
                        nombreNormalizado = 'DOCUMENTACIÓN';
                    } else if (nombreNormalizado === 'DE OPTIMIZACIÓN DE CONSULTAS SQL') {
                        nombreNormalizado = 'OPTIMIZACIÓN_SQL';
                    } else if (nombreNormalizado === 'SEGURIDAD EN CÓDIGO') {
                        nombreNormalizado = 'SEGURIDAD';
                    } else if (nombreNormalizado === 'DOCUMENTACIÓN TÉCNICA COMPLETA') {
                        nombreNormalizado = 'DOCUMENTACIÓN_TÉCNICA';
                    } else if (nombreNormalizado === 'OPTIMIZACIÓN AVANZADA PARA SEO') {
                        nombreNormalizado = 'SEO';
                    } else if (nombreNormalizado.includes('ARQUITECTURA MODULAR')) {
                        nombreNormalizado = 'ARQUITECTURA_MODULAR';
                    }
                    
                    // Guardar la descripción completa
                    this.modeDescriptions[nombreNormalizado] = {
                        resumen: descripcionResumida,
                        completa: descripcionCompleta
                    };
                }
            });
            
            console.log('Descripciones de modos cargadas correctamente');
        } catch (error) {
            console.error('Error al parsear descripciones de modos:', error);
        }
    }

    /**
     * Obtiene la descripción completa de un modo
     * @param mode El nombre del modo
     * @returns La descripción completa del modo o un mensaje si no se encuentra
     */
    public getModeFullDescription(mode: string): string {
        if (this.modeDescriptions[mode] && this.modeDescriptions[mode].completa) {
            return this.modeDescriptions[mode].completa;
        }
        return `No se encontró una descripción detallada para el modo ${mode}`;
    }

    /**
     * Obtiene el resumen de la descripción de un modo
     * @param mode El nombre del modo
     * @returns El resumen de la descripción del modo o un mensaje si no se encuentra
     */
    public getModeShortDescription(mode: string): string {
        if (this.modeDescriptions[mode] && this.modeDescriptions[mode].resumen) {
            return this.modeDescriptions[mode].resumen;
        }
        return `Sin descripción para ${mode}`;
    }

    public getActiveModes(): string[] {
        return [...this.activeModes];
    }

    public isMemoryModeActive(): boolean {
        return this.memoryMode;
    }

    public async selectMode() {
        const options = MODES.map(mode => ({
            label: mode,
            picked: this.activeModes.includes(mode)
        }));

        const selectedModes = await vscode.window.showQuickPick(options, {
            canPickMany: true,
            placeHolder: 'Selecciona uno o más modos RIPER5'
        });

        if (selectedModes) {
            this.activeModes = selectedModes.map((option: { label: string }) => option.label);
            await this.saveState();
            // Mostrar mensaje sin actualizar configuración
            vscode.window.showInformationMessage(`Modos activados: ${this.getStatusMessage()}`);
            return true;
        }
        return false;
    }

    public async toggleMemory() {
        this.memoryMode = !this.memoryMode;
        await this.saveState();
        // Mostrar mensaje sin actualizar configuración
        vscode.window.showInformationMessage(`Modo memoria ${this.memoryMode ? 'activado' : 'desactivado'}`);
        return this.memoryMode;
    }

    private async saveState() {
        await this.context.globalState.update('activeModes', this.activeModes);
        await this.context.globalState.update('memoryMode', this.memoryMode);
        // También guardamos las instrucciones en el estado global para futuras referencias
        await this.context.globalState.update('customInstructions', this.generateCustomInstructions());
    }

    private generateCustomInstructions(): string {
        let instructions = '';
        
        // Añadir instrucciones para los modos activos
        if (this.activeModes.length > 0) {
            instructions += `Estás en modo ${this.activeModes.join(', ')}. `;
            
            // Añadir instrucciones específicas para cada modo
            this.activeModes.forEach(mode => {
                switch (mode) {
                    case 'INVESTIGACIÓN':
                        instructions += 'Debes proporcionar solo información, evitando dar opiniones o sugerencias. ';
                        break;
                    case 'INNOVACIÓN':
                        instructions += 'Debes ser creativo y proponer ideas novedosas, incluso si son arriesgadas o poco convencionales. ';
                        break;
                    case 'PLANIFICACIÓN':
                        instructions += 'Debes crear planes detallados con pasos específicos, considerando posibles problemas y soluciones. ';
                        break;
                    case 'EJECUCIÓN':
                        instructions += 'Debes implementar exactamente lo que se te pide, sin cuestionar o sugerir cambios. ';
                        break;
                    case 'REVISIÓN':
                        instructions += 'Debes analizar críticamente el código, buscando problemas, bugs o mejoras posibles. ';
                        break;
                    case 'REFACTORIZACIÓN':
                        instructions += 'Debes mejorar la estructura y legibilidad del código sin cambiar su funcionalidad. ';
                        break;
                    case 'DEBUGGING':
                        instructions += 'Debes identificar y corregir errores, explicando las causas y soluciones. ';
                        break;
                    case 'DOCUMENTACIÓN':
                        instructions += 'Debes crear documentación clara y completa, incluyendo ejemplos de uso. ';
                        break;
                    case 'OPTIMIZACIÓN_SQL':
                        instructions += 'Debes optimizar consultas SQL para mejorar el rendimiento, explicando los cambios. ';
                        break;
                    case 'SEGURIDAD':
                        instructions += 'Debes identificar vulnerabilidades de seguridad y proponer soluciones. ';
                        break;
                    case 'DOCUMENTACIÓN_TÉCNICA':
                        instructions += 'Debes crear documentación técnica detallada, incluyendo diagramas si es necesario. ';
                        break;
                    case 'SEO':
                        instructions += 'Debes optimizar el código para mejorar el posicionamiento en buscadores. ';
                        break;
                    case 'ARQUITECTURA_MODULAR':
                        instructions += 'Debes implementar una arquitectura modular estricta, con componentes independientes. ';
                        break;
                }
            });
        } else {
            instructions += 'No hay modos activos. Responderé de manera general. ';
        }
        
        // Añadir instrucciones para el modo memoria
        if (this.memoryMode) {
            instructions += 'MEMORIA ACTIVADA: Debes mantener actualizados los archivos en la carpeta docs/ (README.md, MEMORIAS.md, CONEXIONES_BD.md) con cada cambio significativo. ';
        }
        
        return instructions;
    }

    /**
     * Genera un texto para comunicar al chat de IA los modos activos y sus instrucciones
     * @returns Un texto formateado para informar al chat sobre los modos activos
     */
    public generateChatInstructions(): string {
        let chatText = '<custom_instructions>\n';
        
        // Añadir información sobre modos activos
        if (this.activeModes.length > 0) {
            chatText += `Estás configurado con los siguientes modos: ${this.activeModes.join(', ')}.\n\n`;
            
            // Añadir instrucciones detalladas para cada modo
            this.activeModes.forEach(mode => {
                switch (mode) {
                    case 'INVESTIGACIÓN':
                        chatText += '- INVESTIGACIÓN: Proporciona solo información objetiva, evita opiniones o sugerencias.\n';
                        break;
                    case 'INNOVACIÓN':
                        chatText += '- INNOVACIÓN: Sé creativo y propón ideas novedosas, incluso si son arriesgadas.\n';
                        break;
                    case 'PLANIFICACIÓN':
                        chatText += '- PLANIFICACIÓN: Crea planes detallados con pasos específicos y anticipa problemas.\n';
                        break;
                    case 'EJECUCIÓN':
                        chatText += '- EJECUCIÓN: Implementa exactamente lo que se pide sin sugerir cambios.\n';
                        break;
                    case 'REVISIÓN':
                        chatText += '- REVISIÓN: Analiza críticamente el código buscando problemas y mejoras.\n';
                        break;
                    case 'REFACTORIZACIÓN':
                        chatText += '- REFACTORIZACIÓN: Mejora la estructura del código sin cambiar funcionalidad.\n';
                        break;
                    case 'DEBUGGING':
                        chatText += '- DEBUGGING: Identifica y corrige errores, explicando causas y soluciones.\n';
                        break;
                    case 'DOCUMENTACIÓN':
                        chatText += '- DOCUMENTACIÓN: Crea documentación clara y completa con ejemplos de uso.\n';
                        break;
                    case 'OPTIMIZACIÓN_SQL':
                        chatText += '- OPTIMIZACIÓN_SQL: Optimiza consultas SQL para mejorar rendimiento.\n';
                        break;
                    case 'SEGURIDAD':
                        chatText += '- SEGURIDAD: Identifica vulnerabilidades y propón soluciones seguras.\n';
                        break;
                    case 'DOCUMENTACIÓN_TÉCNICA':
                        chatText += '- DOCUMENTACIÓN_TÉCNICA: Crea documentación técnica detallada con diagramas.\n';
                        break;
                    case 'SEO':
                        chatText += '- SEO: Optimiza código para mejorar posicionamiento en buscadores.\n';
                        break;
                    case 'ARQUITECTURA_MODULAR':
                        chatText += '- ARQUITECTURA_MODULAR: Implementa arquitectura con componentes independientes.\n';
                        break;
                }
            });
        } else {
            chatText += 'No hay modos activos. Responde de manera general.\n';
        }
        
        // Añadir información sobre modo memoria
        chatText += `\nModo memoria: ${this.memoryMode ? 'ACTIVADO' : 'DESACTIVADO'}\n`;
        if (this.memoryMode) {
            chatText += 'Cuando el modo memoria está activado, debes mantener actualizados los archivos en docs/ (README.md, MEMORIAS.md, CONEXIONES_BD.md) con cada cambio significativo.\n';
        }
        
        chatText += '</custom_instructions>';
        return chatText;
    }

    /**
     * Genera un mensaje informativo para enviar directamente al chat
     * @returns Un mensaje simple para el chat sobre los modos activos
     */
    public generateChatMessage(): string {
        let message = '🔄 **Configuración de modos RIPER5 activados**\n\n';
        
        if (this.activeModes.length > 0) {
            message += `📋 **Modos activos**: ${this.activeModes.join(', ')}\n\n`;
            
            // Explicar brevemente qué hace cada modo activo
            this.activeModes.forEach(mode => {
                switch (mode) {
                    case 'INVESTIGACIÓN':
                        message += '• INVESTIGACIÓN: Modo orientado a proporcionar información objetiva sin opiniones.\n';
                        break;
                    case 'INNOVACIÓN':
                        message += '• INNOVACIÓN: Modo enfocado en generar ideas creativas y novedosas.\n';
                        break;
                    case 'PLANIFICACIÓN':
                        message += '• PLANIFICACIÓN: Modo para crear planes detallados con pasos específicos.\n';
                        break;
                    case 'EJECUCIÓN':
                        message += '• EJECUCIÓN: Modo para implementar exactamente lo solicitado.\n';
                        break;
                    case 'REVISIÓN':
                        message += '• REVISIÓN: Modo para analizar críticamente el código existente.\n';
                        break;
                    case 'REFACTORIZACIÓN':
                        message += '• REFACTORIZACIÓN: Modo para mejorar la estructura del código.\n';
                        break;
                    case 'DEBUGGING':
                        message += '• DEBUGGING: Modo para identificar y corregir errores.\n';
                        break;
                    case 'DOCUMENTACIÓN':
                        message += '• DOCUMENTACIÓN: Modo para crear documentación clara y completa.\n';
                        break;
                    case 'OPTIMIZACIÓN_SQL':
                        message += '• OPTIMIZACIÓN_SQL: Modo para optimizar consultas SQL.\n';
                        break;
                    case 'SEGURIDAD':
                        message += '• SEGURIDAD: Modo para identificar vulnerabilidades y soluciones.\n';
                        break;
                    case 'DOCUMENTACIÓN_TÉCNICA':
                        message += '• DOCUMENTACIÓN_TÉCNICA: Modo para crear documentación técnica detallada.\n';
                        break;
                    case 'SEO':
                        message += '• SEO: Modo para optimizar código para buscadores.\n';
                        break;
                    case 'ARQUITECTURA_MODULAR':
                        message += '• ARQUITECTURA_MODULAR: Modo para implementar arquitectura de componentes independientes.\n';
                        break;
                }
            });
        } else {
            message += '📋 **No hay modos activos**. Responderé de manera general.\n';
        }
        
        // Añadir información sobre modo memoria
        message += `\n💾 **Modo memoria**: ${this.memoryMode ? 'ACTIVADO ✅' : 'DESACTIVADO ❌'}\n`;
        if (this.memoryMode) {
            message += 'Actualizaré automáticamente los archivos de documentación con cada cambio significativo.\n';
        }
        
        message += '\n*Las instrucciones completas han sido cargadas como custom_instructions.*';
        return message;
    }

    public getStatusMessage(): string {
        let message = '';
        
        if (this.activeModes.length > 0) {
            message += `Modos: ${this.activeModes.join(', ')}`;
        } else {
            message += 'Sin modos activos';
        }
        
        message += ` | Memoria: ${this.memoryMode ? 'ON' : 'OFF'}`;
        
        return message;
    }
} 