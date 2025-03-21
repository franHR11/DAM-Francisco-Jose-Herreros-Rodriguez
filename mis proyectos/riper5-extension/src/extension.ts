// El punto de entrada principal que activará la extensión y configurará los comandos
import * as vscode from 'vscode';
import { ModeManager } from './modeManager';
import { setupStatusBar, updateModeStatusBar, updateMemoryStatusBar } from './statusBarItems';

let modeManager: ModeManager;
let modesPanel: vscode.WebviewPanel | undefined;
let extensionContext: vscode.ExtensionContext;

/**
 * Crea o muestra un panel webview con los modos activos para facilitar su visualización
 * @param context El contexto de la extensión
 * @param modeManager El gestor de modos para obtener los modos activos
 */
function showModesWebview(context: vscode.ExtensionContext, modeManager: ModeManager) {
    // Si ya existe un panel, mostrarlo
    if (modesPanel) {
        modesPanel.reveal(vscode.ViewColumn.Two);
        updateWebviewContent(modesPanel, modeManager);
        return;
    }

    // Crear un nuevo panel webview
    modesPanel = vscode.window.createWebviewPanel(
        'riper5Modes',
        'Modos RIPER5 Activos',
        vscode.ViewColumn.Two,
        {
            enableScripts: true,
            retainContextWhenHidden: true
        }
    );

    // Actualizar el contenido
    updateWebviewContent(modesPanel, modeManager);

    // Manejar cuando el panel se cierra
    modesPanel.onDidDispose(() => {
        modesPanel = undefined;
    }, null, context.subscriptions);
}

/**
 * Actualiza el contenido del panel webview con los modos activos
 * @param panel El panel webview a actualizar
 * @param modeManager El gestor de modos para obtener la información actual
 */
function updateWebviewContent(panel: vscode.WebviewPanel, modeManager: ModeManager) {
    const message = modeManager.generateChatMessage();
    const instructions = modeManager.generateChatInstructions();
    
    panel.webview.html = `<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modos RIPER5</title>
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                padding: 20px;
                color: var(--vscode-foreground);
                background-color: var(--vscode-editor-background);
            }
            h1 {
                color: var(--vscode-editor-foreground);
                border-bottom: 1px solid var(--vscode-panel-border);
                padding-bottom: 10px;
            }
            .card {
                background-color: var(--vscode-editor-inactiveSelectionBackground);
                border-radius: 6px;
                padding: 16px;
                margin-bottom: 16px;
            }
            .instructions {
                margin-top: 20px;
                background-color: var(--vscode-textBlockQuote-background);
                border-left: 4px solid var(--vscode-focusBorder);
                padding: 10px;
                border-radius: 3px;
            }
            .mode {
                margin: 8px 0;
            }
            .memory-status {
                display: inline-block;
                padding: 6px 12px;
                border-radius: 12px;
                font-weight: bold;
                margin-top: 10px;
            }
            .active {
                background-color: var(--vscode-terminal-ansiGreen);
                color: var(--vscode-editor-background);
            }
            .inactive {
                background-color: var(--vscode-terminal-ansiRed);
                color: var(--vscode-editor-background);
            }
            .copy-button {
                background-color: var(--vscode-button-background);
                color: var(--vscode-button-foreground);
                border: none;
                padding: 8px 16px;
                border-radius: 4px;
                cursor: pointer;
                margin-top: 20px;
            }
            .copy-button:hover {
                background-color: var(--vscode-button-hoverBackground);
            }
            pre {
                background-color: var(--vscode-textCodeBlock-background);
                padding: 10px;
                border-radius: 5px;
                overflow: auto;
                white-space: pre-wrap;
            }
        </style>
    </head>
    <body>
        <h1>🔄 Configuración de modos RIPER5</h1>
        
        <div class="card">
            ${formatMessageHtml(message)}
        </div>
        
        <div class="instructions">
            <h3>Instrucciones para pegar en el chat:</h3>
            <pre>${instructions.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</pre>
            <button class="copy-button" id="copyBtn">Copiar instrucciones al portapapeles</button>
        </div>

        <script>
            const copyBtn = document.getElementById('copyBtn');
            copyBtn.addEventListener('click', () => {
                const text = \`${instructions.replace(/`/g, '\\`')}\`;
                navigator.clipboard.writeText(text)
                    .then(() => {
                        copyBtn.textContent = '✅ Copiado!';
                        setTimeout(() => {
                            copyBtn.textContent = 'Copiar instrucciones al portapapeles';
                        }, 2000);
                    })
                    .catch(err => {
                        copyBtn.textContent = '❌ Error al copiar';
                        console.error('Error al copiar:', err);
                    });
            });
            
            // Mensajería con la extensión
            const vscode = acquireVsCodeApi();
        </script>
    </body>
    </html>`;
}

