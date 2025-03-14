let cliente = {
    mesa: '',
    hora: '',
    pedido: []
}

const categorias = {
    1: 'Comida',
    2: 'Bebidas',
    3: 'Postres'
}

const btnGuardarCliente = document.querySelector('#guardar-cliente');
btnGuardarCliente.addEventListener('click', guardarCliente);

function guardarCliente(){
    // console.log('desde la fn')
    const mesa = document.querySelector('#mesa').value;
    const hora = document.querySelector('#hora').value;

    const camposVacios = [mesa, hora].some( campo => campo === '');

    if(camposVacios){
        // verificar si ya hay una alerta
        const existeAlerta = document.querySelector('.invalid-feedback')

        if(!existeAlerta){

    const alerta = document.createElement('DIV');
    alerta.classList.add('invalid-feedback', 'd-block', 'text-center');
    alerta.textContent = 'Todos los campos son obligatorios'
    document.querySelector('.modal-body form').appendChild(alerta);

    setTimeout(() => {
        alerta.remove()
    }, 3000);

    }
    return
        }
        // Asignar datos del formulario a cliente
        cliente = { ...cliente, mesa, hora}
        // ocultar modal
        const modalFormulario = document.querySelector('#formulario');
        const modalBootstrap = bootstrap.Modal.getInstance(modalFormulario)
        modalBootstrap.hide();

        //Mostar las secciones
        mostrarSecciones();

        // Obtener Platos de la API de JSON-server

        obtenerPlatillos();

}
    function mostrarSecciones(){
        const seccionesOcultas = document.querySelectorAll('.d-none');
        seccionesOcultas.forEach(seccion => seccion.classList.remove('d-none'));
    }

    function obtenerPlatillos(){
        const url = 'http://localhost:4000/platillos';
        fetch(url)
        .then(respuesta => respuesta.json())
        .then( resultado => mostrarPlatillos(resultado))
        .catch( error => console.log(error));
    }

    function mostrarPlatillos(platillos){
        const contenido = document.querySelector('#platillos .contenido');

        platillos.forEach(platillo => {
        const row = document.createElement('DIV');
        row.classList.add('row', 'py-3', 'border-top');

        const nombre = document.createElement('DIV');
        nombre.classList.add('col-md-4');
        nombre.textContent = platillo.nombre;

        const precio = document.createElement('DIV');
        precio.classList.add('col-md-3', 'fw-bold');
        precio.textContent = `$${platillo.precio}`;

        const categoria = document.createElement('DIV');
        categoria.classList.add('col-md-3');
        categoria.textContent = categorias [platillo.categoria];

        const inputCantidad = document.createElement('INPUT');
        inputCantidad.type = 'number';
        inputCantidad.min = 0;
        inputCantidad.value = 0;
        inputCantidad.id = `producto-${platillo.id}`;
        inputCantidad.classList.add('form-control');

        // funcion detectar la cantidad y tipo de plato

        inputCantidad.onchange = function (){
            const cantidad = parseInt (inputCantidad.value);
            
            agregarPlatillo({...platillo, cantidad});
        }

        const agregar = document.createElement('DIV');
        agregar.classList.add('col-md-2');
        agregar.appendChild(inputCantidad);

            // console.log(precio)

        row.appendChild(nombre);
        row.appendChild(precio);
        row.appendChild(categoria);
        row.appendChild(agregar);

        contenido.appendChild(row);   
    })
}
function agregarPlatillo(producto){
    // extraer el pedido actual
    let {pedido} = cliente;

    // Revisar que la cantidad sea mayor a 0

    if(producto.cantidad > 0){

        // comprueba si el elemento ya existe en el array
        if( pedido.some(articulo => articulo.id === producto.id)){
            // el articulo ya existe,actualizar la cantidad
            const pedidoActualizado = pedido.map( articulo =>{
                if(articulo.id === producto.id){
                    articulo.cantidad = producto.cantidad;
                }
                return articulo;
            })
            // se asigna el nuevo array a cliente.pedido
            cliente.pedido = [...pedidoActualizado];
        }else{
            // el articulo no existe, lo agrego al array de pedido
            cliente.pedido = [...pedido, producto]
        }

        
    }else{
            // Eliminar elementos cuando la cantidad sea 0
            const resultado = pedido.filter(articulo => articulo.id !== producto.id);
            cliente.pedido = [...resultado]
    }
    // limpiar html previo
    limpiarHTML();

    if(cliente.pedido.length){
    // mostrar el resumen
    actualizarResumen();
    }else{
        mensajePedidoVacio();    
    }
}
function actualizarResumen(){
    
    const contenido = document.querySelector('#resumen .contenido');

    const resumen = document.createElement('DIV');
    resumen.classList.add('col-md-6', 'card', 'py-2', 'px-3', 'shadow');

        // imformacion de la mesa
    const mesa = document.createElement('P');
    mesa.textContent = 'Mesa: ';
    mesa.classList.add('fw-bold');

    const mesaSpan = document.createElement('SPAN');
    mesaSpan.textContent = cliente.mesa;
    mesaSpan.classList.add('fw-normal');

    // imformacion de la hora
    const hora = document.createElement('P');
    hora.textContent = 'Hora: ';
    hora.classList.add('fw-bold');

    const horaSpan = document.createElement('SPAN');
    horaSpan.textContent = cliente.hora;
    horaSpan.classList.add('fw-normal');


    // agregar a los elementos padres
    mesa.appendChild(mesaSpan);
    hora.appendChild(horaSpan);

    //titulo de lav seccion
    const heading = document.createElement('H3');
    heading.textContent = 'Platos Consumidos';
    heading.classList.add('my-4', 'text-center');

    // iterar sobre array de pedidos
    const grupo = document.createElement('UL');
    grupo.classList.add('list-group');

    const {pedido} = cliente;
    pedido.forEach(articulo =>{
        const {nombre, cantidad, precio, id} = articulo;
        // nombre del articulo
        const lista = document.createElement('LI');
        lista.classList.add('list-group-item');

        const nombreEL = document.createElement('H4');
        nombreEL.classList.add('my-4');
        nombreEL.textContent = nombre;

        // cantidad del articulo
        const cantidadEl = document.createElement('P');
        cantidadEl.classList.add('fw-bold');
        cantidadEl.textContent = 'Cantidad: ';

        const cantidadValor = document.createElement('SPAN')
        cantidadValor.classList.add('fw-normal');
        cantidadValor.textContent = cantidad;

        // precio del articulo
        const precioEl = document.createElement('P');
        precioEl.classList.add('fw-bold');
        precioEl.textContent = 'Precio: ';

        const precioValor = document.createElement('SPAN')
        precioValor.classList.add('fw-normal');
        precioValor.textContent = `$${precio}`;

        // subtotal del articulo
        const subtotalEl = document.createElement('P');
        subtotalEl.classList.add('fw-bold');
        subtotalEl.textContent = 'Subtotal: ';

        const subtotalValor = document.createElement('SPAN')
        subtotalValor.classList.add('fw-normal');
        subtotalValor.textContent = calcularSubtotal(precio, cantidad);

        // boton eliminar
        const btnEliminar = document.createElement('BUTTON');
        btnEliminar.classList.add('btn', 'btn-danger');
        btnEliminar.textContent = 'Eliminar del pedido';

        // funcion de eliminar del pedido

        btnEliminar.onclick =  function(){
            eliminarProducto(id)
        }


        // agregar valores a sus contenedores

        cantidadEl.appendChild(cantidadValor)
        precioEl.appendChild(precioValor)
        subtotalEl.appendChild(subtotalValor)

        //agregar elementos al LI
        lista.appendChild(nombreEL);
        lista.appendChild(cantidadEl);
        lista.appendChild(precioEl);
        lista.appendChild(subtotalEl);
        lista.appendChild(btnEliminar);

        //agregar lista a grupo principal
        grupo.appendChild(lista);

    })

    // agregar al contenido
    resumen.appendChild(heading);
    resumen.appendChild(mesa);
    resumen.appendChild(hora);
    resumen.appendChild(grupo);

    contenido.appendChild(resumen);

    // mostrar formulario de propinas
    formularioPropinas()
}

