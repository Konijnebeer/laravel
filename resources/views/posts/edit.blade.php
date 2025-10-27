@php
    use Illuminate\Support\Facades\Storage;

    $imageUrl = null;
    if ($post->header_image) {
    $imageUrl = preg_match('/^https?:\\/\\//i', $post->header_image)
    ? $post->header_image
    : Storage::url($post->header_image);
    }
@endphp

<x-app-layout>
    <x-forms.form-card
        action="{{ route('blogs.posts.update', ['blog' => $blog->id, 'post' => $post->id]) }}"
        method="POST"
        title="Edit Post"
        description="Update your post"
        :hasFiles="true">
        @method('PUT')

        <x-forms.group>
            <x-forms.input
                label="Post Title"
                name="name"
                value="{{ old('name', $post->name) }}"
                placeholder="Enter an engaging title"
                required/>

            @if($imageUrl)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Current Header Image
                    </label>
                    <img src="{{ $imageUrl }}" alt="{{ $post->name }}" class="w-full aspect-[5/2] object-cover">

                </div>
            @endif

            <x-forms.file-upload
                label="Header Image"
                name="header_image"
                accept="image/*"
                help="Upload a new header image to replace the current one (JPG, PNG, GIF)"/>

            <x-forms.textarea
                label="Post Content"
                name="text"
                rows="8"
                placeholder="Write your post content..."
                required
                value="{{ old('text', $post->text) }}">
            </x-forms.textarea>

            <div class="flex gap-4 pt-4">
                <x-forms.button
                    variant="secondary"
                    href="{{ route('blogs.posts.show', ['blog' => $blog->id, 'post' => $post->id]) }}"
                    class="flex-1 text-center">
                    Cancel
                </x-forms.button>
                <x-forms.button
                    variant="success"
                    type="submit"
                    class="flex-1">
                    Update Post
                </x-forms.button>
            </div>
        </x-forms.group>
    </x-forms.form-card>
</x-app-layout>

