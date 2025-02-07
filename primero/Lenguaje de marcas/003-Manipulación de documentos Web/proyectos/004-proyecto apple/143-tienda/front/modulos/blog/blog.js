// Variable global para almacenar las categorías
let categoriasMap = {};

function cargaBlog(){
    fetch("../back/?tabla=categoriasblog")
    .then(response => response.json())
    .then(categorias => {
        // Guardamos las categorías globalmente
        categorias.forEach(cat => {
            categoriasMap[cat.Identificador] = cat.titulo || cat.nombre || cat.categoria || 'Categoría ' + cat.Identificador;
        });

        return fetch("../back/?tabla=blog")
            .then(response => response.json());
    })
    .then(function(datos) {
        let principal = document.querySelector("main");
        let plantilla = document.querySelector("#plantillaentrada");
        
        datos.forEach(function(dato){
            let instancia = plantilla.content.cloneNode(true);
            
            // Modificar la forma de mostrar la imagen en el listado
            if(dato.imagen) {
                instancia.querySelector("img").src = "../static/" + dato.imagen;
            }
            
            instancia.querySelector("h4").textContent = dato.titulo;
            instancia.querySelector("time").textContent = dato.fecha;
            // Usar el nombre de la categoría en lugar del ID
            instancia.querySelector("h5").textContent = categoriasMap[dato.categoriasblog_categorias] || 'Categoría Desconocida';
            
            // Añadir preview del contenido
            const contenidoPreview = instancia.querySelector(".contenido-preview");
            contenidoPreview.textContent = dato.contenido;
            
            // Configurar el botón
            const boton = instancia.querySelector(".ver-articulo");
            instancia.querySelector("article").setAttribute("Identificador", dato.Identificador);
            
            // Evento click solo en el botón
            boton.onclick = function(e){
                e.stopPropagation(); // Evitar propagación al artículo
                mostrarModal(dato.Identificador);
            }
            
            principal.appendChild(instancia);
        });
    });
}

function mostrarModal(identificador) {
    fetch("../back/?busca=blog&campo=Identificador&dato="+identificador)
    .then(response => response.json())
    .then(datos => {
        let modal = document.querySelector("#modalpersonalizado");
        modal.innerHTML = "";

        // Añadir botón de cierre
        let closeButton = document.createElement("button");
        closeButton.className = "modal-close";
        closeButton.innerHTML = "×";
        closeButton.onclick = function() {
            document.querySelector("#contienemodalpersonalizado").style.display = "none";
        };
        modal.appendChild(closeButton);

        // Encabezado del modal con imagen y texto
        let header = document.createElement("div");
        header.className = "modal-header";
        
        // Contenedor de imagen
        let imagenContenedor = document.createElement("div");
        imagenContenedor.className = "imagen-contenedor";
        let imagen = document.createElement("img");
        if(datos[0].imagen) {
            imagen.src = "../static/" + datos[0].imagen;
        }
        imagenContenedor.appendChild(imagen);
        header.appendChild(imagenContenedor);

        // Contenedor de contenido del header
        let contenidoHeader = document.createElement("div");
        contenidoHeader.className = "contenido-header";
        
        let titulo = document.createElement("h3");
        titulo.textContent = datos[0].titulo;
        
        let metaInfo = document.createElement("div");
        metaInfo.className = "modal-meta";
        
        let fecha = document.createElement("time");
        fecha.textContent = datos[0].fecha;
        
        let categoria = document.createElement("h5");
        categoria.classList.add("categoriablog");
        categoria.textContent = categoriasMap[datos[0].categoriasblog_categorias] || 'Categoría Desconocida';
        
        contenidoHeader.appendChild(titulo);
        metaInfo.appendChild(fecha);
        metaInfo.appendChild(categoria);
        contenidoHeader.appendChild(metaInfo);
        header.appendChild(contenidoHeader);
        
        modal.appendChild(header);

        // Contenido principal
        let contenedor = document.createElement("div");
        contenedor.classList.add("modal-contenedor");
        
        let contenido = document.createElement("div");
        contenido.classList.add("modal-contenido");
        contenido.textContent = datos[0].contenido;
        contenedor.appendChild(contenido);
        
        modal.appendChild(contenedor);
        
        document.querySelector("#contienemodalpersonalizado").style.display = "block";
    });
}

cargaBlog();