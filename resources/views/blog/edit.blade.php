<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Blog') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <x-forms.form-group>
                            <x-forms.label for="description" required>Description</x-forms.label>
                            <x-forms.textarea
                                name="description"
                                placeholder="Enter blog description"
                                rows="4"
                                required
                            >{{ old('description', $blog->description) }}</x-forms.textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                        </x-forms.form-group>
                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Update Blog') }}
                            </x-primary-button>
                            <a href="{{ route('blogs.index') }}"
                               class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

