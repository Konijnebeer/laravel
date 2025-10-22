@props(['filler'])

@php
    $type = $filler['filler_type'] ?? 'image';
@endphp

<article class="col-span-1 row-span-1 rounded-lg overflow-hidden shadow-md">
    @if($type === 'image')
        <img src="{{ $filler['image'] }}" alt="Random" class="w-full h-full object-cover">
    @elseif($type === 'stat')
        <div class="bg-amber-100 border-2 border-amber-300 h-full flex flex-col items-center justify-center p-3">
            <p class="text-3xl font-bold text-amber-800">{{ $filler['stat']['value'] }}</p>
            <p class="text-xs text-amber-700 mt-1 font-medium">{{ $filler['stat']['label'] }}</p>
            <span class="text-2xl mt-2">🐱</span>
        </div>
    @elseif($type === 'fact')
        <div class="bg-orange-100 border-2 border-orange-300 h-full flex flex-col items-center justify-center p-3">
            <span class="text-3xl mb-2">😺</span>
            <p class="text-xs text-orange-800 text-center font-medium leading-relaxed">{{ $filler['cat_fact'] }}</p>
        </div>
    @endif
</article>

