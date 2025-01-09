document.addEventListener('DOMContentLoaded', function() {


    const email = {
        email: '',
        asunto: '',
        mensaje: ''
    }

    // seleccionar el formulario

    const inputEmail = document.querySelector('#email');
    const inputAsunto = document.querySelector('#asunto');
    const inputMensaje = document.querySelector('#mensaje');
    const formulario = document.querySelector('#formulario');
    const btnsubmit = document.querySelector('#formulario button[type="submit"]');


    // asignar un evento al formulario

inputEmail.addEventListener('blur', validar );

inputAsunto.addEventListener('blur', validar);

inputMensaje.addEventListener('blur', validar);


function validar(e) {
    if(e.target.value.trim() === '') {
        mostrarAlerta(`el campo ${e.target.id} es obligatorio`, e.target.parentElement);
        email[e.target.id] = '';    
        comprobarEmail();
        return;
    } 

    if(e.target.id === 'email' && !validarEmail(e.target.value)){
        mostrarAlerta(`el campo ${e.target.id} no es valido`, e.target.parentElement);
        email[e.target.id] = '';  
        comprobarEmail();
        return;
    }
    limpiarAlerta(e.target.parentElement);

    // asignar los valores al objeto email

    email[e.target.id] = e.target.value.trim().toLowerCase();
    // comprobar si el objeto email tiene valores 
    comprobarEmail();  


    
}

function mostrarAlerta(mensaje, referencia){
    limpiarAlerta(referencia);


    // Generar alerta en html   
    const error = document.createElement('P');
    error.textContent = mensaje;
    error.classList.add('bg-red-600', 'text-white', 'p-3', 'my-5', 'text-center', 'font-bold');


    // injectar el error en el html

    referencia.appendChild(error);
}
function limpiarAlerta(referencia){
    const alerta = referencia.querySelector('.bg-red-600');
    if(alerta){
        alerta.remove();
    }
}

function validarEmail(email){
    const regex =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ 
    const resultado = regex.test(email);
    return resultado;

}
function comprobarEmail(){
    if(Object.values(email).includes('')){
        btnsubmit.classList.add('cursor-not-allowed', 'opacity-50');
        btnsubmit.disabled = true;
    } else {
        btnsubmit.classList.remove('cursor-not-allowed', 'opacity-50');
        btnsubmit.disabled = false;
    }}
});