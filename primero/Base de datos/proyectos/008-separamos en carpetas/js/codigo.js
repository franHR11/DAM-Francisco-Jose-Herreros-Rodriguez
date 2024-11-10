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
		// Calificaciones
        document.querySelector("#calificaciones h4").textContent = datos.calificaciones.h4;
        document.querySelector("#calificaciones h3").textContent = datos.calificaciones.h3;

        // Col1
        document.querySelector("#col1 h6").textContent = datos.calificaciones.col1.titulo;
        datos.calificaciones.col1.articulos.forEach((articulo, index) => {
          const articleElement = document.querySelector(`#col1 article:nth-child(${index + 1})`);
          articleElement.querySelector("h5").textContent = articulo.h5;
          articleElement.querySelector("a").textContent = articulo.link;
          articleElement.querySelector("p").textContent = articulo.fecha;
        });

        // Col2
        document.querySelector("#col2 h6").textContent = datos.calificaciones.col2.titulo;
        datos.calificaciones.col2.articulos.forEach((articulo, index) => {
          const articleElement = document.querySelector(`#col2 article:nth-child(${index + 1})`);
          articleElement.querySelector(".icono img").src = `imagenes/${articulo.icono}`;
          articleElement.querySelector("h5").textContent = articulo.h5;
          articleElement.querySelector("a").textContent = articulo.link;
          articleElement.querySelector("p").textContent = articulo.fecha;
        });

        // Col3
        document.querySelector("#col3 h6").textContent = datos.calificaciones.col3.titulo;
        datos.calificaciones.col3.habilidades.forEach((habilidad, index) => {
          document.querySelector(`#col3 ul li:nth-child(${index + 1}) h6`).textContent = habilidad;
        });

        // Servicios
        document.querySelector("#servicios h4").textContent = datos.servicios.h4;
        document.querySelector("#servicios h3").textContent = datos.servicios.h3;
        datos.servicios.articulos.forEach((articulo, index) => {
          const articleElement = document.querySelector(`#servicios article:nth-child(${index + 1})`);
          articleElement.querySelector(".icono img").src = `imagenes/${articulo.icono}`;
          articleElement.querySelector("h5").textContent = articulo.h5;
          articleElement.querySelector("p:not(.icono)").textContent = articulo.p;
          articleElement.querySelector("a").textContent = articulo.link;
        });

        // Proyectos
        document.querySelector("#proyectos h4").textContent = datos.proyectos.h4;
        document.querySelector("#proyectos h3").textContent = datos.proyectos.h3;
        document.querySelector("#proyectos .texto p").textContent = datos.proyectos.p;
        datos.proyectos.botones.forEach((texto, index) => {
          document.querySelector(`#proyectos .botones button:nth-child(${index + 1})`).textContent = texto;
        });
        datos.proyectos.articulos.forEach((articulo, index) => {
          const articleElement = document.querySelector(`#proyectos .articulos article:nth-child(${index + 1})`);
          articleElement.querySelector("img").src = `imagenes/${articulo.imagen}`;
          articleElement.querySelector("h5").textContent = articulo.h5;
          articleElement.querySelector("p").textContent = articulo.p;
        });
        document.querySelector("#proyectos > button").textContent = datos.proyectos.boton;

        // Testimonios
        document.querySelector("#testimonios h4").textContent = datos.testimonios.h4;
        document.querySelector("#testimonios h3").textContent = datos.testimonios.h3;
        document.querySelector("#testimonios .texto p:not(.firma)").textContent = datos.testimonios.p;
        document.querySelector("#testimonios .firma").textContent = datos.testimonios.firma;

        // Blog
        document.querySelector("#blog h4").textContent = datos.blog.h4;
        document.querySelector("#blog h3").textContent = datos.blog.h3;
        datos.blog.articulos.forEach((articulo, index) => {
          const articleElement = document.querySelector(`#blog .articulos article:nth-child(${index + 1})`);
          articleElement.querySelector("img").src = `imagenes/${articulo.imagen}`;
          articleElement.querySelector("h5").textContent = articulo.h5;
          articleElement.querySelector("p").textContent = articulo.p;
        });
        document.querySelector("#blog button").textContent = datos.blog.boton;

        // Contacto
        document.querySelector("#contacto h4").textContent = datos.contacto.h4;
        document.querySelector("#contacto h3").textContent = datos.contacto.h3;
        document.querySelector("#contacto input[type='text']:first-child").placeholder = datos.contacto.form.nombre;
        document.querySelector("#contacto input[type='email']").placeholder = datos.contacto.form.email;
        document.querySelector("#contacto input[type='text']:last-of-type").placeholder = datos.contacto.form.asunto;
        document.querySelector("#contacto button").textContent = datos.contacto.form.boton;

        // Footer
        document.querySelector("footer h3").textContent = datos.footer.h3;
        document.querySelector("footer p:nth-child(2)").textContent = datos.footer.email;
        document.querySelector("footer p:nth-child(3)").textContent = datos.footer.telefono;
        document.querySelector("footer p:last-child").textContent = datos.footer.copyright;
    })
}