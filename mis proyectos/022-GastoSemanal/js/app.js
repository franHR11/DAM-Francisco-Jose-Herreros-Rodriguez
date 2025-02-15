// Variables y Selectores
const formulario = document.querySelector('#agregar-gasto');
const gastoListado = document.querySelector('#gastos ul')

//Eventos

eventListener();
function eventListener(){
    document.addEventListener('DOMContentLoaded', () => {
        iniciarApp();
    });
    formulario.addEventListener('submit', agregarGasto);
}

// Clases

class Presupuesto {
    constructor(presupuesto) {
        this.presupuesto = Number(presupuesto);
        this.restante = Number(presupuesto);
        this.gastos = [];
    }
    nuevoGasto(gasto){
        this.gastos = [...this.gastos, gasto];
        this.calcularRestante();
        this.guardarStorage();
    }
    calcularRestante(){
        const gastado = this.gastos.reduce((total, gasto )=> total + gasto.cantidad, 0);
        this.restante = this.presupuesto - gastado;
    }
    eliminarGasto(id){
        this.gastos = this.gastos.filter(gasto => gasto.id !== id);
        this.calcularRestante();
        this.guardarStorage();
    }
    guardarStorage() {
        localStorage.setItem('presupuesto', this.presupuesto);
        localStorage.setItem('gastos', JSON.stringify(this.gastos));
    }
}

class UI {
    insertarPresupuesto(cantidad) {
        const { presupuesto, restante } = cantidad;
        document.querySelector('#total').textContent = presupuesto;
        document.querySelector('#restante').textContent = restante;
    }

    imprimirAlerta(mensaje, tipo) {
        // Crear el div
        const divMensaje = document.createElement('div');
        divMensaje.classList.add('text-center', 'alert');

        if(tipo === 'error') {
            divMensaje.classList.add('alert-danger');
        } else {
            divMensaje.classList.add('alert-success');
        }
        // Mensaje de error
        divMensaje.textContent = mensaje;

        // Insertar en el HTML
        document.querySelector('.primario').insertBefore(divMensaje, formulario);

        setTimeout(() => {
            divMensaje.remove();
        }, 3000);
    }
    mostrarGastos(gastos){
        this.limpiarHTML();

        // Iterrar sobre los gastos
        gastos.forEach( gasto => {

            const {cantidad, nombre, id} = gasto;
            //Creamos un LI
            const nuevoGasto = document.createElement('li');
            nuevoGasto.className = 'list-group-item d-flex justify-content-between align-items-center';
            nuevoGasto.dataset.id = id;
            console.log(gastos)


            // Agregar el HTML del gasto
            nuevoGasto.innerHTML = `${nombre} <span class="badge badge-primary badge-pill">$ ${cantidad}</span>`;

            // Boton para borrar el gasto
            const btnBorrar = document.createElement('button');
            btnBorrar.classList.add('btn', 'btn-danger','borrar-gasto');
            btnBorrar.innerHTML = 'Borrar &times;'
            btnBorrar.onclick = () => {
                eliminarGasto(id);
            }
            nuevoGasto.appendChild(btnBorrar);


            // Agregar al HTML

            gastoListado.appendChild(nuevoGasto);
        })
    }
    limpiarHTML(){
        while(gastoListado.firstChild){
            gastoListado.removeChild(gastoListado.firstChild);
        }
    }
    actualizarRestante(restante){
        document.querySelector('#restante').textContent = restante;
    }
    comprobarPresupuesto(presupuestoObj){
        const {presupuesto, restante} = presupuestoObj;
        const restanteDiv = document.querySelector('.restante');
        //comprobar 25%

        if((presupuesto / 4) > restante){
            restanteDiv.classList.remove('alert-success','alert-warning');
            restanteDiv.classList.add('alert-danger');
        }else if ((presupuesto / 2)> restante){
            restanteDiv.classList.remove('alert-success');
            restanteDiv.classList.add('alert-warning');
        }else{
            restanteDiv.classList.remove('alert-danger','alert-warning');
            restanteDiv.classList.add('alert-success');
        }
        // Si el total es 0 o menor
        if(restante <=0){
            ui.imprimirAlerta('El presupuesto se ha agotado', 'error');
            formulario.querySelector('button[type="submit"]').disabled = true;
        }
    }
}
// instanciar
const ui = new UI();
let presupuesto;

// Funciones

function iniciarApp() {
    // Intentar recuperar del LocalStorage
    const presupuestoStorage = localStorage.getItem('presupuesto');
    const gastosStorage = localStorage.getItem('gastos');

    if(presupuestoStorage === null) {
        // No hay presupuesto, pedir al usuario
        preguntarPresupuesto();
    } else {
        // Cargar presupuesto del LocalStorage
        presupuesto = new Presupuesto(presupuestoStorage);
        presupuesto.gastos = gastosStorage ? JSON.parse(gastosStorage) : [];
        presupuesto.calcularRestante();

        // Mostrar en la UI
        ui.insertarPresupuesto(presupuesto);
        ui.mostrarGastos(presupuesto.gastos);
        ui.actualizarRestante(presupuesto.restante);
        ui.comprobarPresupuesto(presupuesto);
    }
}

function preguntarPresupuesto(){
    const presupuestoUsuario = prompt('¿Cual es tu presupuesto?');

    //console.log(parseFloat(presupuestoUsuario))
    if(presupuestoUsuario === '' || presupuestoUsuario === null || isNaN(presupuestoUsuario) || presupuestoUsuario <= 0){
        window.location.reload();
        return;
    }

    // Presupuesto valido
    presupuesto = new Presupuesto(presupuestoUsuario);
    presupuesto.guardarStorage();
    ui.insertarPresupuesto(presupuesto);

}

// Añadir Gastos

function agregarGasto(e){
    e.preventDefault();
    // Leer los datos del formulario
    const nombre = document.querySelector('#gasto').value;
    const cantidad = Number(document.querySelector('#cantidad').value);

    //validar
if(nombre === '' || cantidad === '') {
    ui.imprimirAlerta('Ambos campos son obligatorios', 'error');
    return; // Agregamos return para detener la ejecución
} else if (cantidad <= 0 || isNaN(cantidad)) {
    ui.imprimirAlerta('Cantidad no válida', 'error');
    return; // Agregamos return para detener la ejecución
}

// Generar un objeto con el gasto
    const gasto = {nombre, cantidad, id: Date.now()}
// Añade un nuevo gasto
presupuesto.nuevoGasto(gasto);

// Mensaje Gasto Agregado
ui.imprimirAlerta('Gasto agregado Correctamente');

// Imprimir los gastos
const {gastos, restante} = presupuesto;
ui.mostrarGastos(gastos);

ui.actualizarRestante(restante);

ui.comprobarPresupuesto(presupuesto);

// Reinicio de formulario
formulario.reset();

}
function eliminarGasto(id){
    // Elimina los GAstos del objeto
    presupuesto.eliminarGasto(id);
    // Elimina los gastos del HTML
    const {gastos, restante} = presupuesto;
    ui.mostrarGastos(gastos);

    ui.actualizarRestante(restante);

    ui.comprobarPresupuesto(presupuesto);
}