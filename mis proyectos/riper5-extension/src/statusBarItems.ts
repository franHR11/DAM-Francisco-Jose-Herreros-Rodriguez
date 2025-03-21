// Gestiona los elementos visuales en la barra de estado
import * as vscode from 'vscode';
import { ModeManager } from './modeManager';

let modeStatusBarItem: vscode.StatusBarItem;
let memoryStatusBarItem: vscode.StatusBarItem;
let chatInstructionsStatusBarItem: vscode.StatusBarItem;
let showPanelStatusBarItem: vscode.StatusBarItem;
let insertInfoStatusBarItem: vscode.StatusBarItem;
let generateCommandsStatusBarItem: vscode.StatusBarItem;

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

    // Crear el item para copiar instrucciones al chat
    chatInstructionsStatusBarItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 98);
    chatInstructionsStatusBarItem.text = `$(clippy) Copiar instrucciones para Chat`;
    chatInstructionsStatusBarItem.tooltip = 'Copia al portapapeles las instrucciones para el chat IA';
    chatInstructionsStatusBarItem.command = 'riper5.copyChatInstructions';
    context.subscriptions.push(chatInstructionsStatusBarItem);
    
    // Crear el item para mostrar el panel de modos
    showPanelStatusBarItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 97);
    showPanelStatusBarItem.text = `$(preview) Mostrar Panel de Modos`;
    showPanelStatusBarItem.tooltip = 'Muestra un panel con los modos activos y sus instrucciones';
    showPanelStatusBarItem.command = 'riper5.showModesPanel';
    context.subscriptions.push(showPanelStatusBarItem);
    
    // Crear el item para insertar información en el editor
    insertInfoStatusBarItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 96);
    insertInfoStatusBarItem.text = `$(insert) Insertar Información de Modos`;
    insertInfoStatusBarItem.tooltip = 'Inserta información sobre los modos activos en el editor actual';
    insertInfoStatusBarItem.command = 'riper5.insertModesInfo';
    context.subscriptions.push(insertInfoStatusBarItem);
    
    // Crear el item para generar comandos para el chat
    generateCommandsStatusBarItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 95);
    generateCommandsStatusBarItem.text = `$(terminal) Generar Comandos para Chat`;
    generateCommandsStatusBarItem.tooltip = 'Genera un archivo con comandos para activar modos en el chat';
    generateCommandsStatusBarItem.command = 'riper5.generateCommands';
    context.subscriptions.push(generateCommandsStatusBarItem);

    // Actualizar los items basados en el estado actual
    updateModeStatusBar(modeManager);
    updateMemoryStatusBar(modeManager);

    // Mostrar los items
    modeStatusBarItem.show();
    memoryStatusBarItem.show();
    chatInstructionsStatusBarItem.show();
    showPanelStatusBarItem.show();
    insertInfoStatusBarItem.show();
    generateCommandsStatusBarItem.show();
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