/**
 * Formatea el mensaje para HTML manteniendo el formato
 * @param message El mensaje a formatear
 * @returns El mensaje formateado en HTML
 */
function formatMessageHtml(message: string): string {
    return message
        .replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>') // Negrita
        .replace(/\n\n/g, '<br><br>') // Doble salto
        .replace(/\n/g, '<br>') // Salto simple
        .replace(/• ([^:]+):/g, '<div class="mode"><strong>• $1:</strong>') // Inicio modo
        .replace(/\.\n/g, '.</div>') // Fin modo
        .replace(/✅/g, '<span class="active">✅</span>')
        .replace(/❌/g, '<span class="inactive">❌</span>');
}

/**
 * Inserta la información de los modos activos en el editor actual
 * @param modeManager El gestor de modos para obtener la información
 */
async function insertModesInfoIntoEditor(modeManager: ModeManager): Promise<boolean> {
    const editor = vscode.window.activeTextEditor;
    if (!editor) {
        vscode.window.showWarningMessage('No hay editor activo para insertar la información de modos');
        return false;
    }

    try {
        // Obtener los modos activos y sus descripciones
        const activeModes = modeManager.getActiveModes();
        const memoryMode = modeManager.isMemoryModeActive();
        
        // Determinar el formato de comentarios según el lenguaje
        const language = editor.document.languageId;
        let startComment = '/**';
        let lineComment = ' * ';
        let endComment = ' */';
        
        // Ajustar el formato según el lenguaje
        if (['python', 'ruby'].includes(language)) {
            startComment = '"""';
            lineComment = '';
            endComment = '"""';
        } else if (['html', 'xml'].includes(language)) {
            startComment = '<!--';
            lineComment = ' ';
            endComment = ' -->';
        } else if (language === 'sql') {
            startComment = '/*';
            lineComment = ' * ';
            endComment = ' */';
        } else if (language === 'bat' || language === 'powershell') {
            startComment = 'REM';
            lineComment = 'REM ';
            endComment = 'REM';
        }
        
        // Construir el mensaje para insertar
        let text = `\n${startComment}\n`;
        text += `${lineComment}=== MODOS RIPER ACTIVOS ===\n`;
        
        if (activeModes.length > 0) {
            // Encabezado para modos
            text += `${lineComment}\n`;
            text += `${lineComment}📋 Modos actualmente activos:\n`;
            
            // Listar cada modo activo con su descripción
            activeModes.forEach(mode => {
                text += `${lineComment}\n`;
                text += `${lineComment}[MODO: ${mode}]\n`;
                text += `${lineComment}➡️ ${modeManager.getModeShortDescription(mode)}\n`;
                text += `${lineComment}-------------------\n`;
            });
        } else {
            text += `${lineComment}\n`;
            text += `${lineComment}⚠️ No hay modos RIPER activos actualmente\n`;
        }
        
        // Información del modo memoria
        text += `${lineComment}\n`;
        text += `${lineComment}💾 Modo memoria: ${memoryMode ? 'ACTIVADO ✅' : 'DESACTIVADO ❌'}\n`;
        if (memoryMode) {
            text += `${lineComment}📝 Cuando está activado, se mantienen actualizados los archivos en docs/\n`;
        }
        
        // Insertar instrucciones en formato de comentario
        text += `${lineComment}\n`;
        text += `${lineComment}🔄 Por favor, ajusta tu respuesta según los modos activos.\n`;
        text += `${lineComment}📌 Recuerda iniciar tu respuesta con [MODO: NOMBRE_DEL_MODO]\n`;
        text += `${endComment}\n\n`;
        
        // Insertar en la posición actual del cursor
        await editor.edit(editBuilder => {
            const position = editor.selection.active;
            editBuilder.insert(position, text);
        });
        
        vscode.window.showInformationMessage('Información de modos insertada en el editor');
        return true;
    } catch (error) {
        console.error('Error al insertar información de modos:', error);
        vscode.window.showErrorMessage('Error al insertar información de modos: ' + (error as Error).message);
        return false;
    }
}

