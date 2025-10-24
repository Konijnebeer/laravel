<x-app-layout>
    <x-forms.form-card
        action="{{ route('blogs.posts.store', $blog->id) }}"
        method="POST"
        title="Create New Post"
        description="Share your thoughts with the world"
        :hasFiles="true">

        <x-forms.group>
            <x-forms.input
                label="Post Title"
                name="name"
                placeholder="Enter an engaging title"
                required/>

            <x-forms.file-upload
                label="Header Image"
                name="header_image"
                accept="image/*"
                help="Upload a header image for your post (JPG, PNG, GIF)"/>

            <x-forms.textarea
                label="Post Content"
                name="text"
                rows="8"
                placeholder="Write your post content..."
                required/>

            <x-forms.checkbox
                label="Publish immediately"
                name="publish_immediately"/>

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
                    Create Post
                </x-forms.button>
            </div>
        </x-forms.group>
    </x-forms.form-card>
</x-app-layout>

