import Notificacion from './classes/Notificacion';
import AdminCitas from './classes/AdminCitas';
import { citaObj, editando, Cita, generarId } from './variables'
import { formulario, formularioInput, pacienteInput, propietarioInput, emailInput, fechaInput, sintomasInput } from './selectores'

const citas = new AdminCitas()

export function datosCita(e: Event): void {
    const target = e.target as HTMLInputElement;
    citaObj[target.name as keyof Cita] = target.value;
}

export function submitCita(e: Event): void {
    e.preventDefault();
    
    if (Object.values(citaObj).some(valor => valor.trim() === '')) {
        new Notificacion({
            texto: 'Todos los campos son obligatorios',
            tipo: 'error'
        });
        return;
    }

    if (editando.value) {
        citas.editar({...citaObj});
        new Notificacion({
            texto: 'Guardado Correctamente',
            tipo: 'exito'
        });
    } else {
        citas.agregar({...citaObj});
        new Notificacion({
            texto: 'Paciente Registrado',
            tipo: 'exito'
        });
    }    
    formulario.reset();
    reiniciarObjetoCita();
    formularioInput.value = 'Registrar Paciente';
    editando.value = false;
}

export function reiniciarObjetoCita(): void {
    Object.assign(citaObj, {
        id: generarId(),
        paciente: '',
        propietario: '',
        email: '',
        fecha: '',
        sintomas: ''
    });
}

export function cargarEdicion(cita: Cita): void {
    Object.assign(citaObj, cita);

    pacienteInput.value = cita.paciente;
    propietarioInput.value = cita.propietario;
    emailInput.value = cita.email;
    fechaInput.value = cita.fecha;
    sintomasInput.value = cita.sintomas;

    editando.value = true;

    formularioInput.value = 'Guardar Cambios';
}