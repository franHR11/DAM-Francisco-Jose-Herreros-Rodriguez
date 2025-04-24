/**
 * Configuración para SunEditor
 * @author franHR - web - www.pcprogramacion.es
 */

// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Configuración para el editor de propiedades (campo descripción)
    const descripcionEditor = document.getElementById('descripcion');
    if (descripcionEditor) {
        const editor = SUNEDITOR.create(descripcionEditor, {
            // Opciones generales
            width: '100%',
            height: '300px',
            buttonList: [
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['removeFormat'],
                ['fontColor', 'hiliteColor'],
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'table'],
                ['link', 'image', 'video'],
                ['fullScreen', 'showBlocks', 'codeView'],
                ['preview', 'print']
            ],
            // Usar idioma español si está disponible
            lang: SUNEDITOR_LANG ? SUNEDITOR_LANG['es'] || SUNEDITOR_LANG['en'] : null,
            // Placeholder personalizado
            placeholder: 'Escribe la descripción de la propiedad aquí...',
            // Opciones de imágenes
            imageFileInput: false,
            // Autofocus al cargar
            autoFocus: true
        });

        // Asegurarse de que el contenido se transfiera al textarea antes de enviar el formulario
        const form = descripcionEditor.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Actualizar el valor del textarea con el contenido del editor
                descripcionEditor.value = editor.getContents();
                console.log('Formulario de propiedad enviado, contenido descripción:', descripcionEditor.value);
            });
        }
    }

    // Configuración para el editor de blog (campo contenido)
    const contenidoEditor = document.getElementById('contenido');
    if (contenidoEditor) {
        const editor = SUNEDITOR.create(contenidoEditor, {
            // Opciones generales
            width: '100%',
            height: '500px',
            buttonList: [
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['removeFormat'],
                ['fontColor', 'hiliteColor'],
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'table'],
                ['link', 'image', 'video'],
                ['fullScreen', 'showBlocks', 'codeView'],
                ['preview', 'print']
            ],
            // Usar idioma español si está disponible
            lang: SUNEDITOR_LANG ? SUNEDITOR_LANG['es'] || SUNEDITOR_LANG['en'] : null,
            // Placeholder personalizado
            placeholder: 'Escribe el contenido del artículo aquí...',
            // Opciones de imágenes
            imageFileInput: false,
            // Autofocus al cargar
            autoFocus: true
        });

        // Asegurarse de que el contenido se transfiera al textarea antes de enviar el formulario
        const form = contenidoEditor.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Detener temporalmente el envío
                e.preventDefault();
                
                // Actualizar el valor del textarea con el contenido del editor
                contenidoEditor.value = editor.getContents();
                console.log('Formulario de blog enviado, contenido:', contenidoEditor.value);
                
                // Continuar con el envío del formulario después de asegurar que el contenido está actualizado
                setTimeout(function() {
                    form.submit();
                }, 100);
            });
        }
    }
}); 