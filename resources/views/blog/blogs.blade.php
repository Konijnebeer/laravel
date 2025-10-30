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
                    <th class="px-4 py-2 text-left text-gray-200">Description</th>
                    <th class="px-4 py-2 text-left text-gray-200">Published At</th>
                    <th class="px-4 py-2 text-left text-gray-200">Posts</th>
                    <th class="px-4 py-2 text-left text-gray-200">Follow</th>
                    @if(auth()->user()->isAdmin())
                        <th class="px-4 py-2 text-left text-gray-200">Publish</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $blog)
                    <tr class="border-t border-gray-700">
                        <td class="px-4 py-2 text-white underline">
                            <a href="{{route('blogs.show', $blog->id)}}">
                                {{ $blog->user->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-white">
                            {{ $blog->description }}
                        </td>
                        <td class="px-4 py-2 text-white">
                            {{ $blog->published_at ? $blog->published_at->format('Y-m-d H:i') : 'Not published'}}
                        </td>
                        <td class="px-4 py-2 text-white">
                            <a href="{{ route('blogs.posts.index', $blog)}}"
                               class="text-blue-500 hover:underline">Posts</a>
                        </td>
                        <td class="px-4 py-2">
                            <form action="{{ route('blogs.toggleFollow', $blog->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="{{ auth()->user()->followedBlogs->contains($blog->id) ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-3 py-1 rounded">
                                    {{ auth()->user()->followedBlogs->contains($blog->id) ? 'Unfollow' : 'Follow' }}
                                </button>
                            </form>
                        </td>
                        @if(auth()->user()->isAdmin())
                            <td class="px-4 py-2">
                                <form action="{{ route('blogs.togglePublish', $blog->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="{{ $blog->published_at ? 'bg-orange-500 hover:bg-orange-600' : 'bg-blue-500 hover:bg-blue-600' }} text-white px-3 py-1 rounded">
                                        {{ $blog->published_at ? 'Unpublish' : 'Publish' }}
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
