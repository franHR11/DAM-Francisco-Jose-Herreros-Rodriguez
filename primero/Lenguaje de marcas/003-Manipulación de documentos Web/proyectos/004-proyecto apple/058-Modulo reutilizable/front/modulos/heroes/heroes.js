fetch("../back/?tabla=heroes")													// Cargo un endpoint en el back
.then(function(response){														// Cuando obtenga respuesta
	return response.json()														// La conbierto en json
})
.then(function(datos){															// Y cuando reciba datos
	console.log(datos)
	let contenedorheroes = document.querySelector("#heroes")
	let plantillaheroe = document.querySelector("#plantillaheroe")
	datos.forEach(function(dato){
		let instancia = plantillaheroe.content.cloneNode(true);
		instancia.querySelector("h3").textContent = dato.titulo
		instancia.querySelector("h4").textContent = dato.texto
		instancia.querySelector("article").style.background = "url(data:image/png;base64,"+dato.imagen+")"
		contenedorheroes.appendChild(instancia)
		
	})
})
