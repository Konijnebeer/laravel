<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>
    @auth
        <section class="flex justify-center items-center py-20">
            <table class="min-w-80 bg-gray-800 rounded-lg shadow-md">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-200">Description</th>
                    <th class="px-4 py-2 text-left text-gray-200">Published Status</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2 text-white">{{$blog->description}}</td>
                    <td class="px-4 py-2 text-white">{{$blog->published_at ? 'published' : 'under review'}}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2 text-white text-center" colspan="2">
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2 text-white text-center" colspan="2">
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this blog?');"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-500 hover:underline bg-transparent border-none cursor-pointer p-0">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                </tfoot>
            </table>
        </section>
    @endauth
    @guest
        <p class="text-red-600">you are not logged in</p>
    @endguest
</x-app-layout>
