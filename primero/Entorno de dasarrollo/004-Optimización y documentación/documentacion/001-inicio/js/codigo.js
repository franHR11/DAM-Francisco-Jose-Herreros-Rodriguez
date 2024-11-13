window.onload = function() {
    console.log("La web está preparada...");
    fetch("json/web.json")
        .then(response => response.json())
        .then(datos => {
            console.log(datos);

            // Cabecera
            document.querySelector("header h1").textContent = datos.cabecera.titulo;
            document.querySelector("header h2").textContent = datos.cabecera.subtitulo;
            document.querySelector("header button").textContent = datos.cabecera.boton;
            datos.cabecera.menu.forEach((item, index) => {
                document.querySelector(`header nav a:nth-child(${index + 1})`).textContent = item;
            });

            // Sección Heroe
            document.querySelector("#heroe h4").textContent = datos.heroe.titulo;
            document.querySelector("#heroe h3").textContent = datos.heroe.subtitulo;
            document.querySelector("#heroe p").textContent = datos.heroe.texto;
            document.querySelector("#heroe button").textContent = datos.heroe.boton1;
            document.querySelector("#heroe .secundario").textContent = datos.heroe.boton2;
            document.querySelector("#heroe #redes p").textContent = datos.heroe.redes;
            datos.heroe.icons.forEach((icon, index) => {
                document.querySelector(`#heroe #redes a:nth-child(${index + 1}) img`).src = icon;
            });

            // Sección Sobre Mí
            document.querySelector("#sobremi h4").textContent = datos.sobremi.h4;
            document.querySelector("#sobremi h3").textContent = datos.sobremi.h3;
            document.querySelector("#sobremi p").textContent = datos.sobremi.p;
            document.querySelector("#sobremi .firma").textContent = datos.sobremi.firma;
            document.querySelector("#sobremi button").textContent = datos.sobremi.boton
            document.querySelector("#sobremi .imagen img").src = datos.sobremi.imagen;

            // Sección Calificaciones
            document.querySelector("#calificaciones h4").textContent = datos.calificaciones.h4;
            document.querySelector("#calificaciones h3").textContent = datos.calificaciones.h3;
            datos.calificaciones.education.forEach((edu, index) => {
                const article = document.querySelector(`#calificaciones #col2 article:nth-child(${index + 1})`);
                article.querySelector("h5").textContent = edu.title;
                article.querySelector("p").textContent = edu.fecha;
                article.querySelector("img").src = edu.icono;
            });
            const skillsList = document.querySelector("#calificaciones #col3 ul");
            skillsList.innerHTML = "";  // Limpia el contenido previo
            datos.calificaciones.skills.forEach(skill => {
                const li = document.createElement("li");
                li.innerHTML = `<h6>${skill}</h6>`;
                skillsList.appendChild(li);
            });

            // Sección Servicios
            document.querySelector("#servicios h4").textContent = datos.servicios.h4;
            document.querySelector("#servicios h3").textContent = datos.servicios.h3;
            const serviciosContainer = document.querySelector("#servicios #contenedor");
            serviciosContainer.innerHTML = "";  // Limpia el contenido previo
            datos.servicios.items.forEach(servicio => {
                const article = document.createElement("article");
                article.innerHTML = `
                    <p class="icono"><img src="${servicio.icon}" /></p>
                    <h5>${servicio.title}</h5>
                    <p>${servicio.text}</p>
                    <a href="#">${servicio.link}</a>
                `;
                serviciosContainer.appendChild(article);
            });

            // Sección Proyectos
            document.querySelector("#proyectos h4").textContent = datos.proyectos.h4;
            document.querySelector("#proyectos h3").textContent = datos.proyectos.h3;
            document.querySelector("#proyectos .cabecera .texto p").innerHTML = datos.proyectos.descripcion;
            const proyectosBotones = document.querySelector("#proyectos .cabecera .botones");
            proyectosBotones.innerHTML = "";
            datos.proyectos.buttons.forEach(buttonText => {
                const button = document.createElement("button");
                button.className = "inactivo";
                button.textContent = buttonText;
                proyectosBotones.appendChild(button);
            });
            const proyectosContainer = document.querySelector("#proyectos .articulos");
            proyectosContainer.innerHTML = "";
            datos.proyectos.items.forEach(proyecto => {
                const article = document.createElement("article");
                article.innerHTML = `
                    <img src="${proyecto.image}" />
                    <h5>${proyecto.title}</h5>
                    <p>${proyecto.text}</p>
                `;
                proyectosContainer.appendChild(article);
            });

            // Sección Testimonios
            document.querySelector("#testimonios h4").textContent = datos.testimonios.h4;
            document.querySelector("#testimonios h3").textContent = datos.testimonios.h3;
            document.querySelector("#testimonios p").textContent = datos.testimonios.text;
            document.querySelector("#testimonios .firma").textContent = datos.testimonios.firma;

            // Sección Blog
            document.querySelector("#blog h4").textContent = datos.blog.h4;
            document.querySelector("#blog h3").textContent = datos.blog.h3;
            const blogContainer = document.querySelector("#blog .articulos");
            blogContainer.innerHTML = "";
            datos.blog.items.forEach(blog => {
                const article = document.createElement("article");
                article.innerHTML = `
                    <img src="${blog.image}" />
                    <h5>${blog.title}</h5>
                    <p>${blog.text}</p>
                `;
                blogContainer.appendChild(article);
            });

            // Sección Contacto
            document.querySelector("#contacto h4").textContent = datos.contacto.h4;
            document.querySelector("#contacto h3").textContent = datos.contacto.h3;
            document.querySelector("#contacto input[placeholder='Tu nombre']").placeholder = datos.contacto.fields.nombre;
            document.querySelector("#contacto input[placeholder='Tu email']").placeholder = datos.contacto.fields.email;
            document.querySelector("#contacto input[placeholder='Asunto']").placeholder = datos.contacto.fields.asunto;
            document.querySelector("#contacto textarea").placeholder = datos.contacto.fields.mensaje;
            document.querySelector("#contacto button").textContent = datos.contacto.button;

            // Footer
            document.querySelector("footer h3").textContent = datos.footer.h3;
            document.querySelector("footer p:nth-of-type(1)").textContent = datos.footer.email;
            document.querySelector("footer p:nth-of-type(2)").textContent = datos.footer.phone;
            datos.footer.social.forEach((icon, index) => {
                document.querySelector(`footer img:nth-of-type(${index + 1})`).src = icon;
            });
            document.querySelector("footer p:last-of-type").textContent = datos.footer.copyright;
        })
        .catch(error => console.error("Error al cargar el JSON:", error));
}
