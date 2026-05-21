<footer class="bg-dark text-light py-5 mt-5">
    <div class="container">
        <div class="row g-4 justify-content-between">
            <div class="col-md-3">
                <h5 class="font-serif text-light fs-3">
                    <i class="bi bi-leaf-fill text-success me-2"></i>ECOCREATIONS
                </h5>
                <p class="text-light opacity-75 fs-7">
                    Productos ecológicos personalizados, hechos en Perú con materiales sostenibles.
                </p>
            </div>

            <div class="col-md-2">
                <h6 class="font-serif text-light opacity-75 text-uppercase fs-8 mb-3">Tienda</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('catalog.index') }}">Catálogo</a></li>
                    <li><a href="{{ route('catalog.index') }}">Promociones</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h6 class="font-serif text-light opacity-75 text-uppercase fs-8 mb-3">Empresa</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('page.about') }}">Sobre nosotros</a></li>
                    <li><a href="{{ route('page.shipping') }}">Envíos</a></li>
                    <li><a href="{{ route('page.contact') }}">Contacto</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h6 class="font-serif text-light opacity-75 text-uppercase fs-8 mb-3">Ayuda</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('page.returns') }}">Cambios y devoluciones</a></li>
                    <li><a href="{{ route('page.privacy') }}">Política de privacidad</a></li>
                    <li><a href="{{ route('page.terms') }}">Términos y condiciones</a></li>
                </ul>
            </div>
        </div>

        <hr class="border-secondary mt-4 opacity-25">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <p class="font-mono fs-8 mb-0 text-light opacity-75">
                © {{ date('Y') }} ECOCREATIONS — Todos los derechos reservados
            </p>
            <ul class="footer-links list-inline mb-0">
                <li class="list-inline-item"><a href="#" class="font-mono fs-8 text-uppercase">Instagram</a></li>
                <li class="list-inline-item"><a href="#" class="font-mono fs-8 text-uppercase">Facebook</a></li>
                <li class="list-inline-item"><a href="#" class="font-mono fs-8 text-uppercase">Tiktok</a></li>
            </ul>
        </div>
    </div>
</footer>
