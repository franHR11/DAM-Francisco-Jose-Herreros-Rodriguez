if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('./sw.js').then(registrado => {
            console.log('Registro de Service Worker exitoso', registrado);
        }).catch(error => {
            console.log('Error al registrar Service Worker', error);
        });
    });
}else{
    console.log('No se puede utilizar Service Worker');
}