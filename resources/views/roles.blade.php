<x-app-layout>
    <h1 class="text-white">Roles Page</h1>
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
                        <td class="px-4 py-2 text-white">{{$role->name}}</td>
                        <td class="px-4 py-2 text-white">{{$role->permission}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    @endauth
    @guest
        <p class="text-red-600">you are not logged in</p>
    @endguest
</x-app-layout>
