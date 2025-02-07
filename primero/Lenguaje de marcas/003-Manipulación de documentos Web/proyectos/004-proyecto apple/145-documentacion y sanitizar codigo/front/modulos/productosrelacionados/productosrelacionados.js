/**
 * @webblock
 * @author FranHR
 * @description Gestiona la carga dinámica de productos relacionados mediante fetch
 */

const productosRelacionados = async () => {
    try {
        const response = await fetch("../back/?tabla=productos");
        if (!response.ok) throw new Error('Error en la respuesta del servidor');
        
        const datos = await response.json();
        const contenedor = document.querySelector("aside");
        
        datos.slice(0, 4).forEach(dato => {
            const articulo = document.createElement("article");
            
            // Crear elementos del producto
            const elementos = {
                img: createImage(dato),
                titulo: createElementWithText('h4', dato.titulo),
                subtitulo: createElementWithText('h5', dato.subtitulo),
                precio: createPrecio(dato.precio),
                boton: createBoton(dato.Identificador)
            };
            
            // Añadir elementos al artículo
            Object.values(elementos).forEach(elem => articulo.appendChild(elem));
            contenedor.appendChild(articulo);
        });
    } catch (error) {
        console.error("Error al cargar productos:", error);
    }
};

// Funciones auxiliares
const createImage = (dato) => {
    const imagen = document.createElement("img");
    imagen.src = dato.imagen.startsWith('http') ? dato.imagen : '../static/' + dato.imagen;
    imagen.alt = dato.titulo;
    imagen.onerror = () => {
        imagen.src = '../static/default.jpg';
        console.log("Error cargando imagen:", dato.imagen);
    };
    return imagen;
};

const createElementWithText = (tag, text) => {
    const element = document.createElement(tag);
    element.textContent = text;
    return element;
};

const createPrecio = (precio) => {
    const p = document.createElement("p");
    p.className = "precio";
    p.textContent = `${precio} €`;
    return p;
};

const createBoton = (id) => {
    const boton = document.createElement("button");
    boton.textContent = "Saber más";
    boton.onclick = () => window.location.href = `producto.php?prod=${id}`;
    return boton;
};

// Iniciar carga de productos
productosRelacionados();