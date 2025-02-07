// Iniciar con el listado de productos
listadoProductos()

// Remover toda la sección de carga inicial de producto y el evento onclick de confirmar
// ya que esto solo es relevante en la página de producto individual
var actual = {}

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
		localStorage.removeItem("carrito");						// Vacío el carrito
		window.location = "index.php"							// Te redirijo a la página principal
	})
	
}
function listadoProductos(){
    const clavealmacenaje = 'carrito';
    let productos = localStorage.getItem(clavealmacenaje)
    let productosjson = JSON.parse(productos)
    let totalcarrito = 0
    let contenedor = document.querySelector("#carrito")
    contenedor.innerHTML = ""
    
    if(productosjson != undefined && productosjson.length > 0){
        productosjson.forEach(function(producto){
            contenedor.innerHTML += `
                <article>
                    <img src="../static/${producto.imagen}" alt="${producto.nombre}" style="width: 100px; height: auto; margin-right: 10px;">
                    <div class="texto">
                        <h4>${producto.nombre}</h4>
                        <p class="descripcion">${decodeHTMLEntities(producto.descripcion)}</p>
                        <p class="precio">${producto.precio} €</p>
                    </div>
                    <div class="eliminar" producto="${producto.nombre}">❌</div>
                </article>
            `;
            totalcarrito += parseFloat(producto.precio)
        })
        document.querySelector("#total").innerHTML = "El total de tu carrito es de: "+totalcarrito+" €"
        document.querySelector("#procesarpedido").style.display = "block"
    } else {
        contenedor.innerHTML = "<p>No hay productos en el carrito</p>"
        document.querySelector("#total").innerHTML = ""
        document.querySelector("#procesarpedido").style.display = "none"
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

function decodeHTMLEntities(text) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = text;
    return textarea.value;
}