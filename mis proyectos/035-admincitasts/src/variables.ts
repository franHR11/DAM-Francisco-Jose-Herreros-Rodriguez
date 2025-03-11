// Definimos las interfaces para los tipos
export interface Cita {
    id: string;
    paciente: string;
    propietario: string;
    email: string;
    fecha: string;
    sintomas: string;
}

export interface EditandoState {
    value: boolean;
}

export const editando: EditandoState = {
    value: false
}

// Función para generar ID único
export function generarId(): string {
    return Math.random().toString(36).substring(2) + Date.now();
}

// Objeto de Cita
export const citaObj: Cita = {
    id: generarId(),
    paciente: '',
    propietario: '',
    email: '',
    fecha: '',
    sintomas: ''
}