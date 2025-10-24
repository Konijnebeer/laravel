@props(['post'])

@php
    $liked = auth()->check() && $post->likedByUsers->contains(auth()->id());
    $followed = auth()->check() && $post->blog && $post->blog->followers->contains(auth()->id());
@endphp

<a href="{{ route('blogs.posts.show', ['blog' => $post->blog_id, 'post' => $post->id]) }}"
   class="flex flex-col col-span-2 row-span-1 rounded-xl shadow-md overflow-hidden transition-transform hover:scale-[1.02] bg-primary-background">
    @if($post->header_image)
        <div class="h-28 overflow-hidden relative">
            <img src="{{ $post->header_image }}" alt="{{ $post->name }}" class="w-full h-full object-cover">
            class="w-full h-full object-cover">
            @auth
                <button onclick="toggleLike(event, {{ $post->id }})"
                        class="like-btn-{{ $post->id }} absolute top-2 right-2 p-2 bg-white/80 backdrop-blur-sm rounded-lg shadow-md hover:bg-white transition-all {{ $liked ? 'text-fail' : 'text-accent' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="like-icon-{{ $post->id }}">
                        @if($liked)
                            <path
                                d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>
                        @else
                            <path
                                d="m14.479 19.374-.971.939a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5a5.2 5.2 0 0 1-.219 1.49"/>
                            <path d="M15 15h6"/>
                            <path d="M18 12v6"/>
                        @endif
                    </svg>
                </button>
            @endauth
        </div>
        <div class="p-4 flex-shrink-0">
            <h3 class="font-bold text-lg text-primary line-clamp-2">{{ $post->name }}</h3>
        </div>
    @else
        <div class="flex-1 p-4 flex items-center justify-center bg-gradient-to-br from-primary/5 to-accent/5">
            <h3 class="font-bold text-lg text-primary text-center line-clamp-3">{{ $post->name }}</h3>
        </div>
    @endif
</a>

<script>
    function toggleLike(event, postId) {
        event.preventDefault();

        const button = event.target.closest('button');
        const icon = button.querySelector(`.like-icon-${postId}`);

        fetch(`/posts/${postId}/toggle-like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const isLiked = data.liked;
                    button.classList.toggle('text-fail', isLiked);
                    button.classList.toggle('text-accent', !isLiked);

                    // Update SVG path
                    if (isLiked) {
                        icon.innerHTML = '<path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>';
                    } else {
                        icon.innerHTML = '<path d="m14.479 19.374-.971.939a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5a5.2 5.2 0 0 1-.219 1.49"/><path d="M15 15h6"/><path d="M18 12v6"/>';
                    }
                }
            })
            .catch(console.error);
    }
</script>

