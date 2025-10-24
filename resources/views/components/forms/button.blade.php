@props(['type' => 'submit', 'variant' => 'primary', 'href' => null])

@php
    $baseClasses = 'font-semibold py-3 px-6 rounded-lg transition-colors shadow-md';
    $variantClasses = [
        'primary' => 'bg-primary hover:bg-primary/80 text-white',
        'success' => 'bg-success hover:bg-success/80 text-white',
        'secondary' => 'bg-secondary hover:bg-secondary/80 text-white',
        'fail' => 'bg-fail hover:bg-fail/80 text-white',
        'accent' => 'bg-accent hover:bg-accent/80 text-primary',
    ];
    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
