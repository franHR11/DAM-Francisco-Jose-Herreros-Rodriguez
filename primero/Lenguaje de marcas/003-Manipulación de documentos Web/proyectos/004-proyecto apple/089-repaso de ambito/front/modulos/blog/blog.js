function cargaBlog(){
	fetch("../back/?tabla=blog") 													// Cargo un endpoint en el back
	.then(function(response) { 													// Cuando obtenga respuesta
		 return response.json(); 													// La convierto en json
	})
	.then(function(datos) { 														// Y cuando reciba datos
		 console.log(datos);
		 let principal = document.querySelector("main")						// Selecciona la etiqueta principal
		 let plantilla = document.querySelector("#plantillaentrada")	// Selecciona el template
		 datos.forEach(function(dato){											// Para cada dato recibido
		 	let instancia = plantilla.content.cloneNode(true);				// Clono la plantilla original
		 	instancia.querySelector("h4").textContent = dato.titulo		// Introduzco un titulo personalizado
		 	instancia.querySelector("time").textContent = dato.fecha		// Introduzco la fecha personalizada
		 	
		 	instancia.onclick = function(){
		 		console.log("Has hecho click en un articulo")
		 	}
		 	
		 	principal.appendChild(instancia)										// Añadimos la instancia al cuerpo
		 })
	 })
 }
 
 cargaBlog();