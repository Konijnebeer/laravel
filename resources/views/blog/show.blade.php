<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="bg-primary-background min-h-screen">
        <!-- Blog Header -->
        <section class="bg-accent py-12 px-4 shadow-lg">
            <div class="max-w-6xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <!-- Blog Icon -->
                        <div class="bg-secondary p-4 rounded-xl"
                             style="view-transition-name: blog-icon-{{ $blog->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="text-primary">
                                <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4"/>
                                <path d="M2 6h4"/>
                                <path d="M2 10h4"/>
                                <path d="M2 14h4"/>
                                <path d="M2 18h4"/>
                                <path
                                    d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-primary mb-2 vt-title"
                                style="view-transition-name: blog-title-{{ $blog->id }}">
                                {{ $blog->user->name ?? 'Unknown' }}'s Blog
                            </h1>
                            @if($blog->description)
                                <p class="text-primary/80 text-lg"
                                   style="view-transition-name: blog-description-{{ $blog->id }}">
                                    {{ $blog->description }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Follow Button -->
                    @auth
                        @if(auth()->id() !== $blog->user_id)
                            <button onclick="toggleFollow(event, {{ $blog->id }})"
                                    style="view-transition-name: blog-follow-{{ $blog->id }}"
                                    class="follow-btn-{{ $blog->id }} {{ auth()->user()->followedBlogs->contains($blog->id) ? 'bg-fail hover:bg-secondary' : 'bg-success hover:bg-success/80' }} text-white px-6 py-3 rounded-lg shadow-md font-semibold transition-colors">
                                <span
                                    class="follow-text-{{ $blog->id }}">{{ auth()->user()->followedBlogs->contains($blog->id) ? 'Unfollow' : 'Follow' }}</span>
                            </button>
                        @endif
                    @endauth
                </div>

                <!-- Stats Bar -->
                <div class="flex items-center justify-between gap-6 bg-white/60 backdrop-blur-sm rounded-lg p-4">
                    <div class="flex items-center gap-6">
                        <!-- Published Date -->
                        @if($blog->published_at)
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="text-primary">
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
                                <div>
                                    <p class="text-xs text-primary/70 font-medium">Published</p>
                                    <p class="text-sm font-semibold text-primary">{{ $blog->published_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Posts Count -->
                        <div class="flex items-center gap-2"
                             style="view-transition-name: blog-post-counter-{{ $blog->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-primary">
                                <circle cx="11" cy="4" r="2"/>
                                <circle cx="18" cy="8" r="2"/>
                                <circle cx="20" cy="16" r="2"/>
                                <path
                                    d="M9 10a5 5 0 0 1 5 5v3.5a3.5 3.5 0 0 1-6.84 1.045Q6.52 17.48 4.46 16.84A3.5 3.5 0 0 1 5.5 10Z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-primary/70 font-medium">Posts</p>
                                <p class="text-sm font-semibold text-primary">{{ $blog->posts->count() }}</p>
                            </div>
                        </div>

                        <!-- Followers Count -->
                        <div class="flex items-center gap-2"
                             style="view-transition-name: blog-follow-counter-{{ $blog->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-primary">
                                <path
                                    d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z"/>
                                <path d="M8 14v.5"/>
                                <path d="M16 14v.5"/>
                                <path d="M11.25 16.25h1.5L12 17l-.75-.75Z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-primary/70 font-medium">Followers</p>
                                <p class="text-sm font-semibold text-primary">{{ $blog->followers->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tags Pills -->
                    @if($blog->tags->count() > 0)
                        <div class="flex items-center gap-2 flex-wrap">
                            @foreach($blog->tags as $tag)
                                <span
                                    class="px-3 py-1 bg-secondary text-white text-xs font-medium rounded-full shadow-sm">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Published Posts Grid -->
        <section class="max-w-6xl mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold text-primary mb-6">Published Posts</h2>

            @php
                $publishedPosts = $blog->posts()->whereNotNull('published_at')->get();
            @endphp

            @if($publishedPosts->count() > 0)
                <div
                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 auto-rows-fr gap-4">
                    @foreach($publishedPosts as $post)
                        <x-post-card :post="$post"/>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-primary/60 text-lg">No published posts yet.</p>
                </div>
            @endif
        </section>

        <!-- Floating Admin Panel for Owner/Admin -->
        @auth
            @if(auth()->id() === $blog->user_id || auth()->user()->isAdmin())
                <div
                    class="fixed right-4 bottom-4 w-80 max-h-[80vh] bg-white rounded-xl shadow-2xl overflow-hidden z-50">
                    <!-- Panel Header -->
                    <div class="bg-secondary p-4">
                        <h3 class="text-white font-bold text-lg">Blog Management</h3>
                    </div>

                    <!-- Create New Post Button -->
                    <div class="p-4 border-b border-gray-200">
                        @if($blog->published_at === null && !auth()->user()->isAdmin())
                            <a class="block w-full bg-success/40 cursor-not-allowed text-white text-center font-semibold py-3 rounded-lg transition-colors">
                                + New Post
                            </a>
                        @else
                            <a href="{{ route('blogs.posts.create', $blog->id) }}"
                               class="block w-full bg-success hover:bg-success/80 text-white text-center font-semibold py-3 rounded-lg transition-colors">
                                + New Post
                            </a>
                        @endif
                    </div>

                    <!-- Edit & Delete Blog Buttons -->
                    <div class="p-4 border-b border-gray-200 space-y-2">
                        <a href="{{ route('blogs.edit', $blog->id) }}"
                           class="block w-full bg-primary hover:bg-primary/80 text-white text-center font-medium py-2 rounded-lg transition-colors">
                            Edit Blog
                        </a>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this blog and all its posts?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-fail hover:bg-fail/80 text-white font-medium py-2 rounded-lg transition-colors">
                                Delete Blog
                            </button>
                        </form>
                    </div>

                    <!-- Unpublished Posts Section -->
                    <div class="overflow-y-auto max-h-96">
                        <div class="p-4">
                            <h4 class="font-semibold text-primary mb-3">Unpublished Posts</h4>

                            @php
                                $unpublishedPosts = $blog->posts()->whereNull('published_at')->get();
                            @endphp

                            @if($unpublishedPosts->count() > 0)
                                <div class="space-y-2">
                                    @foreach($unpublishedPosts as $post)
                                        <div
                                            class="bg-primary-background p-3 rounded-lg flex items-center justify-between gap-2">
                                            <a href="{{ route('blogs.posts.show', ['blog' => $blog->id, 'post' => $post->id]) }}"
                                               class="flex-1 hover:opacity-80 transition-opacity">
                                                <p class="font-medium text-primary text-sm">{{ Str::limit($post->name, 30) }}</p>
                                                <div class="flex items-center gap-1 mt-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                         viewBox="0 0 24 24"
                                                         fill="none" stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round"
                                                         stroke-linejoin="round" class="text-primary/60">
                                                        <path d="M12.5 22H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v9.5"/>
                                                        <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                                                        <path
                                                            d="M13.378 15.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                                                    </svg>
                                                    <p class="text-xs text-primary/60">Draft</p>
                                                </div>
                                            </a>
                                            @if(auth()->id() === $blog->user_id || auth()->user()->isAdmin())
                                                <form
                                                    action="{{ route('posts.togglePublish', ['blog' => $blog->id, 'post' => $post->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                            class="bg-success hover:bg-success/80 text-white text-xs px-3 py-1.5 rounded font-medium transition-colors whitespace-nowrap">
                                                        Publish
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-primary/60 text-sm">No unpublished posts</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endauth
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
                        button.classList.toggle('hover:bg-success/80', !isFollowing);
                        button.classList.toggle('bg-fail', isFollowing);
                        button.classList.toggle('hover:bg-secondary', isFollowing);
                        textSpan.textContent = isFollowing ? 'Unfollow' : 'Follow';
                    }
                })
                .catch(console.error);
        }
    </script>
</x-app-layout>
