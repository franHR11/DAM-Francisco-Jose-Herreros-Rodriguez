/**
 * Configuración global de SunEditor
 * @author franHR - web - www.pcprogramacion.es
 */
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si existe el elemento descripcion
    const descripcionTextarea = document.getElementById('descripcion');
    
    if (descripcionTextarea && typeof suneditor !== 'undefined') {
        try {
            // Inicializar el editor con opciones básicas
            const editor = suneditor.create('descripcion', {
                width: '100%',
                height: '400px',
                buttonList: [
                    ['undo', 'redo'],
                    ['font', 'fontSize', 'formatBlock'],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['removeFormat'],
                    ['fontColor', 'hiliteColor', 'outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'table'],
                    ['link', 'image', 'video'],
                    ['fullScreen', 'showBlocks', 'codeView'],
                ],
                lang: 'es',
                placeholder: 'Escribe el contenido aquí...',
                
                // Asegurar que el textarea se actualice al enviar el formulario
                onLoad: function(e) {
                    console.log('SunEditor cargado correctamente');
                }
            });
            
            // Asegurar que el textarea se actualice antes de enviar el formulario
            const form = descripcionTextarea.closest('form');
            if (form) {
                form.addEventListener('submit', function() {
                    descripcionTextarea.value = editor.getContents();
                });
            }
        } catch (error) {
            console.error('Error al inicializar SunEditor:', error);
        }
    }
}); 