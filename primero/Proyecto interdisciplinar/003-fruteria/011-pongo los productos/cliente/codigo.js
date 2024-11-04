window.onload = function(){
  fetch("http://localhost:5000/leerTabla/Producto")      // Cargo la tabla dinamica
  .then(function(response){
      return response.json();                                     // formateo como json
    })
    .then(function(datos){
    let contenedorproductos = document.querySelector("#contieneproductos")
      datos.forEach(function(dato){
      console.log(dato)
          contenedorproductos.innerHTML += ` 
              <article>
                <h4>`+dato.Nombre+`</h4>
                <p>`+dato.PrecioUnidad+` €</p>
              </article>
          `
      })
    }) 
}