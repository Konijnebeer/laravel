@php
    use App\Models\Tag;

    // Recursive function to render tags and their children
    function renderTag($tag, $selectedTags = [], $level = 0) {
        $indent = $level * 14; // Indentation in pixels (ml-7 per level)
        $checkboxSize = $level === 0 ? 'w-5 h-5' : 'w-4 h-4';
        $labelClass = $level === 0 ? 'text-primary font-medium' : 'text-primary/80 text-sm';
        $isChecked = in_array($tag->id, $selectedTags) ? 'checked' : '';

        $html = '<div class="space-y-2">';
        $html .= '<div class="flex items-center gap-2" style="margin-left: ' . $indent . 'px;">';
        $html .= '<input name="tags[]" id="tag_' . $tag->id . '" type="checkbox" value="' . $tag->id . '" ' . $isChecked . ' class="' . $checkboxSize . ' text-success bg-white border-primary/20 rounded focus:ring-2 focus:ring-primary transition-colors">';
        $html .= '<label for="tag_' . $tag->id . '" class="' . $labelClass . ' cursor-pointer">' . e($tag->name) . '</label>';
        $html .= '</div>';

        // Recursively render children
        $children = Tag::where('parent_id', $tag->id)->get();
        if ($children->count() > 0) {
            foreach ($children as $child) {
                $html .= renderTag($child, $selectedTags, $level + 1);
            }
        }

        $html .= '</div>';
        return $html;
    }
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search Page') }}
        </h2>
    </x-slot>

    <div class="bg-primary-background min-h-screen">
        <section class="bg-accent py-12 px-4 shadow-lg">
            <div class="max-w-6xl mx-auto">
                <form method="POST" action="{{ route('home.results') }}" class="space-y-6">
                    @csrf

                    <!-- Search Bar Row -->
                    <div class="bg-white/50 p-4 rounded-lg">
                        <div class="flex items-center gap-4">
                            <!-- Search Input -->
                            <input
                                id="searchbar"
                                name="search"
                                type="text"
                                value="{{ old('search', $search ?? '') }}"
                                placeholder="Search for blogs or posts..."
                                class="flex-1 px-4 py-3 border border-primary/20 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors bg-white text-primary placeholder:text-primary/40"
                            />

                            <!-- Checkboxes -->
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <input
                                        name="blogs"
                                        id="blogs"
                                        type="checkbox"
                                        value="1"
                                        {{ old('blogs', $blogs ?? true) ? 'checked' : '' }}
                                        class="w-5 h-5 text-success bg-white border-primary/20 rounded focus:ring-2 focus:ring-primary transition-colors"
                                    >
                                    <label for="blogs"
                                           class="text-primary font-medium cursor-pointer whitespace-nowrap">Blogs</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input
                                        name="posts"
                                        id="posts"
                                        type="checkbox"
                                        value="1"
                                        {{ old('posts', $posts ?? true) ? 'checked' : '' }}
                                        class="w-5 h-5 text-success bg-white border-primary/20 rounded focus:ring-2 focus:ring-primary transition-colors"
                                    >
                                    <label for="posts"
                                           class="text-primary font-medium cursor-pointer whitespace-nowrap">Posts</label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                class="bg-primary hover:bg-primary/80 text-white font-semibold py-3 px-8 rounded-lg transition-colors shadow-md whitespace-nowrap"
                            >
                                Search
                            </button>
                        </div>
                    </div>

                    <!-- Tags Section -->
                    <div class="bg-white/50 p-6 rounded-lg">
                        <p class="text-primary font-semibold text-lg mb-4">Filter by Tags:</p>
                        <div class="flex flex-row gap-6 justify-around flex-wrap">
                            @foreach(Tag::where('parent_id', '=', null)->get() as $tag)
                                {!! renderTag($tag, old('tags', $tags ?? [])) !!}
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </section>
        @if($items === null)
            <div class="flex items-center justify-center min-h-80 w-full">
                <p class="text-center text-secondary text-5xl font-bold"
                   style="text-shadow: #b0d0d3 5px 5px 4px">Start Searching</p>
            </div>
        @elseif($items->isEmpty())
            <div class="flex items-center justify-center min-h-80 w-full">
                <p class="text-center text-secondary text-5xl font-bold"
                   style="text-shadow: #b0d0d3 5px 5px 4px">Nothing Found</p>
            </div>
        @else
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-700 m-4 rounded-xl">
                <x-posts-blog-grid :items="$items"/>
            </div>
        @endif
    </div>
</x-app-layout>
