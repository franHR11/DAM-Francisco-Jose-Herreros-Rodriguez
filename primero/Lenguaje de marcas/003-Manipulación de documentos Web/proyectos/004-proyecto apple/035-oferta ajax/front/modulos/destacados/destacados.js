console.log("Soy el JS de los destacados")
let destacados = [
	'uno',
	'dos',
	'tres',
	'cuatro',
	'cinco',
	'seis'
	]																						// Creo un array de elementos
let contenedordestacados = document.querySelector("#destacados")		// Selecciono un contenedor
let plantilladestacados = document.querySelector("#destacado")			// Selecciono el elemento plantilla
destacados.forEach(function(destacado){										// Para cada destacado
	let instancia = plantilladestacados.content.cloneNode(true);		// Clono la plantilla
	instancia.querySelector("h3").textContent = destacado					/// Cambio el texto de cada instancia
	contenedordestacados.appendChild(instancia)								// Lo añado al contenedor
})