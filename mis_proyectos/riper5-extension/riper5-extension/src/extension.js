"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.deactivate = exports.activate = void 0;
// El punto de entrada principal que activará la extensión y configurará los comandos
const vscode = require("vscode");
const modeManager_1 = require("./modeManager");
const statusBarItems_1 = require("./statusBarItems");
let modeManager;
/**
 * Esta función se llama cuando la extensión es activada
 * @param context El contexto de la extensión
 */
function activate(context) {
    console.log('La extensión "riper5-extension" está activa');
    // Inicializar el gestor de modos
    modeManager = new modeManager_1.ModeManager(context);
    // Configurar la barra de estado
    (0, statusBarItems_1.setupStatusBar)(context, modeManager);
    // Registrar el comando para seleccionar modos
    const selectModeCommand = vscode.commands.registerCommand('riper5.selectMode', async () => {
        const result = await modeManager.selectMode();
        if (result) {
            (0, statusBarItems_1.updateModeStatusBar)(modeManager);
        }
    });
    // Registrar el comando para activar/desactivar memoria
    const toggleMemoryCommand = vscode.commands.registerCommand('riper5.toggleMemory', async () => {
        await modeManager.toggleMemory();
        (0, statusBarItems_1.updateMemoryStatusBar)(modeManager);
    });
    context.subscriptions.push(selectModeCommand, toggleMemoryCommand);
}
exports.activate = activate;
/**
 * Esta función se llama cuando la extensión es desactivada
 */
function deactivate() {
    // Limpieza
    console.log('La extensión "riper5-extension" ha sido desactivada');
}
exports.deactivate = deactivate;
//# sourceMappingURL=extension.js.map