document.addEventListener('DOMContentLoaded', function() {


    const email = {
        email: '',
        asunto: '',
        mensaje: ''
    }

    // seleccionar el formulario
    const inputCc = document.querySelector('#cc');
    const inputEmail = document.querySelector('#email');
    const inputAsunto = document.querySelector('#asunto');
    const inputMensaje = document.querySelector('#mensaje');
    const formulario = document.querySelector('#formulario');
    const btnsubmit = document.querySelector('#formulario button[type="submit"]');
    const btnReset = document.querySelector('#formulario button[type="reset"]');
    const spinner = document.querySelector('#spinner');


    // asignar un evento al formulario
    inputCc.addEventListener('input', validar );
    inputEmail.addEventListener('input', validar );
    inputAsunto.addEventListener('input', validar);
    inputMensaje.addEventListener('input', validar);
    formulario.addEventListener('submit', enviarEmail);
    btnReset.addEventListener('click', function(e) {
        e.preventDefault();
        resetearFormulario();
    });

    function enviarEmail(e) {
        e.preventDefault();
        spinner.classList.remove('hidden');
        spinner.classList.add('flex');

        setTimeout(() => {
            spinner.classList.add('hidden');
            spinner.classList.remove('flex');

            resetearFormulario();

            //CREAR ALERTA DE ENVIO
            const alertaExito = document.createElement('P');
            alertaExito.classList.add('bg-green-500', 'text-white', 'p-2', 'my-5', 'text-center', 'font-bold', 'uppercase', 'rounded-lg', 'text-sm');
            alertaExito.textContent = 'Mensaje enviado correctamente';
            formulario.appendChild(alertaExito);


            setTimeout(() => {
                alertaExito.remove();
            },3000);
        },3000);
    }


    function validar(e) {
        if(e.target.value.trim() === '') {
            mostrarAlerta(`el campo ${e.target.id} es obligatorio`, e.target.parentElement);
            email[e.target.id] = '';    
            comprobarEmail();
            return;
        } 

        if(e.target.id === 'email' && !validarEmail(e.target.value)) {
            mostrarAlerta(`el campo ${e.target.id} no es valido`, e.target.parentElement);
            email[e.target.id] = '';  
            comprobarEmail();
            return;
        }
        if(e.target.id === 'cc' && !validarEmail(e.target.value)){
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
            return
        } 
        btnsubmit.classList.remove('cursor-not-allowed', 'opacity-50');
        btnsubmit.disabled = false;
    }

    function resetearFormulario() {
        email.email = '';
        email.asunto = '';
        email.mensaje = '';
        formulario.reset();
        comprobarEmail();
    }

});