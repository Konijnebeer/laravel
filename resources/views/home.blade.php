<x-app-layout>
    <h1 class="text-white">Home Page</h1>
    @auth
        <p class="text-blue-300">You are logged in</p>
    @endauth
    @guest
        <p class="text-red-300">you are not logged in</p>
    @endguest
</x-app-layout>
