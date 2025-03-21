"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.showModeQuickPick = void 0;
// Funciones para mostrar y manejar los QuickPicks
const vscode = require("vscode");
const constants_1 = require("./constants");
/**
 * Muestra una interfaz de selección rápida para elegir los modos RIPER5
 * @returns Una promesa que se resuelve con los modos seleccionados o undefined si el usuario canceló
 */
async function showModeQuickPick(currentModes = []) {
    const quickPickItems = constants_1.MODES.map(mode => ({
        label: mode,
        description: constants_1.MODE_DESCRIPTIONS[mode],
        picked: currentModes.includes(mode)
    }));
    const selectedItems = await vscode.window.showQuickPick(quickPickItems, {
        canPickMany: true,
        placeHolder: 'Selecciona uno o más modos RIPER5',
        title: 'Selector de Modos RIPER5'
    });
    if (selectedItems) {
        return selectedItems.map((item) => item.label);
    }
    return undefined;
}
exports.showModeQuickPick = showModeQuickPick;
//# sourceMappingURL=quickPickHelpers.js.map