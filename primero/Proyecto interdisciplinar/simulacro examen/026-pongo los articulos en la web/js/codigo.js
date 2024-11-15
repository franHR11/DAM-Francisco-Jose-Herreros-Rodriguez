window.onload = function(){
	console.log("Javascript funcionando")
	fetch("http://localhost:5000/damearticulos")
	.then(function(response){
		return response.json()
	})
	.then(function(datos){
		console.log(datos)
		let contenedor = document.querySelector("#capitulos")
		datos.forEach(function(dato){
			contenedor.innerHTML += `
				<article>
					<img src="https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-La-arquitectura-min.jpg">
					<h4>`+dato.titulo+`</h4>
					<p>`+dato.subtitulo+`</p>
				</article>
			`
		})
	})
}