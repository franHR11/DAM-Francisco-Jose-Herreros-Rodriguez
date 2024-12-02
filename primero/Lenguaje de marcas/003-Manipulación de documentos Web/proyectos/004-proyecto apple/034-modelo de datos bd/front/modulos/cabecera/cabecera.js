console.log('Ejecutando JS de cabecera.js');

let secciones = ['Mac', 'iPad', 'iPhone', 'Watch', 'TV', 'Music', 'Soporte'];
let cabecera = document.querySelector('header nav ul')
let plantilla = document.querySelector('#elementomenu')
secciones.forEach(function(seccion){
    let instancia = plantilla.content.cloneNode(true);
    instancia.querySelector('a').textContent = seccion;
    cabecera.appendChild(instancia);
});