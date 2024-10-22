fetch("http://127.0.0.1:5000")                        // Hago una petición al servidor flask de Python
.then(function(response){                             // Cuando el servidor me responda
  return response.json();                             // Formateo su respuesta como json
})
.then(function(entradas){                             // Y cuando esa operación haya concluido
  console.log(entradas)                               // Primero saca las entradas por consola para ver que todo va ok
  entradas.forEach(function(entrada){                 // Para cada una de las entradas
    let seccion = document.querySelector("section")   // Cojo la sección
    seccion.innerHTML += `
      <article>
        <h3>`+entrada.titulo+`</h3>
        <time>`+entrada.fecha+`</time>
        <p>`+entrada.contenido+`</p>
      </article>
    `                                                 // Y entonces a la sección le añado un artículo por cada artículo de la base de datos
  })
})