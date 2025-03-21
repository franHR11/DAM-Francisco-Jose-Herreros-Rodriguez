// Gestiona el estado de los modos y proporciona métodos para cambiarlos
import * as vscode from 'vscode';
import { MODES } from './constants';

export class ModeManager {
    private context: vscode.ExtensionContext;
    private activeModes: string[] = [];
    private memoryMode: boolean = false;

    constructor(context: vscode.ExtensionContext) {
        this.context = context;
        // Cargar estados guardados
        this.activeModes = context.globalState.get('activeModes', []);
        this.memoryMode = context.globalState.get('memoryMode', false);
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
            vscode.window.showInformationMessage(`Modos actualizados: ${this.getStatusMessage()}`);
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