@props(['blog'])

@php
    $followed = auth()->check() && $blog->followers->contains(auth()->id());
@endphp

<a href="{{ route('blogs.show', $blog->id) }}"
   class="block col-span-2 row-span-2 rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02] {{ $followed ? 'bg-gradient-to-br from-orange-200 via-amber-100 to-yellow-100 border-2 border-orange-400' : 'bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 border-2 border-amber-200'}}">
    <div class="p-4 h-full flex flex-col">
        <div class="mb-2">
            <span class="text-2xl">📚</span>
        </div>
        <h3 class="font-bold text-xl text-amber-900 mb-2">{{ $blog->user->name ?? 'Unknown' }}'s Blog</h3>
        @if($blog->description)
            <p class="text-sm text-amber-800 mb-3 leading-relaxed flex-grow">{{ Str::limit($blog->description, 120) }}</p>
        @endif
        <div class="text-xs text-amber-700 bg-white bg-opacity-50 rounded p-2 mt-auto">
            <p class="font-semibold">🐾 {{ $blog->posts->count() }} Posts</p>
            @if($blog->published_at)
                <p class="mt-1">📅 {{ $blog->published_at->format('M d, Y') }}</p>
            @endif
        </div>
    </div>
</a>

