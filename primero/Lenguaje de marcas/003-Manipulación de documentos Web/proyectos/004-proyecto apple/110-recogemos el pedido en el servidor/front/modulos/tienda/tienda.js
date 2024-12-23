// Me conecto a la base de datos en busca de ese producto

listadoProductos()

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
	
	listadoProductos()
};
document.querySelector("#enviardatos").onclick = function(){
	let json = {}
	let nombre = document.querySelector("#nombrecliente").value
	let apellidos = document.querySelector("#apellidoscliente").value
	let email = document.querySelector("#emailcliente").value
	let fecha = new Date();
	let fechahumana = fecha.getFullYear()+"-"+(fecha.getMonth()+1)+"-"+fecha.getDate()
	let numeropedido = fecha.getFullYear()+""+(fecha.getMonth()+1)+""+fecha.getDate()+""+fecha.getHours()+""+fecha.getMinutes()+""+fecha.getSeconds()
	json = {
		"cliente":{
			"nombre":nombre,
			"apellidos":apellidos,
			"email":email
		},
		"pedido":{
			"fecha":fechahumana,
			"numerodepedido":numeropedido
		},
		"productos":JSON.parse(localStorage.getItem("carrito"))
	}
	fetch("../back/?envio="+JSON.stringify(json))
	.then(function(response){
		return response.text()
	})
	.then(function(datos){
		console.log(datos)
	})
	
}
function listadoProductos(){
const clavealmacenaje = 'carrito';
	// Listo los productos existentes:
	let productos = localStorage.getItem(clavealmacenaje)
	let productosjson = JSON.parse(productos)
	let totalcarrito = 0
	console.log(productosjson)
	let contenedor = document.querySelector("#carrito")
	if(productosjson != undefined){
	productosjson.forEach(function(producto){
		contenedor.innerHTML += `
			<article>
				<h4>`+producto.nombre+`</h4>
				<p class="descripcion">`+producto.descripcion+`</p>
				<p class="precio">`+producto.precio+`</p>
			</article>
		`
		totalcarrito += parseFloat(producto.precio)
		
	})
	document.querySelector("#total").textContent = "El total de tu carrito es de: "+totalcarrito+" euros"
	}
}
document.querySelector("#procesarpedido").onclick = function(){
	document.querySelector("#datoscliente").style.display = "block"
}