/**
 * @webblock Controlador de ofertas
 * @author FranHR
 * @description Gestiona la carga y visualización de ofertas desde el backend
 * @version 1.0.0
 */

const mostrarOferta = async () => {
    try {
        const response = await fetch("../back/?tabla=oferta");
        const datos = await response.json();
        const texto = document.querySelector("#oferta p");
        texto.innerHTML = `${datos[0].texto} - <a href="#">Saber más</a>`;
    } catch (error) {
        console.error('Error al cargar la oferta:', error);
    }
}

mostrarOferta();