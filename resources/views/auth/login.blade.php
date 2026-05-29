@extends('layouts.app', ['hideNav' => true, 'hideFooter' => true])

@section('title', 'Acceder — ECOCREATIONS')

@section('content')
    <div class="row g-0 min-vh-100 position-relative">

        {{-- Logo flotante para móvil (volver al inicio) --}}
        <a href="{{ route('home') }}"
            class="d-lg-none position-absolute top-0 start-0 m-3 m-sm-4 text-dark text-decoration-none font-serif fw-bold d-flex align-items-center"
            style="z-index: 10;">
            <span class="bg-dark rounded-circle d-flex align-items-center justify-content-center me-2"
                style="width: 36px; height: 36px;">
                <span class="font-serif text-primary fw-bold" style="font-size: 1rem; line-height: 1;">E</span>
            </span>
            <span class="fs-6">ECOCREATIONS</span>
        </a>

        {{-- Columna Izquierda (Diseño Visual) --}}
        <div class="col-lg-6 bg-primary text-light d-none d-lg-flex flex-column justify-content-between"
            style="padding: 5rem;">
            <div>
                <a class="text-light text-decoration-none font-serif fw-bold d-flex align-items-center"
                    href="{{ route('home') }}">
                    <span class="bg-dark rounded-circle d-flex align-items-center justify-content-center me-2"
                        style="width: 40px; height: 40px;">
                        <span class="font-serif text-primary fw-bold" style="font-size: 1.35rem; line-height: 1;">E</span>
                    </span>
                    <span style="font-size: 1.125rem;">ECOCREATIONS</span>
                </a>
            </div>

            <div>
                <p class="font-mono fs-8 text-secondary text-uppercase fw-semibold mb-3">—— ENTRÁ AL ECOSISTEMA</p>
                <h1 class="font-serif text-light fw-normal mb-0"
                    style="font-size: 3.5rem; line-height: 1.05;">
                    Cada producto<br>personalizado evita<br>uno de plástico.
                </h1>
            </div>

            <div class="d-flex align-items-end gap-5">
                <div>
                    <p class="font-serif fw-medium mb-1" style="font-size: 2.25rem; line-height: 1;">+12K</p>
                    <p class="font-mono text-secondary text-uppercase fw-semibold mb-0"
                        style="font-size: 0.625rem; letter-spacing: 0.05em;">Personalizaciones</p>
                </div>
                <div>
                    <p class="font-serif fw-medium mb-1" style="font-size: 2.25rem; line-height: 1;">98%</p>
                    <p class="font-mono text-secondary text-uppercase fw-semibold mb-0"
                        style="font-size: 0.625rem; letter-spacing: 0.05em;">Mat. sostenibles</p>
                </div>
                <div>
                    <p class="font-serif text-accent fw-medium mb-1" style="font-size: 2.25rem; line-height: 1;">0</p>
                    <p class="font-mono text-secondary text-uppercase fw-semibold mb-0"
                        style="font-size: 0.625rem; letter-spacing: 0.05em;">Plásticos único uso</p>
                </div>
            </div>
        </div>

        {{-- Columna Derecha (Formulario) --}}
        <div class="col-lg-6 d-flex flex-column justify-content-center bg-body auth-form-col"
            style="background-color: #F5F0E6 !important;">
            <div class="mx-auto w-100" style="max-width: 480px;">

                <p class="font-mono fs-8 text-muted-eco text-uppercase fw-semibold mb-2">—— ACCEDÉ A TU CUENTA</p>
                <h2 class="font-serif mb-4 fw-normal"
                    style="font-size: 3rem; line-height: 1;">Bienvenido<br>de vuelta.</h2>

                {{-- Tabs Toggle --}}
                @php
                    $errorsRegistro = $errors->hasAny(['name']) || ($errors->has('email') && old('email_form') === 'register');
                    $tabLoginActiva = ! $errorsRegistro;
                @endphp
                <ul class="nav nav-pills nav-justified mb-4 p-1 rounded-pill" style="background-color: #E8E2D4;"
                    id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $tabLoginActiva ? 'active' : '' }} rounded-pill text-dark fw-semibold font-mono fs-7 py-2"
                            id="login-tab" data-bs-toggle="tab" data-bs-target="#login-pane" type="button" role="tab"
                            aria-controls="login-pane" aria-selected="{{ $tabLoginActiva ? 'true' : 'false' }}">Iniciar sesión</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ ! $tabLoginActiva ? 'active' : '' }} rounded-pill text-dark fw-semibold font-mono fs-7 py-2"
                            id="register-tab"
                            data-bs-toggle="tab" data-bs-target="#register-pane" type="button" role="tab"
                            aria-controls="register-pane" aria-selected="{{ ! $tabLoginActiva ? 'true' : 'false' }}">Crear cuenta</button>
                    </li>
                </ul>

                <style>
                    .nav-pills .nav-link.active {
                        background-color: #1F1B16;
                        color: #fff !important;
                    }
                </style>

                {{-- Contenido de los Tabs --}}
                <div class="tab-content" id="authTabsContent">

                    {{-- TAB: LOGIN --}}
                    <div class="tab-pane fade {{ $tabLoginActiva ? 'show active' : '' }}" id="login-pane" role="tabpanel" aria-labelledby="login-tab"
                        tabindex="0">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email_login"
                                    class="form-label font-mono fs-8 text-uppercase text-dark mb-1 fw-bold">Email</label>
                                <input type="email"
                                    class="form-control py-2 bg-transparent border-dark border-opacity-50 rounded-2 @error('email') is-invalid @enderror"
                                    id="email_login" name="email" value="{{ old('email') }}"
                                    placeholder="tu@correo.com" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback fs-8">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="password_login"
                                        class="form-label font-mono fs-8 text-uppercase text-dark fw-bold mb-0">Contraseña</label>
                                    <a href="#" class="text-accent text-decoration-none font-mono fs-8">¿Olvidaste tu
                                        contraseña?</a>
                                </div>
                                <div class="position-relative">
                                    <input type="password"
                                        class="form-control py-2 bg-transparent border-dark border-opacity-50 rounded-2 pe-5 @error('password') is-invalid @enderror"
                                        id="password_login" name="password" placeholder="Ingresa tu contraseña" required>
                                    <button type="button"
                                        class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-muted-eco toggle-password"
                                        data-target="password_login" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block fs-8">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input border-dark bg-dark" type="checkbox" name="remember"
                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label fs-7 text-dark" for="remember">
                                        Recordar mi sesión en este dispositivo
                                    </label>
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-accent btn-lg w-100 rounded-pill font-mono fs-7 fw-bold d-flex align-items-center justify-content-center py-3 gap-2">
                                Iniciar sesión <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>
                    </div>

                    {{-- TAB: REGISTER --}}
                    <div class="tab-pane fade {{ ! $tabLoginActiva ? 'show active' : '' }}" id="register-pane" role="tabpanel" aria-labelledby="register-tab"
                        tabindex="0">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name"
                                    class="form-label font-mono fs-8 text-uppercase text-dark mb-1 fw-bold">Nombre
                                    completo</label>
                                <input type="text"
                                    class="form-control py-2 bg-transparent border-dark border-opacity-50 rounded-2 @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" placeholder="Nombre" required>
                                @error('name')
                                    <div class="invalid-feedback fs-8">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email_reg"
                                    class="form-label font-mono fs-8 text-uppercase text-dark mb-1 fw-bold">Email</label>
                                <input type="email"
                                    class="form-control py-2 bg-transparent border-dark border-opacity-50 rounded-2 @error('email') is-invalid @enderror"
                                    id="email_reg" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback fs-8">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_reg"
                                    class="form-label font-mono fs-8 text-uppercase text-dark mb-1 fw-bold">Contraseña</label>
                                <div class="position-relative">
                                    <input type="password"
                                        class="form-control py-2 bg-transparent border-dark border-opacity-50 rounded-2 pe-5 @error('password') is-invalid @enderror"
                                        id="password_reg" name="password" placeholder="Mínimo 8 caracteres" required>
                                    <button type="button"
                                        class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-muted-eco toggle-password"
                                        data-target="password_reg" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block fs-8">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation"
                                    class="form-label font-mono fs-8 text-uppercase text-dark mb-1 fw-bold">Confirmar contraseña</label>
                                <input type="password"
                                    class="form-control py-2 bg-transparent border-dark border-opacity-50 rounded-2"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Repetí la contraseña" required>
                            </div>

                            <button type="submit"
                                class="btn btn-dark btn-lg w-100 rounded-pill font-mono fs-7 fw-bold d-flex align-items-center justify-content-center py-3 gap-2">
                                Crear cuenta <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Separador y Sociales --}}
                <div class="mt-4 pt-3">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <hr class="flex-grow-1 opacity-25">
                        <span class="font-mono fs-8 text-muted-eco text-uppercase">O continuar con</span>
                        <hr class="flex-grow-1 opacity-25">
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <button
                                class="btn btn-outline-dark w-100 rounded-pill font-mono fs-7 fw-semibold py-2 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-google"></i> Google
                            </button>
                        </div>
                        <div class="col-6">
                            <button
                                class="btn btn-outline-dark w-100 rounded-pill font-mono fs-7 fw-semibold py-2 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-facebook"></i> Facebook
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle de visibilidad de contraseña (botón con ojito)
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = document.getElementById(btn.dataset.target);
                if (!input) return;
                const oculto = input.type === 'password';
                input.type = oculto ? 'text' : 'password';
                const icon = btn.querySelector('i');
                if (icon) icon.className = oculto ? 'bi bi-eye-slash' : 'bi bi-eye';
            });
        });
    </script>
@endpush
