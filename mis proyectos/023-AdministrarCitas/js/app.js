import { pacienteInput, propietarioInput, emailInput, fechaInput, sintomasInput, formulario, telefonoInput, horaInput } from './selectores.js'
import { datosCita, submitCita, mostrarCitas } from './funciones.js'

export let DB;

window.onload =() => {
    console.log('Documento Listo ...')

    crearDB();
}

// EVENTOS
    // eventos imput formulario
    pacienteInput.addEventListener('change', datosCita)
    propietarioInput.addEventListener('change', datosCita)
    telefonoInput.addEventListener('change', datosCita)
    emailInput.addEventListener('change', datosCita)
    fechaInput.addEventListener('change', datosCita)
    horaInput.addEventListener('change', datosCita)
    sintomasInput.addEventListener('change', datosCita)
        // evento boton enviar
    formulario.addEventListener('submit',submitCita)


function crearDB() {
    // crear la base de datos v1
    const crearDB = window.indexedDB.open('citas',1);

    // Si hay un error
    crearDB.onerror = function() {
        console.log('Hubo un error');
    }

    // si todo va bien
    crearDB.onsuccess = function() {
        console.log('BD creada');

        DB = crearDB.result;
        console.log(DB);
        // Mostrar citas cuando la BD esté lista
        mostrarCitas();
    }

    // Definir el schema
    crearDB.onupgradeneeded = function(e){
        const db = e.target.result;
        const objectStore = db.createObjectStore('citas', {
            keyPath: 'id',
            autoIncrement: true
        });

        //definir columnas

        objectStore.createIndex('paciente','paciente',{unique:false});
        objectStore.createIndex('propietario','propietario',{unique:false});
        objectStore.createIndex('telefono','telefono',{unique:false});
        objectStore.createIndex('email','email',{unique:false});
        objectStore.createIndex('fecha','fecha',{unique:false});
        objectStore.createIndex('hora','hora',{unique:false});
        objectStore.createIndex('sintomas','sintomas',{unique:false});
        objectStore.createIndex('id','id',{unique:true});

        console.log('Base de datos lista')



    }
}





