@props(['disabled' => false, 'checked' => false])

<input
    type="radio"
    @disabled($disabled)
    @checked($checked)
    {{ $attributes->merge(['class' => 'border-primary/30 text-secondary focus:ring-secondary focus:ring-offset-0 transition-colors duration-150']) }}
>
@props(['disabled' => false, 'type' => 'text'])

<input
    type="{{ $type }}"
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full border-primary/30 bg-white text-primary placeholder:text-primary/50 focus:border-secondary focus:ring-secondary rounded-lg shadow-sm transition-colors duration-150']) }}
>

