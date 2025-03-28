/**
 * Script principal para Mi Web 2.0
 * Funcionalidades:
 * - Slider principal
 * - Slider de testimonios
 * - Animaciones de tarjetas
 * - Validación de formulario
 */

document.addEventListener('DOMContentLoaded', () => {
    // Inicializar todos los componentes
    initMainSlider();
    initTestimonialSlider();
    initCardAnimations();
    initContactForm();
    initSmoothScroll();
});

/**
 * Slider Principal
 */
function initMainSlider() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.prev-arrow');
    const nextBtn = document.querySelector('.next-arrow');
    let currentSlide = 0;
    let slideInterval;

    // Función para mostrar un slide específico
    const showSlide = (index) => {
        // Ocultar todos los slides
        slides.forEach(slide => {
            slide.classList.remove('active');
        });
        
        // Desactivar todos los dots
        dots.forEach(dot => {
            dot.classList.remove('active');
        });
        
        // Mostrar el slide actual
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    };

    // Función para ir al siguiente slide
    const nextSlide = () => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    };

    // Función para ir al slide anterior
    const prevSlide = () => {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    };

    // Iniciar autoplay
    const startSlideInterval = () => {
        slideInterval = setInterval(nextSlide, 5000);
    };

    // Detener autoplay
    const stopSlideInterval = () => {
        clearInterval(slideInterval);
    };

    // Event listeners para los botones
    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            stopSlideInterval();
            startSlideInterval();
        });

        nextBtn.addEventListener('click', () => {
            nextSlide();
            stopSlideInterval();
            startSlideInterval();
        });
    }

    // Event listeners para los dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
            stopSlideInterval();
            startSlideInterval();
        });
    });

    // Iniciar autoplay al cargar la página
    startSlideInterval();
}

/**
 * Slider de Testimonios
 */
function initTestimonialSlider() {
    const testimonials = document.querySelectorAll('.testimonio-slide');
    const dots = document.querySelectorAll('.testimonio-dot');
    const prevBtn = document.querySelector('.prev-testimonio');
    const nextBtn = document.querySelector('.next-testimonio');
    let currentTestimonial = 0;

    // Función para mostrar un testimonio específico
    const showTestimonial = (index) => {
        // Ocultar todos los testimonios
        testimonials.forEach(testimonial => {
            testimonial.classList.remove('active');
        });
        
        // Desactivar todos los dots
        dots.forEach(dot => {
            dot.classList.remove('active');
        });
        
        // Mostrar el testimonio actual
        testimonials[index].classList.add('active');
        dots[index].classList.add('active');
    };

    // Función para ir al siguiente testimonio
    const nextTestimonial = () => {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        showTestimonial(currentTestimonial);
    };

    // Función para ir al testimonio anterior
    const prevTestimonial = () => {
        currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
        showTestimonial(currentTestimonial);
    };

    // Event listeners para los botones
    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', prevTestimonial);
        nextBtn.addEventListener('click', nextTestimonial);
    }

    // Event listeners para los dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentTestimonial = index;
            showTestimonial(currentTestimonial);
        });
    });
}

/**
 * Animaciones para las tarjetas de servicios
 */
function initCardAnimations() {
    // Animación al hacer scroll
    const cards = document.querySelectorAll('.servicio-card, .producto-card');
    
    // Opciones para el IntersectionObserver
    const observerOptions = {
        root: null, // viewport
        rootMargin: '0px',
        threshold: 0.1 // 10% del elemento visible
    };

    // Callback para el IntersectionObserver
    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Añadir clase para animar
                entry.target.classList.add('animate');
                // Dejar de observar el elemento
                observer.unobserve(entry.target);
            }
        });
    };

    // Crear el IntersectionObserver
    const observer = new IntersectionObserver(observerCallback, observerOptions);

    // Observar cada tarjeta
    cards.forEach(card => {
        observer.observe(card);
        
        // Añadir efecto hover personalizado
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
            card.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.style.boxShadow = '';
        });
    });
}

/**
 * Validación del formulario de contacto
 */
function initContactForm() {
    const form = document.getElementById('formulario-contacto');
    
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Obtener los valores del formulario
            const nombre = document.getElementById('nombre').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const servicio = document.getElementById('servicio').value;
            const mensaje = document.getElementById('mensaje').value.trim();
            
            // Validar los campos
            let isValid = true;
            
            if (nombre === '') {
                showError('nombre', 'Por favor, introduce tu nombre');
                isValid = false;
            } else {
                removeError('nombre');
            }
            
            if (email === '') {
                showError('email', 'Por favor, introduce tu email');
                isValid = false;
            } else if (!isValidEmail(email)) {
                showError('email', 'Por favor, introduce un email válido');
                isValid = false;
            } else {
                removeError('email');
            }
            
            if (mensaje === '') {
                showError('mensaje', 'Por favor, introduce tu mensaje');
                isValid = false;
            } else {
                removeError('mensaje');
            }
            
            // Si todo es válido, enviar el formulario
            if (isValid) {
                // En un entorno real, aquí se enviaría el formulario
                // Para WordPress, se puede usar AJAX para enviar a admin-ajax.php
                
                // Simulación de envío
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                
                submitBtn.disabled = true;
                submitBtn.textContent = 'Enviando...';
                
                setTimeout(() => {
                    // Mostrar mensaje de éxito
                    form.innerHTML = `
                        <div class="mensaje-exito">
                            <i class="fas fa-check-circle"></i>
                            <h3>¡Mensaje enviado con éxito!</h3>
                            <p>Nos pondremos en contacto contigo lo antes posible.</p>
                        </div>
                    `;
                }, 2000);
            }
        });
    }
    
    // Función para mostrar errores
    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        const errorElement = document.createElement('div');
        
        // Eliminar error existente si lo hay
        removeError(inputId);
        
        errorElement.className = 'error-message';
        errorElement.textContent = message;
        errorElement.style.color = '#e74c3c';
        errorElement.style.fontSize = '0.85rem';
        errorElement.style.marginTop = '5px';
        
        input.style.borderColor = '#e74c3c';
        input.parentNode.appendChild(errorElement);
    }
    
    // Función para eliminar errores
    function removeError(inputId) {
        const input = document.getElementById(inputId);
        const errorElement = input.parentNode.querySelector('.error-message');
        
        if (errorElement) {
            input.parentNode.removeChild(errorElement);
        }
        
        input.style.borderColor = '';
    }
    
    // Función para validar email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}

/**
 * Scroll suave para los enlaces de navegación
 */
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            
            // Solo aplicar a enlaces internos
            if (href !== '#') {
                e.preventDefault();
                
                const targetElement = document.querySelector(href);
                
                if (targetElement) {
                    // Scroll suave
                    window.scrollTo({
                        top: targetElement.offsetTop - 80, // Offset para el header
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
}

/**
 * Función para detectar cuando un elemento está en el viewport
 * Se usa para animaciones al hacer scroll
 */
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.bottom >= 0
    );
}

// Animaciones adicionales al hacer scroll
window.addEventListener('scroll', () => {
    // Animación para sección de proceso
    const procesoItems = document.querySelectorAll('.proceso-item');
    
    procesoItems.forEach((item, index) => {
        if (isInViewport(item)) {
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 200);
        }
    });
});
