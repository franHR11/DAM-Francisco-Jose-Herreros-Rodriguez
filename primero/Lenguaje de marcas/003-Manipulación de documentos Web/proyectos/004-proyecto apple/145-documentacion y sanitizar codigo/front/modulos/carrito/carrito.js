/**
 * @webblock Controlador del Carrito
 * @description Gestiona la lógica del carrito de compras:
 * - Gestión del localStorage
 * - Validación de formularios
 * - Procesamiento de pedidos
 * - Actualización de interfaz
 * @version 1.0.0
 * @package AppleStore
 */

class CartController {
    constructor() {
        this.init();
    }

    init() {
        this.listadoProductos();
        this.setupEventListeners();
    }

    setupEventListeners() {
        document.querySelector("#enviardatos").onclick = () => this.procesarPedido();
        document.querySelector("#procesarpedido").onclick = () => {
            document.querySelector("#datoscliente").style.display = "block";
        };
    }

    validarFormulario() {
        const nombre = document.querySelector("#nombrecliente").value.trim();
        const apellidos = document.querySelector("#apellidoscliente").value.trim();
        const email = document.querySelector("#emailcliente").value.trim();
        
        if(!nombre || !apellidos || !email) {
            alert('Por favor, rellene todos los campos');
            return false;
        }
        
        if(!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            alert('Por favor, introduzca un email válido');
            return false;
        }
        
        return true;
    }

    listadoProductos() {
        const clavealmacenaje = 'carrito';
        let productos = localStorage.getItem(clavealmacenaje)
        let productosjson = JSON.parse(productos)
        let totalcarrito = 0
        let contenedor = document.querySelector("#carrito")
        contenedor.innerHTML = ""
        
        if(productosjson != undefined && productosjson.length > 0){
            productosjson.forEach((producto) => {
                contenedor.innerHTML += `
                    <article>
                        <img src="../static/${producto.imagen}" alt="${producto.nombre}" style="width: 100px; height: auto; margin-right: 10px;">
                        <div class="texto">
                            <h4>${producto.nombre}</h4>
                            <p class="descripcion">${this.decodeHTMLEntities(producto.descripcion)}</p>
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
        this.setEliminarEventos();
    }

    setEliminarEventos() {
        const elementosEliminar = document.querySelectorAll(".eliminar");
        elementosEliminar.forEach((elemento) => {
            elemento.onclick = () => {
                const productoNombre = elemento.getAttribute("producto");
                this.eliminarProducto(productoNombre);
            };
        });
    }

    eliminarProducto(nombreProducto) {
        const clavealmacenaje = 'carrito';
        let productos = JSON.parse(localStorage.getItem(clavealmacenaje)) || [];
        const productosActualizados = productos.filter(producto => producto.nombre !== nombreProducto);
        localStorage.setItem(clavealmacenaje, JSON.stringify(productosActualizados));
        console.log("Producto eliminado:", nombreProducto);

        this.listadoProductos(); // Refresca el listado
        this.setEliminarEventos(); // Vuelve a establecer los eventos para los nuevos elementos del DOM
    }

    decodeHTMLEntities(text) {
        const textarea = document.createElement('textarea');
        textarea.innerHTML = text;
        return textarea.value;
    }

    procesarPedido() {
        if(!this.validarFormulario()) {
            return;
        }
        
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
        .then((response) => {
            if(!response.ok) {
                throw new Error('Error en la red');
            }
            return response.text()
        })
        .then((datos) => {
            console.log(datos)
            document.querySelector("#mensajeConfirmacion").style.display = "block";
            setTimeout(() => {
                localStorage.removeItem("carrito");
                window.location = "index.php"
            }, 2000);
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Hubo un error al procesar el pedido');
        });
    }
}

// Inicialización
const cart = new CartController();