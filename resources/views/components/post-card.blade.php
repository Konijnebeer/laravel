@props(['post'])

@php
    $liked = auth()->check() && $post->likedByUsers->contains(auth()->id());
    $followed = auth()->check() && $post->blog && $post->blog->followers->contains(auth()->id());
@endphp

<a href="{{ route('blogs.posts.show', ['blog' => $post->blog_id, 'post' => $post->id]) }}"
   class="block col-span-2 row-span-1 rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02] {{ $followed && $liked ? 'bg-gradient-to-br from-orange-200 to-amber-200 border-2 border-orange-400' : ($followed ? 'bg-gradient-to-br from-amber-100 to-yellow-100 border-2 border-amber-300' : ($liked ? 'bg-gradient-to-br from-yellow-100 to-amber-50 border-2 border-yellow-300' : 'bg-gradient-to-br from-orange-50 to-amber-50 border-2 border-orange-200'))}}">
    @if($post->header_image)
        <div class="h-24 overflow-hidden">
            <img src="{{ $post->header_image }}" alt="{{ $post->name }}" class="w-full h-full object-cover">
        </div>
    @endif
    <div class="p-4">
        <h3 class="font-bold text-lg text-amber-900 mb-1">{{ $post->name }}</h3>
        @if($post->text)
            <p class="text-sm text-amber-800 leading-relaxed">{{ Str::limit($post->text, 80) }}</p>
        @endif
    </div>
</a>
