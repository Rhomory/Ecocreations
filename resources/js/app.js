import './bootstrap';
import 'bootstrap';

// AOS — animaciones al hacer scroll
import AOS from 'aos';
import 'aos/dist/aos.css';

// En móvil, todas las animaciones laterales (fade-left/right, slide-*, zoom-in)
// se sustituyen por "fade-up" para evitar el espacio en blanco horizontal.
const esMovil = window.matchMedia('(max-width: 767.98px)').matches;
if (esMovil) {
    document.querySelectorAll('[data-aos]').forEach(el => {
        const anim = el.getAttribute('data-aos');
        if (anim && anim !== 'fade-up') {
            el.setAttribute('data-aos', 'fade-up');
        }
    });
}

AOS.init({
    duration: 800,           // duración de la animación en ms
    easing: 'ease-out-cubic', // curva de aceleración
    once: true,              // anima solo una vez (no se repite al volver a subir)
    offset: 80,              // px antes de que el elemento entre al viewport
});

// ============================================================
// Page loader: muestra el splash al navegar entre páginas internas
// ============================================================
(function () {
    const loader = document.getElementById('pageLoader');
    if (!loader) return;

    const MIN_VISIBLE_MS = 500;
    let mostradoEn = 0;

    const mostrar = () => {
        mostradoEn = Date.now();
        loader.classList.add('is-active');
        loader.setAttribute('aria-hidden', 'false');
    };

    const ocultar = () => {
        const transcurrido = Date.now() - mostradoEn;
        const espera = Math.max(0, MIN_VISIBLE_MS - transcurrido);
        setTimeout(() => {
            loader.classList.remove('is-active');
            loader.setAttribute('aria-hidden', 'true');
        }, espera);
    };

    document.addEventListener('click', (e) => {
        if (e.defaultPrevented) return;
        const link = e.target.closest('a[href]');
        if (!link) return;
        if (link.hasAttribute('data-no-loader')) return;

        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;
        if (link.target === '_blank' || link.hasAttribute('download')) return;
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;

        try {
            const url = new URL(link.href, window.location.href);
            if (url.origin !== window.location.origin) return;
            if (url.pathname === window.location.pathname && url.search === window.location.search) return;
        } catch {
            return;
        }

        mostrar();
    });

    document.addEventListener('submit', (e) => {
        if (e.defaultPrevented) return;
        const form = e.target;
        if (!form || form.tagName !== 'FORM' || form.method.toLowerCase() === 'get') return;
        if (form.hasAttribute('data-no-loader')) return;
        mostrar();
    });

    window.addEventListener('pageshow', ocultar);
})();