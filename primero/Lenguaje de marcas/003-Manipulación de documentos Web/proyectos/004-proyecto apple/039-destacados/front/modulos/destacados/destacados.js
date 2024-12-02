
fetch("../back/destacados.php")													// Cargo un endpoint en el back
.then(function(response){														// Cuando obtenga respuesta
	return response.json()														// La conbierto en json
})
.then(function(datos){															// Y cuando reciba datos
	console.log(datos)
	let contenedorheroes = document.querySelector("#destacados")
	let plantilladestacado = document.querySelector("#plantilladestacado")
	datos.forEach(function(dato){
		let instancia = plantilladestacado.content.cloneNode(true);
		instancia.querySelector("h3").textContent = dato.titulo
		instancia.querySelector("h4").textContent = dato.texto
		instancia.querySelector("button").textContent = dato.comprar
		instancia.querySelector(".botonmas").textContent = dato.enlace
		instancia.querySelector("article").style.background = "url(data:image/png;base64,"+dato.imagen+")"
		contenedorheroes.appendChild(instancia)
		
	})
})