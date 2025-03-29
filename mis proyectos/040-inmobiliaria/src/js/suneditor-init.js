/**
 * Inicialización y configuración de SunEditor
 * @author franHR - web - www.pcprogramacion.es
 */

document.addEventListener('DOMContentLoaded', function() {
    // Verificar si existe el elemento descripcion (para propiedades o blog)
    const descripcionTextarea = document.getElementById('descripcion');
    
    if (descripcionTextarea) {
        // Importar SunEditor desde node_modules
        import('/node_modules/suneditor/dist/suneditor.min.js')
            .then((module) => {
                const SunEditor = module.default;
                
                // Cargar los plugins
                import('/node_modules/suneditor/src/plugins/index.js')
                    .then((plugins) => {
                        // Inicializar el editor
                        const editor = SunEditor.create(descripcionTextarea, {
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
                            plugins: plugins.default,
                            lang: 'es',
                            placeholder: 'Escribe el contenido aquí...',
                            fontSizeUnit: 'pt',
                            imageUploadUrl: '/admin/upload.php', // URL para subir imágenes (se implementará en el futuro)
                            imageGalleryUrl: '/admin/gallery.php', // URL para galería de imágenes (se implementará en el futuro)
                            
                            // Evento al enviar el formulario para sincronizar el contenido
                            onSubmit: function(contents) {
                                descripcionTextarea.value = contents;
                            }
                        });
                        
                        // Asegurar que el textarea se actualice antes de enviar el formulario
                        const form = descripcionTextarea.closest('form');
                        if (form) {
                            form.addEventListener('submit', function() {
                                descripcionTextarea.value = editor.getContents();
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar plugins de SunEditor:', error);
                    });
            })
            .catch(error => {
                console.error('Error al cargar SunEditor:', error);
            });
    }
}); 