{{--
    Pantalla de transición entre páginas: hoja giratoria sobre fondo oscuro.
    Se controla desde resources/js/app.js (show on click + hide on pageshow).
--}}
<div id="pageLoader" class="page-loader" aria-hidden="true" role="status">
    <div class="page-loader__inner">

        {{-- Hoja giratoria (SVG del .pen) + anillo --}}
        <div class="page-loader__leaf-wrap">
            <svg class="page-loader__leaf" viewBox="0 0 50 70" aria-hidden="true">
                <path d="M25 2c-11 12-23 28-23 42 0 14 10 24 23 24 13 0 23-10 23-24 0-14-12-30-23-42z"/>
            </svg>
            <span class="page-loader__ring"></span>
        </div>

        {{-- Marca --}}
        <p class="page-loader__brand font-serif">ECOCREATIONS</p>

        {{-- 3 puntitos animados --}}
        <div class="page-loader__dots" aria-hidden="true">
            <span></span><span></span><span></span>
        </div>

        <p class="page-loader__text font-mono">Preparando tu experiencia…</p>
    </div>
</div>
