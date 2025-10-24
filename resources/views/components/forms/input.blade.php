@props(['label' => '', 'name', 'type' => 'text', 'value' => '', 'required' => false, 'placeholder' => ''])

<div class="mb-6">
    @if($label)
        <x-forms.label :for="$name" :required="$required">
            {{ $label }}
        </x-forms.label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 border border-primary/20 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors bg-white text-primary placeholder:text-primary/40']) }}
    >

    <x-forms.error :name="$name"/>
</div>
