// El punto de entrada principal que activará la extensión y configurará los comandos
import * as vscode from 'vscode';
import { ModeManager } from './modeManager';
import { setupStatusBar, updateModeStatusBar, updateMemoryStatusBar } from './statusBarItems';

let modeManager: ModeManager;

/**
 * Esta función se llama cuando la extensión es activada
 * @param context El contexto de la extensión
 */
export function activate(context: vscode.ExtensionContext) {
    console.log('La extensión "riper5-extension" está activa');
    
    // Inicializar el gestor de modos
    modeManager = new ModeManager(context);
    
    // Configurar la barra de estado
    setupStatusBar(context, modeManager);
    
    // Registrar el comando para seleccionar modos
    const selectModeCommand = vscode.commands.registerCommand('riper5.selectMode', async () => {
        const result = await modeManager.selectMode();
        if (result) {
            updateModeStatusBar(modeManager);
        }
    });

    // Registrar el comando para activar/desactivar memoria
    const toggleMemoryCommand = vscode.commands.registerCommand('riper5.toggleMemory', async () => {
        await modeManager.toggleMemory();
        updateMemoryStatusBar(modeManager);
    });

    context.subscriptions.push(selectModeCommand, toggleMemoryCommand);
}

/**
 * Esta función se llama cuando la extensión es desactivada
 */
export function deactivate() {
    // Limpieza
    console.log('La extensión "riper5-extension" ha sido desactivada');
} 