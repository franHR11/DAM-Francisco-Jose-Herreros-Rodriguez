/**
 * @fileoverview Gestiona la funcionalidad del blog, incluyendo la carga de entradas,
 * categorías y la visualización de artículos en un modal.
 * 
 * Este módulo se encarga de:
 * - Cargar y mostrar entradas del blog desde el backend
 * - Gestionar las categorías del blog
 * - Manejar la visualización de artículos completos en un modal
 * 
 * @author Francisco José Herreros Rodríguez
 * @version 1.0.0
 */

'use strict';

// Mapa para almacenar las categorías
const categoriasMap = new Map();

/**
 * Carga las entradas del blog y sus categorías
 * @async
 * @function cargaBlog
 * @returns {void}
 */
async function cargaBlog() {
    try {
        // Cargar primero las categorías
        const respCategorias = await fetch("../back/?tabla=categoriasblog");
        const categorias = await respCategorias.json();
        
        // Almacenar categorías en el mapa
        categorias.forEach(cat => {
            const nombreCategoria = cat.titulo || cat.nombre || cat.categoria || `Categoría ${cat.Identificador}`;
            categoriasMap.set(cat.Identificador, nombreCategoria);
        });

        // Cargar entradas del blog
        const respBlog = await fetch("../back/?tabla=blog");
        const datos = await respBlog.json();
        
        const principal = document.querySelector("main");
        const plantilla = document.querySelector("#plantillaentrada");
        
        datos.forEach(dato => {
            renderizarEntrada(dato, plantilla, principal);
        });
    } catch (error) {
        console.error('Error al cargar el blog:', error);
    }
}

/**
 * Renderiza una entrada individual del blog
 * @param {Object} dato - Datos de la entrada
 * @param {HTMLTemplateElement} plantilla - Plantilla HTML para la entrada
 * @param {HTMLElement} contenedor - Elemento donde se insertará la entrada
 */
function renderizarEntrada(dato, plantilla, contenedor) {
    const instancia = plantilla.content.cloneNode(true);
    
    // Sanitizar y establecer la imagen
    if (dato.imagen) {
        const img = instancia.querySelector("img");
        img.src = `../static/${encodeURIComponent(dato.imagen)}`;
        img.alt = dato.titulo || 'Imagen del blog';
    }
    
    // Sanitizar y establecer el contenido textual
    instancia.querySelector("h4").textContent = dato.titulo;
    instancia.querySelector("time").textContent = dato.fecha;
    instancia.querySelector("h5").textContent = categoriasMap.get(dato.categoriasblog_categorias) || 'Categoría Desconocida';
    instancia.querySelector(".contenido-preview").textContent = dato.contenido;
    
    const articulo = instancia.querySelector("article");
    articulo.setAttribute("data-id", dato.Identificador);
    
    // Configurar el botón
    const boton = instancia.querySelector(".ver-articulo");
    boton.addEventListener('click', (e) => {
        e.stopPropagation();
        mostrarModal(dato.Identificador);
    });
    
    contenedor.appendChild(instancia);
}

/**
 * Muestra un modal con el contenido completo de un artículo
 * @async
 * @param {number} identificador - ID del artículo a mostrar
 */
async function mostrarModal(identificador) {
    try {
        const response = await fetch(`../back/?busca=blog&campo=Identificador&dato=${encodeURIComponent(identificador)}`);
        const datos = await response.json();
        
        if (!datos.length) return;
        
        const modal = document.querySelector("#modalpersonalizado");
        modal.innerHTML = '';
        
        crearContenidoModal(modal, datos[0]);
        
        document.querySelector("#contienemodalpersonalizado").style.display = "block";
    } catch (error) {
        console.error('Error al mostrar el modal:', error);
    }
}

/**
 * Crea y añade el contenido del modal
 * @param {HTMLElement} modal - Elemento del modal
 * @param {Object} dato - Datos del artículo
 */
function crearContenidoModal(modal, dato) {
    // Añadir botón de cierre
    const closeButton = document.createElement("button");
    closeButton.className = "modal-close";
    closeButton.innerHTML = "×";
    closeButton.onclick = function() {
        document.querySelector("#contienemodalpersonalizado").style.display = "none";
    };
    modal.appendChild(closeButton);

    // Encabezado del modal con imagen y texto
    const header = document.createElement("div");
    header.className = "modal-header";
    
    // Contenedor de imagen
    const imagenContenedor = document.createElement("div");
    imagenContenedor.className = "imagen-contenedor";
    const imagen = document.createElement("img");
    if (dato.imagen) {
        imagen.src = `../static/${encodeURIComponent(dato.imagen)}`;
    }
    imagenContenedor.appendChild(imagen);
    header.appendChild(imagenContenedor);

    // Contenedor de contenido del header
    const contenidoHeader = document.createElement("div");
    contenidoHeader.className = "contenido-header";
    
    const titulo = document.createElement("h3");
    titulo.textContent = dato.titulo;
    
    const metaInfo = document.createElement("div");
    metaInfo.className = "modal-meta";
    
    const fecha = document.createElement("time");
    fecha.textContent = dato.fecha;
    
    const categoria = document.createElement("h5");
    categoria.classList.add("categoriablog");
    categoria.textContent = categoriasMap.get(dato.categoriasblog_categorias) || 'Categoría Desconocida';
    
    contenidoHeader.appendChild(titulo);
    metaInfo.appendChild(fecha);
    metaInfo.appendChild(categoria);
    contenidoHeader.appendChild(metaInfo);
    header.appendChild(contenidoHeader);
    
    modal.appendChild(header);

    // Contenido principal
    const contenedor = document.createElement("div");
    contenedor.classList.add("modal-contenedor");
    
    const contenido = document.createElement("div");
    contenido.classList.add("modal-contenido");
    contenido.textContent = dato.contenido;
    contenedor.appendChild(contenido);
    
    modal.appendChild(contenedor);
}

// Inicializar el blog
document.addEventListener('DOMContentLoaded', cargaBlog);