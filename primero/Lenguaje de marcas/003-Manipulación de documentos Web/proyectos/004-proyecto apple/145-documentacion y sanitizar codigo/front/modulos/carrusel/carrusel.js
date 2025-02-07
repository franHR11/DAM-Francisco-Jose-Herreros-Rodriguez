/**
 * @webblock Controlador del Carrusel
 * @description Gestiona la funcionalidad de los carruseles
 * @version 1.0.0
 */

// Carrusel 1
fetch("../back/?tabla=carrusel1")
.then(response => response.json())
.then(function(datos){
    const carrusel1 = document.querySelector("#carrusel1");
    const plantilla = document.querySelector("#plantillacarrusel1");
    
    if(datos.length === 0) {
        // Crear elementos por defecto
        for(let i = 0; i < 8; i++) {
            const instancia = plantilla.content.cloneNode(true);
            instancia.querySelector(".enlace").style.display = "none";
            carrusel1.appendChild(instancia);
        }
    } else {
        datos.forEach(function(dato){
            const instancia = plantilla.content.cloneNode(true);
            instancia.querySelector("h3").textContent = dato.titulo;
            instancia.querySelector("p").textContent = dato.texto;
            instancia.querySelector("article").style.background = `url(../static/${dato.imagen})`;
            
            if(dato.enlace && dato.textoboton) {
                instancia.querySelector(".enlace").href = dato.enlace;
                instancia.querySelector(".boton").textContent = dato.textoboton;
            } else {
                instancia.querySelector(".enlace").style.display = "none";
            }
            
            carrusel1.appendChild(instancia);
        });
    }
});

// Carrusel 2
fetch("../back/?tabla=carrusel2")
.then(response => response.json())
.then(function(datos){
    const carrusel2 = document.querySelector("#carrusel2");
    const plantilla = document.querySelector("#plantillacarrusel2");
    
    if(datos.length === 0) {
        for(let i = 0; i < 8; i++) {
            const instancia = plantilla.content.cloneNode(true);
            carrusel2.appendChild(instancia);
        }
    } else {
        datos.forEach(function(dato){
            const instancia = plantilla.content.cloneNode(true);
            instancia.querySelector("p").textContent = dato.texto;
            instancia.querySelector("article").style.background = `url(../static/${dato.imagen})`;
            instancia.querySelector(".enlace-carrusel2").href = dato.enlace;
            carrusel2.appendChild(instancia);
        });
    }
});

// Control de navegación por puntos
document.querySelectorAll(".punto").forEach(function(punto, index){
    punto.onclick = function(){
        const carrusel1 = document.querySelector("#carrusel1");
        carrusel1.classList.remove("animado1");
        carrusel1.style.left = `-${index * 1024}px`;
    };
});
