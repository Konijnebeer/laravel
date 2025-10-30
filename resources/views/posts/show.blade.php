@php
    use Illuminate\Support\Facades\Storage;

    $liked = auth()->check() && $post->likedByUsers->contains(auth()->id());
    $followed = auth()->check() && $post->blog && $post->blog->followers->contains(auth()->id());

    $imageUrl = null;
    if ($post->header_image) {
        $imageUrl = preg_match('/^https?:\\/\\//i', $post->header_image)
            ? $post->header_image
            : Storage::url($post->header_image);
    }
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
    <div class="bg-primary-background min-h-screen">
        <!-- Post Header Banner -->
        <section class="relative">
            @if($post->header_image)
                <!-- Banner Image -->
                <div class="h-80 overflow-hidden relative">
                    <img src="{{ $imageUrl }}" alt="{{ $post->name }}" class="w-full h-full object-cover"
                         style="view-transition-name: post-image-{{ $post->id }}">
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/40 to-transparent"></div>
                </div>

                <!-- Title and Like Button Overlay -->
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="max-w-6xl mx-auto flex items-end justify-between">
                        <div>
                            <h1 class="text-5xl font-bold text-white mb-2 drop-shadow-lg"
                                style="view-transition-name: post-title-{{ $post->id }}">
                                {{ $post->name }}
                            </h1>
                            <!-- Blog Link -->
                            <a href="{{ route('blogs.show', $post->blog_id) }}"
                               class="inline-flex items-center gap-2 text-white/90 hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     style="view-transition-name: blog-icon-{{ $blog->id }}">
                                    <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4"/>
                                    <path d="M2 6h4"/>
                                    <path d="M2 10h4"/>
                                    <path d="M2 14h4"/>
                                    <path d="M2 18h4"/>
                                    <path
                                        d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                                </svg>
                                <span class="font-medium"
                                      style="view-transition-name: blog-title-{{ $blog->id }}">
                                    {{ $post->blog->user->name ?? 'Unknown' }}'s Blog
                                </span>
                            </a>
                        </div>

                        <!-- Like Button with Count -->
                        @php
                            $likeCount = $post->likedByUsers->count();
                        @endphp

                        @auth
                            @php
                                $liked = auth()->user()->likedPosts->contains($post->id);
                            @endphp
                            <button onclick="toggleLike(event, {{ $post->id }})"
                                    style="view-transition-name: post-like-{{ $post->id }}"
                                    class="like-btn-{{ $post->id }} flex items-center gap-3 {{ $liked ? 'bg-fail' : 'bg-accent' }} hover:bg-secondary text-white px-6 py-4 rounded-xl shadow-lg font-semibold transition-all hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="like-icon-{{ $post->id }}">
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
                                <div class="text-left">
                                    <p class="text-2xl font-bold like-count-{{ $post->id }}">{{ $likeCount }}</p>
                                    <p class="text-xs text-white/80">Likes</p>
                                </div>
                            </button>
                        @else
                            <!-- Static like count display for guests -->
                            <div
                                class="flex items-center gap-3 bg-accent/80 text-white px-6 py-4 rounded-xl shadow-lg"
                                style="view-transition-name: post-like-{{ $post->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path
                                        d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>
                                </svg>
                                <div class="text-left">
                                    <p class="text-2xl font-bold">{{ $likeCount }}</p>
                                    <p class="text-xs opacity-70">Likes</p>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            @else
                <!-- Fallback if no image -->
                <div class="bg-accent py-12 px-8">
                    <div class="max-w-6xl mx-auto flex items-center justify-between">
                        <div>
                            <h1 class="text-5xl font-bold text-primary mb-2"
                                style="view-transition-name: post-title-{{ $post->id }}">
                                {{ $post->name }}
                            </h1>
                            <a href="{{ route('blogs.show', $post->blog_id) }}"
                               class="inline-flex items-center gap-2 text-primary/80 hover:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     style="view-transition-name: blog-icon-{{ $blog->id }}">
                                    <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4"/>
                                    <path d="M2 6h4"/>
                                    <path d="M2 10h4"/>
                                    <path d="M2 14h4"/>
                                    <path d="M2 18h4"/>
                                    <path
                                        d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                                </svg>
                                <span class="font-medium"
                                      style="view-transition-name: blog-title-{{ $blog->id }}">
                                    {{ $post->blog->user->name ?? 'Unknown' }}'s Blog
                                </span>
                            </a>
                        </div>

                        @php
                            $likeCount = $post->likedByUsers->count();
                        @endphp

                        @auth
                            @php
                                $liked = auth()->user()->likedPosts->contains($post->id);
                            @endphp
                            <button onclick="toggleLike(event, {{ $post->id }})"
                                    class="like-btn-{{ $post->id }} flex items-center gap-3 {{ $liked ? 'bg-fail' : 'bg-success' }} hover:bg-secondary text-white px-6 py-4 rounded-xl shadow-lg font-semibold transition-all hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="like-icon-{{ $post->id }}">
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
                                <div class="text-left">
                                    <p class="text-2xl font-bold like-count-{{ $post->id }}">{{ $likeCount }}</p>
                                    <p class="text-xs text-white/80 like-text-{{ $post->id }}">Likes</p>
                                </div>
                            </button>
                        @else
                            <!-- Static like count display for guests -->
                            <div
                                class="flex items-center gap-3 bg-primary/10 text-primary px-6 py-4 rounded-xl shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path
                                        d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>
                                </svg>
                                <div class="text-left">
                                    <p class="text-2xl font-bold">{{ $likeCount }}</p>
                                    <p class="text-xs opacity-70">Likes</p>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            @endif
        </section>

        <!-- Post Content -->
        <section class="max-w-4xl mx-auto px-4 py-12">
            <!-- Meta Information -->
            <div
                class="flex items-center gap-6 mb-8 pb-6 border-b border-primary/20 publish-date-section-{{ $post->id }}">
                @if($post->published_at)
                    <div class="flex items-center gap-2 text-primary/70">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M8 2v4"/>
                            <path d="M16 2v4"/>
                            <rect width="18" height="18" x="3" y="4" rx="2"/>
                            <path d="M3 10h18"/>
                            <path d="M8 14h.01"/>
                            <path d="M12 14h.01"/>
                            <path d="M16 14h.01"/>
                            <path d="M8 18h.01"/>
                            <path d="M12 18h.01"/>
                            <path d="M16 18h.01"/>
                        </svg>
                        <span class="text-sm font-medium">{{ $post->published_at->format('F d, Y') }}</span>
                    </div>
                @else
                    <div class="bg-accent/30 px-4 py-2 rounded-lg flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="text-primary">
                            <path d="M12.5 22H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v9.5"/>
                            <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                            <path
                                d="M13.378 15.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                        </svg>
                        <span class="text-sm font-semibold text-primary">Draft</span>
                    </div>
                @endif

                <!-- Tags if available -->
                @if($post->tags && $post->tags->count() > 0)
                    <div class="flex items-center gap-2 flex-wrap">
                        @foreach($post->tags as $tag)
                            <span class="bg-success/20 text-primary px-3 py-1 rounded-full text-xs font-medium">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Post Content -->
            @if($post->text)
                <div class="prose prose-lg max-w-none">
                    <div class="text-primary leading-relaxed">
                        {{ $post->text }}
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-primary/60">No content available yet.</p>
                </div>
            @endif

            <!-- Edit/Delete Buttons for Owner/Admin -->
            @auth
                @if(auth()->id() === $post->blog->user_id || auth()->user()->isAdmin())
                    <div class="mt-12 pt-8 border-t border-primary/20 flex gap-4">
                        <a href="{{ route('blogs.posts.edit', ['blog' => $post->blog_id, 'post' => $post->id]) }}"
                           class="bg-primary hover:bg-primary/80 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                            Edit Post
                        </a>
                        <button onclick="togglePublish(event, {{ $post->blog_id }}, {{ $post->id }})"
                                class="publish-btn-{{ $post->id }} {{ $post->published_at ? 'bg-secondary hover:bg-secondary/80' : 'bg-success hover:bg-success/80' }} text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                            <span
                                class="publish-text-{{ $post->id }}">{{ $post->published_at ? 'Unpublish' : 'Publish' }}</span>
                        </button>
                        <form
                            action="{{ route('blogs.posts.destroy', ['blog' => $post->blog_id, 'post' => $post->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-fail hover:bg-fail/80 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                                Delete Post
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </section>
    </div>

    <script>
        function toggleLike(event, postId) {
            event.preventDefault();

            const button = event.target.closest('button');
            const icon = button.querySelector(`.like-icon-${postId}`);
            const countElement = button.querySelector(`.like-count-${postId}`);

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

                        // Update button color
                        button.classList.toggle('bg-fail', isLiked);
                        button.classList.toggle('bg-accent', !isLiked);

                        // Update like count
                        let currentCount = parseInt(countElement.textContent);
                        countElement.textContent = isLiked ? currentCount + 1 : currentCount - 1;

                        // Update SVG icon
                        if (isLiked) {
                            icon.innerHTML = '<path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>';
                        } else {
                            icon.innerHTML = '<path d="m14.479 19.374-.971.939a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5a5.2 5.2 0 0 1-.219 1.49"/><path d="M15 15h6"/><path d="M18 12v6"/>';
                        }
                    }
                })
                .catch(console.error);
        }

        function togglePublish(event, blogId, postId) {
            event.preventDefault();

            const button = event.target.closest('button');
            const textSpan = button.querySelector(`.publish-text-${postId}`);
            const dateSection = document.querySelector(`.publish-date-section-${postId}`);

            fetch(`/blogs/${blogId}/posts/${postId}/toggle-publish`, {
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
                        const isPublished = data.published;

                        // Update button styling
                        button.classList.toggle('bg-success', !isPublished);
                        button.classList.toggle('hover:bg-success/80', !isPublished);
                        button.classList.toggle('bg-secondary', isPublished);
                        button.classList.toggle('hover:bg-secondary/80', isPublished);

                        // Update button text
                        textSpan.textContent = isPublished ? 'Unpublish' : 'Publish';

                        // Update published date / draft badge
                        if (isPublished) {
                            const now = new Date();
                            const formatted = now.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            dateSection.innerHTML = `
                                <div class="flex items-center gap-2 text-primary/70">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/>
                                    </svg>
                                    <span class="text-sm font-medium">${formatted}</span>
                                </div>
                            `;
                        } else {
                            dateSection.innerHTML = `
                                <div class="bg-accent/30 px-4 py-2 rounded-lg flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="text-primary">
                                        <path d="M12.5 22H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v9.5"/>
                                        <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                                        <path d="M13.378 15.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-primary">Draft</span>
                                </div>
                            `;
                        }

                        console.log(data.message);
                    }
                })
                .catch(console.error);
        }
    </script>
</x-app-layout>