/**
 * Genera un mensaje simple para activar el modo en el chat
 * @param mode El nombre del modo a activar
 * @returns El mensaje para enviar al chat
 */
function generateActivateModeMessage(mode: string): string {
    return `Modo ${mode} ACTIVAR`;
}

/**
 * Genera un mensaje simple para desactivar el modo en el chat
 * @param mode El nombre del modo a desactivar
 * @returns El mensaje para desactivar el modo
 */
function generateDeactivateModeMessage(mode: string): string {
    return `Modo ${mode} DESACTIVAR`;
}

/**
 * Envía un mensaje a Cursor con los modos activados o desactivados en formato simple
 * @param instructions Las instrucciones generadas para el chat
 * @returns Verdadero si se envió correctamente, falso en caso contrario
 */
async function sendToCursorChat(instructions: string): Promise<boolean> {
    try {
        // 1. Intenta usar la API de Cursor a través de la extensión
        const cursorExt = vscode.extensions.getExtension('cursor.cursor');
        if (cursorExt) {
            if (!cursorExt.isActive) {
                await cursorExt.activate();
            }
            
            const cursorApi = cursorExt.exports;
            
            if (cursorApi && cursorApi.chat && cursorApi.chat.sendMessage) {
                // Enviar mensaje simple en formato "Modo X ACTIVAR/DESACTIVAR"
                await cursorApi.chat.sendMessage(instructions);
                vscode.window.showInformationMessage('Mensaje enviado al chat de Cursor');
                return true;
            }
        }

        // 2. Intentar comunicarse con la API de chat de VS Code (si está disponible)
        const commands = await vscode.commands.getCommands();
        const chatCommand = commands.find(cmd => cmd.includes('chat.action.sendMessage') || cmd.includes('cursor.chat'));
            
        if (chatCommand) {
            try {
                await vscode.commands.executeCommand(chatCommand, instructions);
                vscode.window.showInformationMessage('Mensaje enviado al chat usando comandos de VS Code');
                return true;
            } catch (cmdError) {
                console.error("Error al ejecutar comando de chat:", cmdError);
            }
        }
        
        // 3. Intentar con otras extensiones populares
        const chatExtensions = [
            'chatgpt.chatgpt',
            'gpt-pilot.gpt-pilot',
            'codeium.codeium',
            'github.copilot-chat'
        ];
        
        for (const extId of chatExtensions) {
            const ext = vscode.extensions.getExtension(extId);
            if (ext) {
                if (!ext.isActive) {
                    await ext.activate();
                }
                
                const api = ext.exports;
                if (api && (api.sendMessage || api.chat?.sendMessage)) {
                    try {
                        const sendFn = api.sendMessage || api.chat?.sendMessage;
                        if (typeof sendFn === 'function') {
                            await sendFn(instructions);
                            vscode.window.showInformationMessage(`Mensaje enviado al chat de ${extId}`);
                            return true;
                        }
                    } catch (extError) {
                        console.log(`Error con extensión ${extId}:`, extError);
                    }
                }
            }
        }
        
        // 4. Alternativa: Mostrar WebView con mensaje
        if (extensionContext) {
            showModesWebview(extensionContext, modeManager);
            vscode.window.showInformationMessage('No se pudo enviar automáticamente al chat. Mostrando panel visual.');
            return true;
        }
        
        return false;
    } catch (error) {
        console.error('Error al enviar mensaje al chat:', error);
        vscode.window.showErrorMessage('Error al enviar al chat: ' + (error as Error).message);
        
        // En caso de error, intentar mostrar el WebView
        try {
            if (extensionContext) {
                showModesWebview(extensionContext, modeManager);
                vscode.window.showInformationMessage('Mostrando modos activos en panel visual como alternativa.');
                return true;
            }
        } catch (webviewError) {
            console.error('Error al mostrar WebView:', webviewError);
        }
        return false;
    }
}

