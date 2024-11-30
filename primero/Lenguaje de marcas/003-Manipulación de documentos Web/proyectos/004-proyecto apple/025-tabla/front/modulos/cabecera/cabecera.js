console.log('Ejecutando JS de cabecera.js');

let secciones = ['Mac', 'iPad', 'iPhone', 'Watch', 'TV', 'Music', 'Soporte'];
let cabecera = document.querySelector('header nav ul');
secciones.forEach(function(seccion){
 cabecera.innerHTML += 
 `<li>
   <a href="">`+seccion+`</a>
</li>`  
});