// Cargar datos del carrusel1
fetch("../back/?tabla=carrusel1")
.then(response => response.json())
.then(function(datos){
    let carrusel1 = document.querySelector("#carrusel1")
    let plantilla = document.querySelector("#plantillacarrusel1")
    
    // Si no hay datos, crear elementos por defecto
    if(datos.length === 0) {
        for(let i = 0; i < 8; i++) {
            let instancia = plantilla.content.cloneNode(true);
            instancia.querySelector(".enlace").style.display = "none";
            carrusel1.appendChild(instancia)
        }
    } else {
        datos.forEach(function(dato){
            let instancia = plantilla.content.cloneNode(true);
            instancia.querySelector("h3").textContent = dato.titulo
            instancia.querySelector("p").textContent = dato.texto
            instancia.querySelector("article").style.background = "url(../static/"+dato.imagen+")"
            
            // Solo mostrar botón si hay enlace y texto
            if(!dato.enlace || !dato.textoboton) {
                instancia.querySelector(".enlace").style.display = "none";
            } else {
                instancia.querySelector(".enlace").setAttribute("href", dato.enlace)
                instancia.querySelector(".boton").textContent = dato.textoboton
            }
            
            carrusel1.appendChild(instancia)
        })
    }
})

// Cargar datos del carrusel2
fetch("../back/?tabla=carrusel2")
.then(response => response.json())
.then(function(datos){
    let carrusel2 = document.querySelector("#carrusel2")
    let plantilla = document.querySelector("#plantillacarrusel2")
    
    // Si no hay datos, crear elementos por defecto
    if(datos.length === 0) {
        for(let i = 0; i < 8; i++) {
            let instancia = plantilla.content.cloneNode(true);
            carrusel2.appendChild(instancia)
        }
    } else {
        datos.forEach(function(dato){
            let instancia = plantilla.content.cloneNode(true);
            instancia.querySelector("p").textContent = dato.texto
            instancia.querySelector("article").style.background = "url(../static/"+dato.imagen+")"
            instancia.querySelector(".enlace-carrusel2").setAttribute("href", dato.enlace)
            carrusel2.appendChild(instancia)
        })
    }
})

let puntos = document.querySelectorAll(".punto")					// Selecciono los puntos
puntos.forEach(function(punto,index){									// PAra cada uno de los puntos
	punto.onclick = function(){											// Cuando haga click en un punto			
		let carrusel1 = document.querySelector("#carrusel1")		// Cojo el carrusel
		carrusel1.classList.remove("animado1")							// Paro la animacion
		carrusel1.style.left = 0-index*1024+"px"						// Le pongo a mano el desfase en base al punto en el cual he hecho click
	}
})
