/**
 * @webblock Validación de formulario
 * @author FranHR
 * @description Gestiona la validación y envío del formulario de contacto
 * @version 1.0.0
 */

const EMAIL_REGEX = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

const validarCampo = (selector, mensaje) => {
    const elemento = document.querySelector(selector);
    const ayuda = document.querySelector(`#ayuda${selector.slice(1)}`);
    const valor = elemento.value.trim();
    
    if (!valor) {
        elemento.classList.add("rojo");
        ayuda.textContent = mensaje;
        return false;
    }
    elemento.classList.remove("rojo");
    ayuda.textContent = "";
    return true;
};

document.querySelector("#enviar").onclick = function() {
    let envias = true;
    const campos = {
        nombre: validarCampo("#nombre", "Introduce un nombre"),
        asunto: validarCampo("#asunto", "Introduce un asunto"),
        mensaje: validarCampo("#mensaje", "Introduce un mensaje")
    };
    
    // Validación email
    const email = document.querySelector("#email").value.trim();
    if (!email || !EMAIL_REGEX.test(email)) {
        document.querySelector("#email").classList.add("rojo");
        document.querySelector("#ayudaemail").textContent = !email ? "Introduce un email" : "Introduce un email válido";
        envias = false;
    }
    
    // Validación pregunta seguridad 
    const diaActual = new Date().getDate();
    if (parseInt(document.querySelector("#dobledia").value) !== diaActual * 2) {
        envias = false;
    }
    
    if (envias && Object.values(campos).every(v => v)) {
        const formData = new FormData();
        ["nombre", "email", "asunto", "mensaje"].forEach(campo => {
            formData.append(campo, document.querySelector(`#${campo}`).value.trim());
        });
        
        fetch("../back/mail.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.querySelector("#retroalimentacion").textContent = data;
        })
        .catch(error => console.error("Error:", error));
    }
};