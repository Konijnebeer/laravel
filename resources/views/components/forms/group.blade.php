@props(['spacing' => 'space-y-6'])

<div {{ $attributes->merge(['class' => $spacing]) }}>
    {{ $slot }}
</div>
