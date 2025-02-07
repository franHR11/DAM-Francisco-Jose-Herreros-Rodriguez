//  VARIABLES
const marca = document.querySelector('#marca');
const year = document.querySelector('#year');
const resultado = document.querySelector('#resultado');
const minimo = document.querySelector('#minimo');
const maximo = document.querySelector('#maximo');
const puertas = document.querySelector('#puertas');
const transmision = document.querySelector('#transmision');
const color = document.querySelector('#color');

const max = new Date().getFullYear();
const min = max - 10;

// generar un objeto con la busqueda

const datosBusqueda = {
    marca: '',
    year: '',
    minimo: '',
    maximo: '',
    puertas: '',
    transmision: '',
    color: ''
}




//EVENTOS
document.addEventListener('DOMContentLoaded', () => {
mostrarAutos(autos);    // Muestra los autos al cargar



// Filtrar autos año
    llenarSelect();

});

// Event listener para los select de busqueda

marca.addEventListener('change', e => {
    datosBusqueda.marca = e.target.value;

    filtrarAuto();
});

year.addEventListener('change', e => {
    datosBusqueda.year = e.target.value;
    filtrarAuto();
});

minimo.addEventListener('change', e => {
    datosBusqueda.minimo = e.target.value;
    filtrarAuto();
});

maximo.addEventListener('change', e => {
    datosBusqueda.maximo = e.target.value;
    filtrarAuto();
});

puertas.addEventListener('change', e => {
    datosBusqueda.puertas = parseInt(e.target.value);
    filtrarAuto();
});

transmision.addEventListener('change', e => {
    datosBusqueda.transmision = e.target.value;
    filtrarAuto();
});

color.addEventListener('change', e => {
    datosBusqueda.color = e.target.value;
    
    filtrarAuto();
});

//FUNCIONES


function mostrarAutos(autos) {
    // Limpiar los resultados anteriores
    limpiarHTML();

    autos.forEach(auto => {
        const { marca, modelo, year, puertas, transmision, precio, color } = auto;
        const autoHTML = document.createElement('div');
        autoHTML.classList.add('auto');
        
        autoHTML.innerHTML = `
            <div class="auto-header">
                ${marca} ${modelo} ${year}
            </div>
            <div class="auto-content">
                <p><span>Puertas:</span> <span>${puertas}</span></p>
                <p><span>Transmisión:</span> <span>${transmision}</span></p>
                <p><span>Color:</span> <span>${color}</span></p>
                <div class="auto-precio">
                    €${precio.toLocaleString('es-ES')}
                </div>
            </div>
        `;

        resultado.appendChild(autoHTML);
    });
}

// limpiar html

function limpiarHTML(){
    while(resultado.firstChild){
        resultado.removeChild(resultado.firstChild);
    }}

//genero un select para los años

function llenarSelect(){
    for(let i = max; i >= min; i--){
        const opcion = document.createElement('OPTION');
        opcion.value = i;
        opcion.textContent = i;
        year.appendChild(opcion); //agrega las opciones de año al select
        
    }
}

//funcion que filtra en base a la busqueda

function filtrarAuto(){
    const resultado = autos.filter(filtrarMarca).filter(filtrarYear).filter(filtrarMinimo).filter(filtrarMaximo).filter(filtrarPuertas).filter(filtrarTransmision).filter(filtrarColor);
   
   mostrarAutos(resultado);

   if(resultado.length){
       mostrarAutos(resultado);
    } else {
        noResultado();
    }
   
   // console.log(resultado);
}
function filtrarMarca(auto){
    const {marca} = datosBusqueda;
    if(marca){
        return auto.marca === marca;
    }
    return auto;
}

function filtrarYear(auto){
    const {year} = datosBusqueda;
    if(year){
        return auto.year === parseInt(year);
    }
    return auto;
}

function filtrarMinimo(auto){
    const {minimo} = datosBusqueda;
    if(minimo){
        return auto.precio >= minimo;
    }
    return auto;
}
function filtrarMaximo(auto){
    const {maximo} = datosBusqueda;
    if(maximo){
        return auto.precio <= maximo;
    }
    return auto;
}
function filtrarPuertas(auto){
    const {puertas} = datosBusqueda;
    if(puertas){
        return auto.puertas === puertas;
    }
    return auto;
}
function filtrarTransmision(auto){
    const {transmision} = datosBusqueda;
    if(transmision){
        return auto.transmision === transmision;
    }
    return auto;
}
function filtrarColor(auto){
    const {color} = datosBusqueda;
    if(color){
        return auto.color === color;
    }
    return auto;
}

function noResultado() {
    limpiarHTML();
    
    const noResultado = document.createElement('div');
    noResultado.classList.add('mensaje-error');
    
    noResultado.innerHTML = `
        <div class="mensaje-error-contenido">
            <div class="mensaje-error-icono">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
            </div>
            <h3>No se encontraron resultados</h3>
            <p>Lo sentimos, no hay coches que coincidan con tu búsqueda.</p>
            <p class="sugerencia">Prueba con otros criterios de búsqueda:</p>
            <ul>
                <li>Amplía el rango de precios</li>
                <li>Prueba con diferentes marcas</li>
                <li>Modifica los filtros aplicados</li>
            </ul>
        </div>
    `;
    
    resultado.appendChild(noResultado);
}