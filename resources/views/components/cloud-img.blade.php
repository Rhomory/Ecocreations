@props([
    /** URL completa de Cloudinary, o cualquier URL externa, o null. */
    'src' => null,
    /** Ancho destino en px (sin "px"). null = sin transformación de ancho. */
    'w' => null,
    /** Alto destino en px. null = ratio libre. */
    'h' => null,
    /** Modo de recorte: fill, fit, scale, crop, thumb, etc. Default fill (recorta al ratio). */
    'crop' => 'fill',
    /** Alt text accesible. */
    'alt' => '',
    /** Placeholder a mostrar si $src está vacío (mantiene la maqueta). */
    'placeholderIcon' => 'bi-image',
])

@php
    $esCloudinary = $src && str_contains($src, 'res.cloudinary.com');

    // Inyectar transformaciones en la URL de Cloudinary.
    // Ejemplo: .../upload/v123/foo.jpg → .../upload/f_auto,q_auto,w_400,c_fill/v123/foo.jpg
    $finalSrc = $src;
    if ($esCloudinary) {
        $tx = ['f_auto', 'q_auto'];
        if ($w) $tx[] = 'w_'.$w;
        if ($h) $tx[] = 'h_'.$h;
        if ($w || $h) $tx[] = 'c_'.$crop;
        $finalSrc = preg_replace('#/upload/#', '/upload/'.implode(',', $tx).'/', $src, 1);
    }
@endphp

@if ($finalSrc)
    <img src="{{ $finalSrc }}"
         alt="{{ $alt }}"
         loading="lazy"
         decoding="async"
         {{ $attributes }}>
@else
    <span {{ $attributes->merge(['class' => 'd-flex align-items-center justify-content-center bg-secondary text-primary opacity-50']) }}
          role="img"
          aria-label="{{ $alt ?: 'Sin imagen' }}">
        <i class="bi {{ $placeholderIcon }} fs-1"></i>
    </span>
@endif
