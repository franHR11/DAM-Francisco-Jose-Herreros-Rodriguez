// Me conecto a la base de datos en busca de ese producto


const queryString = window.location.search;												// Atrapo la URL
const urlParams = new URLSearchParams(queryString);									// Extraigo los parametros
const idproducto = urlParams.get('prod');													// Me quedo solo con el parametro que me interesa
fetch("../back/?busca=productos&campo=Identificador&dato="+idproducto)			// Construyo una peticion al servidor solo con el parametro que me interesa
.then(function(response){
	return response.json()
})
.then(function(datos){
	datos.forEach(function(dato){
		document.querySelector("#nombreproducto").textContent = dato.titulo
		document.querySelector("#descripcion").textContent = dato.descripcion
		document.querySelector("#precio").textContent = dato.precio
	})
	
})
document.querySelector("#confirmar").onclick = function(){
	console.log("confirmas que metes el producto en el carrito")
}
