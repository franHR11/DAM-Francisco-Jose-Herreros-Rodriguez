import express from 'express';
import { paginaInicio, paginaNosotros, paginaTestimoniales, paginaViajes,paginaDetalleViaje } from '../controllers/paginasController.js';
import {guardarTestimonial} from '../controllers/testimonialController.js';


const router = express.Router();

router.get('/', paginaInicio);

router.get('/nosotros', paginaNosotros); 

router.get('/testimoniales', paginaTestimoniales);
router.post('/testimoniales', (req, res, next) => {
    console.log('Ruta POST /testimoniales');
    next();
}, guardarTestimonial);

router.get('/viajes', paginaViajes);

router.get('/viajes/:slug', paginaDetalleViaje);

export default router;
