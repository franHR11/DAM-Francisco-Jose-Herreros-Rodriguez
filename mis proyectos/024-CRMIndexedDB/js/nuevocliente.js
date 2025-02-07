(function() {
    let DB;
    const formulario = document.querySelector('#formulario');

    document.addEventListener('DOMContentLoaded', () => {
        conectarDB();
        formulario.addEventListener('submit', validarCliente);
    });

    function conectarDB() {
        const abrirConexion = window.indexedDB.open('crm', 1);

        abrirConexion.onerror = function() {
            console.error('Hubo un error al abrir la BD');
        };

        abrirConexion.onsuccess = function(e) {
            DB = e.target.result;
        };
    }

    function validarCliente(e) {
        e.preventDefault();
        
        const nombre = document.querySelector('#nombre').value;
        const email = document.querySelector('#email').value;
        const telefono = document.querySelector('#telefono').value;
        const empresa = document.querySelector('#empresa').value;

        if(nombre === '' || email === '' || telefono === '' || empresa === ''){
            imprimirAlerta('Todos los campos son obligatorios', 'error')
            return;
        }

        const cliente = {
            nombre,
            email,
            telefono,
            empresa,
            id : Date.now()
        }
        
        crearNuevoCliente(cliente);
    }

    function crearNuevoCliente(cliente) {
        if(!DB) {
            imprimirAlerta('Error: Base de datos no inicializada', 'error');
            return;
        }

        const transaction = DB.transaction(['crm'], 'readwrite');
        const objectStore = transaction.objectStore('crm');
        
        try {
            objectStore.add(cliente);

            transaction.onerror = function(error) {
                console.error('Error en la transacción:', error);
                imprimirAlerta('Hubo un error al guardar el cliente', 'error');
            };

            transaction.oncomplete = function() {
                imprimirAlerta('El Cliente se agregó Correctamente');
                setTimeout(() => {
                    window.location.href = 'index.html';
                }, 2000);
            };
        } catch(error) {
            console.error('Error:', error);
            imprimirAlerta('Hubo un error al procesar la operación', 'error');
        }
    }
})();