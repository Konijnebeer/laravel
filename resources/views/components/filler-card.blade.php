@props(['filler'])

@php
    $type = $filler['filler_type'] ?? 'image';
@endphp

<article class="col-span-1 row-span-1 rounded-lg overflow-hidden shadow-md">
    @if($type === 'image')
        <img src="{{ $filler['image'] }}" alt="Random" class="w-full h-full object-cover">
    @elseif($type === 'stat')
        <div class="bg-amber-100 h-full flex flex-col items-center justify-center p-3">
            <span class="text-accent mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="lucide lucide-origami-icon lucide-origami"><path
                        d="M12 12V4a1 1 0 0 1 1-1h6.297a1 1 0 0 1 .651 1.759l-4.696 4.025"/><path
                        d="m12 21-7.414-7.414A2 2 0 0 1 4 12.172V6.415a1.002 1.002 0 0 1 1.707-.707L20 20.009"/><path
                        d="m12.214 3.381 8.414 14.966a1 1 0 0 1-.167 1.199l-1.168 1.163a1 1 0 0 1-.706.291H6.351a1 1 0 0 1-.625-.219L3.25 18.8a1 1 0 0 1 .631-1.781l4.165.027"/>
                </svg>
            </span>
            <p class="text-3xl font-bold text-amber-800">{{ $filler['stat']['value'] }}</p>
            <p class="text-xs text-amber-700 mt-1 font-medium">{{ $filler['stat']['label'] }}</p>
        </div>
    @elseif($type === 'fact')
        <div class="bg-orange-100 h-full flex flex-col items-center justify-center p-3">
            <span class="text-secondary mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round"
                     class="lucide lucide-cat-icon lucide-cat"><path
                        d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z"/><path
                        d="M8 14v.5"/><path d="M16 14v.5"/><path d="M11.25 16.25h1.5L12 17l-.75-.75Z"/>
                </svg>
            </span>
            <p class="text-xs text-orange-800 text-center font-medium leading-relaxed">{{ $filler['cat_fact'] }}</p>
        </div>
    @endif
</article>


