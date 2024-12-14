// Cargo los menús de la cabecera ///////////////////////////////////

fetch("../back/?tabla=categorias") 											// Cargo un endpoint en el back
.then(function(response) { 													// Cuando obtenga respuesta
    return response.json(); 													// La convierto en json
})
.then(function(datos) { 														// Y cuando reciba datos
    console.log(datos);
    let cabecera = document.querySelector("header nav ul");			// Selecciono la cabecera
    let plantilla = document.querySelector("#elementomenu");		// Tomo una plantilla template
    
    datos.forEach(function(dato) {											// Para cada dato recibido
        let instancia = plantilla.content.cloneNode(true);			// Creo una instancia
        let enlace = instancia.querySelector("a");						// Selecciono el enlace interior
        
        enlace.textContent = dato.nombre;									// Le pongo el atributo de texto
        enlace.setAttribute("href", "categoria.php?cat=" + dato.Identificador);	// Y le digo a qué página debe ir
        enlace.setAttribute("cat", dato.Identificador);				// Le pongo un atributo categoría
        
        enlace.addEventListener("mouseover", function() {			// Cuando pase por encima de esa categoria
            console.log("Vamos a ver que hay en esta categoria");
            console.log(this.textContent)
            let tituloseccion = this.textContent						// Cargo el titulo de la categoria
            fetch("../back/?busca=productos&campo=categorias_nombre&dato="+this.getAttribute("cat"))	// Fetch para obtener productos por cateogrias
            .then(function(response) { 									// Cuando obtenga respuesta
					 return response.json(); 									// La convierto en json
				})
				.then(function(datos) { 										// Y cuando reciba datos
					 console.log(datos);
					 document.querySelector("#categoria").textContent = tituloseccion	// Pongo el titulo de la categoria
					 document.querySelector("#productos").innerHTML = ""	// Vacio los productos
					 datos.forEach(function(dato){								// Para cada uno de los productos
					 document.querySelector("#productos").innerHTML += "<li><a href='producto.php?prod="+dato.Identificador+"'>"+dato.titulo+"</a></li>"	// Los pongo en el listado
					 })
					 })
        });
        
        cabecera.appendChild(instancia);
    });
})
.catch(function(error) {
    console.warn("Error al cargar las categorías:", error);
    document.querySelector("#contienemodal").style.display = "block"
});

// Aplico difuminado en el fondo al entrar y salir de la cabecera /////////////////////

let cabecera = document.querySelector("header")							// Selecciono la cabecera

cabecera.onmouseenter = function(){											// Cuando entro
	console.log("Has entrado")		
	document.querySelector("main").classList.add("difuminado")		// LE añado una clase css
	cabecera.style.background = "rgba(255,255,255,0.9)"				// Le pongo transparencia al fondo
}

cabecera.onmouseleave = function(){											// Cuando salgo
	console.log("Has salido")
	document.querySelector("main").classList.remove("difuminado")	// Le quito la clase css
	cabecera.style.background = "rgba(255,255,255,1)"					// Y le pongo un color blanco sólido
}
