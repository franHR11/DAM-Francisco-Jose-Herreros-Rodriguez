import { generarId } from "./funciones.js"

let editando = {value:false}

// OBJETO DE CITA

const citaObj = {
    id: generarId(),
    paciente: '',
    propietario:'',
    telefono:'',
    email: '',
    fecha: '',
    hora: '',
    sintomas: ''
}

export {
    editando,
    citaObj
}
