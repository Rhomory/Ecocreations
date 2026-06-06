{{--
    Card de producto reutilizable.
    Espera una variable $product (modelo Product con su relación 'category').
--}}
<div class="card border h-100 product-card">

    {{-- Imagen / placeholder --}}
    @php
        $imgPrincipal = $product->relationLoaded('images')
            ? $product->images->firstWhere('es_principal', true) ?? $product->images->first()
            : $product->images()->orderByDesc('es_principal')->first();
    @endphp
    <div class="bg-light rounded-top position-relative overflow-hidden"
        style="height: 240px;">

        {{-- Badge ECO --}}
        <span class="badge bg-primary position-absolute top-0 end-0 m-2 font-mono fs-8" style="z-index:1;">ECO</span>

        {{-- Badge personalizable --}}
        @if ($product->es_personalizable)
            <span class="badge bg-accent position-absolute top-0 start-0 m-2 font-mono fs-8" style="z-index:1;">
                Personalizable
            </span>
        @endif

        <x-cloud-img
            :src="$imgPrincipal?->ruta"
            :alt="$imgPrincipal?->alt_text ?? $product->nombre"
            :w="500"
            :h="480"
            crop="fill"
            class="w-100 h-100"
            style="object-fit: cover;" />
    </div>

    <div class="card-body d-flex flex-column p-3">

        {{-- Categoría (Enlace clickeable sobre el stretched-link) --}}
        <p class="font-mono fs-8 text-uppercase mb-1 position-relative" style="z-index: 2;">
            @if ($product->category)
                <a href="{{ route('catalog.show', $product->category->slug) }}" class="text-decoration-none text-muted-eco">
                    {{ $product->category->nombre }}
                </a>
            @else
                <span class="text-muted-eco">Sin categoría</span>
            @endif
        </p>

        {{-- Nombre --}}
        <h3 class="font-serif fs-5 mb-1">
            <a href="{{ route('product.show', $product->slug) }}"
                class="text-decoration-none text-body stretched-link">
                {{ $product->nombre }}
            </a>
        </h3>

        {{-- Descripción corta --}}
        <p class="text-muted-eco fs-7 mb-3">{{ $product->descripcion_corta }}</p>

        {{-- Precio + CTA (al fondo de la card) --}}
        <div class="d-flex justify-content-between align-items-center mt-auto">
            <span class="font-mono fw-bold fs-5">S/ {{ number_format($product->precio_base, 2) }}</span>
            <span class="btn btn-dark btn-sm rounded-pill px-3">
                Añadir <i class="bi bi-arrow-right"></i>
            </span>
        </div>
    </div>
</div>
