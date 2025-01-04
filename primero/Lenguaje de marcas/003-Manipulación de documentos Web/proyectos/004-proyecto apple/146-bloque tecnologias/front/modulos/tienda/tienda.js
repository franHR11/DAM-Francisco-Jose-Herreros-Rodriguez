/**
 * @webblock
 * @author FranHR
 * @description Gestiona la funcionalidad del carrito de compras y la interacción
 * con productos en la tienda
 */

// Constantes
const CLAVE_CARRITO = 'carrito';
const CONFIG = {
    baseUrl: '../back/',
    defaultHeaders: {
        'Content-Type': 'application/json'
    }
};

// Funciones principales optimizadas
const obtenerCarrito = () => JSON.parse(localStorage.getItem(CLAVE_CARRITO) || '[]');
const guardarCarrito = carrito => localStorage.setItem(CLAVE_CARRITO, JSON.stringify(carrito));

const actualizarUI = () => {
    const carrito = obtenerCarrito();
    const total = carrito.reduce((sum, item) => sum + parseFloat(item.precio), 0);
    document.querySelector("#total").textContent = `El total de tu carrito es de: ${total.toFixed(2)} €`;
    listadoProductos();
}

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

	// Verifica si el carrito existe en localStorage
	if (localStorage.getItem(CLAVE_CARRITO) === null) {
		localStorage.setItem(CLAVE_CARRITO, "[]"); // Inicializa el carrito vacío
	}

	// Recupera el carrito actual
	let contenidoanterior = obtenerCarrito(); // Convertimos a objeto JS
	console.log("Contenido anterior del carrito:", contenidoanterior);

	// Agrega el producto actual al carrito
	contenidoanterior.push(actual);

	// Guarda el carrito actualizado
	guardarCarrito(contenidoanterior);
	console.log("Producto añadido al carrito:", actual);
	
	actualizarUI();
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
		"productos":obtenerCarrito()
	}
	fetch("../back/?envio="+JSON.stringify(json))
	.then(function(response){
		return response.text()
	})
	.then(function(datos){
		console.log(datos)
		localStorage.removeItem("carrito");						// Vacío el carrito
		window.location = "index.php"							// Te redirijo a la página principal
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
	contenedor.innerHTML = ""												// Cada vez que ejecutes el listado, vacia esteticamente el carrito
	if(productosjson != undefined){
	productosjson.forEach(function(producto){
		contenedor.innerHTML += `
			<article>
				<div class="texto">
					<h4>`+producto.nombre+`</h4>
					<p class="descripcion">`+producto.descripcion+`</p>
					<p class="precio">`+producto.precio+` €</p>
				</div>
				<div class="eliminar" producto="`+producto.nombre+`">❌</div>
			</article>
		`
		totalcarrito += parseFloat(producto.precio)
		
	})
	document.querySelector("#total").textContent = "El total de tu carrito es de: "+totalcarrito+" €"
	}
	setEliminarEventos();
}
document.querySelector("#procesarpedido").onclick = function(){
	document.querySelector("#datoscliente").style.display = "block"
}
function setEliminarEventos() {
    const elementosEliminar = document.querySelectorAll(".eliminar");
    elementosEliminar.forEach(function(elemento) {
        elemento.onclick = function() {
            const productoNombre = this.getAttribute("producto");
            eliminarProducto(productoNombre);
        };
    });
}

function eliminarProducto(nombreProducto) {
    const clavealmacenaje = 'carrito';
    let productos = JSON.parse(localStorage.getItem(clavealmacenaje)) || [];
    const productosActualizados = productos.filter(producto => producto.nombre !== nombreProducto);
    localStorage.setItem(clavealmacenaje, JSON.stringify(productosActualizados));
    console.log("Producto eliminado:", nombreProducto);

    listadoProductos(); // Refresca el listado
    setEliminarEventos(); // Vuelve a establecer los eventos para los nuevos elementos del DOM
}

// Event Listeners usando delegación de eventos
document.addEventListener('DOMContentLoaded', () => {
    listadoProductos();
    document.querySelector("#carrito").addEventListener('click', e => {
        if (e.target.classList.contains('eliminar')) {
            eliminarProducto(e.target.getAttribute("producto"));
        }
    });
});