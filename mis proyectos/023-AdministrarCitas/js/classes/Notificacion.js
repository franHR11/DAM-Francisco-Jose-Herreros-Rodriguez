
import {formulario} from '../selectores.js'
// CLASES
    // notificaciones del los campos del formulario

export default class Notificacion{
    constructor({texto, tipo}){
        this.texto = texto
        this.tipo = tipo
        this.mostrar()
    }

    // crear la notificacion en html
    mostrar(){
        const alerta = document.createElement('DIV')
        alerta.classList.add('text-center', 'w-full', 'p-3', 'text-white', 'my-5','alert', 'uppercase', 'font-bold', 'text-sm')
        // Eliminar alertas duplicadas
        const alertaPrevia = document.querySelector('.alert')
        alertaPrevia?.remove()


        // agregar clase tipo error o exito
        this.tipo === 'error' ? alerta.classList.add('bg-red-500') : alerta.classList.add('bg-green-500')
        // Agregar Mensaje de error
        alerta.textContent = this.texto
        // Insertar en el DOM
        formulario.parentElement.insertBefore(alerta, formulario)
        // Quitar despues de 5 segundos la notificacion
        setInterval(() => {
            alerta.remove()
        }, 3000);
    }
}