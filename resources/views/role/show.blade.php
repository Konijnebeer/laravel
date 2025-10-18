<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Role') }}
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
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2 text-white">{{$role->name}}</td>
                    <td class="px-4 py-2 text-white">{{$role->permission}}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2 text-white text-center" colspan="2">
                        <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2 text-white text-center" colspan="2">
                        <a href="{{ route('roles.destroy', $role->id) }}"
                           class="text-red-500 hover:underline">Delete</a>
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
