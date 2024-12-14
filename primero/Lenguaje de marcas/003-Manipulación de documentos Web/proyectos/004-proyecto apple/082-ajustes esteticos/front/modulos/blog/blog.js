fetch("../back/?tabla=blog") 											// Cargo un endpoint en el back
.then(function(response) { 													// Cuando obtenga respuesta
    return response.json(); 													// La convierto en json
})
.then(function(datos) { 														// Y cuando reciba datos
    console.log(datos);
    let principal = document.querySelector("main")
    let plantilla = document.querySelector("#plantillaentrada")
    datos.forEach(function(dato){
    	let instancia = plantilla.content.cloneNode(true);
    	instancia.querySelector("h4").textContent = dato.titulo
    	instancia.querySelector("time").textContent = dato.fecha
    	principal.appendChild(instancia)
    })
 })