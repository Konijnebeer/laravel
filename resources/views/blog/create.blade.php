<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>
    <main class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">

        @if(Auth::user()->followedBlogs()->count() >= 5)
            {{--        @if(Auth::user()->followed_blogs_count >= 5)--}}
            <form method="POST" action="{{route('blogs.store')}}" novalidate>
                @csrf
                <div>
                    <x-input-label for="description" :value="__('Description')"/>
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                  :value="old('description')" required
                                  autofocus autocomplete="name"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                </div>
                <div class="flex items-center mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        @else
            <p class="text-white text-2xl">You need to follow atleast 5 blogs to create your own blog</p>
        @endif
    </main>
</x-app-layout>
