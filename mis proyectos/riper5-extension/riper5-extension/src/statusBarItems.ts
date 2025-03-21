// Gestiona los elementos visuales en la barra de estado
import * as vscode from 'vscode';
import { ModeManager } from './modeManager';

let modeStatusBarItem: vscode.StatusBarItem;
let memoryStatusBarItem: vscode.StatusBarItem;

/**
 * Configura los items de la barra de estado para el selector de modos y el toggle de memoria
 * @param context El contexto de extensión
 * @param modeManager El gestor de modos
 */
export function setupStatusBar(context: vscode.ExtensionContext, modeManager: ModeManager): void {
    // Crear el item para el selector de modos
    modeStatusBarItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 100);
    modeStatusBarItem.command = 'riper5.selectMode';
    context.subscriptions.push(modeStatusBarItem);

    // Crear el item para el toggle de memoria
    memoryStatusBarItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 99);
    memoryStatusBarItem.command = 'riper5.toggleMemory';
    context.subscriptions.push(memoryStatusBarItem);

    // Actualizar los items basados en el estado actual
    updateModeStatusBar(modeManager);
    updateMemoryStatusBar(modeManager);

    // Mostrar los items
    modeStatusBarItem.show();
    memoryStatusBarItem.show();
}

/**
 * Actualiza el texto del item de la barra de estado para el selector de modos
 * @param modeManager El gestor de modos
 */
export function updateModeStatusBar(modeManager: ModeManager): void {
    const activeModes = modeManager.getActiveModes();
    
    if (activeModes.length === 0) {
        modeStatusBarItem.text = `$(list-selection) Modos: Ninguno`;
        modeStatusBarItem.tooltip = 'Haz clic para seleccionar modos RIPER5';
    } else if (activeModes.length === 1) {
        modeStatusBarItem.text = `$(list-selection) Modo: ${activeModes[0]}`;
        modeStatusBarItem.tooltip = 'Modo activo: ' + activeModes[0];
    } else {
        modeStatusBarItem.text = `$(list-selection) Modos: ${activeModes.length}`;
        modeStatusBarItem.tooltip = 'Modos activos: ' + activeModes.join(', ');
    }
}

/**
 * Actualiza el texto del item de la barra de estado para el toggle de memoria
 * @param modeManager El gestor de modos
 */
export function updateMemoryStatusBar(modeManager: ModeManager): void {
    const isMemoryActive = modeManager.isMemoryModeActive();
    
    if (isMemoryActive) {
        memoryStatusBarItem.text = `$(database) Memoria: ON`;
        memoryStatusBarItem.tooltip = 'Modo memoria activado - Haz clic para desactivar';
    } else {
        memoryStatusBarItem.text = `$(database) Memoria: OFF`;
        memoryStatusBarItem.tooltip = 'Modo memoria desactivado - Haz clic para activar';
    }
} 