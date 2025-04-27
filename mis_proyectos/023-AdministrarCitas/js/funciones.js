import Notificacion from './classes/Notificacion.js';
import AdminCitas from './classes/AdminCitas.js';
import {citaObj, editando} from './variables.js'
import { formulario, formularioInput, pacienteInput, propietarioInput, telefonoInput, emailInput, fechaInput, sintomasInput, horaInput, contenedorCitas } from './selectores.js';
import { DB } from './app.js';

const citas = new AdminCitas()
// FUNCIONES
    // funcion campos imput dinamicos
export function datosCita(e) {
    citaObj[e.target.name] = e.target.value      
}

    export function submitCita(e){
    e.preventDefault();

    // validadion de los campos del formulario

    if(Object.values(citaObj).some(valor => valor.trim() === '')){
        // instanciamos la clase notificaciones
            new Notificacion({
            texto: 'Todos los campos son obligatorios',
            tipo: 'error'
        })
        return
    }
    if(editando.value){
        citas.editar({...citaObj})
        new Notificacion({
            texto: 'Paciente Actualizado',
            tipo: 'exito'
        })
    }else{
        citas.agregar({...citaObj})
        // Insertar Registro
        const transaction = DB.transaction(['citas'], 'readwrite');
        const objectStore = transaction.objectStore('citas');
        objectStore.add(citaObj)
        transaction.oncomplete = function(){
            console.log('Cita Agregada');
            
          new Notificacion({
            texto: 'Paciente Registrado con exito',
            tipo: 'exito'
        })  
        }


        
    }

    formulario.reset()
    reiniciarObjetoCita()
    formularioInput.value = 'Registrar Paciente'
    editando.value = false

    }

// funcion boton enviar

export function reiniciarObjetoCita(){
// Reiniciar el objeto

//citaObj.paciente = '';
//citaObj.propietario = '';
//citaObj.email = '';
//citaObj.fecha = '';
//citaObj.sintomas = '';
Object.assign(citaObj,{
    id: generarId(),
    paciente: '',
    propietario: '',
    telefono: '',
    email: '',
    hora: '',
    fecha: '',
    sintomas: ''
})
}
// funcion para generar ID unicos

export function generarId(){
    return Math.random().toString(36).substring(2) + Date.now()
}

// cargar cita al formulario al editar
export function cargarEdicion(cita){
    Object.assign(citaObj, cita)

    pacienteInput.value = cita.paciente
    propietarioInput.value = cita.propietario
    telefonoInput.value = cita.telefono
    emailInput.value = cita.email
    horaInput.value = cita.hora
    fechaInput.value = cita.fecha
    sintomasInput.value = cita.sintomas

    editando.value = true

    formularioInput.value = 'Actualizar Paciente'
}

export function mostrarCitas() {
    limpiarHTML();
    
    // Leer el contenido de la BD
    const objectStore = DB.transaction('citas').objectStore('citas');
    
    objectStore.openCursor().onsuccess = function(e) {
        const cursor = e.target.result;
        
        if (cursor) {
            const {paciente, propietario, telefono, email, fecha, hora, sintomas, id } = cursor.value;
            
            const divCita = document.createElement('div');
            divCita.classList.add('mx-5', 'my-10', 'bg-white', 'shadow-md', 'px-5', 'py-10', 'rounded-xl');
            divCita.dataset.id = id;

            // Scripting de los elementos de la cita
            const pacienteParrafo = document.createElement('p');
            pacienteParrafo.classList.add('font-normal', 'mb-3', 'text-gray-700', 'normal-case');
            pacienteParrafo.innerHTML = `<span class="font-bold uppercase">Paciente: </span> ${paciente}`;

            const propietarioParrafo = document.createElement('p');
            propietarioParrafo.classList.add('font-normal', 'mb-3', 'text-gray-700', 'normal-case');
            propietarioParrafo.innerHTML = `<span class="font-bold uppercase">Propietario: </span> ${propietario}`;

            const telefonoParrafo = document.createElement('p');
            telefonoParrafo.classList.add('font-normal', 'mb-3', 'text-gray-700', 'normal-case');
            telefonoParrafo.innerHTML = `<span class="font-bold uppercase">Teléfono: </span> ${telefono}`;

            const emailParrafo = document.createElement('p');
            emailParrafo.classList.add('font-normal', 'mb-3', 'text-gray-700', 'normal-case');
            emailParrafo.innerHTML = `<span class="font-bold uppercase">Email: </span> ${email}`;

            const fechaParrafo = document.createElement('p');
            fechaParrafo.classList.add('font-normal', 'mb-3', 'text-gray-700', 'normal-case');
            fechaParrafo.innerHTML = `<span class="font-bold uppercase">Fecha: </span> ${fecha}`;

            const horaParrafo = document.createElement('p');
            horaParrafo.classList.add('font-normal', 'mb-3', 'text-gray-700', 'normal-case');
            horaParrafo.innerHTML = `<span class="font-bold uppercase">Hora: </span> ${hora}`;

            const sintomasParrafo = document.createElement('p');
            sintomasParrafo.classList.add('font-normal', 'mb-3', 'text-gray-700', 'normal-case');
            sintomasParrafo.innerHTML = `<span class="font-bold uppercase">Síntomas: </span> ${sintomas}`;

            // Botones
            const contenedorBotones = document.createElement('div');
            contenedorBotones.classList.add('flex', 'justify-between', 'mt-10');

            // Agregar los párrafos al divCita
            divCita.appendChild(pacienteParrafo);
            divCita.appendChild(propietarioParrafo);
            divCita.appendChild(telefonoParrafo);
            divCita.appendChild(emailParrafo);
            divCita.appendChild(fechaParrafo);
            divCita.appendChild(horaParrafo);
            divCita.appendChild(sintomasParrafo);
            divCita.appendChild(contenedorBotones);

            contenedorCitas.appendChild(divCita);

            // Ve al siguiente elemento
            cursor.continue();
        }
    }
}

function limpiarHTML() {
    while(contenedorCitas.firstChild) {
        contenedorCitas.removeChild(contenedorCitas.firstChild);
    }
}