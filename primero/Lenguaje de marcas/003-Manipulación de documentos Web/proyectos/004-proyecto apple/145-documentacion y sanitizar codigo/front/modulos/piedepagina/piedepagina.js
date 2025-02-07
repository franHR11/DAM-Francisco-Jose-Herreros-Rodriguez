function pieDePagina(){
    const iconosClases = {
        'Facebook': 'fa-brands fa-facebook-f',
        'Instagram': 'fa-brands fa-instagram',
        'x': 'fa-brands fa-twitter',           // Corregido
        'Github': 'fa-brands fa-github',       // Corregido
        'Linkedin': 'fa-brands fa-linkedin'    // Corregido
    };

    fetch("../back/?tabla=redessociales")
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
        let contenedor = document.querySelector("#redes")
        contenedor.innerHTML = ''; // Limpiar contenedor
        datos.forEach(function(dato){
            if (iconosClases[dato.nombre]) {
                contenedor.innerHTML += `
                    <li>
                        <a href="${dato.enlace}" target="_blank">
                            <i class="${iconosClases[dato.nombre]}"></i>
                            <span>${dato.nombre}</span>
                        </a>
                    </li>
                `;
            } else {
                console.warn(`No se encontró un icono para la red social: ${dato.nombre}`);
            }
        })
    })
}
pieDePagina();