/**
 * Funcionalidades JavaScript para los bloques de Apple Clone
 * 
 * Este archivo contiene las funcionalidades interactivas para:
 * - Control del pasafotos
 * - Manejo de la tienda
 * - Interacciones de usuario
 * 
 * @author Francisco José Herreros Rodríguez
 * @version 1.0
 */

'use strict';

const AppleBlocks = {
    init() {
        this.initPasafotos();
        this.initTienda();
    },

    initPasafotos() {
        document.querySelectorAll('.controlador').forEach(controlador => {
            const buttons = controlador.querySelectorAll('button');
            const contenedor = controlador.closest('.pasafotos-container')
                                       ?.querySelector('.contenedorpasafotos');
            
            if (!contenedor) return;

            buttons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    contenedor.style.left = `${index * -800}px`;
                    buttons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });
        });
    },

    initTienda() {
        document.querySelectorAll('.boton-comprar').forEach(boton => {
            boton.addEventListener('click', (e) => {
                e.preventDefault();
                const producto = boton.closest('.producto');
                if (!producto) return;

                const titulo = producto.querySelector('.producto-titulo')?.textContent;
                const precio = producto.querySelector('.producto-precio')?.textContent;
                
                if (titulo && precio) {
                    this.mostrarMensajeCarrito(titulo, precio);
                }
            });
        });
    },

    mostrarMensajeCarrito(titulo, precio) {
        alert(`Producto añadido al carrito:\n${titulo}\n${precio}`);
    }
};

document.addEventListener('DOMContentLoaded', () => AppleBlocks.init());