function limpiarHTML(){
    const contenido = document.querySelector('#resumen .contenido');

    while(contenido.firstChild){
        contenido.removeChild(contenido.firstChild);
    }
}

function calcularSubtotal(precio,cantidad){
return `$ ${precio * cantidad}` 

}
function eliminarProducto(id){
    const {pedido} = cliente;
    const resultado = pedido.filter(articulo => articulo.id !== id);
    cliente.pedido = [...resultado]

    // limpiar html previo
    limpiarHTML();

    if(cliente.pedido.length){
    // mostrar el resumen
    actualizarResumen();
    }else{
        mensajePedidoVacio();    
    }

    // el producto se elimino por lo tanto regresamos la cantidad a 0 en el formulario
    const productoEliminado = `#producto-${id}`
    const inputEliminado = document.querySelector(productoEliminado);
    inputEliminado.value = 0;
}

function mensajePedidoVacio(){
    const contenido = document.querySelector('#resumen .contenido');

    const texto = document.createElement('P');
    texto.classList.add('text-center');
    texto.textContent = 'Añade los elementos del pedido';

    contenido.appendChild(texto);
}
    function formularioPropinas(){
        const contenido = document.querySelector('#resumen .contenido');

        const formulario = document.createElement('DIV');
        formulario.classList.add('col-md-6', 'formulario');

        const divFormulario = document.createElement('DIV');
        divFormulario.classList.add('card', 'py-2', 'px-3', 'shadow')

        const heading = document.createElement('H3');
        heading.classList.add('my-4', 'text-center');
        heading.textContent = 'Suplemento';

        // Radio button 10%

        const radio10 = document.createElement('INPUT');
        radio10.type = 'radio';
        radio10.name = 'suplemento';
        radio10.value = "10";
        radio10.classList.add('form-check-input');
        radio10.onclick = calcularSuplemento;

        const radio10Label = document.createElement('LABEL');
        radio10Label.textContent = '10%';
        radio10Label.classList.add('form-check-label');

        const radio10Div = document.createElement('DIV');
        radio10Div.classList.add('form-check');

        radio10Div.appendChild(radio10);
        radio10Div.appendChild(radio10Label);

        // Radio button 25%

        const radio25 = document.createElement('INPUT');
        radio25.type = 'radio';
        radio25.name = 'suplemento';
        radio25.value = "25";
        radio25.classList.add('form-check-input');
        radio25.onclick = calcularSuplemento;

        const radio25Label = document.createElement('LABEL');
        radio25Label.textContent = '25%';
        radio25Label.classList.add('form-check-label');

        const radio25Div = document.createElement('DIV');
        radio25Div.classList.add('form-check');

        radio25Div.appendChild(radio25);
        radio25Div.appendChild(radio25Label);

                // Radio button 50%

        const radio50 = document.createElement('INPUT');
        radio50.type = 'radio';
        radio50.name = 'suplemento';
        radio50.value = "50";
        radio50.classList.add('form-check-input');
        radio50.onclick = calcularSuplemento;


        const radio50Label = document.createElement('LABEL');
        radio50Label.textContent = '50%';
        radio50Label.classList.add('form-check-label');

        const radio50Div = document.createElement('DIV');
        radio50Div.classList.add('form-check');

        radio50Div.appendChild(radio50);
        radio50Div.appendChild(radio50Label);

        // Agregar al div Principal
        divFormulario.appendChild(heading);
        divFormulario.appendChild(radio10Div);
        divFormulario.appendChild(radio25Div);
        divFormulario.appendChild(radio50Div);

        // Agregar al formulario
        formulario.appendChild(divFormulario);



        contenido.appendChild(formulario);

    }