/**
 * Envía un mensaje a Cursor con los modos activados o desactivados en formato simple
 * @param modeManager El gestor de modos para obtener los modos
 * @param originalModes Los modos originales antes del cambio
 */
async function sendModeChangesToChat(modeManager: ModeManager, originalModes: string[]) {
    const newModes = modeManager.getActiveModes();
    
    // Identificar modos activados (están en newModes pero no en originalModes)
    const activatedModes = newModes.filter(mode => !originalModes.includes(mode));
    
    // Identificar modos desactivados (están en originalModes pero no en newModes)
    const deactivatedModes = originalModes.filter(mode => !newModes.includes(mode));
    
    // Mostrar notificaciones para modos activados
    for (const mode of activatedModes) {
        const message = generateActivateModeMessage(mode);
        vscode.window.showInformationMessage(message, 'Copiar').then(selection => {
            if (selection === 'Copiar') {
                vscode.env.clipboard.writeText(message);
                vscode.window.showInformationMessage('Comando copiado al portapapeles');
            }
        });
    }
    
    // Mostrar notificaciones para modos desactivados
    for (const mode of deactivatedModes) {
        const message = generateDeactivateModeMessage(mode);
        vscode.window.showInformationMessage(message, 'Copiar').then(selection => {
            if (selection === 'Copiar') {
                vscode.env.clipboard.writeText(message);
                vscode.window.showInformationMessage('Comando copiado al portapapeles');
            }
        });
    }
    
    // Mensaje para modo memoria si cambió
    const memoryMode = modeManager.isMemoryModeActive();
    const memoryMessage = memoryMode ? "Modo MEMORIA ACTIVAR" : "Modo MEMORIA DESACTIVAR";
    vscode.window.showInformationMessage(memoryMessage, 'Copiar').then(selection => {
        if (selection === 'Copiar') {
            vscode.env.clipboard.writeText(memoryMessage);
            vscode.window.showInformationMessage('Comando copiado al portapapeles');
        }
    });
}

/**
 * Crea un archivo temporal con todos los comandos de modos activos para facilitar copiar y pegar al chat
 * @param modeManager El gestor de modos para obtener los modos
 */
async function createModesCommandFile(modeManager: ModeManager): Promise<void> {
    try {
        // Crear contenido del archivo
        let content = '// COMANDOS PARA ACTIVAR MODOS (COPIA Y PEGA EN EL CHAT)\n\n';
        
        // Obtener modos activos y estado de memoria
        const activeModes = modeManager.getActiveModes();
        const memoryMode = modeManager.isMemoryModeActive();
        
        // Añadir comandos para los modos activos
        if (activeModes.length > 0) {
            content += '// Comandos para activar modos:\n';
            activeModes.forEach(mode => {
                content += `Modo ${mode} ACTIVAR\n`;
            });
            content += '\n';
        } else {
            content += '// No hay modos activos actualmente\n\n';
        }
        
        // Añadir comando para el modo memoria
        content += '// Comando para modo memoria:\n';
        content += memoryMode ? 'Modo MEMORIA ACTIVAR\n' : 'Modo MEMORIA DESACTIVAR\n';
        
        // Crear archivo temporal en el editor
        const document = await vscode.workspace.openTextDocument({
            content: content,
            language: 'plaintext'
        });
        
        // Mostrar el documento
        await vscode.window.showTextDocument(document);
        
        vscode.window.showInformationMessage('Comandos de modos generados. Copia y pega en el chat de Cursor.');
    } catch (error) {
        console.error('Error al crear archivo de comandos:', error);
        vscode.window.showErrorMessage('Error al crear archivo de comandos: ' + (error as Error).message);
    }
}

/**
 * Esta función se llama cuando la extensión es activada
 * @param context El contexto de la extensión
 */
