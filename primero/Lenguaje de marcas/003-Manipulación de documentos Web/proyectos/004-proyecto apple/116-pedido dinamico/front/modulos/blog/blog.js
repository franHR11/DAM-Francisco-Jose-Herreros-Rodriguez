function cargaBlog(){
    // Primero obtenemos las categorías
    fetch("../back/?tabla=categoriasblog")
    .then(response => response.json())
    .then(categorias => {
        // Creamos un mapa de ID -> nombre de categoría
        const categoriasMap = {};
        categorias.forEach(cat => {
            categoriasMap[cat.Identificador] = cat.titulo || cat.nombre || cat.categoria || 'Categoría ' + cat.Identificador;
        });

        // Luego cargamos los posts del blog
        return fetch("../back/?tabla=blog")
            .then(response => response.json())
            .then(datos => ({ datos, categoriasMap }));
    })
    .then(function({ datos, categoriasMap }) {
        let principal = document.querySelector("main");
        let plantilla = document.querySelector("#plantillaentrada");
        
        datos.forEach(function(dato){
            let instancia = plantilla.content.cloneNode(true);
            
            if(dato.imagen) {
                instancia.querySelector("img").src = "data:image/png;base64," + dato.imagen;
            }
            
            instancia.querySelector("h4").textContent = dato.titulo;
            instancia.querySelector("time").textContent = dato.fecha;
            // Usar el nombre de la categoría en lugar del ID
            instancia.querySelector("h5").textContent = "Categoría: " + 
                (categoriasMap[dato.categoriasblog_categorias] || 'Desconocida');
            instancia.querySelector("article").setAttribute("Identificador", dato.Identificador);
            
            instancia.querySelector("article").onclick = function(){
                fetch("../back/?busca=blog&campo=Identificador&dato="+this.getAttribute("Identificador"))
                .then(function(response) {
                    return response.json();
                })
                .then(function(datos) {
                    let modal = document.querySelector("#modalpersonalizado");
                    modal.innerHTML = "";
                    
                    let contenedor = document.createElement("div");
                    contenedor.classList.add("modal-contenedor");
                    
                    let imagen = document.createElement("img");
                    if(datos[0].imagen) {
                        imagen.src = "data:image/png;base64," + datos[0].imagen;
                    }
                    imagen.classList.add("modal-imagen");
                    contenedor.appendChild(imagen);
                    
                    let textoContenedor = document.createElement("div");
                    textoContenedor.classList.add("modal-texto");
                    
                    let titulo = document.createElement("h3");
                    titulo.textContent = datos[0].titulo;
                    textoContenedor.appendChild(titulo);
                    
                    let fecha = document.createElement("time");
                    fecha.textContent = datos[0].fecha;
                    textoContenedor.appendChild(fecha);
                    
                    // Usar el nombre de la categoría en el modal
                    let categoria = document.createElement("h5");
                    categoria.classList.add("categoria");
                    categoria.textContent = "Categoría: " + 
                        (categoriasMap[datos[0].categoriasblog_categorias] || 'Desconocida');
                    textoContenedor.appendChild(categoria);
                    
                    let contenido = document.createElement("p");
                    contenido.textContent = datos[0].contenido;
                    textoContenedor.appendChild(contenido);
                    
                    contenedor.appendChild(textoContenedor);
                    modal.appendChild(contenedor);
                })
                
                document.querySelector("#contienemodalpersonalizado").style.display = "block";
                document.querySelector("#contienemodalpersonalizado").onclick = function(event){
                    event.stopPropagation();
                    this.style.display = "none";
                }
                document.querySelector("#modalpersonalizado").onclick = function(event){
                    event.stopPropagation();
                }
            }
            principal.appendChild(instancia);
        })
    });
}

cargaBlog();