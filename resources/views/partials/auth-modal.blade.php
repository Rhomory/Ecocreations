@guest
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="authModalLabel">Acceder a tu cuenta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Ya tienes una cuenta o quieres crear una nueva?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('register') }}" class="btn btn-secondary">Crear cuenta</a>
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>
@endguest
