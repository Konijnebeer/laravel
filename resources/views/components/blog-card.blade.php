@props(['blog'])

@php
    $followed = auth()->check() && $blog->followers->contains(auth()->id());
@endphp

<div
    class="relative col-span-2 row-span-2 rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02] bg-primary-background">

    <!-- Clickable Card Content -->
    <a href="{{ route('blogs.show', $blog->id) }}" class="flex flex-col p-4 h-full">
        <!-- Icon - Top Right -->
        <div class="flex justify-end mb-2">
            <span class="text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4"/><path d="M2 6h4"/><path
                        d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><path
                        d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                </svg>
            </span>
        </div>

        <!-- Title -->
        <h3 class="font-bold text-xl text-primary mb-3 vt-title">
            {{ $blog->user->name ?? 'Unknown' }}'s Blog
        </h3>

        <!-- Description -->
        @if($blog->description)
            <p class=" text-sm text-primary/80 mb-3 leading-relaxed
        flex-grow">{{ Str::limit($blog->description, 120) }}</p>
        @endif
    </a>

    <!-- Bottom Bar with Stats and Follow Button -->
    <div class="absolute bottom-0 left-0 right-0 flex justify-between items-end p-3 z-10">
        <!-- Stats - Bottom Left -->
        <div class="flex items-center gap-3 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-2 shadow-sm">
            <!-- Posts Count -->
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="text-primary">
                    <circle cx="11" cy="4" r="2"/>
                    <circle cx="18" cy="8" r="2"/>
                    <circle cx="20" cy="16" r="2"/>
                    <path
                        d="M9 10a5 5 0 0 1 5 5v3.5a3.5 3.5 0 0 1-6.84 1.045Q6.52 17.48 4.46 16.84A3.5 3.5 0 0 1 5.5 10Z"/>
                </svg>
                <span class="font-semibold text-sm text-primary">{{ $blog->posts->count() }}</span>
            </div>

            <!-- Followers Count -->
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="text-primary">
                    <path
                        d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z"/>
                    <path d="M8 14v.5"/>
                    <path d="M16 14v.5"/>
                    <path d="M11.25 16.25h1.5L12 17l-.75-.75Z"/>
                </svg>
                <span class="font-semibold text-sm text-primary">{{ $blog->followers->count() }}</span>
            </div>
        </div>

        <!-- Follow Button - Bottom Right -->
        @auth
            <button onclick="toggleFollow(event, {{ $blog->id }})"
                    class="follow-btn-{{ $blog->id }} {{ auth()->user()->followedBlogs->contains($blog->id) ? 'bg-fail hover:bg-secondary' : 'bg-success hover:bg-accent' }} text-white px-4 py-1.5 rounded-lg shadow-sm font-medium text-sm transition-colors">
                <span
                    class="follow-text-{{ $blog->id }}">{{ auth()->user()->followedBlogs->contains($blog->id) ? 'Unfollow' : 'Follow' }}</span>
            </button>
        @endauth
    </div>
</div>

<script>
    function toggleFollow(event, blogId) {
        event.preventDefault();

        const button = event.target.closest('button');
        const textSpan = button.querySelector(`.follow-text-${blogId}`);

        fetch(`/blogs/${blogId}/toggle-follow`, {
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
                    const isFollowing = data.following;
                    button.classList.toggle('bg-success', !isFollowing);
                    button.classList.toggle('hover:bg-accent', !isFollowing);
                    button.classList.toggle('bg-fail', isFollowing);
                    button.classList.toggle('hover:bg-secondary', isFollowing);
                    textSpan.textContent = isFollowing ? 'Unfollow' : 'Follow';
                }
            })
            .catch(console.error);
    }
</script>

