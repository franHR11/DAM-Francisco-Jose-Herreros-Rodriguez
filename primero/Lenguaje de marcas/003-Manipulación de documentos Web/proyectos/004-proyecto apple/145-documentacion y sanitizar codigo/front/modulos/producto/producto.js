/**
 * Funcionalidad JavaScript del Módulo de Producto
 * 
 * Este archivo gestiona las interacciones dinámicas en la página de producto:
 * - Control del carrusel de imágenes
 * - Gestión de los botones de navegación
 * - Animaciones de transición entre fotos
 * - Funcionalidades interactivas del producto
 * 
 * @author Francisco José Herreros Rodríguez
 * @version 1.0
 */

console.log("js ok");

document.addEventListener("DOMContentLoaded", function() {
    let botones = document.querySelectorAll(".controlador button");
    console.log(botones);
    botones.forEach(function(boton) {
        boton.onclick = function() {
            seleccionaFoto(boton.value);
        };
    });
});

function seleccionaFoto(boton) {
    console.log("Ok has seleccionado algo");
    console.log(boton);
    let valor = boton;
    console.log(valor);
    let contenedor = document.querySelector(".contenedorpasafotos");
    contenedor.style.transition = "left 0.5s ease-in-out";
    contenedor.style.left = ((0 - (valor - 1)) * 800) + "px";
}