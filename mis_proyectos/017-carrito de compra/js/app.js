/**
 * @fileoverview Carrito de Compra - Gestión de cursos online
 * @author franHR
 * @date 2024
 * @description Este archivo implementa la funcionalidad del carrito de compra para una tienda de cursos online.
 *              Permite agregar cursos, eliminarlos y gestionar cantidades.
 */

// ====== VARIABLES GLOBALES ======
// Selectores DOM principales
const carrito = document.querySelector('#carrito');  // Contenedor principal del carrito
const contenedorCarrito = document.querySelector('#lista-carrito tbody');  // Donde se mostrarán los cursos
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');  // Botón para vaciar carrito
const listaCursos = document.querySelector('#lista-cursos');  // Lista de cursos disponibles
let articulosCarrito = [];  // Array que almacena los cursos en el carrito

// ====== INICIALIZACIÓN ======
cargarEventListeners();

/**
 * Inicializa todos los event listeners de la aplicación
 */
function cargarEventListeners() {
    listaCursos.addEventListener('click', agregarCurso);  // Escucha clicks en "Agregar al carrito"
    carrito.addEventListener('click', eliminarCurso);     // Escucha clicks para eliminar cursos
    
    // muestra los cursos de LocalStorage
    document.addEventListener('DOMContentLoaded', () =>{
        articulosCarrito = JSON.parse(localStorage.getItem('carrito')) || [];

        carritoHTML();

    })

    // Vaciar el carrito completamente
    vaciarCarritoBtn.addEventListener('click', () => {
        articulosCarrito = [];  // Resetea el array
        limpiarHTML();         // Limpia la visualización
    });
}

/**
 * Maneja el evento de agregar un curso al carrito
 * @param {Event} e - Evento del click
 */
function agregarCurso(e) {
    e.preventDefault();
    if (e.target.classList.contains('agregar-carrito')) {
        const cursoSeleccionado = e.target.parentElement.parentElement;
        leerDatosCurso(cursoSeleccionado);
    }
}

/**
 * Elimina un curso del carrito
 * @param {Event} e - Evento del click
 */
function eliminarCurso(e) {
    if (e.target.classList.contains('borrar-curso')) {
        const cursoId = e.target.getAttribute('data-id');

        // Elimina del arreglo de articulosCarrito por el data-id
        articulosCarrito = articulosCarrito.filter(curso => curso.id !== cursoId);
        carritoHTML(); // Iterar sobre el carrito y mostrar su html
    }
}

/**
 * Lee los datos del curso seleccionado y los procesa
 * @param {HTMLElement} curso - Elemento HTML que contiene la información del curso
 */
function leerDatosCurso(curso) {
    // Crea objeto con la información del curso
    const infoCurso = {
        imagen: curso.querySelector('img').src,
        titulo: curso.querySelector('h4').textContent,
        precio: curso.querySelector('.precio span').textContent,
        id: curso.querySelector('a').getAttribute('data-id'),
        cantidad: 1
    }

    // Verifica si el curso ya existe en el carrito
    const existe = articulosCarrito.some(curso => curso.id === infoCurso.id);
    
    if (existe) {
        // Si existe, actualiza la cantidad
        const cursos = articulosCarrito.map(curso => {
            if (curso.id === infoCurso.id) {
                curso.cantidad++;
                return curso;
            }
            return curso;
        });
        articulosCarrito = [...cursos];
    } else {
        // Si no existe, lo agrega al carrito
        articulosCarrito = [...articulosCarrito, infoCurso];
    }

    carritoHTML();  // Actualiza la visualización del carrito
}

function carritoHTML() {

    // limpiar el html

    limpiarHTML();

    // recorre el carrito y genera el html


    articulosCarrito.forEach(curso => { 
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>
            <img src="${curso.imagen}" width="100">
        </td>
        <td>${curso.titulo}</td>
        <td>${curso.precio}</td>
        <td>${curso.cantidad}</td>
        <td>
            <a href="#" class="borrar-curso" data-id="${curso.id}"> X </a>
        </td>
        `;
        // agregar el html del carrito en el tbody
        contenedorCarrito.appendChild(row);
    });
    // sincronizar con localstoraje el carrito
    sincronizarStorage();


}

function sincronizarStorage(){
    localStorage.setItem('carrito', JSON.stringify(articulosCarrito))
}

// elimina los cursos del tbody
function limpiarHTML() {
    // forma lenta
    // contenedorCarrito.innerHTML = '';
    while(contenedorCarrito.firstChild) {
        contenedorCarrito.removeChild(contenedorCarrito.firstChild);
    }

}