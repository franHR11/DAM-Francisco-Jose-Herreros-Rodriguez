console.log("ok en marcha");

// Seleccionar solo celdas editables
let celdas = document.querySelectorAll("td.editable");

celdas.forEach(function(celda){
    celda.ondblclick = function(){
        if (!this.classList.contains('editable')) return;
        
        console.log("ok has hecho doble click");
        
        // Guardar valor original
        this.dataset.originalContent = this.textContent;
        
        this.setAttribute("contenteditable", "true");
        this.classList.add("celdaactiva");
        this.focus();
    }
    
    celda.onblur = function(){
        if (!this.classList.contains('editable')) return;
        
        this.setAttribute("contenteditable", "false");
        this.classList.remove("celdaactiva");
        
        let nuevoContenido = this.textContent.trim();
        let contenidoOriginal = this.dataset.originalContent;
        
        // Solo actualizar si el contenido ha cambiado
        if (nuevoContenido !== contenidoOriginal) {
            let tabla = this.dataset.tabla;
            let columna = this.dataset.columna;
            let id = this.dataset.id;
            
            fetch("crud/actualizar_rapido.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `tabla=${encodeURIComponent(tabla)}&columna=${encodeURIComponent(columna)}&identificador=${encodeURIComponent(id)}&contenido=${encodeURIComponent(nuevoContenido)}`
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            })
            .then(data => {
                console.log('Actualización exitosa:', data);
                // Actualizar el contenido original
                this.dataset.originalContent = nuevoContenido;
            })
            .catch(error => {
                console.error('Error:', error);
                // Revertir cambios si hay error
                this.textContent = contenidoOriginal;
                alert('Error al guardar los cambios');
            });
        }
    }
});

// Agregar estilos para celdas editables
document.head.insertAdjacentHTML('beforeend', `
    <style>
        td.editable {
            cursor: pointer;
        }
        td.editable:hover {
            background-color: #f8f9fa;
        }
        td.celdaactiva {
            background-color: #fff;
            box-shadow: 0 0 0 2px #007bff;
            outline: none;
        }
    </style>
`);