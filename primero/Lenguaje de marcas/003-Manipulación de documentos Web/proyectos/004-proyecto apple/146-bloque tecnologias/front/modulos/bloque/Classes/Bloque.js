/**
 * Funcionalidad JavaScript para el sistema de bloques
 * 
 * Maneja las interacciones del usuario con los diferentes tipos de bloques,
 * incluyendo el carrito de compras, galerías de imágenes y otros elementos
 * interactivos.
 */

document.addEventListener('DOMContentLoaded', function() {
    initTienda();
    initPasafotos();
});

function initTienda() {
    const botonesComprar = document.querySelectorAll('.boton-comprar');
    botonesComprar.forEach(boton => {
        boton.addEventListener('click', handleCompra);
    });
}

function handleCompra(event) {
    const boton = event.target;
    const producto = obtenerDatosProducto(boton);
    agregarAlCarrito(producto);
    actualizarUI();
}

// ...remaining JavaScript functions...
