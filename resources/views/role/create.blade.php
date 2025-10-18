<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>
    <main class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
        <form method="POST" action="{{route('roles.store')}}" novalidate>
            @csrf
            <div>
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                              autofocus autocomplete="name"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>
            <div>
                <x-input-label for="permission" :value="__('permission')"/>
                <select name="permission" id="permission">
                    {{--                    @foreach(App\UserPermission::cases() as $permission)--}}
                    {{--                        --}}{{--                        {{ dd($permission) }}--}}
                    {{--                        <option--}}
                    {{--                            value="{{ $permission }}">{{ ucfirst(str_replace('_', ' ', strtolower($permission->name))) }}</option>--}}
                    {{--                    @endforeach--}}

                    @foreach($permissions as $permission)
                        <option
                            value="{{$permission->name}}">{{ ucfirst(str_replace('_', ' ', strtolower($permission->name))) }}
                    @endforeach
                </select>
                {{--            <x-dropdown id="permission" class="block mt-1 w-full">--}}
                {{--                <x-slot name="trigger">--}}
                {{--                    <span>{{ old('permission', 'Select Permission') }}</span>--}}
                {{--                </x-slot>--}}
                {{--                <x-slot name="content">--}}
                {{--                    --}}{{--                    {{ dd($permissions) }}--}}
                {{--                    @foreach($permissions as $permission)--}}
                {{--                        <button type="submit" name="permission" value="{{ $permission->name }}"--}}
                {{--                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">--}}
                {{--                            {{ $permission->name }}--}}
                {{--                        </button>--}}
                {{--                    @endforeach--}}
                {{--                </x-slot>--}}
                {{--            </x-dropdown>--}}
                <x-input-error :messages="$errors->get('permission')" class="mt-2"/>
            </div>

            <div class="flex items-center mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

        </form>
    </main>
</x-app-layout>
