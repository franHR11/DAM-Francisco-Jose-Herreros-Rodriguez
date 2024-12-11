fetch("../back/?tabla=categorias") // Cargo un endpoint en el back
.then(function(response) { // Cuando obtenga respuesta
    return response.json(); // La convierto en json
})
.then(function(datos) { // Y cuando reciba datos
    console.log(datos);
    let cabecera = document.querySelector("header nav ul");
    let plantilla = document.querySelector("#elementomenu");
    
    datos.forEach(function(dato) {
        let instancia = plantilla.content.cloneNode(true);
        let enlace = instancia.querySelector("a");
        
        enlace.textContent = dato.nombre;
        enlace.setAttribute("href", "categoria.php?cat=" + dato.Identificador.toLowerCase());
        enlace.setAttribute("cat", dato.Identificador.toLowerCase());
        // Usa addEventListener para manejar el evento de mouseover
        enlace.addEventListener("mouseover", function() {
            console.log("Vamos a ver que hay en esta categoria");
            console.log(this.textContent)
            fetch("../back/?busca=productos&campo=categorias_nombre&dato="+this.getAttribute("cat"))
            .then(function(response) { // Cuando obtenga respuesta
					 return response.json(); // La convierto en json
				})
				.then(function(datos) { // Y cuando reciba datos
					 console.log(datos);
					 })
        });
        
        cabecera.appendChild(instancia);
    });
})
.catch(function(error) {
    console.error("Error al cargar las categorías:", error);
});
