<x-app-layout>
    @if(Auth::user()->followedBlogs()->count() >= 5 || Auth::user()->isAdmin())
        <x-forms.form-card
            action="{{ route('blogs.store') }}"
            method="POST"
            title="Create Your Blog"
            description="Start sharing your thoughts with the world">

            <x-forms.group>
                <x-forms.textarea
                    label="Blog Description"
                    name="description"
                    rows="4"
                    placeholder="Describe what your blog is about..."
                    required/>
            </x-forms.group>
            <x-forms.group>
                <div class="flex flex-row space-x-1 justify-around">
                    <div>
                        test
                    </div>
                    <div>
                        test
                    </div>
                    <div>
                        test
                    </div>
                    <div>
                        test
                    </div>
                </div>
            </x-forms.group>
            <x-forms.group>
                <div class="flex gap-4 pt-4">
                    <x-forms.button
                        variant="secondary"
                        href="{{ route('dashboard') }}"
                        class="flex-1 text-center">
                        Cancel
                    </x-forms.button>
                    <x-forms.button
                        variant="success"
                        type="submit"
                        class="flex-1">
                        Create Blog
                    </x-forms.button>
                </div>
            </x-forms.group>
        </x-forms.form-card>
    @else
        <div class="bg-primary-background min-h-screen flex items-center justify-center py-12 px-4">
            <div class="w-full max-w-2xl">
                <div class="bg-white rounded-xl shadow-2xl overflow-hidden p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="text-secondary mx-auto mb-4">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 16v-4"/>
                        <path d="M12 8h.01"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-primary mb-4">Follow More Blogs First</h2>
                    <p class="text-primary/70 text-lg mb-6">You need to follow at least 5 blogs before you can create
                        your own blog.</p>
                    <x-forms.button
                        variant="primary"
                        href="{{ route('dashboard') }}">
                        Browse Blogs
                    </x-forms.button>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