export function activate(context: vscode.ExtensionContext) {
    console.log('La extensión "riper5-extension" está activa');
    
    // Guardar el contexto para uso global
    extensionContext = context;
    
    // Inicializar el gestor de modos
    modeManager = new ModeManager(context);
    
    // Configurar la barra de estado
    setupStatusBar(context, modeManager);

    // Registrar comando para mostrar panel de modos
    const showModesCommand = vscode.commands.registerCommand('riper5.showModesPanel', () => {
        showModesWebview(context, modeManager);
    });
    
    // Registrar comando para insertar información de modos en el editor activo
    const insertModesInfoCommand = vscode.commands.registerCommand('riper5.insertModesInfo', () => {
        insertModesInfoIntoEditor(modeManager);
    });
    
    // Registrar comando para generar archivo con comandos de modos
    const generateCommandsCommand = vscode.commands.registerCommand('riper5.generateCommands', () => {
        createModesCommandFile(modeManager);
    });
    
    // Registrar el comando para seleccionar modos
    const selectModeCommand = vscode.commands.registerCommand('riper5.selectMode', async () => {
        // Guardar los modos originales antes de cambiarlos
        const originalModes = modeManager.getActiveModes();
        const originalMemory = modeManager.isMemoryModeActive();
        
        // Abrir el selector y aplicar cambios
        const result = await modeManager.selectMode();
        if (result) {
            // Actualizar interfaz
            updateModeStatusBar(modeManager);
            
            // Enviar cambios al chat de forma simple
            await sendModeChangesToChat(modeManager, originalModes);
            
            // Si el WebView está abierto, actualizarlo
            if (modesPanel) {
                updateWebviewContent(modesPanel, modeManager);
            }
            
            // Insertar automáticamente la información en el editor
            await insertModesInfoIntoEditor(modeManager);
        }
    });

    // Registrar el comando para activar/desactivar memoria
    const toggleMemoryCommand = vscode.commands.registerCommand('riper5.toggleMemory', async () => {
        // Guardar el estado original
        const originalMemory = modeManager.isMemoryModeActive();
        
        // Activar/desactivar memoria
        await modeManager.toggleMemory();
        
        // Actualizar interfaz
        updateMemoryStatusBar(modeManager);
        
        // Mostrar notificación con opción de copiar
        const memoryMode = modeManager.isMemoryModeActive();
        const memoryMessage = memoryMode ? "Modo MEMORIA ACTIVAR" : "Modo MEMORIA DESACTIVAR";
        vscode.window.showInformationMessage(memoryMessage, 'Copiar').then(selection => {
            if (selection === 'Copiar') {
                vscode.env.clipboard.writeText(memoryMessage);
                vscode.window.showInformationMessage('Comando copiado al portapapeles');
            }
        });
        
        // Si el WebView está abierto, actualizarlo
        if (modesPanel) {
            updateWebviewContent(modesPanel, modeManager);
        }
    });

    // Registrar comando específico para copiar instrucciones al portapapeles
    const copyChatInstructionsCommand = vscode.commands.registerCommand('riper5.copyChatInstructions', async () => {
        // Obtener modos actuales
        const activeModes = modeManager.getActiveModes();
        const memoryMode = modeManager.isMemoryModeActive();
        
        // Mostrar notificaciones para cada modo activo
        for (const mode of activeModes) {
            const message = generateActivateModeMessage(mode);
            vscode.window.showInformationMessage(message, 'Copiar').then(selection => {
                if (selection === 'Copiar') {
                    vscode.env.clipboard.writeText(message);
                    vscode.window.showInformationMessage('Comando copiado al portapapeles');
                }
            });
        }
        
        // Mostrar notificación para modo memoria
        const memoryMessage = memoryMode ? "Modo MEMORIA ACTIVAR" : "Modo MEMORIA DESACTIVAR";
        vscode.window.showInformationMessage(memoryMessage, 'Copiar').then(selection => {
            if (selection === 'Copiar') {
                vscode.env.clipboard.writeText(memoryMessage);
                vscode.window.showInformationMessage('Comando copiado al portapapeles');
            }
        });
    });

    context.subscriptions.push(
        selectModeCommand, 
        toggleMemoryCommand, 
        copyChatInstructionsCommand,
        showModesCommand,
        insertModesInfoCommand,
        generateCommandsCommand
    );
}

/**
 * Esta función se llama cuando la extensión es desactivada
 */
export function deactivate() {
    // Cerrar el panel webview si está abierto
    if (modesPanel) {
        modesPanel.dispose();
    }
    
    // Limpieza
    console.log('La extensión "riper5-extension" ha sido desactivada');
} 