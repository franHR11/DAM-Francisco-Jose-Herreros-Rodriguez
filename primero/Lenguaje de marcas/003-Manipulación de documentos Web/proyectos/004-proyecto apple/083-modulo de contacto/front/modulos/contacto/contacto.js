document.querySelector("#enviar").onclick = function(){
	console.log("Voy a ver si envío un mensaje")
	// Primero recojo los datos de los campos
	let nombre = document.querySelector("#nombre").value
	let email = document.querySelector("#email").value
	let asunto = document.querySelector("#asunto").value
	let mensaje = document.querySelector("#mensaje").value
	// Construyo el paquete que voy a enviar
	let paquete = {
		"nombre":nombre,
		"email":email,
		"asunto":asunto,
		"mensaje":mensaje
	}
	console.log(paquete)
}