fetch("../back/?tabla=destacados")													// Cargo un endpoint en el back
.then(function(response){														// Cuando obtenga respuesta
	return response.json()														// La conbierto en json
})
.then(function(datos){															// Y cuando reciba datos
	console.log(datos)
	let contenedordestacados = document.querySelector("#destacados")
	let plantilladestacado = document.querySelector("#plantilladestacado")
	datos.forEach(function(dato){
		let instancia = plantilladestacado.content.cloneNode(true);
		instancia.querySelector("h3").textContent = dato.titulo
		instancia.querySelector("h4").textContent = dato.texto
		instancia.querySelector("article").style.background = "url(../static/"+dato.imagen+")"
		
		// Solo mostrar botón 1 si hay enlace y texto
		if(!dato.enlace1 || !dato.textoboton1) {
			instancia.querySelector("#enlace1").style.display = "none";
		} else {
			instancia.querySelector("#enlace1").setAttribute("href",dato.enlace1)
			instancia.querySelector("#boton1").textContent = dato.textoboton1
		}
		
		// Solo mostrar botón 2 si hay enlace y texto
		if(!dato.enlace2 || !dato.textoboton2) {
			instancia.querySelector("#enlace2").style.display = "none";
		} else {
			instancia.querySelector("#enlace2").setAttribute("href",dato.enlace2)
			instancia.querySelector("#boton2").textContent = dato.textoboton2
		}
		
		contenedordestacados.appendChild(instancia)
	})
})