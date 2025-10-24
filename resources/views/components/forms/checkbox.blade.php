@props(['label' => '', 'name', 'value' => '1', 'checked' => false])

<div class="flex items-center gap-3 mb-6">
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        @if(old($name, $checked)) checked @endif
        {{ $attributes->merge(['class' => 'w-5 h-5 text-success bg-white border-primary/20 rounded focus:ring-2 focus:ring-primary transition-colors']) }}
    >
    @if($label)
        <x-forms.label :for="$name" class="mb-0">
            {{ $label }}
        </x-forms.label>
    @else
        {{ $slot }}
    @endif
</div>
