window.onload = function(){
	console.log("Javascript funcionando")
	fetch("http://localhost:5000/damearticulos")
	.then(function(response){
		return response.json()
	})
	.then(function(datos){
		console.log(datos)
		let contenedor = document.querySelector(".columnatitulo")
		datos.forEach(function(dato){
			console.log("hola")
			contenedor.innerHTML += `
					<h3>`+dato.titulo+`</h3>			`
			
		})

		let contenedor2 = document.querySelector(".columnaimagen")
		datos.forEach(function(dato){
			console.log("hola")
			contenedor2.innerHTML += `
					<h3>`+dato.texto+`</h3>

			`
			
		})




	})
}