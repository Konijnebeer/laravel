<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>
    @auth
        <section class="flex justify-center items-center py-20">
            <table class="min-w-80 bg-gray-800 rounded-lg shadow-md">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-200">Name</th>
                    <th class="px-4 py-2 text-left text-gray-200">Slug</th>
                    <th class="px-4 py-2 text-left text-gray-200">parent</th>
                    @if(auth()->user()->isAdmin())
                        <th class="px-4 py-2 text-left text-gray-200">Edit</th>
                        <th class="px-4 py-2 text-left text-gray-200">Delete</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr class="border-t border-gray-700">
                        <td class="px-4 py-2 text-white underline">
                            <a href="{{route('tags.show', $tag->id)}}">
                                {{ $tag->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-white">
                            {{ $tag->slug }}
                        </td>
                        <td class="px-4 py-2 text-white">
                            {{ $tag->parent_id ? $tag->parent->name : 'No parent' }}
                        </td>
                        @if(auth()->user()->isAdmin())
                            <td class="px-4 py-2">
                                <a href="{{route('tags.edit', $tag->id)}}"
                                   class="'bg-orange-500 hover:bg-orange-600' text-white px-3 py-1 rounded">
                                    Edit
                                </a>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                            class="'bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
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
                        <a href="{{ route('tags.create')}}" class="text-green-500 hover:underline">Create</a>
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
