function productosRelacionados(){
    fetch("../back/?tabla=productos")
    .then(function(response) { return response.json(); })
    .then(function(datos) { 
        console.log(datos)
        let contenedor = document.querySelector("aside")
        datos.splice(4);
        datos.forEach(function(dato){
            let articulo = document.createElement("article")
            
            // Crear y añadir imagen con ruta completa
            let imagen = document.createElement("img")
            // Actualizar la ruta para usar la carpeta static
            imagen.src = dato.imagen.startsWith('http') ? dato.imagen : '../static/' + dato.imagen
            imagen.alt = dato.titulo
            imagen.onerror = function() {
                // Si la imagen falla, cargar una imagen por defecto de la carpeta static
                this.src = '../static/default.jpg'
                console.log("Error cargando imagen:", dato.imagen)
            }
            articulo.appendChild(imagen)
            
            // Crear y añadir título
            let titulo = document.createElement("h4")
            titulo.textContent = dato.titulo
            articulo.appendChild(titulo)
            
            // Crear y añadir subtítulo
            let subtitulo = document.createElement("h5")
            subtitulo.textContent = dato.subtitulo
            articulo.appendChild(subtitulo)
            
            // Crear y añadir precio
            let precio = document.createElement("p")
            precio.className = "precio"
            precio.textContent = dato.precio + " €"
            articulo.appendChild(precio)
            
            // Añadir botón
            let boton = document.createElement("button")
            boton.textContent = "Saber más"
            boton.addEventListener("click", function(){
                window.location.href = "producto.php?prod=" + dato.Identificador
            })
            articulo.appendChild(boton)
            
            contenedor.appendChild(articulo)
        })
    })
}

productosRelacionados();