window.onload = function(){
    fetch("http://localhost:5000/leerTabla/Producto")      // Cargo la tabla dinamica
    .then(function(response){
        return response.json();                                     // formateo como json
      })
      .then(function(datos){
        console.log(datos)
      }) 
}