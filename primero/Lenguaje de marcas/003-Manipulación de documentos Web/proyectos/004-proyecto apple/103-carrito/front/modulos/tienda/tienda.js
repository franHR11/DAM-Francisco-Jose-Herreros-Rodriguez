// Me conecto a la base de datos en busca de ese producto

var actual = {}
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
		actual = {"nombre":dato.titulo,"descripcion":dato.descripcion,"precio":dato.precio}
	})
	
})
document.querySelector("#confirmar").onclick = function(){
	console.log("Confirmas que metes el producto en el carrito");
	const clavealmacenaje = 'carrito';

	// Verifica si el carrito existe en localStorage
	if (localStorage.getItem(clavealmacenaje) === null) {
		localStorage.setItem(clavealmacenaje, "[]"); // Inicializa el carrito vacío
	}

	// Recupera el carrito actual
	let contenidoanterior = JSON.parse(localStorage.getItem(clavealmacenaje)); // Convertimos a objeto JS
	console.log("Contenido anterior del carrito:", contenidoanterior);

	// Agrega el producto actual al carrito
	contenidoanterior.push(actual);

	// Guarda el carrito actualizado
	localStorage.setItem(clavealmacenaje, JSON.stringify(contenidoanterior));
	console.log("Producto añadido al carrito:", actual);
};