function calcularSuplemento(){
    const {pedido} = cliente;
    let subtotal = 0;
    // calcular el subtotal
    pedido.forEach(articulo => {
        subtotal += articulo.cantidad * articulo.precio;
    })
        // seleccionar el radio button con el suplemento del cliente
    const SuplementoSleccionado = document.querySelector('[name="suplemento"]:checked').value;
 

    // calcular subtotal
    const suplemento = ((subtotal* parseInt(SuplementoSleccionado)) / 100);
    

    // calcular total a pagar

    const total = subtotal + suplemento
console.log(total)

mostrarTotalHTML(subtotal, total, suplemento);
}

function mostrarTotalHTML(subtotal, total, suplemento) {

    const divTotales = document.createElement('DIV');
    divTotales.classList.add('total-pagar', 'my-5');

    // subtotal

    const subtotalParrafo = document.createElement('P');
    subtotalParrafo.classList.add('fs-4', 'fw-bold', 'mt-2');
    subtotalParrafo.textContent = 'Subtotal Consumo';

    const subtotalSpan = document.createElement('SPAN');
    subtotalSpan.classList.add('fw-normal');
    subtotalSpan.textContent = `$${subtotal}`;

    subtotalParrafo.appendChild(subtotalSpan);


    // Suplemento

    const suplementoParrafo = document.createElement('P');
    suplementoParrafo.classList.add('fs-4', 'fw-bold', 'mt-2');
    suplementoParrafo.textContent = 'Suplemento Consumo';

    const suplementoSpan = document.createElement('SPAN');
    suplementoSpan.classList.add('fw-normal');
    suplementoSpan.textContent = `$${suplemento}`;

    suplementoParrafo.appendChild(suplementoSpan);

    
    // Total

    const totalParrafo = document.createElement('P');
    totalParrafo.classList.add('fs-4', 'fw-bold', 'mt-2');
    totalParrafo.textContent = 'Total Consumo';

    const totalSpan = document.createElement('SPAN');
    totalSpan.classList.add('fw-normal');
    totalSpan.textContent = `$${total}`;

    totalParrafo.appendChild(totalSpan);

    // Eliminar el ultimo resultado

   const limpiarTotal = document.querySelector('.total-pagar');
   if(limpiarTotal) {
    limpiarTotal.remove();
   }


    divTotales.appendChild(subtotalParrafo);
    divTotales.appendChild(suplementoParrafo);
    divTotales.appendChild(totalParrafo);
        

    const formulario = document.querySelector('.formulario > div');
    formulario.appendChild(divTotales);
}
    
