<nav>
    <x-navlink href="/" :active="request()->routeIs('home')">Home</x-navlink>
    <x-navlink href="/about" :active="request()->routeIs('about')">About</x-navlink>
    <x-navlink href="/contact" :active="request()->routeIs('contact')">Contact</x-navlink>
</nav>
