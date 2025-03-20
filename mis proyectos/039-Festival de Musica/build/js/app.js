document.addEventListener('DOMContentLoaded', function(){
    crearGaleria()

})

function crearGaleria(){
    const galeria = document.querySelector('.galeria-imagenes')

    for (let i = 1; i<= 16; i++) {
        const imagen = document.createElement('IMG')
        imagen.src = `src/img/gallery/full/${i}.jpg`
        imagen.alt = 'Imagen Galeria'
        console.log(imagen)
    }
}