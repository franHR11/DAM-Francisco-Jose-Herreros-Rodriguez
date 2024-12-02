
fetch("../back/cabecera.php")													// Cargo un endpoint en el back
.then(function(response){														// Cuando obtenga respuesta
	return response.json()														// La conbierto en json
})
.then(function(datos){															// Y cuando reciba datos
	console.log(datos)
	let cabecera = document.querySelector("header nav ul")
	let plantilla = document.querySelector("#elementomenu")
	datos.forEach(function(dato){
		let instancia = plantilla.content.cloneNode(true);
		instancia.querySelector("a").textContent = dato.nombre
		cabecera.appendChild(instancia)
		
	})
})
