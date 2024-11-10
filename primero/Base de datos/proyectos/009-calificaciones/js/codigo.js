window.onload = function(){							// Solo ejecuto JS cuando la web haya cargado del todo
    console.log("La web está preparada...")		// Mensaje en la consola
    fetch("json/web.json")										// Cargo un archivo json
    .then(function(response){							// Y cuando lo haya recibido
            return response.json()							// Interpreto su contenido como json
    })	
    .then(function(datos){										// Cuando lo anterior haya ocurrido
            console.log(datos)								// De momento pongo los datos en pantalla
            // Datos de la cabecera
        document.querySelector("header h1").textContent = datos.cabecera.titulo
        document.querySelector("header h2").textContent = datos.cabecera.subtitulo
        document.querySelector("header nav a:nth-child(1)").textContent = datos.cabecera.menu[0]
        document.querySelector("header nav a:nth-child(2)").textContent = datos.cabecera.menu[1]
        document.querySelector("header nav a:nth-child(3)").textContent = datos.cabecera.menu[2]
        document.querySelector("header nav a:nth-child(4)").textContent = datos.cabecera.menu[3]
        document.querySelector("header nav a:nth-child(5)").textContent = datos.cabecera.menu[4]
        document.querySelector("header nav a:nth-child(6)").textContent = datos.cabecera.menu[5]
        document.querySelector("header button").textContent = datos.cabecera.boton
        // Heroe
        document.querySelector("#heroe h4").textContent = datos.heroe.titulo
        document.querySelector("#heroe h3").textContent = datos.heroe.subtitulo
        document.querySelector("#heroe p").textContent = datos.heroe.texto
        document.querySelector("#heroe button").textContent = datos.heroe.boton1
        document.querySelector("#heroe .secundario").textContent = datos.heroe.boton2
        document.querySelector("#heroe #redes p").textContent = datos.heroe.p
        // Heroe
        document.querySelector("#sobremi h4").textContent = datos.sobremi.h4
        document.querySelector("#sobremi h3").textContent = datos.sobremi.h3
        document.querySelector("#sobremi p").textContent = datos.sobremi.p
        document.querySelector("#sobremi .firma").textContent = datos.sobremi.firma
        document.querySelector("#sobremi button").textContent = datos.sobremi.boton
    
    
    })
}