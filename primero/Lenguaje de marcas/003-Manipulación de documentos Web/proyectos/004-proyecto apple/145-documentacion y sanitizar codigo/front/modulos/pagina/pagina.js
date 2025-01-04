/**
 * @webblock Controlador de página dinámica
 * @author FranHR
 * @description Gestiona la carga de contenido dinámico
 * @version 1.0.0
 */

function pagina(){
    const urlParams = new URLSearchParams(window.location.search);
    const idpagina = urlParams.get('pagina');
    
    if (!idpagina) return;

    fetch(`../back/?busca=paginas&campo=Identificador&dato=${idpagina}`)
    .then(response => response.json())
    .then(datos => {
        if (datos && datos.length > 0) {
            const dato = datos[0];
            document.querySelector("#titulopagina").textContent = dato.titulo;
            document.querySelector("#contenidopagina").innerHTML = dato.contenido.replace(/\n/g, "<br><br>");
        }
    })
    .catch(error => console.error('Error al cargar la página:', error));
}

document.addEventListener('DOMContentLoaded', pagina);