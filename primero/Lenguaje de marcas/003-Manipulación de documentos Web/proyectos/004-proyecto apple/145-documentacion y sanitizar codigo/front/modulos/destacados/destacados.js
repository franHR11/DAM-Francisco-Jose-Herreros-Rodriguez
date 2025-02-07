/**
 * @webblock Lógica del Módulo de Destacados
 * @author FranHR
 * @description Gestiona la carga dinámica de contenido destacado desde el backend
 */

const cargarDestacados = async () => {
    try {
        const contenedor = document.querySelector("#destacados");
        const plantilla = document.querySelector("#plantilladestacado");
        
        if (!contenedor || !plantilla) {
            throw new Error('No se encontraron los elementos necesarios');
        }

        const response = await fetch("../back/?tabla=destacados");
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const datos = await response.json();
        console.log('Datos recibidos:', datos); // Debug

        datos.forEach(dato => {
            const instancia = plantilla.content.cloneNode(true);
            const article = instancia.querySelector("article");
            
            // Debug
            console.log('Procesando dato:', dato);

            // Contenido básico
            article.style.backgroundImage = `url(../static/${dato.imagen})`;
            instancia.querySelector("h3").textContent = dato.titulo;
            instancia.querySelector("h4").textContent = dato.texto;
            
            // CTAs
            [1, 2].forEach(num => {
                const enlace = instancia.querySelector(`.cta-${num}`);
                const textoBoton = dato[`textoboton${num}`];
                const url = dato[`enlace${num}`];
                
                if (!textoBoton || !url) {
                    enlace.style.display = 'none';
                } else {
                    enlace.href = url;
                    enlace.querySelector('button').textContent = textoBoton;
                }
            });
            
            contenedor.appendChild(instancia);
        });
    } catch (error) {
        console.error('Error en cargarDestacados:', error);
    }
};

// Aseguramos que el DOM está cargado
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', cargarDestacados);
} else {
    cargarDestacados();
}