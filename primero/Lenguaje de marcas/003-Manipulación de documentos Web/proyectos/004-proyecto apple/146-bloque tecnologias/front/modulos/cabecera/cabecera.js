/**
 * Gestiona el comportamiento dinámico de la cabecera
 * @version 1.0
 */

async function procesaCabecera() {
    try {
        const response = await fetch("../back/?tabla=categorias");
        const datos = await response.json();
        
        const cabecera = document.querySelector("header nav ul");
        const plantilla = document.querySelector("#elementomenu");

        datos.forEach(dato => {
            let instancia = plantilla.content.cloneNode(true);
            let enlace = instancia.querySelector("a");

            enlace.textContent = dato.nombre;
            enlace.setAttribute("href", "categoria.php?cat=" + dato.Identificador);
            enlace.setAttribute("cat", dato.Identificador);
            instancia.querySelector("li").classList.add("categoria");

            enlace.addEventListener("mouseover", function() {
                console.log("Vamos a ver que hay en esta categoria");
                console.log(this.textContent);
                let tituloseccion = this.textContent;

                if (this.textContent.toLowerCase() === "tienda") {
                    fetch("../back/?tabla=tiendas")
                        .then(response => response.json())
                        .then(datos => {
                            console.log(datos);
                            document.querySelector("#categoria").textContent = tituloseccion;
                            document.querySelector("#productos").innerHTML = "";
                            datos.forEach(dato => {
                                document.querySelector("#productos").innerHTML += 
                                    `<li><a href='tienda.php?tienda_id=${dato.Identificador}'>${dato.titulo}</a></li>`;
                            });
                            let cabecera = document.querySelector("header");
                            difumina(cabecera);
                        });
                } else {
                    fetch("../back/?busca=productos&campo=categorias_nombre&dato=" + this.getAttribute("cat"))
                        .then(response => response.json())
                        .then(datos => {
                            console.log(datos);
                            document.querySelector("#categoria").textContent = tituloseccion;
                            document.querySelector("#productos").innerHTML = "";
                            datos.forEach(dato => {
                                document.querySelector("#productos").innerHTML += 
                                    `<li><a href='producto.php?prod=${dato.Identificador}'>${dato.titulo}</a></li>`;
                            });
                            let cabecera = document.querySelector("header");
                            difumina(cabecera);
                        });
                }
            });
            cabecera.prepend(instancia);
        });
    } catch (error) {
        console.error("Error en procesaCabecera:", error);
        document.querySelector("#contienemodal").style.display = "block";
    }

    // Aplico difuminado en el fondo al entrar y salir de la cabecera
    let cabecera = document.querySelector("header");
    let categorias = document.querySelectorAll(".categoria");

    cabecera.onmouseleave = function() {
        console.log("Has salido");
        document.querySelector("main").classList.remove("difuminado");
        document.querySelector("header").classList.remove("grande");
        cabecera.style.background = "rgba(255,255,255,1)";
    };
}

procesaCabecera();
