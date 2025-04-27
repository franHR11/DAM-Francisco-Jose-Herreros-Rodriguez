const btnLeft = document.querySelector(".botonizquierda"),
      btnRight = document.querySelector(".botonderecha"),
      slider = document.querySelector("#slider"),
      sliderSection = document.querySelectorAll(".slider-section");

const modal = document.getElementById("myModal");
const modalImg = document.getElementById("modalImg");
const cerrarModal = document.getElementById("cerrarModal");

let operacion = 0,
    counter = 0,
    widthImg = 100 / sliderSection.length;

// Intervalo para mover automáticamente
let autoSlide = setInterval(() => {
    muevederecha();
}, 3000);

// Detener el intervalo cuando se hace clic en los botones
btnLeft.addEventListener("click", e => {
    mueveizquierda();
    clearInterval(autoSlide);  // Detener el cambio automático
    autoSlide = setInterval(() => {
        muevederecha();  // Reiniciar el intervalo
    }, 3000);
});

btnRight.addEventListener("click", e => {
    muevederecha();
    clearInterval(autoSlide);  // Detener el cambio automático
    autoSlide = setInterval(() => {
        muevederecha();  // Reiniciar el intervalo
    }, 3000);
});

function muevederecha() {
    if (counter >= sliderSection.length - 1) {
        counter = 0;
        operacion = 0;
        slider.style.transform = `translate(-${operacion}%)`;
        slider.style.transition = "none";
        return;
    }
    counter++;
    operacion = operacion + widthImg;
    slider.style.transform = `translate(-${operacion}%)`;
    slider.style.transition = "all ease .6s";
}

function mueveizquierda() {
    counter--;
    if (counter < 0) {
        counter = sliderSection.length - 1;
        operacion = widthImg * (sliderSection.length - 1);
        slider.style.transform = `translate(-${operacion}%)`;
        slider.style.transition = "none";
        return;
    }
    operacion = operacion - widthImg;
    slider.style.transform = `translate(-${operacion}%)`;
    slider.style.transition = "all ease .6s";
}
 // Mostrar la imagen en el modal cuando se hace clic
 sliderSection.forEach(section => {
    const img = section.querySelector("img");
    img.addEventListener("click", function() {
        modal.style.display = "flex";  // Mostrar el modal
        modalImg.src = img.src;  // Cambiar la imagen del modal a la imagen clickeada
    });
});

// Cerrar el modal
cerrarModal.addEventListener("click", function() {
    modal.style.display = "none";  // Ocultar el modal
});

// Cerrar el modal si el usuario hace clic fuera de la imagen
window.addEventListener("click", function(event) {
    if (event.target == modal) {
        modal.style.display = "none";  // Ocultar el modal
    }
});

// Función para cambiar el tamaño de la imagen al hacer clic sobre ella
modalImg.addEventListener("click", function() {
    if (modalImg.style.transform === "scale(1.5)") {
        modalImg.style.transform = "scale(1)";  // Reducir el tamaño
    } else {
        modalImg.style.transform = "scale(1.5)";  // Aumentar el tamaño
    }
});