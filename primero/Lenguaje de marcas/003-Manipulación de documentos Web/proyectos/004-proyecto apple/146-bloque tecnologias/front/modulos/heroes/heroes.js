/**
 * @webblock Heroes
 * @author FranHR
 * @description Gestiona la carga dinámica de héroes desde el backend y su renderizado
 */

const recogeHeroes = async () => {
    try {
        const response = await fetch("../back/?tabla=heroes");
        const datos = await response.json();
        
        const contenedorHeroes = document.querySelector("#heroes");
        const plantillaHeroe = document.querySelector("#plantillaheroe");

        datos.forEach(dato => {
            const instancia = plantillaHeroe.content.cloneNode(true);
            const article = instancia.querySelector("article");
            const productImage = instancia.querySelector(".product-image");
            
            // Aplicar estilos personalizados si existen
            if (dato.estilo) {
                try {
                    const estilos = JSON.parse(dato.estilo);
                    article.dataset.estilo = dato.estilo; // Guardamos el JSON original
                    
                    // Aplicar estilos al artículo
                    if (estilos.self) {
                        Object.assign(article.style, estilos.self);
                    }
                    
                    // Aplicar estilos a elementos hijos específicos
                    ['h3', 'h4', 'button', '.product-image', '.content'].forEach(selector => {
                        if (estilos[selector]) {
                            const elementos = article.querySelectorAll(selector);
                            elementos.forEach(elem => {
                                Object.assign(elem.style, estilos[selector]);
                            });
                        }
                    });
                } catch (e) {
                    console.error('Error al parsear los estilos:', e);
                }
            }
            
            // Configurar contenido básico
            instancia.querySelector("h3").textContent = dato.titulo;
            instancia.querySelector("h4").textContent = dato.texto;
            
            if (dato.imagen) {
                article.style.background = `url(../static/${dato.imagen})`;
                article.style.backgroundSize = "cover";
            }
            
            if(dato.imagen2) {
                productImage.style.backgroundImage = `url(../static/${dato.imagen2})`;
            }
            
            configuraBoton(instancia, dato, 1);
            configuraBoton(instancia, dato, 2);
            
            contenedorHeroes.appendChild(instancia);
        });
    } catch (error) {
        console.error('Error al cargar los héroes:', error);
    }
};

const configuraBoton = (instancia, dato, numBoton) => {
    const enlace = instancia.querySelector(`#enlace${numBoton}`);
    const boton = instancia.querySelector(`#boton${numBoton}`);
    
    if (!dato[`enlace${numBoton}`] || !dato[`textoboton${numBoton}`]) {
        enlace.style.display = "none";
    } else {
        enlace.href = dato[`enlace${numBoton}`];
        boton.textContent = dato[`textoboton${numBoton}`];
    }
};

recogeHeroes();