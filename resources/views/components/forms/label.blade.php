@props(['for' => '', 'required' => false])

<label
    @if($for) for="{{ $for }}" @endif
    {{ $attributes->merge(['class' => 'block text-sm font-medium text-primary mb-2']) }}
>
    {{ $slot }}
    @if($required)
        <span class="text-fail">*</span>
    @endif
</label>
