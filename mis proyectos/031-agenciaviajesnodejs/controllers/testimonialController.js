import {Testimonial} from '../models/testimoniales.js'

const guardarTestimonial = async (req, res) => {

    // validar

    const {nombre, correo, mensaje} = req.body;

    const errores =  []

    if(nombre.trim() === ''){
        errores.push({mensaje: 'El Nombre esta vacio'});
    }

    if(correo.trim() === ''){
        errores.push({mensaje: 'El correo esta vacio'});
    }

    if(mensaje.trim() === ''){
        errores.push({mensaje: 'El mensaje esta vacio'});
    }

    if(errores.length > 0){

        // Consultar Testimoniales Existentes
        const testimoniales = await Testimonial.findAll();

        //mostrar la vista con errores
        res.render('testimoniales',{
            pagina : 'Testimoniales',
            errores,
            nombre,
            correo,
            mensaje,
            testimoniales
        })
    }else{
        //almacenamos los datos en la base de datos
        try {
            await Testimonial.create({
                nombre,
                correo,
                mensaje

            });
            res.redirect('/testimoniales');
        } catch (error) {
            console.log(error)
        }
    }

}

export {
    guardarTestimonial
}