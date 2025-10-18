<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    @auth
        <section class="flex justify-center items-center py-20">
            <table class="min-w-80 bg-gray-800 rounded-lg shadow-md">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-200">Name</th>
                    <th class="px-4 py-2 text-left text-gray-200">Permission</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr class="border-t border-gray-700">
                        <td class="px-4 py-2 text-white underline">
                            <a href="{{route('roles.show', $role->id)}}">
                                {{$role->name}}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-white">{{$role->permission}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2 text-white text-center" colspan="2">
                        <a href="{{ route('roles.create')}}" class="text-green-500 hover:underline">Create</a>
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
