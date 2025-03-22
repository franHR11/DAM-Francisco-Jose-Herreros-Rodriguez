/**
 * Módulo principal de la galería de imágenes
 * @author franHR - web - www.pcprogramacion.es
 * @module Galeria
 */

/**
 * Inicializa la galería al cargar el documento
 * @event DOMContentLoaded
 * @listens document
 */
document.addEventListener("DOMContentLoaded", () => {
  navegacionFija();
  crearGaleria();
  resaltarEnlace();
  scrollNav();
});

function navegacionFija() {
  const header = document.querySelector(".header");
  const sobreFestival = document.querySelector(".sobre-festival");

  window.addEventListener("scroll", function () {
    if (sobreFestival.getBoundingClientRect().bottom < 1) {
      header.classList.add("fixed");
    } else {
      header.classList.remove("fixed");
    }
  });
}

/**
 * Crea dinámicamente la galería de imágenes
 * @function crearGaleria
 * @description Genera 16 elementos img y los añade al contenedor .galeria-imagenes
 */
function crearGaleria() {
  const galeria = document.querySelector(".galeria-imagenes");

  // Generar imágenes de la 1 a la 16
  for (let i = 1; i <= 16; i++) {
    const imagen = document.createElement("PICTURE");
    imagen.innerHTML = `
    <source srcset="build/img/gallery/thumb/${i}.avif" type="image/avif">
    <source srcset="build/img/gallery/thumb/${i}.webp" type="image/webp">
    <img loading="lazy" width="200" height="300" src="build/img/gallery/thumb/${i}.jpg" alt="imagen galeria">
`;

    /**
     * Manejador de clic para mostrar imagen en modal
     * @event click
     * @listens HTMLImageElement
     * @param {number} i - Índice de la imagen clickeada
     */
    imagen.onclick = function () {
      mostrarImagen(i);
    };

    galeria.appendChild(imagen);
  }
}

/**
 * Muestra una imagen en modal
 * @function mostrarImagen
 * @param {number} i - Índice numérico de la imagen (1-16)
 * @example
 * mostrarImagen(5); // Muestra la quinta imagen en el modal
 */
function mostrarImagen(i) {
  // Crear elemento de imagen para el modal con el índice recibido
  const imagenModal = document.createElement("PICTURE");
  imagenModal.innerHTML = `
  <source srcset="build/img/gallery/full/${i}.avif" type="image/avif">
  <source srcset="build/img/gallery/full/${i}.webp" type="image/webp">
  <img loading="lazy" width="200" height="300" src="build/img/gallery/full/${i}.jpg" alt="imagen galeria">
`;

  // Contenedor principal del modal
  const modal = document.createElement("div");
  modal.classList.add("modal");
  modal.setAttribute("role", "dialog");
  modal.setAttribute("aria-label", "Vista previa de imagen");

  // Cerrar modal al hacer clic en el fondo
  modal.onclick = cerrarModal;

  // Botón de cierre con accesibilidad
  const cerrarBtn = document.createElement("button");
  cerrarBtn.textContent = "×"; // Usar símbolo de multiplicación para "X"
  cerrarBtn.classList.add("modal-close");
  cerrarBtn.setAttribute("aria-label", "Cerrar modal");

  // Evitar que el clic en el botón active el cierre del fondo
  cerrarBtn.onclick = (e) => {
    e.stopPropagation();
    cerrarModal();
  };

  // Construir estructura del modal

  modal.appendChild(imagenModal);
  modal.appendChild(cerrarBtn);

  // Añadir modal al cuerpo del documento
  document.body.classList.add("overflow-hidden");
  document.body.appendChild(modal);
}

/**
 * Cierra el modal con animación de fade
 * @function cerrarModal
 * @description Remueve el modal después de 500ms y restaura scroll
 * @listens modal#click
 */
function cerrarModal() {
  const modal = document.querySelector(".modal");
  modal.classList.add("fade-Off");

  // Limpieza después de la animación
  setTimeout(() => {
    modal?.remove();
    document.body.classList.remove("overflow-hidden");
  }, 500);
}

function resaltarEnlace() {
  document.addEventListener("scroll", function () {
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".navegacion-principal a");

    let actual = "";
    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;

      if (window.scrollY >= sectionTop - sectionHeight / 3) {
        actual = section.id;
      }
    });
    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + actual) {
        link.classList.add("active");
      }
    });
  });
}

function scrollNav() {
  const navLinks = document.querySelectorAll(".navegacion-principal a");
  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const sectionScroll = e.target.getAttribute("href");
      const section = document.querySelector(sectionScroll);

      section.scrollIntoView({ behavior: "smooth" });
    });
  });
}
