// Funciones para mostrar y manejar los QuickPicks
import * as vscode from 'vscode';
import { MODES, MODE_DESCRIPTIONS } from './constants';

/**
 * Muestra una interfaz de selección rápida para elegir los modos RIPER5
 * @returns Una promesa que se resuelve con los modos seleccionados o undefined si el usuario canceló
 */
export async function showModeQuickPick(currentModes: string[] = []): Promise<string[] | undefined> {
    const quickPickItems = MODES.map(mode => ({
        label: mode,
        description: MODE_DESCRIPTIONS[mode as keyof typeof MODE_DESCRIPTIONS],
        picked: currentModes.includes(mode)
    }));

    const selectedItems = await vscode.window.showQuickPick(quickPickItems, {
        canPickMany: true,
        placeHolder: 'Selecciona uno o más modos RIPER5',
        title: 'Selector de Modos RIPER5'
    });

    if (selectedItems) {
        return selectedItems.map((item: { label: string }) => item.label);
    }

    return undefined;
} 