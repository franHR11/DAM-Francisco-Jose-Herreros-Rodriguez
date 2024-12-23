function recogeHeroes(){
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
			instancia.querySelector("h3").innerHTML = dato.titulo
			instancia.querySelector("h4").innerHTML = dato.texto
			instancia.querySelector("article").style.background = "url(../static/"+dato.imagen+")"
			instancia.querySelector("article").style.backgroundSize = "cover";
			contenedorheroes.appendChild(instancia)
			
		})
	})
}
recogeHeroes();