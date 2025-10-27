<x-app-layout>
    <x-forms.form-card
        action="{{ route('blogs.update', $blog->id) }}"
        method="POST"
        title="Edit Your Blog"
        description="Update your blog details">
        @method('PUT')

        <x-forms.group>
            <x-forms.textarea
                label="Blog Description"
                name="description"
                rows="4"
                placeholder="Describe what your blog is about..."
                required
                value="{{ old('description', $blog->description) }}">
            </x-forms.textarea>
        </x-forms.group>

        <x-forms.group>
            <div class="flex gap-4 pt-4">
                <x-forms.button
                    variant="secondary"
                    href="{{ route('blogs.show', $blog->id) }}"
                    class="flex-1 text-center">
                    Cancel
                </x-forms.button>
                <x-forms.button
                    variant="success"
                    type="submit"
                    class="flex-1">
                    Update Blog
                </x-forms.button>
            </div>
        </x-forms.group>
    </x-forms.form-card>
</x-app-layout>

