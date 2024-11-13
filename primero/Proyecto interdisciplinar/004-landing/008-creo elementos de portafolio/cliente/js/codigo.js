window.onload = function(){													// Cuando la ventana haya cargado
	console.log("Javascript está preparado para la acción")
	
	////////////////////////////// ARTICULOS DEL BLOG ///////////////////////////////
	
	fetch("http://localhost:5000/damearticulos")							// Me conecto al servidor
	.then(function(response){													// Cuando el servidor responda
		return response.json()													// Lo que me responda lo interpreto como json
	})
	.then(function(datos){														// Cuando la interpretación haya sido realizada
		console.log(datos)														// En la consola ponme los datos
		let contenedor = document.querySelector("#blog .articulos")
		datos.forEach(function(dato){											// Para cada uno de los datos
			        // Convertir la fecha a un formato más legible en HTML
					let fecha = new Date(dato.fecha); // Convierte la fecha a un objeto Date
					let fechaFormateada = fecha.toLocaleDateString('es-ES', {
						
						year: 'numeric', // Año
						month: 'long', // Mes
						day: 'numeric', // Día
					});
			
			contenedor.innerHTML += `
				<article>
					
					<h5>`+dato.titulo+`</h5>
					<time datetime="${dato.fecha}">${fechaFormateada}</time>
					<p>`+dato.texto+`</p>
				</article>
			`;																			// Devuelvo el resultado al contenedor
		})
	})

	////////////////////////////// ELEMENTOS DE PORTAFOLIO ///////////////////////////////
	
	fetch("http://localhost:5000/dameportafolio")							// Me conecto al servidor
	.then(function(response){													// Cuando el servidor responda
		return response.json()													// Lo que me responda lo interpreto como json
	})
	.then(function(datos){														// Cuando la interpretación haya sido realizada
		console.log(datos)														// En la consola ponme los datos
		
	})
}

