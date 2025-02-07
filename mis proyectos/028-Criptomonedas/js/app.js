const criptomonedasSelect = document.querySelector('#criptomonedas');
const monedaSelect = document.querySelector('#moneda');

const formulario = document.querySelector('#formulario');
const resultado = document.querySelector('#resultado');


const objBusqueda = {
    moneda: '',
    criptomoneda: ''
}


// crear un promise
const obtenerCriptomonedas = criptomonedas => new Promise( resolve =>{
    resolve(criptomonedas)
})


document.addEventListener('DOMContentLoaded', () => {
    consultarCriptomonedas();

    formulario.addEventListener('submit', submitFormulario);
    criptomonedasSelect.addEventListener('change', leerValor)
    monedaSelect.addEventListener('change', leerValor)

})

function consultarCriptomonedas(){
    const url = 'https://min-api.cryptocompare.com/data/top/mktcapfull?limit=10&tsym=USD';

    fetch(url)
    .then( respuesta => respuesta.json())
    .then( resultado => obtenerCriptomonedas(resultado.Data))
    .then(criptomonedas => selectCriptomonedas(criptomonedas))



}
function selectCriptomonedas(criptomonedas){
    criptomonedas.forEach(cripto => {
        const {FullName, Name} = cripto.CoinInfo;

        const option = document.createElement('option');
        option.value = Name;
        option.textContent = FullName;
        criptomonedasSelect.appendChild(option);

    })
}

function leerValor(e){
    objBusqueda[e.target.name] = e.target.value;
    console.log(objBusqueda)

}

function submitFormulario(e){
    e.preventDefault();

    // validar
    const {moneda, criptomoneda} = objBusqueda;

    if(moneda === '' || criptomoneda === ''){
        mostrarAlerta('Ambos campos son obligatorios');
        return;
    }

    // consultar la api con los resultados
    consultarAPI()

}

function mostrarAlerta(msg){

    const existeError = document.querySelector('.error');

    if(!existeError){
    const divMensaje = document.createElement('DIV');
        divMensaje.classList.add('error');

        // mensaje de error

        divMensaje.textContent = msg;
        formulario.appendChild(divMensaje);

        setTimeout(() => {
            divMensaje.remove()
        }, 3000);

    }
    
}

function consultarAPI(){
    const {moneda, criptomoneda} = objBusqueda;

    const url = `https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${criptomoneda}&tsyms=${moneda}`;
    mostrarSpinner();
    fetch(url)
        .then( respuesta => respuesta.json())
        .then(cotizacion => {
            mostrarCotizacionHTML(cotizacion.DISPLAY[criptomoneda][moneda])
        })
}
function mostrarCotizacionHTML (cotizacion){
const {PRICE, HIGHDAY, LOWDAY,CHANGEPCT24HOUR, LASTUPDATE} = cotizacion;
limpiarHTML()
const precio = document.createElement('p');
precio.classList.add('precio');
precio.innerHTML = `El Precio es: <span>${PRICE}</span>`;

const precioAlto = document.createElement('p');
precioAlto.innerHTML = `El Precio más alto del dia es: <span>${HIGHDAY}</span>`;

const precioBajo = document.createElement('p');
precioBajo.innerHTML = `El Precio más bajo del dia es: <span>${LOWDAY}</span>`;

const precioHora = document.createElement('p');
precioHora.innerHTML = `Variación ultimas 24 horas: <span>${CHANGEPCT24HOUR}%</span>`;

const precioActualizado = document.createElement('p');
precioActualizado.innerHTML = `Ultima actualizacion: <span>${LASTUPDATE}</span>`;

resultado.appendChild(precio);
resultado.appendChild(precioAlto);
resultado.appendChild(precioBajo);
resultado.appendChild(precioHora);
resultado.appendChild(precioActualizado);
}

function limpiarHTML() {
    while(resultado.firstChild){
        resultado.removeChild(resultado.firstChild)
    }
}

function mostrarSpinner(){
    limpiarHTML()
    const spinner = document.createElement('DIV');
    spinner.classList.add('spinner');
    spinner.innerHTML = `

  <div class="bounce1"></div>
  <div class="bounce2"></div>
  <div class="bounce3"></div>
    `
    resultado.appendChild(spinner)
}