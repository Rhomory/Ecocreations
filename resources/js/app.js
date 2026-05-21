import './bootstrap';
import 'bootstrap';

// AOS — animaciones al hacer scroll
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    duration: 800,           // duración de la animación en ms
    easing: 'ease-out-cubic', // curva de aceleración
    once: true,              // anima solo una vez (no se repite al volver a subir)
    offset: 80,              // px antes de que el elemento entre al viewport
});