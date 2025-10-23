<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blogs') }}
        </h2>
    </x-slot>
    @auth
        <section class="flex justify-center items-center py-20">
            <table class="min-w-80 bg-gray-800 rounded-lg shadow-md">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-200">Username</th>
                    <th class="px-4 py-2 text-left text-gray-200">Blog</th>
                    <th class="px-4 py-2 text-left text-gray-200">Published At</th>
                    <th class="px-4 py-2 text-left text-gray-200">Text</th>
                    <th class="px-4 py-2 text-left text-gray-200">Liked</th>
                    @if(auth()->user()->isAdmin() || $posts->contains(fn($p) => $p->blog->user_id === auth()->id()))
                        <th class="px-4 py-2 text-left text-gray-200">Publish</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr class="border-t border-gray-700">
                        <td class="px-4 py-2 text-white underline">
                            <a href="{{route('blogs.show', $post->id)}}">
                                {{ $post->user->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-white">
                            {{ $post->blog->description }}
                        </td>
                        <td class="px-4 py-2 text-white">
                            {{ $post->published_at ? $post->published_at->format('Y-m-d H:i') : 'Not published'}}
                        </td>
                        <td class="px-4 py-2 text-white">
                            {{ $post->text }}
                        </td>
                        <td>
                            <form action="{{ route('posts.toggleLike', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="{{ auth()->user()->likedPosts->contains($post->id) ? 'bg-red-500' : 'bg-green-500' }} text-white px-3 py-1 rounded">
                                    {{ auth()->user()->likedPosts->contains($post->id) ? 'Unlike' : 'Like' }}
                                </button>
                            </form>
                        </td>
                        @if(auth()->id() === $post->blog->user_id || auth()->user()->isAdmin())
                            <td class="px-4 py-2">
                                <form
                                    action="{{ route('posts.togglePublish', ['blog' => $post->blog_id, 'post' => $post->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="{{ $post->published_at ? 'bg-orange-500 hover:bg-orange-600' : 'bg-blue-500 hover:bg-blue-600' }} text-white px-3 py-1 rounded">
                                        {{ $post->published_at ? 'Unpublish' : 'Publish' }}
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2 text-white text-center" colspan="3">
                        <a href="{{ route('blogs.create')}}" class="text-green-500 hover:underline">Create</a>
                    </td>
                </tr>
                </tfoot>
            </table>
        </section>
    @endauth
    @guest
        <div>
            <p class="text-red-600">you are not logged in</p>
        </div>
    @endguest
</x-app-layout>
