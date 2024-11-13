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
			contenedor.innerHTML += `
				<article>
					<img src="../imagenes/blog1.png">
					<h5>`+dato.titulo+`</h5>
					<time>`+dato.fecha+`</time>
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
		
		let contenedor = document.querySelector("#proyectos .articulos")
		datos.forEach(function(dato){											// Para cada uno de los datos
			contenedor.innerHTML += `
				<article>
						<img src="../imagenes/folio1.png">
						<h5>`+dato.titulo+`</h5>
						<p>`+dato.texto+`</p>
					</article>
			`;																			// Devuelvo el resultado al contenedor
		})
	})
	
	////////////////////////////// PROCESO EL FORMULARIO ///////////////////////////////
	
	let boton = document.querySelector("#contacto button")			// Selecciono el boton del formulario
	
	boton.onclick = function(){												// Cuando haga click en el boton
		console.log("vamos a guardar un mensaje")							// Lanzo un mensaje por pantalla
		let nombre = document.querySelector("#contactonombre").value
		let email = document.querySelector("#contactoemail").value
		let asunto = document.querySelector("#contactoasunto").value
		let texto = document.querySelector("#contactotexto").value
		console.log(nombre,email,asunto,texto)
		let mensajejson = {
			"nombre":nombre,
			"email":email,
			"asunto":asunto,
			"texto":texto
		}
		console.log(mensajejson)
		fetch("http://localhost:5000/insertamensaje",{
		  method: 'POST',
		  headers: {
			 'Content-Type': 'application/json'
		  },
		  body: JSON.stringify(mensajejson) 
		})
		.then(function(response){
			return response.json()
		})
		.then(function(){
			document.querySelector("#contactonombre").value = ""
			document.querySelector("#contactoemail").value = ""
			document.querySelector("#contactoasunto").value = ""
			document.querySelector("#contactotexto").value = ""
			document.querySelector("#feedback").style.display = "block"
			document.querySelector("#feedback").classList.add("animado")
		})
	}
	
}



