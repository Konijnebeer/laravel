@props(['label' => '', 'name', 'accept' => 'image/*', 'required' => false, 'help' => ''])

<div class="mb-6">
    @if($label)
        <x-forms.label :for="$name" :required="$required">
            {{ $label }}
        </x-forms.label>
    @endif

    <div class="relative">
        <input
            type="file"
            name="{{ $name }}"
            id="{{ $name }}"
            accept="{{ $accept }}"
            @if($required) required @endif
            {{ $attributes->merge(['class' => 'w-full px-4 py-3 border border-primary/20 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors bg-white text-primary file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-success file:text-white hover:file:bg-success/80 file:cursor-pointer cursor-pointer']) }}
            onchange="previewImage{{ $name }}(event)"
        >
    </div>

    @if($help)
        <p class="mt-2 text-sm text-primary/60">{{ $help }}</p>
    @endif

    <!-- Image Preview -->
    <div id="preview-{{ $name }}" class="mt-4 hidden">
        <p class="text-sm font-medium text-primary mb-2">Preview:</p>
        <img id="preview-img-{{ $name }}" src="" alt="Preview"
             class="max-w-full h-48 object-cover rounded-lg border border-primary/20">
    </div>

    <x-forms.error :name="$name"/>
</div>

<script>
    function previewImage{{ $name }}(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-{{ $name }}');
        const previewImg = document.getElementById('preview-img-{{ $name }}');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    }
</script>
