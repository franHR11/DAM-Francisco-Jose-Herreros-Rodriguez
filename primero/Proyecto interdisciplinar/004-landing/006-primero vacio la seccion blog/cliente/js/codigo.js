window.onload = function(){
	console.log("Javascript está preparado para la acción")
	fetch("http://localhost:5000/damearticulos")					// Me conecto al servidor
	.then(function(response){											// Cuando el servidor responda
		return response.json()											// Lo que me responda lo interpreto como json
	})
	.then(function(datos){												// Cuando la interpretación haya sido realizada
		console.log(datos)												// En la consola ponme los datos
	})
}