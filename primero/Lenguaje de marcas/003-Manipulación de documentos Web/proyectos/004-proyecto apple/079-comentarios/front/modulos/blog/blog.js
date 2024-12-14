fetch("../back/?tabla=blog") 											// Cargo un endpoint en el back
.then(function(response) { 													// Cuando obtenga respuesta
    return response.json(); 													// La convierto en json
})
.then(function(datos) { 														// Y cuando reciba datos
    console.log(datos);
    let principal = document.querySelector("main")
    datos.forEach(function(dato){
    	principal.innerHTML += dato.titulo+"<br>"+dato.texto+"<br>";
    })
 })