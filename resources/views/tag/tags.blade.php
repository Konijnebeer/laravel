<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>
    <main class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="bg-white dark:bg-gray-400 p-6 rounded shadow">
            <x-table
                :columns="['Name' => 'name', 'Slug' => 'slug', 'Parent' => 'parent.name']"
                :rows="$tags"
                :actions="['delete' => true, 'edit' => true]"
            />
        </div>
    </main>
</x-app-layout>
