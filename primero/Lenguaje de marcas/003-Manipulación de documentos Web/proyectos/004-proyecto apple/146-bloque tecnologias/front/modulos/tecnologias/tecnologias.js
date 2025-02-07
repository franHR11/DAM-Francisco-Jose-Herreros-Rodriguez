fetch("../back/?tabla=tecnologias")
.then(response => response.json())
.then(function(datos){
    const sliderTecnologias = document.querySelector("#slider-tecnologias");
    const plantilla = document.querySelector("#plantilla-tecnologias");
    
    if(datos.length === 0) {
        for(let i = 0; i < 8; i++) {
            const instancia = plantilla.content.cloneNode(true);
            sliderTecnologias.appendChild(instancia);
        }
    } else {
        datos.forEach(function(dato){
            const instancia = plantilla.content.cloneNode(true);
            instancia.querySelector("p").textContent = dato.texto;
            instancia.querySelector("article").style.background = `url(../static/${dato.imagen})`;
            instancia.querySelector(".enlace-tecnologia").href = dato.enlace;
            sliderTecnologias.appendChild(instancia);
        });
    }
});
