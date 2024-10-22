document.querySelector("button").onclick = function(){                                  // Cuando en el boton hago click
    let usuario = document.querySelector("#usuario").value                              // Atrapo el valor del campo de usuario
    let contrasena = document.querySelector("#contrasena").value                        // Atrapo el valor de la contraseña
    fetch("http://127.0.0.1:5000/login?usuario="+usuario+"&contrasena="+contrasena)     // Envío una petición por fetch a flask
    .then(function(response){                                                           // Cuando el servidor me responda
        return response.json()                                                          // Convierto la respuesta a json
    })
    .then(function(datos){                                                              // Cuando eso haya ocurrido
        if(datos.resultado == 'verdadero'){                                             // Si el resultado dice que es verdadero
            window.location = "escritorio.html"                                         // Redirijo a la ventana de escritorio
        }else{                                                                          // En caso contrario
            window.location = window.location                                           // Recargo la página
        }
    })
}