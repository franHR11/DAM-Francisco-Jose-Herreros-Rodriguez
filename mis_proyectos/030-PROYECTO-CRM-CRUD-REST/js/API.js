const url = 'http://localhost:4000/clientes';
// cuando se crea un nuevo cliente
export const nuevoCliente = async cliente => {

    try {
        await fetch(url,{
            method: 'POST',
            body: JSON.stringify(cliente),
            headers:{
                'Content-Type': 'application/json'
            }
        });
        window.location.href = 'index.html'
    }catch (error){
        console.log(error)
    }
    
}

// contiene todos los clientes
export const obtenercClientes = async() => {
    try {
        const resultado = await fetch(url);
        const clientes = await resultado.json();
        return clientes;
    }catch (error){
        console.log(error);
    }
}

// elimina un cliente...

export const eliminarCliente = async id => {
    try {
        await fetch(`${url}/${id}`,{
            method: 'DELETE'
        })
    } catch(error){
        console.log(error);
    }
}

// obtiene un cliente por su id

export const obtenerClientes = async id => {
    try{
        const resultado = await fetch(`${url}/${id}`);
        const cliente = await resultado.json();
        return cliente
    }catch (error){
        console.log(error);
    }
}

// actualiza un registro
export const editarCliente = async cliente => {
    try {
       await fetch(`${url}/${cliente.id}`,{
            method: 'PUT',
            body: JSON.stringify(cliente),
            headers:{
                'content-type': 'application/json'
            }
        });
        window.location.href = 'index.html';
    } catch (error) {
        console.log(error)
    }
}
